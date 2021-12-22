@extends('layouts.master')

@section('content')

    <div class="d-flex justify-content-between">
        <div class="ml-2 mt-4">
            <button class="btn btn-primary" id="novo">Novo</button>
        </div>
        <div class="ml-2 mt-4 mr-2">
            <h5>Total: R$ 30,00</h5>
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
            <tbody>
                @foreach($despesas as $despesa)
                    <tr>
                        <th scope="row">{{$despesa['id']}}</th>
                        <td>{{$despesa['descricao']}}</td>
                        <td>R$ {{$despesa['valor']}}</td>
                        <td>{{$despesa['categoria']}}</td>
                        <td></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@stop
@include('despesas.modalCadastro')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function(){
        $('#novo').on('click', function (){
            $('#modalCadastroDespesas').modal('show');
            $('#valor').mask("#.##0,00", {reverse: true});
        });

        $('form[id="teste"]').submit(function (event){
           event.preventDefault();

           $.ajax({
               url: "{{ route('despesas.cadastrar') }}",
               type: "post",
               data: $(this).serialize(),
               dataType: 'json',
               success: function (response){
                   if(response.success === true){
                       $('#modalCadastroDespesas').modal('hide');
                       alert(response.msg);
                   }else{
                       $('#modalCadastroDespesas').modal('hide');
                       alert(response.msg);
                   }
               }
           })
        });
    });
</script>
