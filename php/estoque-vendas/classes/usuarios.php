<?php

class usuarios{

	public function registroUsuario($dados){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		// Pegando a data atual
		$data = date('Y-m-d');

		$sql = "INSERT into usuarios (nome, user, email, senha, dataCaptura) VALUES ('$dados[0]', '$dados[1]', '$dados[2]', '$dados[3]', '$data')";
		// A função recebe um array "dados" da página registrarUsuário.php (que pega os dados enviados por ajax) e faz o insert no banco

		return mysqli_query($conexao,$sql);
		// Retorna true se funcionar

	}




	public function login($dados){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		$senha = sha1($dados[1]);  // Pegando o valor passado pelo array "dados" na página login.php onde o valor senha está na posição 1 do array, e fazendo a criptografia
		
		// Aqui os dados recebidos são armazenados em sessões para que o usuário possa logar no sistema e navegar por ele, já que essas serão requisitos para o acesso a página inicial (inicio.php) e o restante de páginas
		$_SESSION['usuario'] = $dados[0]; // Recebe o email
		$_SESSION['iduser'] = self::trazerId($dados);  // Sessão que trabalha com o id do usuário onde self indica que a função (trazerId) está nesse mesmo arquivo
		
		// Recuperando os dados do banco para verificar se o email (posição 0 do array passado em login.php) e a senha (variavel criptografada acima) são compatíveis
		$sql = "SELECT * from usuarios where email = '$dados[0]' and senha = '$senha' ";

		// Essa variável vai receber um único registro do banco
		$result = mysqli_query($conexao,$sql);

		// Se $result tiver encontrado o registro no banco, ela terá 1 registro (linha), e esse if irá verificar o número de linhas retornadas do banco, se for maior que zero (ou seja, se o registro existir), o if retornará o valor 1 que é o valor esperado pelo ajax na página index.php (no segundo bloco de códigos de <script>) para poder acessar a página inicial do sistema
		if(mysqli_num_rows($result) > 0){
			return 1; 
		}else{
			return 0;
		}

	}




	// Função para trazer o id do usuário do banco que está sendo chamada dentro da própria classe na função login
	public function trazerId($dados){
		$c = new conectar();
		$conexao = $c->conexao();  // Conectando com o Banco

		$senha = sha1($dados[1]);  // Pegando o valor passado pelo array "dados" na página login.php onde o valor senha está na posição 1 do array, e fazendo a criptografia

		// Procurando pelo id
		$sql = "SELECT id from usuarios where email = '$dados[0]' and senha = '$senha' ";

		$result = mysqli_query($conexao,$sql);
		return mysqli_fetch_row($result)[0];
		// Irá buscar a linha que contem o resultado de $result (id) permitindo que se utilize também o campo email (posição 0), o que é muito útil para mostrar na tela a informação ao invés do id, no caso, mostrará o email
	}




	public function obterDados($idusuario){

			$c = new conectar();
			$conexao=$c->conexao(); // Conectando com o Banco

			$sql="SELECT id,
							nome,
							user,
							email
					from usuarios 
					where id='$idusuario'";
			$result=mysqli_query($conexao,$sql);

			$mostrar=mysqli_fetch_row($result); // Contando e separando as linhas vindas do Banco ( que será a do id pedido)

			
			// Pegando os dados do SELECT armazenados em $mostrar e jogando no array $dados
			$dados=array(
						'id' => $mostrar[0],
							'nome' => $mostrar[1],
							'user' => $mostrar[2],
							'email' => $mostrar[3]
						);

			return $dados;
		}



		public function atualizar($dados){
			$c = new conectar();
			$conexao=$c->conexao(); // Conectando com o Banco

			$sql="UPDATE usuarios set nome='$dados[1]',
									user='$dados[2]',
									email='$dados[3]'
						where id='$dados[0]'";

					

			return mysqli_query($conexao,$sql);	
		}



		public function excluir($idusuario){
			$c = new conectar();
			$conexao=$c->conexao(); // Conectando com o Banco

			$sql="DELETE from usuarios 
					where id='$idusuario'";
			return mysqli_query($conexao,$sql);
			// Retorna true se funcionar
		}
	}






?>