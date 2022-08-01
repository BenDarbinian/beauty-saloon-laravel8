<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\RecordG;
use App\Models\ServiceHistory;
use Illuminate\Http\Request;

class FinalRecordGController extends Controller
{
    public function store(Request $request)
    {
        $record = new Record();
        $record->name = $request->name;
        $record->phone_number = $request->phone_number;
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
        $record->Stime = $sumMinutes;
        $record->Sprice = $sumPrice;
        $record->save();

        RecordG::where('id', $request->guestRec)->update(['status_id' => 2]);

        return [
            'message' =>  'Вы успешно записались.'
        ];

        //return redirect('/')->with('success', 'Вы успешно записались на прием.');
    }
}
