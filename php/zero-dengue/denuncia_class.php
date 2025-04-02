<?php

class Denuncia{


	public function salvar($dados,$conexao){

		$query = "INSERT INTO `denuncia`(`id_usuario`, `status`, `seriedade`, `abertura`,`endereco`, `cidade`, `estado`, `descricao`) VALUES ('{$dados['id_usuario']}','ABERTA','{$dados['seriedade']}',CURRENT_DATE,'{$dados['endereco']}','{$dados['cidade']}','{$dados['estado']}','{$dados['descricao']}')";

		$sql = mysqli_query($conexao, $query); //1 - true

		if($sql){
			echo "Dados Salvos com Sucesso <br>";
			$last_id = mysqli_insert_id($conexao);
			$result = array();
			$result['sql'] = $sql;
			$result['last_id'] = $last_id;
			//echo "$sql";
			/*$redirect_url = "cadastro_view.php?s=1";
			header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));*/
			return $result;
		}else{
			echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
			/*$redirect_url = "cadastro_view.php?s=2";
			header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));*/
		}
	}


	public function cadastrar_fotoURL($url,$conexao,$denuncia){

		$query = "UPDATE `denuncia` SET `foto` = '$url' WHERE `id_denuncia` = '$denuncia'";

		$sql = mysqli_query($conexao, $query); //1 - true

		if($sql){
			echo "Foto Cadastrada com Sucesso! <br>";
			//echo "$sql";
			/*$redirect_url = "cadastro_view.php?s=1";
			header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));*/
			return $sql;
		}else{
			echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
			/*$redirect_url = "cadastro_view.php?s=2";
			header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));*/
		}
	}

	public function atualizar_denuncia($dados,$id_denuncia,$conexao){

		$query = "UPDATE `denuncia` SET `seriedade`= '{$dados['seriedade']}',`endereco`='{$dados['endereco']}',`cidade`='{$dados['cidade']}',`estado`='{$dados['estado']}',`descricao`='{$dados['descricao']}' WHERE `id_denuncia`= '{$id_denuncia}' AND `id_usuario`= '{$dados['id_usuario']}'";

		$sql = mysqli_query($conexao, $query); //1 - true

		if($sql){
			echo "Denuncia Atualizada com Sucesso! <br>";
			//echo "$sql";
			/*$redirect_url = "cadastro_view.php?s=1";
			header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));*/
			return $sql;
		}else{
			echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
			/*$redirect_url = "cadastro_view.php?s=2";
			header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));*/
		}

	}



	public function dados_denuncia($id_usuario,$conexao){

		$query = "SELECT `id_denuncia`, `status`, `seriedade`, `abertura`, `fechamento`, `endereco`, `cidade`, `estado`, `descricao`, `foto` FROM `denuncia` WHERE `id_usuario` = '{$id_usuario}'";

		$sql = mysqli_query($conexao, $query); // 1 - true

		if(mysqli_num_rows($sql) > 0){
			$dados = array();
			$row=mysqli_fetch_all($sql, MYSQLI_ASSOC);
				//fetch all p trazer tds os registros e mysqli assoc p associar as posições do vetor
				$dados = $row;
				
				return $dados;
			
		}else{
			echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
		}

	}

}

?>