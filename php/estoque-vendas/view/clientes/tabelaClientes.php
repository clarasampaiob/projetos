
<?php 
	// Como para esse SELECT não foi necessário receber dados de nenhuma outra página, não houve intermédio de nenhuma classe ou procedimento, por isso ele pode ser feito na própria página em que é necessário
	require_once "../../classes/conexao.php"; 
	$c = new conectar();
	$conexao = $c->conexao();  // Conectando com o Banco

	$sql = "SELECT id_cliente, nome, sobrenome, endereco, email, telefone, cpf FROM clientes";
	$result = mysqli_query($conexao,$sql);
	

 ?>




<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Clientes</label></caption>
	<tr>
		<td>Nome</td>
 		<td>Sobrenome</td>
 		<td>Endereço</td>
 		<td>Email</td>
 		<td>Telefone</td>
 		<td>CPF</td>
 		<td>Editar</td>
 		<td>Excluir</td>	 
	</tr>

	<!-- Criando um laço de repetição para que possa percorrer todos os dados do banco relacionados a clientes e exibir todos eles na tela enquanto existirem -->
	<?php while($mostrar = mysqli_fetch_row($result)): ?> 
		<!-- Dois pontos substituem as chaves {} no php, nesse caso a chave que abre o código { -->
		<!-- $result está no começo dessa página com o SELECT -->
	<tr>
		<td><?php echo $mostrar[1]; ?></td> <!-- Linha onde aparecem os dados do cliente salvas no Banco, onde cada posição é um dado -->
		<td><?php echo $mostrar[2]; ?></td>
		<td><?php echo $mostrar[3]; ?></td>
		<td><?php echo $mostrar[4]; ?></td>
		<td><?php echo $mostrar[5]; ?></td>
		<td><?php echo $mostrar[6]; ?></td>
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#abremodalClientesUpdate" onclick="adicionarDado('<?php echo $mostrar[0]; ?>')">
				<!-- A função adicionarDado está enviando como parâmetros o array que recebeu os valores do SELECT feito no início dessa página, portanto tem os dados de cliente, e assim envia esses dados qd a função é chamda na view clientes.php -->
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarCliente('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>

<?php endWhile; ?>
</table>