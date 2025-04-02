<?php 
	
	require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
	require_once "../../classes/produtos.php";

	$obj= new produtos();

	$idpro=$_POST['idpro'];

	// Passando os dados para Json
	echo json_encode($obj->obterDados($idpro));

	?>