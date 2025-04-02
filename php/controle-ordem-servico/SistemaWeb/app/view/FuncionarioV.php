



<form name="funcionario" method="get" action="" id="formfuncionario">
     
    <center><h3 style="margin-left:20px;"><i><b>
                    <font color='#E11F1F' size='5'> Cadastro de Funcionário </font><br><br>
    </b></i></h3></center>
    
    
    
        <div class="panel-body">
            <input type="hidden" name="id_funcionario" id="id_funcionario" value="<?php if (isset($lstfunc)) echo $lstfunc['id_funcionario']; ?>">
            <div class="col-lg-6" >
                <label> Nome: </label>
                <input class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['nome_funcionario']; ?>" type="text" name="nome" id="nome" required=""><br>
            </div>
            <div class="col-lg-6" >
                <label> CPF: </label>
                <input class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['cpf']; ?>" type="text" name="cpf" id="cpf" required=""><br>
            </div>
            <div class="col-lg-12" >
                <label> Endereço: </label>
                <input class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['endereco']; ?>" type="text" name="endereco" id="endereco"><br>
            </div>    
            
            <div class="col-lg-6" >
                <label> Telefone: </label>
                <input  class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['tel1']; ?>" type="text" name="tel1" id="tel1" >
            </div>
            <div class="col-lg-6" >
                <label> Celular: </label>
                <input  class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['tel2']; ?>" type="text" name="tel2" id="tel2"><br>
            </div>
            
            <div class="col-lg-12" >
                <label> E-mail: </label>
                <input class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['email']; ?>" type="text" name="email" id="email"><br>
            </div>
            
            <div class="col-lg-6" >
                <label> Cargo: </label>
                <input class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['cargo']; ?>" type="text" name="cargo" id="cargo"><br>
            </div>
            
            <div class="col-lg-6" >    
                <label> Salário: </label>
                <input class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['salario_fixo']; ?>" type="text" name="salario_fixo" id="salario_fixo"><br>                               
            </div>    
                
            <div class="col-lg-12" >
                <label> Login Password: </label>
                <input class="form-control" value=" <?php if (isset($lstfunc)) echo $lstfunc['senha']; ?>" type="password" name="senha" id="senha"><br>
            </div>
        </div>
        <div class="col-lg-6">
             <input type="button" id="salvar" value="Salvar" class="btn btn-danger"><br><br><br><br>
        </div>
    </div>
</form>




<script>
    $(document).ready(function () { // estrutura de abertura do Jquery


        // Botão Salvar                        
        $("#salvar").click(function () {
            $.ajax({
                url: "<?= BASE_URL ?>/cadastrarfunc", //Nome Função -> vai imprimir o localhost:8000 e a função
                type: "GET", // Tipo
                dataType: "json", // Tipo de Retorno esperado do Servidor
                data: $("#formfuncionario").serialize(), //o serialize vai pegar todos os names do formulario e enviar pra função (pra URL)
                success: function (data, textStatus, jqXHR) { // data recebe o retorno do servidor
                    if (data.statusresponse == 'OK') {
                        $("#id_funcionario").val(data.id_funcionario);
                        alert("Salvo com Sucesso");
                    } else {
                        alert("Erro");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                    alert("Erro na Comunicação com Servidor ou Tipo de Dados Inválido");
                }
            });
        });

    });



</script>
