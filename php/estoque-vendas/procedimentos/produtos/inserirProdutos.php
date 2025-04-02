<?php 
	session_start();
	$iduser=$_SESSION['iduser']; // Pegando a sessão do usuário
	require_once "../../classes/conexao.php";
	require_once "../../classes/produtos.php";

	$obj= new produtos();

	$dados=array();
	
	$nomeImg=$_FILES['imagem']['name']; // armazena o caminho que veio do formulario no campo de tipo file - [nome do campo] [parametro name automatico do $_FILES]
	
	$urlArmazenamento=$_FILES['imagem']['tmp_name']; // Nome temporário dado pra imagem que é executado pelo botão do form Browse que é o botão automatico do campo do tipo file - [nome do campo] [parametro tmp_name automatico do $_FILES]

	$pasta='../../arquivos/';
	$urlFinal=$pasta.$nomeImg;

	$dadosImg=array(
		$_POST['categoriaSelect'], // é o campo Select da categoria
		$nomeImg,
		$urlFinal
					);

		// Função do php move_uploaded_file que verifica o upload do arquivo assim que é clicado no botão salvar do form e permite que seja enviado. Ou seja, se o arquivo de upload tiver sido enviado ao clicar em salvar, $idimagem receberá um valor
		if(move_uploaded_file($urlArmazenamento, $urlFinal)){
				$idimagem=$obj->addImagem($dadosImg);
				// a função addImagem faz a inserção da imagem no banco primeiro, pois a tabela de imagens é uma tabela separada da tabela de produtos. A variável $idimagem aarmazena o id dessa inserção através da função addImagem que retorna esse id através do mysqli_insert_id

				// Se idimagem for maior que 0, ou seja, se o insert da imagem tiver sido feito e receber algum id, aí será feito o insert do produto, através da função inserirProduto. Os dados enviados são os dados que vieram do frmProdutos. Esse array $dados já foi criado no início dessa página, mas foi criado vazio para ser implementado aqui
				if($idimagem > 0){

					$dados[0]=$_POST['categoriaSelect'];
					$dados[1]=$idimagem;
					$dados[2]=$iduser;
					$dados[3]=$_POST['nome'];
					$dados[4]=$_POST['descricao'];
					$dados[5]=$_POST['quantidade'];
					$dados[6]=$_POST['preco'];
					echo $obj->inserirProduto($dados);
				}else{
					echo 0;
				}
		}

 ?>