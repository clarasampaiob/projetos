<?php

// Arquivo que recebe por ajax os dados do formulário da página fornecedores.php 

session_start(); // Sessões são necessárias ao navegar entre páginas
require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/fornecedores.php";


$idusuario = $_SESSION['iduser']; // Valor que foi pego no login


$obj = new fornecedores();
$dados = array(
	$idusuario,
	$_POST['nome'],
	$_POST['sobrenome'],
	$_POST['endereco'],
	$_POST['email'],
	$_POST['telefone'],
	$_POST['cpf']
);

echo $obj->adicionar($dados); // Momento onde os dados são enviados para a função adicionar que está na classe fornecedores.php e que fará o Insert no banco. A função receberá um array

?>