<?php 

require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/fornecedores.php";


$obj = new fornecedores();

// Enviando e codificando dados via json e chamando a função obterDados da classe fornecedores.php
echo json_encode($obj->obterDados($_POST['idfornecedor'])); // idfornecedor está vindo por ajax da view fornecedores.php




 ?>