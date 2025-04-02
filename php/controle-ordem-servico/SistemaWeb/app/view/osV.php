
            
            

		<center><h3 style="margin-left:20px;"><i><b>
                                <font color='#E11F1F' size='5'> Ordem de Serviço </font><br><br>
		</b></i></h3></center>


                <form name="ordemservico" method="get" action="" id="formOs">
                    
                    
                    <input type="hidden" name="id_ordem_servico" id="id_ordem_servico" value="<?php if(isset($ordserv))echo $ordserv['id_ordem_servico']; ?>">

                   <div class="panel-body">
                    <div class="col-lg-3" >
                    <label> Status: </label>
                    <select class="form-control" id="id_status" name="id_status">
                            <option></option>
                                <?php if(isset($status)){
                                    foreach ($status as $st){ ?>
                                    <option <?php if(isset($ordserv) && $ordserv['id_status'] == $st['id_status']) echo "selected";  ?> value="<?= $st['id_status'] ?>"> <?= $st['nome_status'] ?> </option> 
                                <?php }} ?>
                        </select><br>
                    </div>


                       <div class="col-lg-3" >
                    <label> Cliente: </label>
                    <select class="form-control" id="id_cliente" name="id_cliente"> 
                            <option></option> 
                                <?php if(isset($clientes)){
                                        foreach($clientes as $cli){ ?>
                                        <option <?php if(isset($ordserv) && $ordserv['id_cliente'] == $cli['id_cliente']) echo "selected";  ?>  value="<?= $cli['id_cliente'] ?>"> <?= $cli['nome_cliente'] ?> </option>
                                <?php }} ?>
                        </select><br>
                       </div>



                       <div class="col-lg-3" >
                    <label> Automóvel: </label>
                    <select class="form-control" id="id_automovel" name="id_automovel">
                            <option></option>
                                <?php if(isset($automovel)){
                                    foreach($automovel as $autom){ ?>
                                    <option <?php if(isset($ordserv) && $ordserv['id_automovel'] == $autom['id_automovel']) echo "selected";  ?> value="<?= $autom['id_automovel'] ?>"> <?= $autom['modelo'].' '.$autom['marca'] ?> </option>
                                <?php }} ?>
                        </select><br>
                       </div>





                    <!-- Data Abertura OS: Não aparece na Tela -->
                    <input type="hidden" value="<?= date('Y-m-d H:i') ?>" name="data_abertura" id="data_abertura">    

                    <div class="col-lg-3" >
                    <label> Data Agendamento: </label>
                    <input class="form-control" type="datetime-local" name="data_agendamento" id="data_agendamento" value="<?php if(isset($ordserv) && $ordserv['data_agendamento'] != '')echo date('Y-m-d\TH:i',strtotime( $ordserv['data_agendamento'])); ?>"><br>
                    </div>    


                    <div class="col-lg-12">
                        <input type="button" id="salvar" value="Salvar" class="btn btn-danger"><br><br><br><br>
              </div>

                    <div class="col-lg-11">
                    <label> Problemas: </label>
                    <select class="form-control" name="id_list_ped" id="id_list_ped">
                        <option></option>
                         <?php if(isset($atv)){
                                    foreach($atv as $list){ ?>
                                    <option value="<?= $list['id_atividade'] ?>"> <?= $list['nome_atividade'] ?> </option>
                                <?php }} ?>
                    </select></div>
                    <div class="col-lg-1">
                        
                    <input style= "margin-top:30px" type="button" class="btn btn-danger" id="escolher" name="escolher" value="Add">
                    <br><br> 
                    </div>
                    
                    <div class="col-lg-12" style="margin-bottom:100px">
                    <div class="table-responsive" id="listatv" style="width:100%"> 
                        <table class="table table-hover" id="tableatv"></table> 
                    </div></div>
                    
                    
                    
                   

                   
                    <div class="col-lg-4">
                    <label> Data Estimada: </label>
                    <div class="input-group">
                    <input class="form-control" type="datetime-local" name="dataestimada" id="dataestimada" > 
                    <input type="button" id="btDataEstimada" class="btn btn-danger" value="Ok">
                    </div>
                    </div>
                     
                    
                   
                    <div class="col-lg-3">
                    <label> Valor Estimado: </label>
                    <div class="input-group">
                    <input class="form-control" type="text" name="valorestimado" id="valorestimado"  placeholder="R$ ">
                    <input type="button" id="editar" name="editar" class="btn btn-danger" value="Ok">
                    </div>
                    </div>
                    

                    <div class="col-lg-3" >
                    <label> Data de Conclusão: </label>
                        <input class="form-control" type="datetime-local" name="conclusao_os" id="conclusao_os" value="<?php if(isset($ordserv)&& $ordserv['conclusao_os'] != '') echo date('Y-m-d\TH:i',strtotime( $ordserv['conclusao_os'])); ?>">
                    </div>
                    
                    <div class="col-lg-2" style="margin-bottom:30px">
                    <label> Valor Total: </label>
                    <input class="form-control" type="text" placeholder="R$" name="valor_tot" id="valor_tot" value="<?php if(isset($ordserv)) echo $ordserv['valor_tot'];  ?>">
                    </div>
                    

                   </div>
                    <div class="col-lg-6">
                    <input type="button" id="finalizar" value="Finalizar" class="btn btn-danger"><br><br><br><br>
                    </div>
                   
                    

		</form>

                
                <div class="modal" tabindex="-1" role="dialog" id="removerproblema">
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
                                <button type="button" class="btn btn-primary" onclick="javascript:removerProblema($('#problema').val())">Sim</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
                            </div>
                        </div>
                    </div>
                </div>


<script src="plugin/bootstraptable/bootstrap-table.min.js" type="text/javascript"></script>



               
                <script> 
                    $(document).ready(function(){ 
                        
                        // Table bootstrap com adição de campos
                        $("#tableatv").bootstrapTable({
                            url:"<?= BASE_URL ?>/listarProblemas",
                            type: "get",
                            queryParams: function(p){
                                return{
                                    idOs : $('#id_ordem_servico').val()
                                }},
                            columns:[{
                                    title:'PROBLEMAS',
                                    field: 'nome_atividade'
                            },{
                                title: 'REMOVER',
                                formatter: removeformat,
                                field: 'id_list_ped'
                            }]
                        });
                        function removeformat(value){
                            return '<a href="javascript:showModalRemoverProblema(' + value + ')"><span class="fa fa-trash"></span></a>';
                        }
                        
                        // Botão Salvar                        
                        $("#salvar").click(function(){
                           $.ajax({
                                url:"<?= BASE_URL ?>/salvarOs", 
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: $("#formOs").serialize(), 
                                success: function (data, textStatus, jqXHR) { 
                                    if(data.statusresponse == 'OK'){
                                        $("#id_ordem_servico").val(data.id_ordem_servico);
                                        alert("Salvo com Sucesso");
                                    }else{
                                        alert("Não Existe Automóvel para Esse Cliente");
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            }); 
                        });
                        
                        
                         // Botão Finalizar                        
                        $("#finalizar").click(function(){
                           $.ajax({
                                url:"<?= BASE_URL ?>/finalizarOs", 
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: $("#formOs").serialize(), 
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    if(data.statusresponse == 'OK'){
                                        $("#id_ordem_servico").val(data.id_ordem_servico);
                                        alert("Salvo com Sucesso");
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
                        
                        
                        // Pra calcular o Valor Estimado
                        $("#editar").click(function(){
                            var listProblemas = $("#tableatv").bootstrapTable('getData');
                            console.log(listProblemas);
                            var total  = 0;
                            for(i=0;i < listProblemas.length; i++) {
                                console.log(listProblemas[i].valor_hora);
                                total += parseInt(listProblemas[i].valor_hora);
                            }
                            console.log(total);
                            $("#valorestimado").val(total);
                        });
                        
                        // Pra calcular a data Estimada
                        $("#btDataEstimada").click(function(){
                            var listProblemas = $("#tableatv").bootstrapTable('getData');
                            var total  = 0;
                            for(i=0;i < listProblemas.length; i++) {
                                total += parseInt(listProblemas[i].tempo_estimado_min);
                            };
                            console.log(total);
                            var horas = total; 
                            var data_agendamento = $("#data_agendamento").val();
                            //var arr_data = data_agendamento.split('T');
                            data = new Date($("#data_agendamento").val());
                            hh = (18 - data.getHours())  * 60; // restante do expediente em minutos
                            hh = hh - data.getMinutes();
                            var total_servico = horas;	//total de minutps do serviço
                            var dia = 0;
                            if(total_servico > hh){ // testa se o total servico é maior q o expediente restante do dia, se for soma 1 dia e ja subtrai do tempo restante
                                    dia++;
                                    total_servico = total_servico - hh  ; // subtrai os minutos
                            }

                            td = parseInt(total_servico / 600); //divide o tempo servico restante pelo expediente(600 = 10 horas * 60)

                            th = total_servico % 600; //pega o resto da divisao caso exita... seria o resto em minutos

                            h = parseInt(th/60); //converte o mituto em horas

                            m = th % 60; ///pega o resto dos minutos

                            td = td+dia; //soma o dia do if la de cima 

                            console.log(td+' - '+ h + ':'+m); //aqui so imprime no console o que foi calculado ate agora 

                            data.setHours(8);		//setando a hora para o inicio do expediente

                            data.setMinutes(0);     //zerando os minutos para o inicio do expediente

                            data.setDate(data.getDate()+td); // somando dia 

                            data.setHours(data.getHours()+h); //somando hora

                            data.setMinutes(data.getMinutes()+m); //somando minuto
                            ano = data.getFullYear();
                                mes = ('0'+(data.getMonth() + 1)).slice(-2);
                                dia = ('0'+data.getDate()).slice(-2);
                                hora =('0'+data.getHours()).slice(-2);
                                min = ('0'+data.getMinutes()).slice(-2);
                            $("#dataestimada").val(ano  +'-'+mes+'-'+dia+'T'+hora+':'+min); //imprime a data estimada
                            
                            //$("#dataestimada").val(total);
                        });
                        
                        
                        
                        
                         // Botão Salvar Insert dos Problemas                      
                        $("#escolher").click(function(){
                           $.ajax({
                                url:"<?= BASE_URL ?>/salvarProblemas", //Nome Função -> vai imprimir o localhost:8000 e a função
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: {
                                   id_ordem_servico:$("#id_ordem_servico").val(), //vel pega o valor q foi enviado e coloca no input
                                   id_atividade:$("#id_list_ped").val(),
                                },
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    $("#tableatv").bootstrapTable("refresh");
                                    if(data.statusresponse == 'OK'){
                                        var listProblemas = $("#tableatv").bootstrapTable('getData');
                                        console.log(listProblemas);
                                        for(i=0;i < listProblemas.length; i++) {
                                            //console.log(listProblemas[i].valor_hora);
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
                        
                       
                        // Lista de automovel automatico
                        $("#id_cliente").change(function(){
                        $('#id_automovel').html('');
                        if($("#id_cliente").val() != ""){
                            $.ajax({
                                url:"<?= BASE_URL ?>/getCarrosCliente", 
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data:{
                                    idcliente:$("#id_cliente").val()
                                    }, //Array que envia parametros pro servidor
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    if(data.statusresponse == 'OK'){
                                        $.each(data.carcli, function (i, item) { // each = foreach no php
                                        $('#id_automovel').append($('<option>', { 
                                            value: item.id_automovel,
                                            text : item.modelo + ' ' + item.marca, 
                                        }));
                                        });
                                    }else{
                                        alert("Não Existe Automóvel para Esse Cliente");
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            });
                        }
                        });
                    });
                    
                    function showModalRemoverProblema(id){
                        $('#problema').val(id);
                        $('#removerproblema').modal('show');
                    }
                    
                    function removerProblema(id){
                        $.ajax({
                                url:"<?= BASE_URL ?>/removerProblema", //Nome Função -> vai imprimir o localhost:8000 e a função
                                type:"GET", // Tipo
                                dataType:"json", // Tipo de Retorno esperado do Servidor
                                data: {id_list_ped: id}, //parametro q to mandando pras funções do controller (eu invento o nome)
                                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                    $("#removerproblema").modal("hide");
                                    if(data.statusresponse == 'OK'){
                                        alert("Removido com Sucesso");
                                    }else{
                                        alert("Erro ao remover pedido");
                                    }
                                    
                                    $("#tableatv").bootstrapTable('refresh');
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.log(errorThrown);
                                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                }
                            });  
                    }
                   
                </script>

	