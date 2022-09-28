<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }
    public function store()
    {
        $attributes = request()->validate([
            'name' => 'max:15|min:2',
            'phone_number' => Rule::unique('users','phone_number'),
            'email' => ['max:255','email', Rule::unique('users','email')],
            'password' => 'min:6|confirmed',
        ]);
        $user = User::create($attributes);
        
        
        auth()->login($user);

        return redirect('/')->with('success', 'Вы успешно зарегистрировались.');
    }
}
