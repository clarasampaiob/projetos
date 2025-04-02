<?php

class clientes{

	public function adicionarCliente($dados){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		
		$sql = "INSERT into clientes (id_usuario, nome, sobrenome, endereco, email, telefone, cpf) VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$dados[4]', '$dados[5]', '$dados[6]')";
		// A função recebe um array "dados" da página adicionarClientes.php (que pega os dados enviados por ajax) e faz o insert no banco

		return mysqli_query($conexao,$sql);
		// Retorna true se funcionar

	}



	public function obterDadosCliente($idcliente){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		$sql = "SELECT id_cliente, nome, sobrenome, endereco, email, telefone, cpf from clientes where id_cliente = '$idcliente' ";

		$result = mysqli_query($conexao,$sql);
		$mostrar = mysqli_fetch_row($result); // Contando e separando as linhas vindas do Banco

		// Passando as informações coletadas no $mostrar para as variáveis em um array
		$dados = array(
			'id_cliente' => $mostrar[0],
			'nome' => $mostrar[1],
			'sobrenome' => $mostrar[2],
			'endereco' => $mostrar[3],
			'email' => $mostrar[4],
			'telefone' => $mostrar[5],
			'cpf' => $mostrar[6]
		);

		return $dados;
	}




	public function atualizarCliente($dados){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		
		$sql = "UPDATE clientes SET nome = '$dados[1]', sobrenome = '$dados[2]', endereco = '$dados[3]', email = '$dados[4]', telefone = '$dados[5]', cpf = '$dados[6]' where id_cliente = '$dados[0]' ";
		// A função recebe um array "dados" da página atualizarClientes.php (que pega os dados enviados por ajax) e faz o update no banco

		echo mysqli_query($conexao,$sql); // Pra mostrar na tela 
	}



	public function excluirCliente($id){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco


		$sql = "DELETE from clientes where id_cliente = '$id' ";

		return mysqli_query($conexao,$sql);
		// Retorna true se funcionar
	}
}

?>


