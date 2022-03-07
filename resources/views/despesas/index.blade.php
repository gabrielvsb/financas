@extends('layouts.master')

@section('content')

    <div class="d-flex justify-content-between">
        <div class="ml-2 mt-4">
            <button class="btn btn-primary" id="novo">Novo</button>
        </div>

        <div class="ml-2 mt-4 mr-2">
            @if($soma)
                <h5>Total R$ <span id="total-despesas">{{ $soma }}</span></h5>
            @endif
        </div>
    </div>

    <div style="margin: 20px">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Descrição</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody id="tableDespesas">
                @foreach($despesas as $despesa)
                    <tr>
                        <th scope="row">{{$despesa['id']}}</th>
                        <td>{{$despesa['descricao']}}</td>
                        <td>R$ {{$despesa['valor']}}</td>
                        <td>{{$despesa['categoria']}}</td>
                        <td><a href="#" class="deletarDespesa" id="{{$despesa['id']}}"><span><i style="color: #b63232" class="fas fa-trash"></i></span></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop

@include('despesas.modalCadastro')
@include('despesas.modalDelete')



