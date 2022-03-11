$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var APP_URL = window.location.origin;

    $('#novo').on('click', function (){
        $('#modalCadastroDespesas').modal('show');
        $('#valor').mask("#.##0,00", {reverse: true});

        $.ajax({
            url: APP_URL + '/tipos/buscartipos',
            type: 'get',
            success: function (response){
                var option = '<option selected>Selecione uma categoria</option>';
                $.each(response, function (index, value){
                    option += '<option value="' + value.id +'">'+ value.descricao +'</option>';
                });
                document.getElementById('categoria').innerHTML = option;
            }
        })

    });

    //FORM DESPESA SALVAR
    $('form[id="teste"]').submit(function (event){
        event.preventDefault();

        $.ajax({
            url: APP_URL + "/despesas/cadastrar",
            type: "post",
            data: $(this).serialize(),
            dataType: 'json',
            success: function (response){
                if(response.success === true){
                    location.reload();
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
            url: APP_URL + "/despesas/deletar",
            type: "post",
            data: 'id='+despesa_id,
            dataType: 'json',
            success:function (response){
                if(response.success === true){
                    location.reload();
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
