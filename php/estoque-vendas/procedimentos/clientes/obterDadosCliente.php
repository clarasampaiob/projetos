<?php 

require_once "../../classes/conexao.php"; // a Função exige conexão com o banco por isso é necessário chamar a classe conexão
require_once "../../classes/clientes.php";


$obj = new clientes();

// Enviando e codificando dados via json e chamando a função obterDadosCliente da classe clientes.php
echo json_encode($obj->obterDadosCliente($_POST['idcliente'])); // idcliente está vindo por ajax da view clientes.php




 ?>