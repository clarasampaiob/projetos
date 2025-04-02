<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title> Produção Calçados</title>
        <script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        <script src="plugin/bootstraptable/bootstrap-table.min.js" type="text/javascript"></script>
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="plugin/bootstraptable/bootstrap-table.min.css">

    </head>
    <body>
        <?php
        
        $obj_mysqli = new mysqli("127.0.0.1", "root", "", "sys_unopar");


        
        if ($obj_mysqli->connect_errno) {

            echo "Erro na Conexão com o Banco de Dados.";
            exit;
        }


        // Configuração dos Caracteres para as Variáveis
        mysqli_set_charset($obj_mysqli, 'utf8');
        $id = -1;
        $dataa = "";
        $estoque = "";
        $tpcalcado = "";
        $qtddprod = "";
        $numero = "";
        $cor = "";


        // Verificando a Existência das Variáveis e Atribuindo Valores
        if (isset($_POST["data"]) && isset($_POST["estoque"]) && isset($_POST["tipocalcado"]) && isset($_POST["qtddprod"]) && isset($_POST["numero"]) && isset($_POST["cor"]) && isset($_POST["id"])) {

            $id = $_POST["id"];
            $dataa = $_POST["data"];
            $estoque = $_POST["estoque"];
            $tpcalcado = $_POST["tipocalcado"];
            $qtddprod = $_POST["qtddprod"];
            $numero = $_POST["numero"];
            $cor = $_POST["cor"];


            // Operação de Insert no Banco
            if (isset($id) && $id == -1) {

                // Operação de Inserção
                $stmt = $obj_mysqli->prepare("INSERT INTO `producao` (`data_prod`,`id_estoque`,`id_tipo`,`qtdd_prod`,`numeracao_calcado`,`cor_calcado`) VALUES (?,?,?,?,?,?)");
                $stmt->bind_param('siiiis', $dataa, $estoque, $tpcalcado, $qtddprod, $numero, $cor);
                

                // Se Ocorrer um Erro
                if (!$stmt->execute()) {
                    $erro = $stmt->error;
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Erro ao Inserir os Dados";
                }
                
            } else {

                // Operação de Update no Banco
                if (isset($id) && is_numeric($id) && $id >= 1) {

                    // Operação de Update
                    $stmt = $obj_mysqli->prepare("UPDATE `producao` SET `data_prod`=?, `id_estoque`=?, `id_tipo`=?, `qtdd_prod`=?, `numeracao_calcado`=?, `cor_calcado`=? WHERE id_lote = ? ");
                    $stmt->bind_param('siiiisi', $dataa, $estoque, $tpcalcado, $qtddprod, $numero, $cor, $id);


                    // Se Ocorrer um Erro
                    if (!$stmt->execute()) {
                        $erro = $stmt->error;
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Erro ao Atualizar os Dados";
                    } else {
                        // Retorna a Página
                        header("Location:Producao.php");
                        exit;
                    }
                }

            }

        } // Primeiro If

        else // Operação de Delete no Banco
        {
            if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
                $id = (int)$_GET["id"];

                // Esse del será passado pela variável $result na Table ao final do doc
                if (isset($_GET["del"])) {
                    $stmt = $obj_mysqli->prepare("DELETE FROM `producao` WHERE id_lote = ?");
                    $stmt->bind_param('i', $id);  // i = Tipo int
                    $stmt->execute();
                    header("Location:Producao.php");
                    exit;
                } else {
                    $stmt = $obj_mysqli->prepare("SELECT * FROM `producao` WHERE id_lote = ?");
                    $stmt->bind_param('i', $id);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $aux_query = $result->fetch_assoc();
                    $dataa = $aux_query["data_prod"];
                    $estoque = $aux_query["id_estoque"];
                    $tpcalcado = $aux_query["id_tipo"];
                    $qtddprod = $aux_query["qtdd_prod"];
                    $numero = $aux_query["numeracao_calcado"];
                    $cor = $aux_query["cor_calcado"];
                }

                $stmt->close();

                //VERIFICA SE FOI CLICADO NO DAR BAIXA OU EM DESFAZER
                if (isset($_GET["bai"]) || isset($_GET["des"])) {
                    $baixa = (isset($_GET["bai"]) ? 1 : 0); 
                    $stmt = $obj_mysqli->prepare("UPDATE `producao` SET `baixa`=? WHERE id_lote = ? "); 
                    //FAZ O UPDATE DO CAMPO BAIXA NA TABELA PRODUCAO
                    $stmt->bind_param('ii', $baixa, $id);

                    // Se Ocorrer um Erro
                    if (!$stmt->execute()) {
                        $erro = $stmt->error;
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Erro ao Atualizar os Dados";
                    } else {
                        // Retorna a Página
                        header("Location:Producao.php");
                        //echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br><br> Dados Cadastrados com sucesso!";
                        exit;
                    }
                }

            }
        }


        ?>

        <div class="panel panel-default">
            <div class="panel-heading">

                <!-- Título da Página -->

                <center><h3 style="margin-left:20px;"><i><b><font color='#7B5C91' size='5'> Produção de Calçados </font></b></i><br>
                    </h3></center>
            </div>
            <div class="panel-body">

                <!-- Formulário -->
                <div class="col-md-4"><!-- dividir a tela -->
                    <div class="panel panel-default">
                        <div class="panel panel-heading">
                            <h3>Cadastro Produção</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="<?= $_SERVER["PHP_SELF"] ?>">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Data:</label>
                                        <input class="form-control" type='date' name='data' required=''
                                               value='<?php if (isset($dataa)) echo $dataa ?>'>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Estoque:</label>
                                        <select class="form-control" name="estoque">
                                            <?php
                                            $result = $obj_mysqli->query("SELECT * FROM `estoque`");
                                            while ($aux_query = $result->fetch_assoc()) { ?>

                                                <option <?php if (isset($estoque) && $estoque == $aux_query['id_estoque']) echo 'selected' ?>
                                                        value="<?php echo $aux_query['id_estoque'] ?>"> <?php echo $aux_query['nome_estoque'] ?></option>

                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label> Tipo Calçado: </label>
                                        <select class="form-control" name="tipocalcado">
                                            <?php
                                            $result = $obj_mysqli->query("SELECT * FROM `tipo_calcado`");
                                            while ($aux_query = $result->fetch_assoc()) { ?>

                                                <option <?php if (isset($tpcalcado) && $tpcalcado == $aux_query['id_tipo']) echo 'selected' ?>
                                                        value="<?php echo $aux_query['id_tipo'] ?>"> <?php echo $aux_query['nome_tipo'] ?></option>

                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Quantidade:</label>
                                        <input class="form-control" type='number' name='qtddprod' required=''
                                               value='<?php if (isset($qtddprod)) echo $qtddprod ?>'>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Numeração: </label>
                                        <input class="form-control" type='number' name='numero' required=''
                                               value='<?php if (isset($numero)) echo $numero ?>'>
                                    </div>
                                </div>

                                <?php
                                //<div class="row"><!-- pular linha <br> -->
                                //<div style="margin-left: 20px;">

                                //<div class="radio">
                                //<label style="margin-top: 40px;">?>
                                <label><b> &nbsp;&nbsp;&nbsp;&nbsp;Cor:</b></label><br>
                                <label>&nbsp;&nbsp;&nbsp;
                                    <input type='radio' name='cor' id='preto'
                                           value='preto' <?php if (isset($cor) && $cor == "preto") {
                                        echo "checked";
                                    } ?>><i> Preto</i>
                                </label>

                                <label>&nbsp;
                                    <input type='radio' name='cor' id='branco'
                                           value='branco' <?php if (isset($cor) && $cor == "branco") {
                                        echo "checked";
                                    } ?>><i> Branco</i>
                                </label>

                                <label>&nbsp;&nbsp;&nbsp;
                                    <input type='radio' name='cor' id='bege'
                                           value='bege' <?php if (isset($cor) && $cor == "bege") {
                                        echo "checked";
                                    } ?>><i> Bege</i>
                                </label>

                                <label>&nbsp;
                                    <input type='radio' name='cor' id='vinho'
                                           value='vinho' <?php if (isset($cor) && $cor == "vinho") {
                                        echo "checked";
                                    } ?>><i> Vinho</i>
                                </label>

                                <label>
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                </label>
                                <?php
                                //</div>
                                //</div>
                                //</div> ?>


                                <div style="margin-left: 15px; margin-bottom: 20px">
                                    <input class="btn btn-primary" type='submit' name='salvar' value='Salvar'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div><!-- fechando a divisao de tela -->


                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel panel-heading">
                            <h3>Lotes de Produção</h3>
                        </div>
                        <div class="panel-body">
                            <table id="tb_producao">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Data</th>
                                    <th> Estoque</th>
                                    <th> Tipo Calçado</th>
                                    <th> Quantidade</th>
                                    <th> Número</th>
                                    <th> Cor</th>
                                    <th> Editar</th>
                                    <th> Remover</th>
                                    <th> Dar Baixa</th>
                                    <!--CABEÇALHO DAR BAIXA NA TABELA -->
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                // Construção da Tabela com os Valores do Banco através do fetch_assoc
                                $result = $obj_mysqli->query("SELECT * FROM `producao` 
                            JOIN `estoque` on estoque.id_estoque = producao.id_estoque
                            JOIN `tipo_calcado` on tipo_calcado.id_tipo = producao.id_tipo WHERE producao.baixa = 0"); //WHERE PARA BUSCAR OS REGISTROS NÃO BAIXADOS
                                while ($aux_query = $result->fetch_assoc()) {

                                    echo '<tr>';
                                    echo '<td align="center"> ' . $aux_query["id_lote"] . '</td>';
                                    echo '<td> ' . $aux_query["data_prod"] . '</td>';
                                    echo '<td> ' . $aux_query["nome_estoque"] . '</td>';
                                    echo '<td> ' . $aux_query["nome_tipo"] . '</td>';
                                    echo '<td> ' . $aux_query["qtdd_prod"] . '</td>';
                                    echo '<td> ' . $aux_query["numeracao_calcado"] . '</td>';
                                    echo '<td> ' . $aux_query["cor_calcado"] . '</td>';
                                    echo '<td><a href="' . $_SERVER["PHP_SELF"] . '?id=' . $aux_query["id_lote"] . '"> Editar </td>';
                                    echo '<td><a href="' . $_SERVER["PHP_SELF"] . '?id=' . $aux_query["id_lote"] . '&del=true"> Remover </td>';
                                    echo '<td><a href="' . $_SERVER["PHP_SELF"] . '?id=' . $aux_query["id_lote"] . '&bai=true"> Dar Baixa </td>'; // LINK PARA DAR BAIXA COM &bai
                                    echo '</tr>'; //&bai recebe 1 pois será setado como true

                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!--MESMA TABELA PARA COLOCAR OS LOTES BAIXADOS-->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel panel-heading">
                            <h3>Lotes Baixados</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th> ID</th>
                                    <th> Data</th>
                                    <th> Estoque</th>
                                    <th> Tipo Calçado</th>
                                    <th> Quantidade</th>
                                    <th> Número</th>
                                    <th> Cor</th>
                                    <th> Desfazer</th>
                                    <!--AÇÃO DE DESFAZER NO CABEÇALHO DA TABELA-->
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                // Construção da Tabela com os Valores do Banco através do fetch_assoc
                                $result = $obj_mysqli->query("SELECT * FROM `producao` 
                            JOIN `estoque` on estoque.id_estoque = producao.id_estoque
                            JOIN `tipo_calcado` on tipo_calcado.id_tipo = producao.id_tipo WHERE producao.baixa = 1"); //WHERE PARA BUSCAR OS REGISTROS BAIXADOS
                                while ($aux_query = $result->fetch_assoc()) {

                                    echo '<tr>';
                                    echo '<td align="center"> ' . $aux_query["id_lote"] . '</td>';
                                    echo '<td> ' . $aux_query["data_prod"] . '</td>';
                                    echo '<td> ' . $aux_query["nome_estoque"] . '</td>';
                                    echo '<td> ' . $aux_query["nome_tipo"] . '</td>';
                                    echo '<td> ' . $aux_query["qtdd_prod"] . '</td>';
                                    echo '<td> ' . $aux_query["numeracao_calcado"] . '</td>';
                                    echo '<td> ' . $aux_query["cor_calcado"] . '</td>';
                                    echo '<td><a href="' . $_SERVER["PHP_SELF"] . '?id=' . $aux_query["id_lote"] . '&des=true"> Desfazer </td>'; // LINK PARA DAR BAIXA COM &des
                                    echo '</tr>'; //&des recebe 1 pois está como true
                                }

                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            //evento ready é executado sempre que a pagina é carregada

            $(document).ready(function () {
                //comando para configurar a table
                $('#tb_producao').bootstrapTable({
                    height: 280

                });

            });
        </script>

    </body>
</html>