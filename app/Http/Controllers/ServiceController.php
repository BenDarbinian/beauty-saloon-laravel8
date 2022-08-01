<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Category;

class ServiceController extends Controller
{
    public function index()
    {
        $services = new Service();
        return view('welcome', ['services' => $services->orderBy('price')->get()],  ['categories' => Category::get()]);
    }
}
