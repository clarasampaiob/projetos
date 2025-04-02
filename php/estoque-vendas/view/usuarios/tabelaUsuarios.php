<?php 
	
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();

	$sql="SELECT id,
					nome,
					user,
					email
			from usuarios";
	$result=mysqli_query($conexao, $sql);

 ?>


<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Usuários</label></caption>
	<tr>
		<td>Nome</td>
		<td>Usuário</td>
		<td>Email</td>
		<td>Editar</td>
		<td>Excluir</td>
	</tr>

	<?php while($mostrar = mysqli_fetch_row($result)): ?>
	<!-- Enquanto $mostrar receber um registro do banco (mysqli_fetch_row conta os registros) mostra-lo na tabela com os botões de editar e excluir. os registros estão vindo do SELECT feito no início da página -->
	<tr>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td><?php echo $mostrar[3]; ?></td>
		<td>
			<span data-toggle="modal" data-target="#atualizaUsuarioModal" class="btn btn-warning btn-xs" onclick="adicionarDados('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarUsuario('<?php echo $mostrar[0]; ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>

<?php endwhile; ?>
</table>

<!-- Ambos os botões de editar qto excluir chamam funções (que estão na view usuarios.php) ao clicar neles e passam como dado o $mostrar[0] que é a posição do id de acordo com o SELECT -->