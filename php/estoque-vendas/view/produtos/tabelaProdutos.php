
<?php 
	require_once "../../classes/conexao.php";
	$c= new conectar();
	$conexao=$c->conexao();
	$sql="SELECT pro.nome,
					pro.descricao,
					pro.quantidade,
					pro.preco,
					img.url,
					cat.nome_categoria,
					pro.id_produto
		  from produtos as pro 
		  inner join imagens as img
		  on pro.id_imagem=img.id_imagem
		  inner join categorias as cat
		  on pro.id_categoria=cat.id_categoria";
	$result=mysqli_query($conexao,$sql);
	// o campo url é para imagem. O SELECT foi feito para pegar os dados e mostrar na tabela através do while que irá percorrer todos os campos da tabela no banco
	

 ?>

<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
	<caption><label>Produtos</label></caption>
	<tr>
		<td>Nome</td>
		<td>Descrição</td>
		<td>Quantidade</td>
		<td>Preço</td>
		<td>Imagem</td>
		<td>Categoria</td>
		<td>Editar</td>
		<td>Excluir</td>
	</tr>

	<?php while($mostrar=mysqli_fetch_row($result)): ?>

	<tr>
		<td><?php echo $mostrar[0]; ?></td>
		<td><?php echo $mostrar[1]; ?></td>
		<td><?php echo $mostrar[2]; ?></td>
		<td>R$ <?php echo $mostrar[3]; ?>,00</td>
		<td>

			

			<?php 
			// explode é qd vc vai extrair e separar algo de uma string, neste caso a separação será com base na "/"
			$imgVer=explode("/", $mostrar[4]) ; 
			$imgurl=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
			// Essa separação em vetor é onde ficam separados cada parte da url da imagem por exemplo: ../../arquivos/nomeimag.jpg (que seria um caminho real no caso desse sistema) ficaria imgVer[1] (..), imgVer[2] (..) e imgVer[3] (arquivos/nomeimag.jpg) armazenando então cada parte do caminho e nome da imagem
			// Dessa forma, o código irá procurar na pasta arquivos o arquivo c o nome em $mostrar[4] e irá carregar na tag abaixo que é a tag img
			?>
			<img width="80" height="80" src="<?php echo $imgurl ?>">
		</td>
		<td><?php echo $mostrar[5]; ?></td>
		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdateProduto" class="btn btn-warning btn-xs" onclick="addDadosProduto('<?php echo $mostrar[6] ?>')">
				<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminarProduto('<?php echo $mostrar[6] ?>')">
				<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>