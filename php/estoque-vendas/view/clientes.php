<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>clientes</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Clientes</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmClientes">
						<label>Nome</label>
						<input type="text" class="form-control input-sm" id="nome" name="nome">
						<label>Sobrenome</label>
						<input type="text" class="form-control input-sm" id="sobrenome" name="sobrenome">
						<label>Endereço</label>
						<input type="text" class="form-control input-sm" id="endereco" name="endereco">
						<label>Email</label>
						<input type="text" class="form-control input-sm" id="email" name="email">
						<label>Telefone</label>
						<input type="text" class="form-control input-sm" id="telefone" name="telefone">
						<label>CPF</label>
						<input type="text" class="form-control input-sm" id="cpf" name="cpf">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarCliente">Salvar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaClientesLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalClientesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar cliente</h4>
					</div>
					<div class="modal-body">
						<form id="frmClientesU">
							<input type="text" hidden="" id="idclienteU" name="idclienteU">
							<label>Nome</label>
							<input type="text" class="form-control input-sm" id="nomeU" name="nomeU">
							<label>Sobrenome</label>
							<input type="text" class="form-control input-sm" id="sobrenomeU" name="sobrenomeU">
							<label>Endereço</label>
							<input type="text" class="form-control input-sm" id="enderecoU" name="enderecoU">
							<label>Email</label>
							<input type="text" class="form-control input-sm" id="emailU" name="emailU">
							<label>Telefone</label>
							<input type="text" class="form-control input-sm" id="telefoneU" name="telefoneU">
							<label>CPF</label>
							<input type="text" class="form-control input-sm" id="cpfU" name="cpfU">
						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAdicionarClienteU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idcliente){  // Função que serve para carregar os dados já cadastrados no banco no form do modal qd a pessoa aperta em editar. idcliente está vindo da função adicionarDado na página tabelaClientes.php através de um SELECT feito na página, que é enviado ao clicar no botão de editar (pois a função está dentro do botão)

			$.ajax({
				type:"POST",
				data:"idcliente=" + idcliente, // A variável idcliente recebe o parametro idcliente de adicionarDado
				url:"../procedimentos/clientes/obterDadosCliente.php",
				success:function(r){

					dado=jQuery.parseJSON(r); // Recendo o Json enviado por obterDadosCliente.php que foi processado pela função obterDadosCliente na classe clientes.php

					// Prgando os dados do array recebido pelo Json e atribuindo aos campos do frmClientesU do modal
					$('#idclienteU').val(dado['id_cliente']);
					$('#nomeU').val(dado['nome']);
					$('#sobrenomeU').val(dado['sobrenome']);
					$('#enderecoU').val(dado['endereco']);
					$('#emailU').val(dado['email']);
					$('#telefoneU').val(dado['telefone']);
					$('#cpfU').val(dado['cpf']);



				}
			});
		}

		function eliminarCliente(idcliente){ // O parametro é recebido ao clicar no botão de remover (na página tabelaClientes.php) q passa o id do cliente pela função eliminarCliente através de um SELECT feito na página
			alertify.confirm('Excluir este cliente?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcliente=" + idcliente, // A variável idcliente recebe o parametro idcliente passado na função eliminarCliente
					url:"../procedimentos/clientes/eliminarClientes.php",
					success:function(r){ // Se os procedimentos retornarem 1 é pq foi true
						if(r==1){
							$('#tabelaClientesLoad').load("clientes/tabelaClientes.php");
							alertify.success("Excluido com sucesso!!");
						}else{
							alertify.error("Não foi possível excluir");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}
	</script>


	<!-- Script para inserir dados na tabela clientes no banco -->
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaClientesLoad').load("clientes/tabelaClientes.php"); // Carregando a página tabelaClientes.php

			$('#btnAdicionarCliente').click(function(){ // Verificando se os campos estão vazios ao clicar no botão btnAdicionarCliente

				vazios=validarFormVazio('frmClientes');
				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmClientes').serialize(); // Pegando todos os dados do form frmClientes para passar via post

				$.ajax({
					type:"POST",
					data:dados, // dados do form que foram agrupados pelo serialize
					url:"../procedimentos/clientes/adicionarClientes.php",
					success:function(r){

						if(r==1){ // recebe 1 se os procedimentos em adicionarClientes.php retornarem true
							$('#frmClientes')[0].reset(); // Limpa os campos
							$('#tabelaClientesLoad').load("clientes/tabelaClientes.php"); // Recarrega a tabela
							alertify.success("Cliente Adicionado");
						}else{
							alertify.error("Não foi possível adicionar");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAdicionarClienteU').click(function(){
				dados=$('#frmClientesU').serialize(); // Pegando os dados dos campos de frmClietesU que já foram carregados através do botão editar

				$.ajax({
					type:"POST", // enviando os dados recebidos pelo serialize por post para atualizarClientes.php
					data:dados,
					url:"../procedimentos/clientes/atualizarClientes.php",
					success:function(r){

						if(r==1){ // recebe um se os procedimentos da página atualizarClientes retornar true
							$('#frmClientes')[0].reset(); // limpa os campos do form
							$('#tabelaClientesLoad').load("clientes/tabelaClientes.php"); // recarrega a tabela
							alertify.success("Cliente atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar cliente");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>