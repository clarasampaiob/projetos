<?php 
	session_start();
	require_once "../../classes/conexao.php";
	require_once "../../classes/vendas.php";
	$c= new conectar();
	
	$obj= new vendas();

	
	// vai contar se a sessão existe, devendo ser 1 pelo menos
	if(count($_SESSION['tabelaComprasTemp'])==0){
		echo 0;
	}else{
		$result=$obj->criarVenda();
		unset($_SESSION['tabelaComprasTemp']); //desfaz a sessão apagando tds os dados da tabela
		echo $result;
	}
 ?>