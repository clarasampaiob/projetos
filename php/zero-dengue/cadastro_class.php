<?php 

	class Cadastro{

		public function salvar($dados,$conexao){

			$query = "INSERT INTO `usuario`(`cpf`, `nome`, `endereco`, `cidade`, `estado`, `sexo`, `telefone`, `email`, `senha`, `foto`) VALUES ('{$dados['cpf']}','{$dados['nome']}','{$dados['endereco']}','{$dados['cidade']}','{$dados['estado']}','{$dados['sexo']}','{$dados['telefone']}','{$dados['email']}','{$dados['senha']}','{$dados['url']}')";

			$sql = mysqli_query($conexao, $query); //1 - true
			
			if($sql){
				echo "Dados Salvos com Sucesso <br>";
				echo "$sql";
				$redirect_url = "cadastro_view.php?s=1";
				header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
				return $sql;
			}else{
				echo "Erro: " . $query . "<br>" . mysqli_error($conexao);
				$redirect_url = "cadastro_view.php?s=2";
				header('Location: ' . filter_var($redirect_url, FILTER_SANITIZE_URL));
			}
		}
	}




?>