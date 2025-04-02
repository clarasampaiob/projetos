<?php
echo "<pre>";
	session_start();
	$_SESSION['id_user'] = 15;
	
	require_once "geral_class.php";
	require_once "denuncia_class.php";

	$obj = new Geral;
	$conexao = $obj->conectar_bd();

	$query = "SELECT `id_denuncia`, `status`, `seriedade`, `abertura`, `endereco`, `cidade`, `estado`, `descricao`,`foto` FROM `denuncia` WHERE `id_usuario` = '{$_SESSION['id_user']}'";

		$sql = mysqli_query($conexao, $query); // 1 - true

		/*if(mysqli_num_rows($sql) > 0){
			$dados = array();
			$row=mysqli_fetch_all($sql, MYSQLI_ASSOC);
				//fetch all p trazer tds os registros e mysqli assoc p associar as posições do vetor
				$dados = $row;
				
				var_dump($dados);

		}*/
			
?>




<!DOCTYPE html>
<html>
<head>
	<title>MINHAS DENUNCIAS</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body class="table_bg">
	<div class="tabela">

		<table>
			<caption><label>Minhas Denúncias</label></caption>
				<tr class="titulo">
					<td>Código</td>
					<td>Status</td>
					<td>Seriedade</td>
					<td>Abertura</td>
					<td>Endereço</td>
					<td>Cidade</td>
					<td>Estado</td>
					<td>Descrição</td>
					<td>Foto</td>
					<td>Editar</td>
					<td>Excluir</td>
				</tr>

				<?php while($coluna = mysqli_fetch_row($sql)): ?>
					<?php $d = explode("-", $coluna[3]); ?>
					<?php $data = $d[2].'/'.$d[1].'/'.$d[0]; ?>
					<?php //var_dump($data); ?>

					<tr>
						<td><?php echo $coluna[0]; ?></td>
						<td><?php echo $coluna[1]; ?></td>
						<td><?php echo $coluna[2]; ?></td>
						<td><?php echo $data; ?></td>
						<td><?php echo $coluna[4]; ?></td>
						<td><?php echo $coluna[5]; ?></td>
						<td><?php echo $coluna[6]; ?></td>
						<td><?php echo $coluna[7]; ?></td>
						<td><img width="80" height="80" src="<?php echo $coluna[8]; ?>"></td>
						<td><a href="criarDenuncia_view.php?den=<?php echo $coluna[0]; ?>"> Editar</td>
						<td><a href="excluirDenuncia_controller.php?den=<?php echo $coluna[0]; ?>"> Excluir</td>	
					</tr>

				<?php endwhile; ?>

		</table>
				

	</div>

	<?php if(isset($_GET['s']) && $_GET['s'] == 1): ?>
		<h2> DENUNCIA EXCLUIDA COM SUCESSO! </h2>
	<?php endif; ?>
</body>
</html>