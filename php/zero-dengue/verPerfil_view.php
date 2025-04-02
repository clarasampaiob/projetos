<?php
echo "<pre>";
	session_start();
	//$_SESSION['id_user'] = 15;
	
	require_once "geral_class.php";

	$obj = new Geral;
	$conexao = $obj->conectar_bd();

	$query = "SELECT `cpf`, `nome`, `endereco`, `cidade`, `estado`, `sexo`, `telefone`, `email` FROM `usuario` WHERE `id_usuario` = '{$_SESSION['id_user']}'";

		$sql = mysqli_query($conexao, $query); // 1 - true

		
?>




<!DOCTYPE html>
<html>
<head>
	<title>MEU PERFIL</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body class="perfil_bg">
	
	<div>
		<?php if(isset($_GET['s']) && $_GET['s'] == 1): ?>
		<h2> ATUALIZADO COM SUCESSO! </h2>
	<?php endif; ?>
	</div>
	<div>
		
		<form action="perfil_controller.php" method="post" name="perfil" class="box_form">
			<?php while($coluna = mysqli_fetch_row($sql)): ?>

				<input type="text" name="cpf" maxlength="14" required="" onkeypress="mascara(this, '###.###.###-##')" value="<?php echo $coluna[0]; ?>" >
					<label> CPF </label>
				<input type="text" name="nome" required="" value="<?php echo $coluna[1]; ?>">	
					<label> Nome </label>
				<input type="text" name="endereco" required="" value="<?php echo $coluna[2]; ?>">	
					<label> Endereço </label>
				<input type="text" name="cidade" required="" value="<?php echo $coluna[3]; ?>">
					<label> Cidade</label><br><br>
					
				<label class="estado"> Estado</label>
					<select name="estado" required="" class="estado_select">
						<option> <?php echo $coluna[4]; ?></option>
					    <option value="AC">AC</option>
					    <option value="AL">AL</option>
					    <option value="AP">AP</option>
					    <option value="AM">AM</option>
					    <option value="BA">BA</option>
					    <option value="CE">CE</option>
					    <option value="DF">DF</option>
					    <option value="ES">ES</option>
					    <option value="GO">GO</option>
					    <option value="MA">MA</option>
					    <option value="MT">MT</option>
					    <option value="MS">MS</option>
					    <option value="MG">MG</option>
					    <option value="PA">PA</option>
					    <option value="PB">PB</option>
					    <option value="PR">PR</option>
					    <option value="PE">PE</option>
					    <option value="PI">PI</option>
					    <option value="RJ">RJ</option>
					    <option value="RN">RN</option>
					    <option value="RS">RS</option>
					    <option value="RO">RO</option>
					    <option value="RR">RR</option>
					    <option value="SC">SC</option>
					    <option value="SP">SP</option>
					    <option value="SE">SE</option>
					    <option value="TO">TO</option>
					    <option value="EX">EXTERIOR</option>
					</select>
				<label class="sexo"> Sexo</label>
				<?php if($coluna[5] == 'm'): ?>
					<select name="sexo" required="" class="sexo_select">
						<option value="m">MASCULINO</option>
					    <option value="f">FEMININO</option>
					  </select>
				<?php elseif($coluna[5] == 'f'): ?>
					<select name="sexo" required="" class="sexo_select">
						<option value="f">FEMININO</option>
					    <option value="m">MASCULINO</option>
					   </select>
				<?php endif; ?>

				<div class="posicao">
				<input type="text" name="telefone" maxlength="13" onkeypress="mascara(this, '## #####-####')" value="<?php echo $coluna[6]; ?>">
					<label>Celular</label>
				<input type="email" name="email" required="" class="lowercase" value="<?php echo $coluna[7]; ?>">
					<label>E-mail</label>
				</div>
					
			<?php endwhile; ?>
			<input type="submit" value="Salvar" class="btn_form">
			</form>
	</div>
	

</body>
</html>