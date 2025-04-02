<!DOCTYPE html>

<html lang="pt-br">
	<head>
    	<meta http-equiv="content-type" charset="utf-8"/>
        <title>Pedido</title>
                
	</head>
<body>

	<?php
		//Recebendo os dados do formulário.
		
		$nome = $_POST["nome"];
		$end = $_POST["end"];
		$Refeiçao = $_POST["Refeiçao"];
		$quant = $_POST["quant"];
		$email = $_POST["email"];
				
		$conteudo1 = "Nome: $nome <br> end:$end <br>Refeiçao: $Refeiçao<br> Quantidade: $quant <br> E-mail: $email ";
		$emaildestino = "leh_cocamix@hotmail.com";
		$headers = "MINE_Version: 1.0\r\n";
		$headers .="Content-type: text/html; charset=iso-8859-1\rzn";
		$headers .="From: $emai";
		$assuntodoemail = "Estação Caseira - Pedidos";
		
		$enviar = mail($emaildestino, $Refeiçaodoemail, $conteudo1, $headers);
		
		if($enviar)
		{
			echo "<script type='text/javascript'>
			alert('Contato Enviado com Sucesso!');
			window.location.href='Pag5.html';
			</script>";
		}
		else
		{
			echo "<script type='text/javascript'>
			alert('Ocorreu algum erro ao enviar o fomul&Aacute;rio');
			</acript>";
		}

	?>
</body>
</html>