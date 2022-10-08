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
        return view('auth.recordg');
    }

    public function store(Request $request)
    {
        request()->validate([
            'name' => ['max:15', 'string', 'min:2'],
            'phone_number' => ['min:18', Rule::unique('users', 'phone_number')]
        ], [
            'name.min' => 'Длина имени не должна быть меньше :min символов.',
            'name.max' => 'Длина имени не должна превышать :max символов.',
            'phone_number.min' => 'Указан неполный номер телефона.',
            'phone_number.unique' => 'Указанный номер телефона зарегистрирован.'
        ]);
        $recordg = new RecordG;
        $recordg->name = $request->name;
        $recordg->phone_number = $request->phone_number;
        $recordg->status_id = 1;
        $recordg->save();

        return redirect('/')->with('success', 'Вы успешно записались, скоро вам позвонит оператор');
    }
}
