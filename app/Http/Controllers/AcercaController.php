<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AcercaController extends Controller
{
    public function index()
    {
        return view('acerca');
    }
}
