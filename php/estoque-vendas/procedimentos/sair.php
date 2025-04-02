<?php 

	session_start(); // Evita erros no sistema caso a sessão não esteja aberta na hora de sair
	session_destroy(); // Finaliza a sessão

	header("location:../index.php");

 ?>