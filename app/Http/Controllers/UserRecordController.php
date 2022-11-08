<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecordCollection;
use App\Models\Record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserRecordController extends Controller
{
    public function index()
    {
        return  Record::where('user_id', '=', Auth::user()->id)
            ->with(['servicehistory.service.category', 'status'])
            ->get();
    }
}
