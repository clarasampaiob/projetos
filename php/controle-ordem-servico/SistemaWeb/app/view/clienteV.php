


		<center><h3 style="margin-left:20px;"><i><b>
                                <font color='#E11F1F' size='5'> Cadastro de Clientes </font><br><br>
		</b></i></h3></center>


        <form name="cliente" method="get" action="" id="formcli">
            
             <input type="hidden" name="id_cliente" id="id_cliente" value="<?php if(isset($lstcli))echo $lstcli['id_cliente']; ?>">
		<div class="panel-body">
                    <div class="col-lg-6" >
			<label> Nome: </label>
				<input class="form-control" value=" <?php if(isset($lstcli)) echo $lstcli['nome_cliente'];  ?>" type="text" name="nomecliente" id="nomecliente" required=""><br>

                    </div>
                                <div class="col-lg-6" >
                                <label> CPF / CNPJ: </label>
				<input class="form-control" value=" <?php if(isset($lstcli)) echo $lstcli['cpf_cnpj'];  ?>" type="text" name="cpfcnpj" id="cpfcnpj" required=""><br>

                        </div>
                                <div class="col-lg-12" >
                                <label> Endereço: </label>
				<input class="form-control" value=" <?php if(isset($lstcli)) echo $lstcli['endereco'];  ?>" type="text" name="endereco" id="endereco"><br>

                        </div>
                                <div class="col-lg-12" >
                                <label> E-mail: </label>
				<input class="form-control" value=" <?php if(isset($lstcli)) echo $lstcli['email'];  ?>" type="text" name="email" id="email"><br>

                        </div>
                                <div class="col-lg-6" >
                                    <label> Telefone: </label>
                                    <input class="form-control" value=" <?php if(isset($lstcli)) echo $lstcli['tel1'];  ?>" type="text" name="tel1" id="tel1" ><br>
                        </div>
                                    <div class="col-lg-6" >
                                <label> Celular: </label>
				<input class="form-control" value=" <?php if(isset($lstcli)) echo $lstcli['tel2'];  ?>" type="text" name="tel2" id="tel2"><br>
                        </div>        

                </div>
			<div class="col-lg-6">
                  <input type="button" id="salvar" value="Salvar" class="btn btn-danger"><br><br><br><br>
              </div>
                       
		</form>


<script>
                        
                        $(document).ready(function(){ // estrutura de abertura do Jquery
    
                            // Botão Salvar                        
                            $("#salvar").click(function(){
                               $.ajax({
                                    url:"<?= BASE_URL ?>/salvarcliente", //Nome Função -> vai imprimir o localhost:8000 e a função
                                    type:"GET", // Tipo
                                    dataType:"json", // Tipo de Retorno esperado do Servidor
                                    data: $("#formcli").serialize(), //o serialize vai pegar todos os names do formulario e enviar pra função (pra URL)
                                    success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                                        if(data.statusresponse == 'OK'){
                                            $("#id_cliente").val(data.id_cliente);
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

	