<?php

namespace App\Http\Controllers;

use App\Models\Despesas;
use Carbon\Carbon;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;
use function PHPUnit\Framework\isNan;

class DespesaController extends Controller
{
    public function index()
    {
        $despesas = $this->listarDespesas();
        $soma = $this->totalDespesas();
        $despesas_agrupadas = $this->listarEAgruparDespesas();
        $mes_atual = ucfirst(Carbon::now()->monthName);
        return view('despesas.index')->with(compact('despesas', 'soma', 'despesas_agrupadas', 'mes_atual'));
    }

    public function listarDespesas($toArray = false)
    {
        $query =  Despesas::where('user_id', '=', auth()->user()->id)
            ->whereMonth('despesas.created_at', Carbon::now()->month)
            ->join('tipo_despesa', 'despesas.categoria', '=', 'tipo_despesa.id')
            ->select('despesas.*', 'tipo_despesa.descricao as tipo_despesa_descricao');

        if($toArray)
            return $query->get()->toArray();

        return $query->get();

    }

    public function listarEAgruparDespesas()
    {
        $lista_despesas_agrupadas = array();
        $despesas = $this->listarDespesas(true);

        foreach ($despesas as $key => $value){

            if(in_array($value['tipo_despesa_descricao'], array_keys($lista_despesas_agrupadas))){
                $valor = $lista_despesas_agrupadas[$value['tipo_despesa_descricao']];
                $soma = $valor + $value['valor'];
                $lista_despesas_agrupadas[$value['tipo_despesa_descricao']] = $soma;
            }else{
                $lista_despesas_agrupadas[$value['tipo_despesa_descricao']] = $value['valor'];
            }

        }
        return $lista_despesas_agrupadas;
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
