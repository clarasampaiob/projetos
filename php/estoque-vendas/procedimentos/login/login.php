<?php

// Arquivo que recebe por ajax (no segundo bloco de códigos em <script>) os dados do formulário da página index.php 

session_start(); // Iniciando uma sessão no momento em que se recebe os dados pois mudou de página
require_once "../../classes/conexao.php"; // a Função registroUsuario exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/usuarios.php";


$obj = new usuarios();
$dados = array(
	$_POST['email'], // "email" vem do name do imput email do form passado pelo ajax
	$_POST['senha']
);

echo $obj->login($dados); // Momento onde os dados são enviados para a função login que está na classe usuarios.php e que fará o select e a comparação entre dados enviados com os que estão no banco

?>