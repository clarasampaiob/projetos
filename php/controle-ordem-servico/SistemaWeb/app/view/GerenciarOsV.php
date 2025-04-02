


<input type="button" id="novaos" value="Novo" class="btn btn-danger">

<div style="margin-top: 30px;" id="listaOs">
    <table id="ordem_servico"></table>
</div>

 <div class="modal" tabindex="-1" role="dialog" id="removeros">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input id="problema" type="hidden">
                                <p>Deseja Remover?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="javascript:removeros($('#problema').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>





<script> 
                    $(document).ready(function(){ // estrutura de abertura do Jquery
                        
                       
                       //Botão novo
                       $("#novaos").click(function(){
                          window.open("/formOs","_self"); 
                       });
                       
                       
        
        
        
        
        
        
                        // Table bootstrap com adição de campos
                        $("#ordem_servico").bootstrapTable({
                            url:"<?= BASE_URL ?>/listarOs",
                            type: "get",
                            columns:[{
                                    title:'OS',
                                    field: 'id_ordem_servico'
                                    },{
                                     title:'Cliente',
                                     field: 'nome_cliente',
                                    },{
                                     title:'Status',
                                     field: 'nome_status',
                                    },
                                    {
                                       title:'Data',
                                       field: 'data_agendamento',
                                    },{
                                        title: 'Pedido',
                    formatter: verped,
                    field: 'id_ordem_servico',
                }, {
                    title: 'Gerenciar',
                    formatter: alterar,
                    field: 'id_ordem_servico',
                },

                {
                    title: 'Remover',
                    formatter: removeformat,
                    field: 'id_ordem_servico'
                }]
        });
        function removeformat(value) {
            return '<a href="javascript:showModalremoveros(' + value + ')"><span class="fa fa-trash"></span></a>';
        }

        function verped(value) {
            return '<a href="gerenciaratv?id_ordem_servico=' + value + '"><span class="fa fa-search"></span></a>';
        }

        function alterar(value) {
            return '<a href="formOs?id_ordem_servico=' + value + '"><span class="fa fa-pencil"></span></a>';
        }


    });


    function showModalremoveros(id) {
        $('#problema').val(id);
        $('#removeros').modal('show');
    }

    function removeros(id) {
        $.ajax({
            url: "<?= BASE_URL ?>/removeros", 
            type: "GET", // Tipo
            dataType: "json", // Tipo de Retorno esperado do Servidor
            data: {id_ordem_servico: id}, 
            success: function (data, textStatus, jqXHR) { 
                $("#removeros").modal("hide");
                if (data.statusresponse == 'OK') {
                    alert("Removido com Sucesso");
                } else {
                    alert("Erro ao remover os");
                }

                $("#ordem_servico").bootstrapTable('refresh');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(errorThrown);
                alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
            }
        });
    }

</script>