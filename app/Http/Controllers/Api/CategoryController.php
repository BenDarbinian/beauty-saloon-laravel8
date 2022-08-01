<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {       
        // dd(Auth::user());
            return Category::select(['id','name'])->get();
            
            
            //return view('record.create');
    }
}
