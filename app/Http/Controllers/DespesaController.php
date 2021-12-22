<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class DespesaController extends Controller
{
    public function index()
    {
        $despesas = Despesas::where('user_id', '=', auth()->user()->id)->get();
        return view('despesas.index')->with(compact('despesas'));
    }

    public function cadastrar(Request $request)
    {
        try {

            Despesas::create([
                'user_id' => auth()->user()->id,
                'descricao' => $request->descricao,
                'valor' => floatval(str_replace(',', '.', str_replace('.', '', $request->valor))),
                'categoria' => $request->categoria
            ]);

            $retorno['success'] = true;
            $retorno['msg'] = 'Despesa cadastrada com sucesso!';

            return json_encode($retorno);
        }catch (Exception $e){
            return $e;
        }

    }
}
