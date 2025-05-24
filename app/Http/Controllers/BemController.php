<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BemController extends Controller
{
    public function index(){
        return view('bens.index');
    }
}
