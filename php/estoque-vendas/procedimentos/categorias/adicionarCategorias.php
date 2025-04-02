<?php

// Arquivo que recebe por ajax (no segundo bloco de códigos em <script>) os dados do formulário da página categorias.php 

session_start(); // Sessões são necessárias ao navegar entre páginas
require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/categorias.php";


$data = date("Y-m-d");
$idusuario = $_SESSION['iduser'];
$categoria = $_POST['categoria']; // Dado que está vindo do imput com o name categoria do form frmCategorias em categorias.php

$obj = new categorias();
$dados = array(
	$idusuario,
	$categoria,
	$data
);

echo $obj->adicionarCategoria($dados); // Momento onde os dados são enviados para a função adicionarCategoria que está na classe categorias.php e que fará o Insert no banco. A função receberá um array

?>