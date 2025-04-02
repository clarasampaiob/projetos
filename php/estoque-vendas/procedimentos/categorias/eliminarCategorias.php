<?php

// Arquivo que recebe por ajax (no segundo bloco de códigos em <script>) os dados do formulário da página categorias.php 


require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/categorias.php";



$id = $_POST['idcategoria']; // enviado pelo ajax em categorias.php através da função eliminarCategoria que se encontra originalmente em tabelaCategoria.php 
	
$obj = new categorias();

echo $obj->excluirCategoria($id); // Momento onde os dados são enviados para a função excluirCategoria que está na classe categorias.php e que fará o delete no banco. 

?>