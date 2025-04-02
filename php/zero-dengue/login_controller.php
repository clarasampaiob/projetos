<?php

require_once 'geral_class.php';

echo "<pre>";
var_dump($_POST);

$obj = new Geral;
$conexao = $obj->conectar_bd();

$dados = array();
$dados['email'] = strtolower($_POST['email']);

$query = "SELECT `id_usuario`, `email`, `senha` FROM `usuario` WHERE email = '{$dados['email']}'";
$sql = mysqli_query($conexao, $query); // 1 - true

if(mysqli_num_rows($sql) > 0){
	while($row=mysqli_fetch_assoc($sql)){
		echo "ID: " . $row['id_usuario'] . "<br>EMAIL: " . $row['email'] . "<br>SENHA: " . $row['senha'] . "<br>";
		$dados['id'] = $row['id_usuario'];
		$dados['senha'] = $row['senha'];
	}
}else{
	echo "EMAIL INCORRETO OU NÃO CADASTRADO";
}


if(password_verify($_POST['senha'],$dados['senha'])){
	echo "SENHA CORRETA";
	$_SESSION['id_user'] = $dados['id'];
}else{
	echo "SENHA INCORRETA";
}

var_dump($_SESSION);
?>