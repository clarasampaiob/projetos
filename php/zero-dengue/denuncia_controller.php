<?php

require_once "geral_class.php";
require_once "denuncia_class.php";
require_once "usuario_class.php";

echo "<pre>";
//var_dump($_POST);
//var_dump($_FILES['foto']);

// CONECTANDO COM O BANCO
$obj = new Geral;
$conexao = $obj->conectar_bd();

//var_dump($_POST['den']);
$dados = array();
$dados['id_usuario'] = 15;
//$dados['id_usuario'] = $_POST['id_usuario'];
$dados['seriedade'] = $_POST['seriedade'];
$dados['endereco'] = mb_strtoupper($_POST['endereco'], 'UTF-8');
$dados['cidade'] = mb_strtoupper($_POST['cidade'], 'UTF-8');
$dados['estado'] = $_POST['estado'];
$dados['descricao'] = mb_strtoupper($_POST['descricao'], 'UTF-8');

if(isset($_POST['den']) && !empty($_POST['den'])){

	$bd = new Denuncia;
	$att = $bd->atualizar_denuncia($dados,$_POST['den'],$conexao);

}else{

$bd = new Denuncia;
$denuncia = $bd->salvar($dados,$conexao);
//var_dump($denuncia);

$user = new Usuario;
$dados['cpf'] = $user->get_cpf($dados['id_usuario'],$conexao);
var_dump($dados['cpf']);


// SE EXISTIR ARQUIVO ENVIADO E NÃO ESTIVER VAZIO
if(isset($_FILES['foto']['name']) && !empty($_FILES['foto']['name'])){
	$cpf = preg_replace("/[^a-zA-Z0-9]/", "", $dados['cpf']);
	$dados['url'] = 'fotos/denuncia-'.$denuncia['last_id'].'-'.$cpf.'-'.basename($_FILES['foto']['name']);
	//var_dump($dados['url']);
	$obj->salvar_foto($_FILES['foto']['tmp_name'],$dados['url']);
	$bd->cadastrar_fotoURL($dados['url'],$conexao,$denuncia['last_id']);
}else{
	//$dados['url'] = "fotos/default.jpg";
}
var_dump($dados);

}



mysqli_close($conexao);
















?>