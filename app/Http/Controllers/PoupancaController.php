<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PoupancaController extends Controller
{
    public function index()
    {
        return view('poupanca.index');
    }
}
