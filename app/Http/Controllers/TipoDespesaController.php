<?php

namespace App\Http\Controllers;

use App\Models\TipoDespesa;
use Illuminate\Http\Request;

class TipoDespesaController extends Controller
{
    public static function buscarTipos(){
        return TipoDespesa::where('ativo', '=', 1)->orderBy('descricao')->get();
    }
}
