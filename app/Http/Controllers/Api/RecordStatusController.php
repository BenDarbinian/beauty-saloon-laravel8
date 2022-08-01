<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Record;
use Illuminate\Http\Request;

class RecordStatusController extends Controller
{

    public function index()
    {
        return Record::with(['status','servicehistory'])->get();

        //return view('record.create');
    }
    public function status(Request $request)
    {
        Record::where('id', $request->recordId)->update(['status_id'=> $request->statusValue]);
        return [
            'message' =>  'Вы успешно изменили статус записи.'
        ];
    }
}
