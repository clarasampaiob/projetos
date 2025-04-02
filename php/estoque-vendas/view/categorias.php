<?php 
// É necessária a sessão para acessar essa página, já q precisa do login do usuário
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>categorias</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<h1>Categorias</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmCategorias">
						<label>Categoria</label>
						<input type="text" class="form-control input-sm" name="categoria" id="categoria">
						<p></p>
						<span class="btn btn-primary" id="btnAdicionarCategoria">Adicionar</span>
					</form>
				</div>
				<div class="col-sm-6">
					<div id="tabelaCategoriaLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="atualizaCategoria" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Atualiza categorias</h4>
					</div>
					<div class="modal-body">
						<form id="frmCategoriaU">
							<input type="text" hidden="" id="idcategoria" name="idcategoria">
							<label>Categoria</label>
							<input type="text" id="categoriaU" name="categoriaU" class="form-control input-sm">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnAtualizaCategoria" class="btn btn-warning" data-dismiss="modal">Salvar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>


	<!-- INSERT e LOAD da tabelaCategorias.php -->
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tabelaCategoriaLoad').load("categorias/tabelaCategorias.php");
			// Nessa div ele carrega a tabelaCategorias

			$('#btnAdicionarCategoria').click(function(){
				// Chamando a função validarFormVazio em funções.js
				vazios=validarFormVazio('frmCategorias');

				// Se os campos vazios forem maiores que 0
				if(vazios > 0){
					alertify.alert("Preencha os Campos!!");
					return false;
				}

				// Pegando os dados do form e enviando para a página adicionarCategoria.php
				dados=$('#frmCategorias').serialize(); // Pega todos os dados do form
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/categorias/adicionarCategorias.php", // envia os dados pra esta página
					success:function(r){
						if(r==1){
					//limpar formulário
					$('#frmCategorias')[0].reset();

					// Dando reload na tabela 
					$('#tabelaCategoriaLoad').load("categorias/tabelaCategorias.php");
					alertify.success("Categoria adicionada com sucesso!");
				}else{
					alertify.error("Não foi possível adicionar a categoria");
				}
			}
		});
			});
		});
	</script>


	<!-- UPDATE da categoria e LOAD da tabelaCategorias.php-->
	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAtualizaCategoria').click(function(){ // No Modal

				// Pegando os dados do form e enviando para atualizarCategorias
				dados=$('#frmCategoriaU').serialize(); // No Modal
				$.ajax({
					type:"POST",
					data:dados,
					url:"../procedimentos/categorias/atualizarCategorias.php",
					success:function(r){
						if(r==1){
							$('#tabelaCategoriaLoad').load("categorias/tabelaCategorias.php");
							alertify.success("Atualizado com Sucesso :)");
						}else{
							alertify.error("Não foi possível atualizar :(");
						}
					}
				});
			});
		});
	</script>


	
	<script type="text/javascript">
		// Função que pega os dados do modal quando clicado no botão de editar e traz o id da categoria e oq foi editado
		function adicionarDado(idCategoria,categoria){ // A função adicionarDado está em tabelaCategoria.php na parte do botão de editar, e essa função está passando os dados através do SELECT feito na página tabelaCategoria.php
			$('#idcategoria').val(idCategoria);
			$('#categoriaU').val(categoria);
			// Os campos do formCategoriaU (idcategoria, categoriaU) recebem os valores passados pela função (idCategoria, categoria)
		}


		function eliminaCategoria(idcategoria){ // Recebido da função eliminaCategoria em tabelaCategorias.php na parte do botão de remover
			alertify.confirm('Deseja excluir esta categoria?', function(){ 
				$.ajax({
					type:"POST",
					data:"idcategoria=" + idcategoria, // variavel idcategoria recebe o parametro idcategoria da função eliminaCategoria
					url:"../procedimentos/categorias/eliminarCategorias.php",
					success:function(r){
						if(r==1){
							$('#tabelaCategoriaLoad').load("categorias/tabelaCategorias.php");
							alertify.success("Excluido com sucesso!!");
						}else{
							alertify.error("Não se pode eliminar");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelado !')
			});
		}


	</script>

	

<?php
	} else{
		// Se a sessão não existir o usuário continuará na página index
		header("location:../index.php");
	}
?>