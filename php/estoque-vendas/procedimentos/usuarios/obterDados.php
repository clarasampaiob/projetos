<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/usuarios.php";

	$obj= new usuarios;

	// Enviando dados via json para a view usuarios.php na função adicionarDados (ajax) e pegando o idusuario enviado pela msm função
	echo json_encode($obj->obterDados($_POST['idusuario']));

 ?>