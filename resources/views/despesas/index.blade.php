@extends('layouts.master')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@section('content')

    <div class="row">
        <div class="col" style="margin-left: 20px; margin-top: 20px">
            <h3>{{ $mes_atual }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col" style="margin-left: 20px">
            <div class="card" style="max-height: 450px; height: 450px">
                <div class="card-header d-flex justify-content-between">
                    <div class="ml-2 mt-2">
                        <button class="btn btn-sm btn-primary" id="novo">Novo</button>
                    </div>
                    <div class="ml-2 mt-2 mr-2">
                        @if($soma)
                            <p>Total R$ <span id="total-despesas">{{ $soma }}</span></p>
                        @endif
                    </div>
                </div>

                <div class="card-body" style="overflow: scroll">
                    <table class="table table-striped" >
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
                                <td>{{$despesa['tipo_despesa_descricao']}}</td>
                                <td><a href="#" class="deletarDespesa" id="{{$despesa['id']}}"><span><i
                                                style="color: #b63232" class="fas fa-trash"></i></span></a></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="col" style="margin-right: 20px">
            <div class="card" style="max-height: 450px; height: 450px">
                <div class="card-header">
                    Gráfico
                </div>
                <div class="card-body">
                    <div>
                        <canvas id="myChart" width="400" height="360"></canvas>

                    </div>

                </div>
            </div>
        </div>
    </div>

@stop

@include('despesas.modalCadastro')
@include('despesas.modalDelete')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script>
    window.onload = function() {
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json(array_keys($despesas_agrupadas)),
                datasets: [{
                    label: 'Valor total',
                    data: @json($despesas_agrupadas),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    }

</script>


