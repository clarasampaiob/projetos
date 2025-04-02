

		<center><h3 style="margin-left:20px;"><i><b>
                                <font color='#E11F1F' size='5'> Atividade do Pedido </font><br><br>
		</b></i></h3></center>

                    <form name="pedidoatividade" method="get" action="" id="formPedAtv">
                        
                        
                        <input type="hidden" name="id_list_ped" id="id_list_ped" value="<?php if(isset($lstped))echo $lstped['id_list_ped']; ?>">
                       
                <div class="panel-body">
                     <div class="col-lg-4">
                        <label> Status: </label>
                        <select class="form-control" name="id_status" id="id_status">
                                <option></option>
                                    <?php if(isset($status)){
                                        foreach ($status as $st){ ?>
                                        <option <?php if(isset($lstped) && $lstped['id_status'] == $st['id_status']) echo "selected";  ?> value="<?= $st['id_status'] ?>"> <?= $st['nome_status'] ?> </option> 
                                    <?php }} ?>
                            </select>
                     </div>
                            
                            
                            

                        <div class="col-lg-4">		
                     <label> OS: </label> 
                       
                     <input class="form-control" type="text" name="id_ordem_servico" id="id_ordem_servico" value=" <?php if(isset($lstped)) echo $lstped['id_ordem_servico'];  ?>" ><!-- fazer inner join e vir automático-->
                        </div>
                            
                            
                            
                        <div class="col-lg-4">
			<label> Atividade: </label>
                        <select class="form-control" name="id_atividade" id="id_atividade">
                                <option></option>
                                    <?php if(isset($atv)){
                                        foreach ($atv as $at){ ?>
                                        <option <?php if(isset($lstped) && $lstped['id_atividade'] == $at['id_atividade']) echo "selected";  ?> value="<?= $at['id_atividade'] ?>"> <?= $at['nome_atividade'] ?> </option> 
                                    <?php }} ?>
                        </select><br><br> <!--  vir automático-->
                        </div>
                            
                            
                            
                            
                        <!-- Data Abertura da Lista na OS: Não aparece na Tela -->
                        <input type="hidden" value="<?= date('Y-m-d H:i') ?>" name="data_abertura" id="data_abertura"> 
                        
                        
                        <div class="col-lg-4" >
			<label> Tempo (Minutos): </label>
                        <input class="form-control" type="text" name="temp_min" id="temp_min" value=" <?php if(isset($lstped)) echo $lstped['temp_min'];  ?>" ><br>
                        </div>
                        
                        
                        <div class="col-lg-4" >
			<label> Valor Hora: </label>
				<input class="form-control" type="text" name="valorhora" id="valorhora" value=" <?php if(isset($lstped)) echo $lstped['valor_hora'];  ?>" ><br>
                        </div>     
                                
                                
                        <div class="col-lg-4" >
			<label> Valor Total: </label>
                        <input class="form-control" type="text" name="valor_tot" id="valor_tot" readonly="" value=" <?php if(isset($lstped)) echo $lstped['valor_tot'];  ?>" ><br><br>
                        </div>       
                              
                        <div class="col-lg-11">
			<label> Funcionários: </label>
                            <select class="form-control" name="id_funcionario" id="id_funcionario">
                                <option></option>
                                    <?php if(isset($funcionario)){
                                        foreach ($funcionario as $fun){ ?>
                                        <option value="<?= $fun['id_funcionario'] ?>"> <?= $fun['nome_funcionario'] ?> </option> 
                                    <?php }} ?>
                            </select></div>
                        <div class="col-lg-1">
                        <input style= "margin-top:30px" class="btn btn-danger" type="button" id="escolher" name="escolher" value="Add">
                        <br><br></div>
                            <div class="col-lg-12" style="margin-bottom:50px">
                            <div class="table-responsive" id="listfunc" style="width:100%"> 
                                <table id="tablefunc"> </table> 
                            </div></div>
                            
                            
                            
                        <div class="col-lg-11">
			<label> Peças: </label>
                        <select class="form-control" name="id_peca" id="id_peca">
                                <option></option>
                                    <?php if(isset($peca)){
                                        foreach ($peca as $pc){ ?>
                                        <option value="<?= $pc['id_peca'] ?>"> <?= $pc['nome_peca'] ?> </option> 
                                    <?php }} ?>
                        </select></div>
                        <div class="col-lg-1">
                        <input style= "margin-top:30px" class="btn btn-danger" type="button" id="selecionar" name="selecionar" value="Add">
                        <br><br></div>
                            
                        <div class="col-lg-12" style="margin-bottom:50px">     
                        <div class="table-responsive"  id="listpeca" style="width:100%"> 
                                <table id="tablepeca"> </table> 
                        </div></div>
                            
                            
                            
                            <div class="col-lg-12" >
			<label> Conclusão: </label>
                        <input class="form-control" type="datetime-local" name="conclusao" id="conclusao" value="<?php if(isset($lstped) && $lstped['conclusao'] != '')echo date('Y-m-d\TH:i',strtotime( $lstped['conclusao'])); ?>"><br>
                            </div>      
                                
                                
                                
                        
 </div>
                        <div class="col-lg-6">
                       <input class="btn btn-danger" type="button" id="salvar" value="Salvar" class="btn btn-primary"><br><br><br><br>
                        </div>
		</form>



                     <!-- Modal Bootstrap (Caixa de Diálogo) -->
                <div class="modal" tabindex="-1" role="dialog" id="removerfunclst">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                    </div>
                                    <div class="modal-body">
                                        <input id="funcionario" type="hidden">
                                        <p>Deseja Remover?</p>
                                    </div>
                                    <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="javascript:removerfunclst($('#funcionario').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>

                     
                     
                 <!-- Modal Bootstrap (Caixa de Diálogo) -->
                <div class="modal" tabindex="-1" role="dialog" id="removerpecalst">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Mensagem</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                    </div>
                                    <div class="modal-body">
                                        <input id="peca" type="hidden">
                                        <p>Deseja Remover?</p>
                                    </div>
                                    <div class="modal-footer">
                                <button type="button" class="btn btn-primary" onclick="javascript:removerpecalst($('#peca').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>     
                

                     <script>
                    $(document).ready(function(){ // estrutura de abertura do Jquery
                        
                            // Table bootstrap com adição de campos
                            $("#tablefunc").bootstrapTable({
                                url:"<?= BASE_URL ?>/listarfuncpedido",
                                type: "get",
                                queryParams: function(p){
                                    return{
                                        //envia pro servidor pra ser pego na função no model
                                        idlistaped: $("#id_list_ped").val()
                                    }},
                                columns:[{
                                        title:'FUNCIONÁRIOS',
                                        field: 'nome_funcionario'
                                },{
                                    title: 'REMOVER',
                                    formatter: removeformat,
                                    field: 'id_pedido_func'
                                }]
                            
                            });
                            
                            
                            // Table bootstrap com adição de campos
                            $("#tablepeca").bootstrapTable({
                                url:"<?= BASE_URL ?>/listarpecapedido",
                                type: "get",
                                queryParams: function(p){
                                    return{
                                        //envia pro servidor pra ser pego na função no model
                                        idlist: $("#id_list_ped").val()
                                    }},
                                columns:[{
                                        title:'PEÇAS',
                                        field: 'nome_peca'
                                },{
                                    title: 'REMOVER',
                                    formatter: removepecaformat,
                                    field: 'id_peca_pedido'
                                }]
                            
                            });
                            
                            
                            
                            
                           



                            // Salvar Insert dos Funcionários
                            $("#escolher").click(function(){
                           $.ajax({
                                url:"<?= BASE_URL ?>/salvarFunc", //Nome Função -> vai imprimir o localhost:8000 e a função
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: {
                                   id_list_ped:$("#id_list_ped").val(),
                                   id_funcionario:$("#id_funcionario").val(),
                                },
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    $("#tablefunc").bootstrapTable("refresh");
                                    if(data.statusresponse == 'OK'){
                                        var listfuncionario = $("#tablefunc").bootstrapTable('getData');
                                        console.log(listfuncionario);
                                        for(i=0;i < listfuncionario.length; i++) {
                                        }
                                        
                                    }else{
                                        alert("Erro");
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            }); 
                        });
                        
                        
                        
                        // Salvar Insert das Peças
                            $("#selecionar").click(function(){
                           $.ajax({
                                url:"<?= BASE_URL ?>/salvarpecalista", //Nome Função -> vai imprimir o localhost:8000 e a função
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: {
                                   id_list_ped:$("#id_list_ped").val(),
                                   id_peca:$("#id_peca").val(),
                                },
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    $("#tablepeca").bootstrapTable("refresh");
                                    if(data.statusresponse == 'OK'){
                                        
                                       
                                        
                                    }else{
                                        alert("Erro");
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            }); 
                        });
                        
                        
                        
                        
                        
                        
                        // Botão Salvar                        
                        $("#salvar").click(function(){
                           $.ajax({
                                url:"<?= BASE_URL ?>/salvarpedatv", //Nome Função -> vai imprimir o localhost:8000 e a função
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: $("#formPedAtv").serialize(), //o serialize vai pegar todos os names do formulario e enviar pra função (pra URL)
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    if(data.statusresponse == 'OK'){
                                        $("#id_list_ped").val(data.id_list_ped);
                                        alert("Salvo com Sucesso");
                                        $.ajax({
                                            url:"<?= BASE_URL ?>/concluirOs", //Nome Função -> vai imprimir o localhost:8000 e a função
                                            type:"GET", // Tipo
                                            dataType:"json", // Tipo de Retorno esperado do Servidor
                                            data: {
                                                id_ordem_servico: $("#id_ordem_servico").val(),
                                                conclusao: $("#conclusao").val()
                                            }, //o serialize vai pegar todos os names do formulario e enviar pra função (pra URL)
                                            success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                            },
                                            error: function (jqXHR, textStatus, errorThrown) {
                        
                    }
                                            });
                                    }else{
                                        alert("Erro");
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro");
                                }
                            }); 
                        });
                        
                        
                        
                    });
                    
                     function showModalremoverfunclst(id){
                                $('#funcionario').val(id);
                                $('#removerfunclst').modal('show');
                            }
                            
                            
                     function showModalremoverpecalst(id){
                                $('#peca').val(id);
                                $('#removerpecalst').modal('show');
                            }
                            
                            
                            
                            function removeformat(value){
                            return '<a href="javascript:showModalremoverfunclst(' + value + ')"><span class="fa fa-trash"></span></a>';
                            }
                            
                            
                            function removepecaformat(value){
                            return '<a href="javascript:showModalremoverpecalst(' + value + ')"><span class="fa fa-trash"></span></a>';
                            }
                            
                            
                            
                            
                            
                            
                            
                            function removerfunclst(id){
                                $.ajax({
                                        url:"<?= BASE_URL ?>/removerfunclst", //Nome Função -> vai imprimir o localhost:8000 e a função
                                        type:"GET", // Tipo
                                        dataType:"json", // Tipo de Retorno esperado do Servidor
                                        data: {id_pedido_func: id}, 
                                        success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                            $("#removerfunclst").modal("hide");
                                            if(data.statusresponse == 'OK'){
                                                alert("Removido com Sucesso");
                                            }else{
                                                alert("Erro ao remover pedido");
                                            }

                                            $("#tablefunc").bootstrapTable('refresh');
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            console.log(errorThrown);
                                            alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                        }
                                    });  
                            }
                     
                     
                     
                     
                            function removerpecalst(id){
                                $.ajax({
                                        url:"<?= BASE_URL ?>/removerpecalst", //Nome Função -> vai imprimir o localhost:8000 e a função
                                        type:"GET", // Tipo
                                        dataType:"json", // Tipo de Retorno esperado do Servidor
                                        data: {id_peca_pedido: id}, 
                                        success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                            $("#removerpecalst").modal("hide");
                                            if(data.statusresponse == 'OK'){
                                                alert("Removido com Sucesso");
                                            }else{
                                                alert("Erro ao remover pedido");
                                            }

                                            $("#tablepeca").bootstrapTable('refresh');
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            console.log(errorThrown);
                                            alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                        }
                                    });  
                            }
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     
                     </script>