<?php

namespace App\Http\Controllers;

use App\Models\RecordG;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RecordGController extends Controller
{
    public function create()
    {
        return view('record_guest.create');
    }

    public function store()
    {
        request()->validate([
            'name' => 'max:15|min:2',
            'phone_number' => Rule::unique('users', 'phone_number')
        ]);
        $recordg = new RecordG;
        $recordg->name = request()->name;
        $recordg->phone_number = request()->phone_number;
        $recordg->status_id = 1;
        $recordg->save();

        return redirect('/')->with('success', 'Вы успешно записались, скоро вам позвонит оператор');
    }
}
