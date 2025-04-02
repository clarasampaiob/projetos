<input type="button" id="novofunc" value="Novo" class="btn btn-danger">

<div style="margin-top: 30px;" id="listafunc">
    <table id="func_table"></table>
</div>

 <div class="modal" tabindex="-1" role="dialog" id="removerfunc">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input id="func" type="hidden">
                                <p>Deseja Remover?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="javascript:removerfunc($('#func').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>

<script> 
                    $(document).ready(function(){ // estrutura de abertura do Jquery
                        
                        //Botão novo
                       $("#novofunc").click(function(){
                          window.open("/formfuncionario","_self"); 
                       });
        
        
        
                        // Table bootstrap com adição de campos
                        $("#func_table").bootstrapTable({
                            url:"<?= BASE_URL ?>/listarfuncionarios",
                            type: "get",
                           
                            columns:[{
                                        title: 'ID',
                                        field: 'id_funcionario',
                                    },{
                                        title: 'Funcionário',
                                        field: 'nome_funcionario',
                                    },{
                                        title: 'Cargo',
                                        field: 'cargo',
                                    },{
                                        title: 'E-mail',
                                        field: 'email',
                                    },
                                    {
                                        title: 'Gerenciar',
                                        formatter: alterar,
                                        field: 'id_funcionario',
                                    },
                                   
                            {
                                title: 'Remover',
                                formatter: removeformat,
                                field: 'id_funcionario'
                            }]
                        });
                        function removeformat(value){
                            return '<a href="javascript:showModalremoverfunc(' + value + ')"><span class="fa fa-trash"></span></a>';
                        }
                        
                        function alterar(value){
                            return '<a href="formfuncionario?id_funcionario=' + value + '"><span class="fa fa-pencil"></span></a>';
                        }
                        
                       
                    });
                    
                    
                    function showModalremoverfunc(id){
                        $('#func').val(id);
                        $('#removerfunc').modal('show');
                    }
                    
                    function removerfunc(id){
                        $.ajax({
                                url:"<?= BASE_URL ?>/removerfunc", //Nome Função -> vai imprimir o localhost:8000 e a função
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: {id_funcionario: id}, 
                                success: function (data, textStatus, jqXHR) { 
                                    $("#removerfunc").modal("hide");
                                    if(data.statusresponse == 'OK'){
                                        alert("Removido com Sucesso");
                                    }else{
                                        alert("Erro ao remover os");
                                    }
                                    
                                    $("#func_table").bootstrapTable('refresh');
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            });  
                    }
                   
</script>

