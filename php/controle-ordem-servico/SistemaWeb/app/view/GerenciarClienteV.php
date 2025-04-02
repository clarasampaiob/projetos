

<input type="button" id="novocli" value="Novo" class="btn btn-danger">
<input type="hidden"  id="id_cliente" value="<?php if(isset($cliente))echo $cliente; ?>">
<div style="margin-top: 30px;" id="cliente">
    <table id="cliente_table"></table>
</div>

 <div class="modal" tabindex="-1" role="dialog" id="removercli">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input id="cli" type="hidden">
                                <p>Deseja Remover?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="javascript:removercli($('#cli').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>


<script> 
                    $(document).ready(function(){ // estrutura de abertura do Jquery
                        
                        //Botão novo
                       $("#novocli").click(function(){
                          window.open("/cadastrarcli","_self"); 
                       });
        
        
        
                        // Table bootstrap com adição de campos
                        $("#cliente_table").bootstrapTable({
                            url:"<?= BASE_URL ?>/listarcli",
                            type: "get",
                           
                            columns:[{
                                        title: 'ID',
                                        field: 'id_cliente',
                                    },{
                                        title: 'Cliente',
                                        field: 'nome_cliente',
                                    },{
                                        title: 'E-mail',
                                        field: 'email',
                                    },
                                    {
                                        title: 'Gerenciar',
                                        formatter: alterar,
                                        field: 'id_cliente',
                                    },
                                   
                            {
                                title: 'Remover',
                                formatter: removeformat,
                                field: 'id_cliente'
                            }]
                        });
                        function removeformat(value){
                            return '<a href="javascript:showModalremovercli(' + value + ')"><span class="fa fa-trash"></span></a>';
                        }
                        
                        function alterar(value){
                            return '<a href="formcli?id_cliente=' + value + '"><span class="fa fa-pencil"></span></a>';
                        }
                        
                       
                    });
                    
                    
                    function showModalremovercli(id){
                        $('#cli').val(id);
                        $('#removercli').modal('show');
                    }
                    
                    function removercli(id){
                        $.ajax({
                                url:"<?= BASE_URL ?>/removercli", 
                                type:"GET", // Tipo
                                dataType:"json", 
                                data: {id_cliente: id}, 
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    $("#removercli").modal("hide");
                                    if(data.statusresponse == 'OK'){
                                        alert("Removido com Sucesso");
                                    }else{
                                        alert("Erro ao remover os");
                                    }
                                    
                                    $("#cliente_table").bootstrapTable('refresh');
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            });  
                    }
                   
</script>

