
<?php

	session_start();
	

	if(isset($_GET['den'])){
		//var_dump($_GET);

		require_once "geral_class.php";
		require_once "denuncia_class.php";

		$obj = new Geral;
		$conexao = $obj->conectar_bd();

		$query = "SELECT `status`, `seriedade`, `endereco`, `cidade`, `estado`, `descricao`, `foto` FROM `denuncia` WHERE `id_usuario` = '{$_SESSION['id_user']}' AND `id_denuncia` = {$_GET['den']}";

			$sql = mysqli_query($conexao, $query); // 1 - true
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>DENUNCIAR</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body class="denuncia_bg">
	<div class="formulario">

	<form action="denuncia_controller.php" method="post" enctype="multipart/form-data" name="denuncia">
				
				<input type="hidden" name="id_usuario" value="<?php $_SESSION['id_user']; ?>">
				<?php if(isset($_GET['den'])): ?>
					<?php while($coluna = mysqli_fetch_row($sql)): ?>
					<input type="hidden" name="den" value="<?php echo $_GET['den']; ?>">
					<input type="hidden" name="foto" value="<?php echo $coluna[6]; ?>">
					<label class="imagem"> Seriedade</label>
					<select name="seriedade" required="">
						<option> <?php echo $coluna[1]; ?> </option>
					    <option value="ALTA">ALTA</option>
					    <option value="MEDIA">MÉDIA</option>
					    <option value="BAIXA">BAIXA</option>
					</select>

					<label class="margin"> Estado</label>
					<select name="estado" required="">
						<option> <?php echo $coluna[4]; ?> </option>
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
					</select><br><br>

					<input type="text" name="endereco" required="" class="input_denuncia" value="<?php echo $coluna[2]; ?> ">	<br>
					<label> Endereço </label><br>
				<input type="text" name="cidade" required="" value="<?php echo $coluna[3]; ?>"> <br>
					<label> Cidade</label><br>

					<input type="text" name="descricao" maxlength="1000" required="" value="<?php echo $coluna[5]; ?>"><br>
					<label> Descrição </label><br><br>
					<?php endwhile; ?>

				<input type="submit" value="Salvar" class="botao">
				

				<?php else: ?>







				
				<label class="imagem"> Seriedade</label>
					<select name="seriedade" required="">
						<option> </option>
					    <option value="ALTA">ALTA</option>
					    <option value="MEDIA">MÉDIA</option>
					    <option value="BAIXA">BAIXA</option>
					</select>

					<label class="margin"> Estado</label>
					<select name="estado" required="">
						<option> </option>
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
					</select><br><br>
				
				<input type="hidden" name="abertura" value="<?php date("Y-m-d"); ?>">
				<input type="text" name="endereco" required="" class="input_denuncia">	<br>
					<label> Endereço </label><br>
				<input type="text" name="cidade" required=""> <br>
					<label> Cidade</label><br>
					
				
					<input type="text" name="descricao" maxlength="1000" required=""><br>
					<label> Descrição </label><br><br>
					
				<label class="lateral">Foto</label>
					<input type="file" name="foto" class="lateral"><br><br>
				<input type="submit" value="Salvar" class="botao">
			<?php endif; ?>
			
		</form>
	</div>
</body>
</html>