<?php 

	require_once "../../classes/conexao.php";
	require_once "../../classes/usuarios.php";

	$obj= new usuarios;

	$dados=array(
			$_POST['idUsuario'],  
		    $_POST['nomeU'] , 
		    $_POST['usuarioU'],  
		    $_POST['emailU']
				);  
	echo $obj->atualizar($dados);
	// Pegando os dados que vieram via ajax pelo botão btnAtualizarUsuario em view usuarios.php  e passando para o array $dados que será processado pela função atualizar da classe usuarios.php


 ?>