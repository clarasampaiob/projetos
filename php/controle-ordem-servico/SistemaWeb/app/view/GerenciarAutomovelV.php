

<input type="button" id="novoauto" value="Novo" class="btn btn-danger">

<div style="margin-top: 30px;" id="listaauto">
    <table id="automovel_table"></table>
</div>

 <div class="modal" tabindex="-1" role="dialog" id="removerauto">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input id="automovel" type="hidden">
                                <p>Deseja Remover?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="javascript:removerauto($('#automovel').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>

<script> 
                    $(document).ready(function(){ // estrutura de abertura do Jquery
                        
                       
                       //Botão novo
                       $("#novoauto").click(function(){
                          window.open("/formauto","_self"); 
                       });
        
        
        
        
        
        
                        // Table bootstrap com adição de campos
                        $("#automovel_table").bootstrapTable({
                            url:"<?= BASE_URL ?>/listarautos",
                            type: "get",
                            columns:[{
                                    title:'ID',
                                    field: 'id_automovel'
                                    },{
                                     title:'Cliente',
                                     field: 'nome_cliente',
                                    },
                                    {
                                     title:'Automóvel',
                                     field: 'modelo',
                                    },{
                                       title:'Marca',
                                       field: 'marca',
                                    },{
                                        title: 'Cor',
                                        field: 'cor',
                                    },{
                                        title: 'Ano',
                                        field: 'ano',
                                    },
                                    {
                                        title: 'Gerenciar',
                                        formatter: alterar,
                                        field: 'id_automovel',
                                    },
                                   
                            {
                                title: 'Remover',
                                formatter: removeformat,
                                field: 'id_automovel'
                            }]
                        });
                        function removeformat(value){
                            return '<a href="javascript:showModalremoverauto(' + value + ')"><span class="fa fa-trash"></span></a>';
                        }
                        
                        
                        function alterar(value){
                            return '<a href="formauto?id_automovel=' + value + '"><span class="fa fa-pencil"></span></a>';
                        }
                        
             
                    });
                    
                    
                    function showModalremoverauto(id){
                        $('#automovel').val(id);
                        $('#removerauto').modal('show');
                    }
                    
                    function removerauto(id){
                        $.ajax({
                                url:"<?= BASE_URL ?>/removerauto", 
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: {id_automovel: id}, 
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    $("#removerauto").modal("hide");
                                    if(data.statusresponse == 'OK'){
                                        alert("Removido com Sucesso");
                                    }else{
                                        alert("Erro ao remover os");
                                    }
                                    
                                    $("#automovel_table").bootstrapTable('refresh');
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            });  
                    }
                   
</script>

