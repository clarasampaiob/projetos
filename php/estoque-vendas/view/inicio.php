
<?php
	session_start(); // Iniciando a sessão do usuário após o login

	// Se a sessão de usuário existir ela abre a página html (lembrando que a página atual é aquela exibida após a página de login (index.php), portanto a sessão tem q já ter sido criada e também iniciada para fazer a verificação)
	if(isset($_SESSION['usuario'])){
		// Conteúdo HTML abaixo (OBS: a chave de fechamento } será usada apenas no fim da página após os códigos html)
?>


<!DOCTYPE html>
<html>
<head>
	<title> Início </title>
	<?php require_once "menu.php"; ?>
</head>
<body>
Pagina inicial
</body>
</html>


<?php
	} else{
		// Se a sessão não existir o usuário continuará na página index
		header("location:../index.php");
	}
?>