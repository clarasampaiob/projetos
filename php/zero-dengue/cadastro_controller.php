<?php

require_once "geral_class.php";
require_once "cadastro_class.php";

echo "<pre>";
//var_dump($_POST);
//var_dump($_FILES['foto']);

// CONECTANDO COM O BANCO
$obj = new Geral;
$conexao = $obj->conectar_bd();


$dados = array();
$dados['cpf'] = $_POST['cpf'];
$dados['nome'] = mb_strtoupper($_POST['nome'], 'UTF-8');
$dados['endereco'] = mb_strtoupper($_POST['endereco'], 'UTF-8');
$dados['cidade'] = mb_strtoupper($_POST['cidade'], 'UTF-8');
$dados['estado'] = $_POST['estado'];
$dados['sexo'] = $_POST['sexo'];
$dados['telefone'] = $_POST['telefone'];
$dados['email'] = strtolower($_POST['email']);
$dados['senha'] = password_hash($_POST['senha'],PASSWORD_DEFAULT);

// SE EXISTIR ARQUIVO ENVIADO E NÃO ESTIVER VAZIO
if(isset($_FILES['foto']['name']) && !empty($_FILES['foto']['name'])){
	$cpf = preg_replace("/[^a-zA-Z0-9]/", "", $dados['cpf']);
	$dados['url'] = "fotos/perfil-".$cpf.'-'.basename($_FILES['foto']['name']);
	$obj->salvar_foto($_FILES['foto']['tmp_name'],$dados['url']);
}else{
	$dados['url'] = "fotos/default.jpg";
}
var_dump($dados);

$bd = new Cadastro;
$bd->salvar($dados,$conexao);


mysqli_close($conexao);







?>