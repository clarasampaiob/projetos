<?php 


require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$dados=$_POST['dados'];

	$idproduto = $dados[0];
	$quantidade = $dados[3].$dados[4].$dados[5].$dados[6];


	// essa $quantidade já eh o valor antigo do estoque pq foi ele q foi enviado via post, a atualização feita no banco ao fazer a venda ainda n foi enviada por post para q os dados estivessem atualizados 
	$sqlU = "UPDATE produtos SET quantidade = '$quantidade' where id_produto = '$idproduto' ";
		mysqli_query($conexao,$sqlU);

	


 ?>