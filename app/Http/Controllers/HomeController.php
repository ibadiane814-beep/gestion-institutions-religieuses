<?php

namespace App\Http\Controllers;

use App\Models\Institution;

class HomeController extends Controller
{
    public function index()
    {
        $institutions = Institution::all();
        return view('home.index', compact('institutions'));
    }
}
