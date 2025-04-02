<?php

class categorias{

	public function adicionarCategoria($dados){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		
		$sql = "INSERT into categorias (id_usuario, nome_categoria, dataCaptura) VALUES ('$dados[0]', '$dados[1]', '$dados[2]')";
		// A função recebe um array "dados" da página adicionarCategorias.php (que pega os dados enviados por ajax) e faz o insert no banco

		return mysqli_query($conexao,$sql);
		// Retorna true se funcionar

	}



	public function atualizarCategoria($dados){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		
		$sql = "UPDATE categorias SET nome_categoria = '$dados[1]' where id_categoria = '$dados[0]' ";
		// A função recebe um array "dados" da página atualizarCategorias.php (que pega os dados enviados por ajax) e faz o update no banco

		echo mysqli_query($conexao,$sql); // Pra mostrar na tela 
	}



	public function excluirCategoria($idcategoria){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco


		$sql = "DELETE from categorias where id_categoria = '$idcategoria' ";
		// O campo idcategoria (name) está no frmCategoriaU enviado em categorias.php no modal

		return mysqli_query($conexao,$sql);
		// Retorna true se funcionar
	}
}

?>


