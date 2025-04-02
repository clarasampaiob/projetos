<?php

// Arquivo que recebe por ajax (no segundo bloco de códigos em <script>) os dados do formulário da página categorias.php 


require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/categorias.php";


$obj = new categorias();
$dados = array(
	$_POST['idcategoria'], // em name no frmCategoriaU enviado no modal de categorias.php através da função adicionarDado que se encontra originalmente em tabelaCategoria.php
	$_POST['categoriaU'] // em name no formCategoriaU enviado em categorias.php no modal
);

echo $obj->atualizarCategoria($dados); // Momento onde os dados são enviados para a função atualizarCategoria que está na classe categorias.php e que fará o Update no banco. A função receberá um array

?>