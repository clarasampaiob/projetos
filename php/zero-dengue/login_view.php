<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> LOGIN </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="login_bg">

	<div class="login_box">
		<form action="login_controller.php" method="post" name="login" class="login_form">
				<input type="email" name="email" required="" class="lowercase login_input">
			<label class="login_label">E-mail</label>
				<input type="password" name="senha" required="" minlength="10" class="nenhum login_input">
			<label class="login_label">Senha</label>
			<input type="submit" value="Entrar" class="nenhum login_btn">	
		</form>
	</div>

</body>
</html>