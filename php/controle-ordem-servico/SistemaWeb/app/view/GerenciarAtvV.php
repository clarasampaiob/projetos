
<input type="hidden"  id="id_ordem_servico" value="<?php if(isset($ordserv))echo $ordserv; ?>">
<div style="margin-top: 30px;" id="listapedatv">
    <table id="pedido_atv"></table>
</div>

 <div class="modal" tabindex="-1" role="dialog" id="removerpedatv">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input id="pdatv" type="hidden">
                                <p>Deseja Remover?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="javascript:removerpedatv($('#pdatv').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>


<script> 
                    $(document).ready(function(){ // estrutura de abertura do Jquery
                        
                        // Table bootstrap com adição de campos
                        $("#pedido_atv").bootstrapTable({
                            url:"<?= BASE_URL ?>/listarpedatv",
                            type: "get",
                            queryParams: function(p){
                                return{
                                    idOs : $('#id_ordem_servico').val() //passado para enviar esse valor para a proxima página
                                }},
                            columns:[{
                                        title: 'OS',
                                        field: 'id_ordem_servico',
                                    },{
                                        title: 'Data',
                                        field: 'data_abertura',
                                    },
                                    {
                                        title: 'Status',
                                        field: 'nome_status',
                                    },{
                                        title: 'Atividade',
                                        field: 'nome_atividade',
                                    },
                                    {
                                        title: 'Gerenciar',
                                        formatter: alterar,
                                        field: 'id_list_ped',
                                    },
                                   
                            {
                                title: 'Remover',
                                formatter: removeformat,
                                field: 'id_list_ped'
                            }]
                        });
                        function removeformat(value){
                            return '<a href="javascript:showModalremoverpedatv(' + value + ')"><span class="fa fa-trash"></span></a>';
                        }
                        
                        function alterar(value){
                            return '<a href="formatv?id_list_ped=' + value + '"><span class="fa fa-pencil"></span></a>';
                        }
                        
             
                    });
                    
                    
                    function showModalremoverpedatv(id){
                        $('#pdatv').val(id);
                        $('#removerpedatv').modal('show');
                    }
                    
                    function removerpedatv(id){
                        $.ajax({
                                url:"<?= BASE_URL ?>/removerpedatv", 
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: {id_list_ped: id}, 
                                success: function (data, textStatus, jqXHR) { 
                                    $("#removerpedatv").modal("hide");
                                    if(data.statusresponse == 'OK'){
                                        alert("Removido com Sucesso");
                                    }else{
                                        alert("Erro ao remover os");
                                    }
                                    
                                    $("#pedido_atv").bootstrapTable('refresh');
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            });  
                    }
                   
</script>
