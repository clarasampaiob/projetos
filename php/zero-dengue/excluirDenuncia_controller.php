<?php
require_once "geral_class.php";
echo "<pre>";

// CONECTANDO COM O BANCO
$obj = new Geral;
$conexao = $obj->conectar_bd();

$query = "UPDATE `denuncia` SET `status`= 'DEL' WHERE `id_denuncia`= '{$_GET['den']}'";

		$sql = mysqli_query($conexao, $query); //1 - true

		if($sql){
			echo "Denuncia Atualizada com Sucesso! <br>";
			//echo "$sql";
			$redirect_url = "verDenuncia_view.php?s=1";
			header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
			return $sql;
		}else{
			echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
			
		}


?>