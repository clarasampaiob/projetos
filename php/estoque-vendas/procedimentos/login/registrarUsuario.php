<?php

// Arquivo que recebe por ajax (no segundo bloco de códigos em <script>) os dados do formulário da página registrar.php 

require_once "../../classes/conexao.php"; // a Função registroUsuario exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/usuarios.php";

$obj = new usuarios();
$senha = sha1($_POST['senha']); // O "sha1" faz a codificação dos valores q estão vindo em senha, deixando criptografado
$dados = array(
	$_POST['nome'], // ['nome'] é o nome que está em name do imput nome no form
	$_POST['usuario'],
	$_POST['email'],
	$senha
);

echo $obj->registroUsuario($dados); // Momento onde os dados são enviados para a função registroUsuario que está na classe usuarios.php e que fará o Insert no banco. A função receberá um array

?>