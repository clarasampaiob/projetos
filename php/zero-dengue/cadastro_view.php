<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> CADASTRO </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="cadastro_bg">
	<?php if($_GET == null): ?>
		<div class="forms">
		<div class="cadastro_form">
			<form action="cadastro_controller.php" method="post" enctype="multipart/form-data" name="cadastro">
				<input type="text" name="cpf" maxlength="14" required="" onkeypress="mascara(this, '###.###.###-##')">
					<label> CPF </label>
				<input type="text" name="nome" required="">	
					<label> Nome </label>
				<input type="text" name="endereco" required="">	
					<label> Endereço </label>
				<input type="text" name="cidade" required="">
					<label> Cidade</label><br><br>
					
				<label> Estado</label>
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
					</select>
				<label> Sexo</label>
					<input type="radio" name="sexo" value="m" class="radio"> Masculino
					<input type="radio" name="sexo" value="f" class="radio"> Feminino

				
				<input type="text" name="telefone" maxlength="13" onkeypress="mascara(this, '## #####-####')">
					<label>Celular</label>
				<input type="email" name="email" required="" class="lowercase">
					<label>E-mail</label>
				<input type="password" name="senha" required="" minlength="10" class="nenhum">
					<label>Senha</label><br>
					
				<label class="lateral">Foto</label>
					<input type="file" name="foto" class="lateral">
				<input type="submit" value="Salvar" class="nenhum botao">
			</form>
		</div>
	</div>
	<?php elseif($_GET['s'] == 1): ?>
		<h1> Seus dados foram cadastrados com sucesso! Clique aqui para fazer Login </h1>
	<?php elseif($_GET['s'] == 2): ?>
		<h1> Erro ao cadastrar seus dados! Cheque seu cpf e e-mail</h1>
	<?php endif; ?>
</body>
</html>

<script language="JavaScript">
	function mascara(t, mask){
		var i = t.value.length;
		var saida = mask.substring(1,0);
		var texto = mask.substring(i)
		if (texto.substring(0,1) != saida){
		t.value += texto.substring(0,1);
		}
	}
 </script>

<!--required: obriga o preenchimento -->
<!--lang: informar pro navegador a lingua -->
<!--meta charset pra definir a acentuação -->
<!-- enctype="multipart/form-data" para enviar arquivos-->