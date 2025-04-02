<?php 

	
	session_start();
	$index=$_POST['ind']; // recebe o ind q esta vindo de vendasDePodutos.php
	unset($_SESSION['tabelaComprasTemp'][$index]); // remove o indice da sessao
	


	

 ?>