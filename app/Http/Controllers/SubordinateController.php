<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubordinateController extends Controller
{
    //
    public function index(){
        return view('subordinates.subordinate');
    }
}
