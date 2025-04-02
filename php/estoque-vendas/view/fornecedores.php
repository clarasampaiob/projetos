<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>fornecedores</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Fornecedores</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmFornecedores">
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
						<span class="btn btn-primary" id="btnAdicionarFornecedores">Salvar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tabelaFornecedoresLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->


		<!-- Modal -->
		<div class="modal fade" id="abremodalFornecedoresUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualizar Fornecedor</h4>
					</div>
					<div class="modal-body">
						<form id="frmFornecedoresU">
							<input type="text" hidden="" id="idfornecedorU" name="idfornecedorU">
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
						<button id="btnAdicionarFornecedorU" type="button" class="btn btn-primary" data-dismiss="modal">Atualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>

	<script type="text/javascript">
		function adicionarDado(idfornecedor){ // Função q serve para carregar os dados no form do modal na hora que a pessoa aperta em editar para ela ver os dados já cadastrados e que está em tabelaFornecedores.php

			$.ajax({
				type:"POST",
				data:"idfornecedor=" + idfornecedor, // variável idfornecedor recebe o parametro idfornecedor
				url:"../procedimentos/fornecedores/obterDadosFornecedores.php",
				success:function(r){



					dado=jQuery.parseJSON(r); // recebendo os dados json


					$('#idfornecedorU').val(dado['id_fornecedor']);
					$('#nomeU').val(dado['nome']);
					$('#sobrenomeU').val(dado['sobrenome']);
					$('#enderecoU').val(dado['endereco']);
					$('#emailU').val(dado['email']);
					$('#telefoneU').val(dado['telefone']);
					$('#cpfU').val(dado['cpf']);
					// Os campos do form recebem os valores do array que está na classe fornecedores.php na função obterDados


				}
			});
		}

		function eliminar(idfornecedor){   // Função q está em tabelaFornecedores.php
			alertify.confirm('Deseja Excluir este fornecedor?', function(){ 
				$.ajax({
					type:"POST",
					data:"idfornecedor=" + idfornecedor, // variável idfornecedor recebe o parametro idfornecedor
					url:"../procedimentos/fornecedores/eliminarFornecedores.php",
					success:function(r){



						if(r==1){
							$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php"); // dando um reload na tabela
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

	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php"); // daando um load na tabela

			$('#btnAdicionarFornecedores').click(function(){

				vazios=validarFormVazio('frmFornecedores');

				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				dados=$('#frmFornecedores').serialize(); // pegando todos os dados do form

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/fornecedores/adicionarFornecedores.php",
					success:function(r){

						if(r==1){
							$('#frmFornecedores')[0].reset(); // ao receber true (1) ele limpa os campos do formulario
							$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php"); // reload na tabela
							alertify.success("Fornecedor Adicionado");
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
			$('#btnAdicionarFornecedorU').click(function(){
				dados=$('#frmFornecedoresU').serialize(); // pegando tds os dados do form

				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/fornecedores/atualizarFornecedores.php",
					success:function(r){

						
						if(r==1){
							$('#frmFornecedores')[0].reset(); // limpando os campos do form
							$('#tabelaFornecedoresLoad').load("fornecedores/tabelaFornecedores.php"); // reload na tabela
							alertify.success("Fornecedor atualizado com sucesso!");
						}else{
							alertify.error("Não foi possível atualizar fornecedor");
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