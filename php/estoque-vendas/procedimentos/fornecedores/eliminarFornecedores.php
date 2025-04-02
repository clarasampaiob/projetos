<?php

// Arquivo que recebe por ajax os dados do formulário da página fornecedores.php 


require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/fornecedores.php";



$id = $_POST['idfornecedor']; // Recebido pelo ajax da página fornecedores.php na função eliminar 
	
$obj = new fornecedores();

echo $obj->excluir($id); // Momento onde os dados são enviados para a função excluir que está na classe fornecedores.php e que fará o delete no banco. 

?>