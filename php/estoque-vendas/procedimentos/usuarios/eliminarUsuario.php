<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/usuarios.php";

	$obj= new usuarios;

	echo $obj->excluir($_POST['idusuario']);
	// Pegando o idusuario que vem via ajax pela view usuarios.php na função EliminarUsuario e chamando a função excluir da classe usuarios.php

 ?>