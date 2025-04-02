
<?php 
	// Como para esse SELECT não foi necessário receber dados de nenhuma outra página, não houve intermédio de nenhuma classe ou procedimento, por isso ele pode ser feito na própria página em que é necessário
	require_once "../../classes/conexao.php"; 
	$c = new conectar();
	$conexao = $c->conexao();  // Conectando com o Banco

	$sql = "SELECT id_categoria, nome_categoria FROM categorias";
	$result = mysqli_query($conexao,$sql);
	

 ?>




<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Categorias</label></caption>
	<tr>
		<td>Categoria</td>
		<td>Editar</td>
		<td>Excluir</td>
	</tr>

	<!-- Criando um laço de repetição para que possa percorrer todos os dados do banco relacionados a categorias e exibir todos eles na tela enquanto existirem -->
	<?php while($mostrar = mysqli_fetch_row($result)): ?> 
		<!-- Dois pontos substituem as chaves {} no php, nesse caso a chave que abre o código { -->
		<!-- $result está no começo dessa página com o SELECT -->
	<tr>
		<td><?php echo $mostrar[1]; ?></td> <!-- Linha onde aparecem os nomes das categorias salvas no Banco, pois é a variável $mostrar (do while) na posição 1 que é a posição onde está os dados do nome_categoria -->
		<td>
			<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#atualizaCategoria" onclick="adicionarDado('<?php echo $mostrar[0]; ?>','<?php echo $mostrar[1]; ?>')">
				<!-- A função adicionarDado está enviando como parâmetros o array que recebeu os valores do SELECT feito no início dessa página, portanto tem o id e o nome da categoria, e assim envia esses dados qd a função é chamda na view categorias.php -->
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaCategoria('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>

<?php endWhile; ?>
</table>