<?php


require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/fornecedores.php";


$obj = new fornecedores();
$dados = array(
	$_POST['idfornecedorU'], 
	$_POST['nomeU'], 
	$_POST['sobrenomeU'], 
	$_POST['enderecoU'], 
	$_POST['emailU'], 
	$_POST['telefoneU'], 
	$_POST['cpfU']
	// Dados que já foram recuperados e carregados no frmFornecedoresU através do botão editar e que foram enviados para esta página através do clique em btnAdicionarFornecedorU na página fornecedores.php
);


echo $obj->atualizar($dados); // Momento onde os dados são enviados para a função atualizar que está na classe fornecedoress.php e que fará o Update no banco. A função receberá um array

?>