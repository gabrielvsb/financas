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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#novo').on('click', function (){
            $('#modalCadastroDespesas').modal('show');
            $('#valor').mask("#.##0,00", {reverse: true});
        });

        //FORM DESPESA SALVAR
        $('form[id="teste"]').submit(function (event){
           event.preventDefault();

           $.ajax({
               url: "{{ route('despesas.cadastrar') }}",
               type: "post",
               data: $(this).serialize(),
               dataType: 'json',
               success: function (response){
                   if(response.success === true){
                       var option = listar(response.dados);
                       $('#tableDespesas').html(option);
                       $('#modalCadastroDespesas').modal('hide');
                       alert(response.msg);
                   }else{
                       $('#modalCadastroDespesas').modal('hide');
                       alert(response.msg);
                   }
               }
           })
        });
        //FIM FORM DESPESA SALVAR

        var despesa_id;

        //DELETAR DESPESA

        $('.deletarDespesa').on('click', function (){
            $('#modalDeleteDespesa').modal('show');
            despesa_id = $(this).attr('id');
        });

        $('#excluir').on('click', function (){
            $.ajax({
                url: "{{ route('despesas.deletar') }}",
                type: "post",
                data: 'id='+despesa_id,
                dataType: 'json',
                success:function (response){
                    if(response.success === true){
                        var option = listar(response.dados);
                        $('#tableDespesas').html(option);
                        $('#modalDeleteDespesa').modal('hide');
                        alert(response.msg);
                    }else{
                        $('#modalDeleteDespesa').modal('hide');
                        alert(response.msg);
                    }
                }
            });
        });
        //FIM DELETAR EMPRESA


        //FUNÇÃO PARA ATUALIZAR TABELA
        function listar(dados){
            var option = '';
            $.each(dados, function (index, value){
                option += '<tr>';
                option += '<td>'+value['id']+'</td>';
                option += '<td>'+value['descricao']+'</td>';
                option += '<td>R$'+value['valor']+'</td>';
                option += '<td>'+value['categoria']+'</td>';
                option += '<td><a href="#" class="deletarDespesa" id="'+value['id']+'" ><span><i style="color: #b63232" class="fas fa-trash"></i></span></a></td>';
                option += '</tr>';
            });
            return option;
        }
        //FIM FUNÇÃO PARA ATUALIZAR TABELA

    });
</script>
