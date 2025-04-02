<?php


require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/clientes.php";


$obj = new clientes();
$dados = array(
	$_POST['idclienteU'], 
	$_POST['nomeU'], 
	$_POST['sobrenomeU'], 
	$_POST['enderecoU'], 
	$_POST['emailU'], 
	$_POST['telefoneU'], 
	$_POST['cpfU']
	// Dados que já foram recuperados e carregados no frmClientesU através do botão editar e que foram enviados para esta página através do clique em btnAdicionarClienteU na página clientes.php
);


echo $obj->atualizarCliente($dados); // Momento onde os dados são enviados para a função atualizarCliente que está na classe clientes.php e que fará o Update no banco. A função receberá um array

?>