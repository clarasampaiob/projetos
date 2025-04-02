<?php 
require_once "geral_class.php";
require_once "usuario_class.php";

session_start();
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


$user = new Usuario();
$att = $user->atualizar_dados($_SESSION['id_user'],$dados,$conexao);

?>