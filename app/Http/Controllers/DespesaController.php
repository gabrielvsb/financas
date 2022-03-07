<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

class DespesaController extends Controller
{
    public function index()
    {
        $despesas = $this->listarDespesas();
        $soma = $this->totalDespesas();
        return view('despesas.index')->with(compact('despesas', 'soma'));
    }

    public function listarDespesas()
    {
        return Despesas::where('user_id', '=', auth()->user()->id)->get();
    }

    public function totalDespesas()
    {
        $valor = Despesas::where('user_id', '=', auth()->user()->id)->sum('valor');
        return number_format($valor, 2, ',', '.' );
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
            $retorno['dados'] = $this->listarDespesas();
            $retorno['msg'] = 'Despesa cadastrada com sucesso!';

            return json_encode($retorno);
        }catch (Exception $e){
            return $e;
        }

    }

    public function deletar(Request $request)
    {
        try {
            Despesas::where('id', '=', $request->id)->delete();

            $retorno['success'] = true;
            $retorno['dados'] = $this->listarDespesas();
            $retorno['msg'] = 'Despesa deletada com sucesso!';

            return $retorno;

        }catch (Exception $e){
            return $e;
        }

        return $request->all();
    }

}
