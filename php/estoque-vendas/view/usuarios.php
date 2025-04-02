<?php 
session_start();
if(isset($_SESSION['usuario'])){

?>

<!DOCTYPE html>
	<html>
	<head>
		<title>usuarios</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Administrar Usuários</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmRegistro">
						<label>Nome</label>
						<input type="text" class="form-control input-sm" name="nome" id="nome">
						<label>Usuário</label>
						<input type="text" class="form-control input-sm" name="usuario" id="usuario">
						<label>Email</label>
						<input type="text" class="form-control input-sm" name="email" id="email">
						<label>Senha</label>
						<input type="text" class="form-control input-sm" name="senha" id="senha">
						<p></p>
						<span class="btn btn-primary" id="registro">Salvar</span>

					</form>
				</div>
				<div class="col-sm-7">
					<div id="tabelaUsuariosLoad"></div>
				</div>
			</div>
		</div>


		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="atualizaUsuarioModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Editar Usuario</h4>
					</div>
					<div class="modal-body">
						<form id="frmRegistroU">
							<input type="text" hidden="" id="idUsuario" name="idUsuario">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" name="nomeU" id="nomeU">
							<label>Usuário</label>
							<input type="text" class="form-control input-sm" name="usuarioU" id="usuarioU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" name="emailU" id="emailU">

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAtualizaUsuario" type="button" class="btn btn-warning" data-dismiss="modal">Editar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		
		function adicionarDados(idusuario){ // idususario vem de tabelaUsuario na função adicionarDados. Essa função é a que carrega os dados no form do modal qd se aperta no botão editar, para que o usuário veja os dados já cadastrados e os edite

			$.ajax({
				type:"POST",
				data:"idusuario=" + idusuario, // variavel idusuario recebe o parametro idusuario
				url:"../procedimentos/usuarios/obterDados.php",
				success:function(r){
					dado=jQuery.parseJSON(r);
					// recebdno os dados enviados pela classe usuarios.php na função obterDados
					$('#idUsuario').val(dado['id']);
					$('#nomeU').val(dado['nome']);
					$('#usuarioU').val(dado['user']);
					$('#emailU').val(dado['email']);
				}
			});
		}

		function eliminarUsuario(idusuario){ // idususario vem de tabelaUsuario na função eliminarUsuario
			
			alertify.confirm('Deseja excluir este usuario?', function(){ 
				$.ajax({
					type:"POST",
					data:"idusuario=" + idusuario, // variavel idusuario recebe o parametro idusuario
					url:"../procedimentos/usuarios/eliminarUsuario.php",

					// Se receber true (1)
					success:function(r){
						if(r==1){
							$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php'); // reload na tabela
							alertify.success("Excluido com sucesso!!");
						}else{
							alertify.error("Não excluido :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}


	</script>

	<script type="text/javascript">
		$(document).ready(function(){ 
			$('#btnAtualizaUsuario').click(function(){  // Processo de edição

				datos=$('#frmRegistroU').serialize(); // Pega tds os dados do form
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procedimentos/usuarios/atualizarUsuario.php",
					success:function(r){
						// Se receber true (1)
						if(r==1){
							$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php'); //reload na tabela
							alertify.success("Editado com sucesso :D");
						}else{
							alertify.error("Não foi possível editar :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){  // Processo de insert

			$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php'); // carregando a tabela

			$('#registro').click(function(){
				// Verificando se não há campos vazios para fazer o insert através da função validarFormVazio
				vazios=validarFormVazio('frmRegistro');

				if(vazios > 0){
					alertify.alert("Preencha os campos!!");
					return false;
				}

				datos=$('#frmRegistro').serialize(); // Pega todos os dados do form
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procedimentos/login/registrarUsuario.php",
					success:function(r){
						//alert(r);
						// Se for true (1)
						if(r==1){
							$('#frmRegistro')[0].reset(); // Limpa os campos do form
							$('#tabelaUsuariosLoad').load('usuarios/tabelaUsuarios.php'); // Reload na tabela
							alertify.success("Adicionado com sucesso");
						}else{
							alertify.error("Falha ao adicionar :(");
						}
					}
				});
			});
		});
	</script>




<?php 
}else{
	header("location:../index.php");
}
?>