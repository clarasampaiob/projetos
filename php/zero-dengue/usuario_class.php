<?php

	class Usuario{

		public function get_cpf($id_usuario,$conexao){

			$query = "SELECT `cpf` FROM `usuario`";

			$sql = mysqli_query($conexao, $query); //1 - true
			//return $sql;

			if (mysqli_num_rows($sql) > 0) {
			  while($row = mysqli_fetch_assoc($sql)) {
			    $cpf = $row["cpf"];
			    return $cpf;
			  }
			} else {
			  echo "CPF não encontrado";
			}
		}


		public function atualizar_dados($id_usuario,$dados,$conexao){

			$query = "UPDATE `usuario` SET `cpf`='{$dados['cpf']}',`nome`='{$dados['nome']}',`endereco`='{$dados['endereco']}',`cidade`='{$dados['cidade']}',`estado`='{$dados['estado']}',`sexo`='{$dados['sexo']}',`telefone`='{$dados['telefone']}',`email`='{$dados['email']}' WHERE `id_usuario` = '{$id_usuario}'";

			$sql = mysqli_query($conexao, $query); //1 - true
			
			if($sql){
				echo "Dados Salvos com Sucesso <br>";
				//echo "$sql";
				$redirect_url = "Verperfil_view.php?s=1";
				header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
				return $sql;
			}else{
				echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
				/*$redirect_url = "cadastro_view.php?s=2";
				header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));*/
			}
		}
	}

?>