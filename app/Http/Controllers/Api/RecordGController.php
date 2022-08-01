<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\RecordG;
use Illuminate\Http\Request;

class RecordGController extends Controller
{
    public function index()
    {
        return RecordG::with('status')->get();


        //return view('record.create');
    }

    public function status(Request $request)
    {
        RecordG::where('id', $request->recordgId)->update(['status_id' => 4]);
        return [
            'message' =>  'Вы успешно изменили статус записи.'
        ];
    }
}
