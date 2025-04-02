<?php

	class Geral{

		private $servidor = "localhost";
		private $usuario = "root";
		private $senha = "";
		private $bd = "zero_dengue";

		public function conectar_bd(){

			$mysql = mysqli_connect($this->servidor, $this->usuario, $this->senha, $this->bd); // CONEXÃO COM O BANCO
			$mysql->query("SET NAMES 'utf8'"); // COLOCAR OS CARACTERES EM PT

			if(!$mysql){
				die("Erro ao Conectar:" . mysqli_connect_error());
			}else{
				//echo "Conectado com Sucesso <br>";
				return $mysql;
			}
		}



		public function salvar_foto($origem, $destino){

			if(move_uploaded_file($origem,$destino)){
				echo "Imagem Enviada com Sucesso";
			}else{
				echo "Falha ao Carregar Imagem";
			}

		}
	}

?>