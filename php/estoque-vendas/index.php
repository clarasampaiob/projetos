
<?php

require_once "classes/conexao.php";

$obj = new conectar();
$conexao = $obj->conexao();

// Verificando se tem o usuário admin no sistema para ocultar o botão "Registrar" da tela de login
$sql = "SELECT * from usuarios where email = 'admin' ";
$result = mysqli_query($conexao,$sql);

// Se o numero de linhas retornadas em $result forem maior que 1 é pq o usuário admin existe, então validar recebe 1 (true)
$validar = 0;
if(mysqli_num_rows($result) > 0){
	$validar = 1;
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
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
				<div class="panel panel-primary">
					<div class="panel panel-heading">Sistema</div>
					<div class="panel panel-body">
						<p>
							<img src="img/phpoo.png"  width="100%">
						</p>
						<form id="frmLogin">
							<label>E-mail</label>
							<input type="text" class="form-control input-sm" name="email" id="email">
							<label>Senha</label>
							<input type="password" name="senha" id="senha" class="form-control input-sm">
							<p></p>
							<span class="btn btn-primary btn-sm" id="entrarSistema">Entrar</span>
							
							<!-- Se o email admin existir, esse botão não irá aparecer -->
							<?php if(!$validar): ?>
							<!-- Os dois pontos substituem as chaves {} -->
							<a href="registrar.php" class="btn btn-danger btn-sm">Registrar</a>
							<?php endif; ?>

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
		$('#entrarSistema').click(function(){// Botão que vai chamar a função em funcoes.js ao ser clicado

		vazios=validarFormVazio('frmLogin');// Nome do formulário a ser passado pra função validarFormVazio localizada no arquivo funcoes.js

			if(vazios > 0){ // Se o retorno da função for maior que zero
				alert("Preencha os campos!!");
				return false;
			}




		dados=$('#frmLogin').serialize();
		$.ajax({
			type:"POST",
			data:dados,
			url:"procedimentos/login/login.php",
			success:function(r){

				if(r==1){
					window.location="view/inicio.php";
				}else{
					alert("Acesso Negado!!");
				}
			}
		});
	});
	});
</script>