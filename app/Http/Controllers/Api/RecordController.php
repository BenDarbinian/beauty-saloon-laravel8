<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecordCollection;
use App\Models\Category;
use App\Models\Record;
use App\Models\Service;
use App\Models\ServiceHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function index()
    {
        return RecordCollection::collection(Record::where(
            'status_id','<>', 4
        )->get());


        //return view('record.create');
    }
    public function store(Request $request)
    {
        $record = new Record;
        $record->user_id = Auth::user()->id;
        $record->name = Auth::user()->name;
        $record->phone_number = Auth::user()->phone_number;
        $record->time = $request->time;
        $record->date = $request->date;
        $record->status_id = 1;
        $record->save();
        $sumPrice = 0;
        $sumMinutes = 0;
        foreach ($request->checkedNames as $service) {
            $serHis = new ServiceHistory;
            $serHis->record_id = $record->id;
            $serHis->service_id = $service;
            $serHis->save();
            $sumPrice += $serHis->Service->price;
            $sumMinutes += $serHis->Service->time;
        }
        $record->sTime = $sumMinutes;
        $record->sPrice = $sumPrice;
        $record->save();

        return [
            'message' =>  'Вы успешно записались.'
        ];

        //return redirect('/')->with('success', 'Вы успешно записались на прием.');
    }
}
