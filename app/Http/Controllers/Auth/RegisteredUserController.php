<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'min:2', 'max:15'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', 'max:255', Rules\Password::defaults()],
            'phone_number' => ['required', 'min:18', Rule::unique('users', 'phone_number')],
        ], [
            'name.required' => 'Поле "Имя" не заполнено.',
            'name.min' => 'Длина имени не должна быть меньше :min символов.',
            'name.max' => 'Длина имени не должна превышать :max символов.',
            'email.required' => 'Поле "Почта" не заполнено.',
            'email.email' => 'Ввод не является электронной почтой.',
            'email.max' => 'Длина почты не должна превышать :max символов.',
            'email.unique' => 'Указанная электронная почта занята.',
            'password.required' => 'Поле "Пароль" не заполнено.',
            'password.min' => 'Пароль не должен быть меньше :min символов.',
            'password.max' => 'Пароль не должен быть больше :max символов.',
            'password.confirmed' => 'Подтверждение пароля не совпадает.',
            'phone_number.required' => 'Поле "Номер телефона" не заполнено.',
            'phone_number.min' => 'Указан неполный номер телефона.',
            'phone_number.unique' => 'Указанный номер телефона занят.'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('success', 'Вы успешно зарегистрировались.');;
    }
}
