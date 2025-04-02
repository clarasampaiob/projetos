
<?php

	session_start();
	
	var_dump($_SESSION);
	
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> HOME </title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body class="home_bg">

	<div class="home_menu">
		<ul>
			<li><a href="criarDenuncia_view.php"><img src="layout/criar_denuncia.jpg"></a></li>
			<li class="lista"><a href="verDenuncia_view.php"><img src="layout/ver_denuncia.jpg"></a></li>
			<li class="lista"><a href="verPerfil_view.php?user=<?php echo $_SESSION['id_user']; ?>"><img src="layout/ver_perfil.jpg"></a></li>
		</ul>
	</div>

</body>
</html>