
		<center><h3 style="margin-left:20px;"><i><b>
                                <font color='#E11F1F' size='5'> Cadastro de Automóvel </font><br><br>
		</b></i></h3></center>


        <form name="automovel" method="get" action="" id="formauto">
            
             <input type="hidden" name="id_automovel" id="id_automovel" value="<?php if(isset($automovel))echo $automovel['id_automovel']; ?>">
             
             <div class="panel-body">
                    <div class="col-lg-12" >
			<label> Cliente: </label>
                        <select class="form-control" id="id_cliente" name="id_cliente">
                                <option></option>
                                    <?php if (isset($cliauto)){
                                        foreach ($cliauto as $clientauto){ ?>
                                        <option  <?php if(isset($automovel) && $automovel['id_cliente'] == $clientauto['id_cliente']) echo "selected";  ?> value="<?= $clientauto['id_cliente'] ?>"> <?= $clientauto['nome_cliente'] ?> </option> 
                                    <?php }} ?>                                                                             
                        </select><br><br>
                    </div>
                            
                            
			

                    <div class="col-lg-4" >        
			<label> Chassi: </label>
				<input class="form-control" value="<?php if(isset($automovel)) echo $automovel['chassi']; ?>" type="text" name="chassi" id="chassi" required=""><br>
                    </div>            
                                
                    <div class="col-lg-4" >            
			<label> Modelo: </label>
				<input class="form-control" value="<?php if(isset($automovel)) echo $automovel['modelo']; ?>" type="text" name="modelo" id="modelo" required=""><br>
                    </div>
                                
                    <div class="col-lg-4" >            
			<label> Marca: </label>
                        <input class="form-control" value="<?php if(isset($automovel)) echo $automovel['marca']; ?>" type="text" name="marca" id="marca" required=""><br><br>
                    </div>
                                
                     <div class="col-lg-12" >              
                        <label> Cor: </label> &nbsp; &nbsp; 
                        <input <?php if(isset($automovel) && $automovel['cor'] == 'preto') echo 'checked'; ?> type="radio" name="cor" id="preto" value="preto"> Preto &nbsp;&nbsp;  
				<input <?php if(isset($automovel) && $automovel['cor'] == 'branco') echo 'checked'; ?> type="radio" name="cor" id="branco" value="branco"> Branco &nbsp; &nbsp; 
				<input <?php if(isset($automovel) && $automovel['cor'] == 'prata') echo 'checked'; ?> type="radio" name="cor" id="prata" value="prata"> Prata &nbsp;&nbsp;  
				<input <?php if(isset($automovel) && $automovel['cor'] == 'vermelho') echo 'checked'; ?> type="radio" name="cor" id="vermelho" value="vermelho"> Vermelho &nbsp;&nbsp;  
                                <input <?php if(isset($automovel) && $automovel['cor'] == 'amarelo') echo 'checked'; ?> type="radio" name="cor" id="amarelo" value="amarelo"> Amarelo <br><br>
                     </div>
                                
                     <div class="col-lg-6" >              
			<label> Ano: </label>
				<input class="form-control" value="<?php if(isset($automovel)) echo $automovel['ano']; ?>" type="number" name="ano" id="ano"><br>
                     </div>
                                
                     <div class="col-lg-6" >              
			<label> Local: </label>
				<input class="form-control" value="<?php if(isset($automovel)) echo $automovel['local']; ?>" type="text" name="local" id="local"><br>
                     </div>
             </div> 
              <div class="col-lg-12">
                  <input type="button" id="salvar" value="Salvar" class="btn btn-danger"><br><br><br><br>
              </div>
		</form>


<script>
                        
                        $(document).ready(function(){ 
    
                            // Botão Salvar                        
                            $("#salvar").click(function(){
                               $.ajax({
                                    url:"<?= BASE_URL ?>/salvarautomovel", 
                                    type:"GET", // Tipo
                                    dataType:"json", // Tipo de Retorno esperado do Servidor
                                    data: $("#formauto").serialize(), //o serialize vai pegar todos os names do formulario e enviar pra função (pra URL)
                                    success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                        if(data.statusresponse == 'OK'){
                                            $("#id_automovel").val(data.id_automovel);
                                            alert("Salvo com Sucesso");
                                        }else{
                                            alert("Erro");
                                        }
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        //console.log(errorThrown);
                                        alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                                    }
                                }); 
                            });
                        });
    
    
    
    
</script>

	


