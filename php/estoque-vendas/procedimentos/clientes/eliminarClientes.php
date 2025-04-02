<?php

// Arquivo que recebe por ajax os dados do formulário da página clientes.php 


require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/clientes.php";



$id = $_POST['idcliente']; // Recebido pelo ajax da página clientes.php na função eliminarCliente 
	
$obj = new clientes();

echo $obj->excluirCliente($id); // Momento onde os dados são enviados para a função excluirCliente que está na classe clientes.php e que fará o delete no banco. 

?>