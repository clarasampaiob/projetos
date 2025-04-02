<?php

require_once "classes/conexao.php";

$obj = new conectar();
$conexao = $obj->conexao();

// Verificando se tem o usuário admin no sistema para ocultar o botão "Registrar" da tela de login
$sql = "SELECT * from usuarios where email = 'admin' ";
$result = mysqli_query($conexao,$sql);

// Se o numero de linhas retornadas em $result forem maior que 1 é pq o usuário admin existe, então ele retorna para a página de login index.php impedindo que o usuário acesse essa página de registro de usuário não sendo admin
$validar = 0;
if(mysqli_num_rows($result) > 0){
	header("location:index.php");
}

?>



<!DOCTYPE html>
<html>
<head>
	<title>Registrar Usuário</title>
	<link rel="stylesheet" type="text/css" href="lib/bootstrap/css/bootstrap.css">
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="js/funcoes.js"></script>
	

</head>
<body style="background-color: gray">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">Registrar Administrador</div>
					<div class="panel panel-body">
						<form id="frmRegistro">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" name="nome" id="nome">
							<label>Usuário</label>
							<input type="text" class="form-control input-sm" name="usuario" id="usuario">
							<label>Email</label>
							<input type="text" class="form-control input-sm" name="email" id="email">
							<label>Senha</label>
							<input type="password" class="form-control input-sm" name="senha" id="senha">
							<p></p>
							<span class="btn btn-primary" id="registro">Registrar</span>
							<a href="index.php" class="btn btn-default">Voltar Login</a>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
</body>
</html>




<!-- Chamando a função js pra ver se o formulário não está vazio -->
<script type="text/javascript">
	$(document).ready(function(){
		$('#registro').click(function(){  // Botão que vai chamar a função em funcoes.js ao ser clicado

			vazios=validarFormVazio('frmRegistro');  // Nome do formulário a ser passado pra função validarFormVazio localizada no arquivo funcoes.js

			if(vazios > 0){  // Se o retorno da função for maior que zero
				alert("Preencha os Campos!!");
				return false;
			}


			// Função que envia os dados do form para registrarUsuario.php que fará a inserção de dados no banco 
			dados=$('#frmRegistro').serialize(); // Serialize pega todos os dados e passa pra variável dados
			$.ajax({
				type:"POST", // tipo de passagem de dados
				data:dados, // data recebe a variável dados q pegou os dados por serialize
				url:"procedimentos/login/registrarUsuario.php", // caminho do arquivo que fará o insert no banco e que receberá os valores passados em dados
				success:function(r){
					// Recebe o resultado da função, se for true, se tornará 1 e exibirá a mensagem de inserção, se for false se tornará 0
					if(r==1){
						alert("Inserido com Sucesso!!");
					}else{
						alert("Erro ao Inserir");
					}
				}
			});
		});
	});
</script>
