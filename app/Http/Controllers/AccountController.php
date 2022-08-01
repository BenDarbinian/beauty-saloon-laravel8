<?php

namespace App\Http\Controllers;

use App\Models\Record;
use App\Models\ServiceHistory;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function account()
    {
        return view('account', ['serHistories' => ServiceHistory::get()],  ['records' => Record::where('user_id', '=', Auth::user()->id)->get()], ['statuses' => Status::get()]);
    }
}
