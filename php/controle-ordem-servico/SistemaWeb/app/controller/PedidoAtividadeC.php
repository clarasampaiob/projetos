<?php

namespace App\Controller;

class PedidoAtividadeC {
    /* public function index(){
      \App\View::make('GerenciarAtvV');
      } */

    public function formatv() {

        //Chamando a Classe StatusM e o Método findall
        $stts = new \App\Model\StatusM;
        $dadosatv['status'] = $stts->findall();

        //Chamando a Classe PedidoAtividadeM e o Método findall
        $os = new \App\Model\OsM;
        $dadosatv['ordserv'] = $os->findall();

        //Chamando a Classe AtividadeM e o Método findall
        $pdatv = new \App\Model\AtividadeM;
        $dadosatv['atv'] = $pdatv->findall();

        //Chamando a Classe FuncionarioM e o Método findall
        $func = new \App\Model\FuncionarioM;
        $dadosatv['funcionario'] = $func->findall();

        //Chamando a Classe PecaM e o Método findall
        $pca = new \App\Model\PecaM;
        $dadosatv['peca'] = $pca->findall();



        if (isset($_GET['id_list_ped'])) {
            $ab = new \App\Model\PedidoAtividadeM;
            $dadosatv['lstped'] = $ab->find('id_list_ped', $_GET['id_list_ped']);
        }


        \App\View::make('pedidoAtividadeV', $dadosatv);
    }

    public function salvarProblemas() {
        $dadosatvpd = new \App\Model\PedidoAtividadeM;

        $dados["id_ordem_servico"] = isset($_GET['id_ordem_servico']) ? $_GET['id_ordem_servico'] : null;
        $dados["id_status"] = 1;
        $dados["id_atividade"] = isset($_GET['id_atividade']) ? $_GET['id_atividade'] : null;
        $dados["data_abertura"] = date("Y-m-d H:i");


        $atv = $dadosatvpd->findAtvEspecialidade($dados["id_atividade"]);
        $dados["valor_hora"] = $atv["valor_hora"]; // em $atv o valor_hora é o do join na tabela especialidade



        $id = $dadosatvpd->insert($dados, 'lista_pedido');

        if ($id != null) {
            echo '{"statusresponse":"OK","id_ordem_servico":"' . $id . '"}';
        } else {
            echo '{"statusresponse":"ERRO"}';
        }
    }

    public function listarProblemas() {
        if ($_GET['idOs']) {
            $atvlst = new \App\Model\PedidoAtividadeM;
            $lst = $atvlst->findPedidoAtv($_GET['idOs']);
            echo json_encode($lst);
        }
    }

    public function listarFunc() {
        if ($_GET['idlistaped']) {
            $funclst = new \App\Model\FuncionarioM;
            $funclista = $funclst->findallfunc($_GET['idlistaped']);
            echo json_encode($funclista);
        }
    }

    public function removerProblema() {
        if ($_GET['id_list_ped']) {
            $dlt = new \App\Model\PedidoAtividadeM;
            $var = $dlt->delete("id_list_ped", $_GET['id_list_ped']);

            if ($var) { //se true
                echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
            } else {
                echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
            }
        }
    }

    public function listarpdatv() {
        if (isset($_GET['idOs'])) {
            $pat = new \App\Model\PedidoAtividadeM;
            $listpdatv = $pat->findallatv($_GET['idOs']);
            echo json_encode($listpdatv);
        }
    }

    public function gerenciaratv() {
        $dados['ordserv'] = isset($_GET['id_ordem_servico']) ? $_GET['id_ordem_servico'] : null;
        \App\View::make('GerenciarAtvV', $dados);
    }

    public function removerpedatv() {
        if ($_GET['id_list_ped']) {
            $dlt = new \App\Model\PedidoAtividadeM;
            $var = $dlt->delete("id_list_ped", $_GET['id_list_ped']);

            if ($var) { //se true
                echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
            } else {
                echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
            }
        }
    }

    public function salvarpedatv() {
        $dadosatvpd = new \App\Model\PedidoAtividadeM;

        // Array dados recebe todos os valores do form e armazenam nas variaveis com os nomes dos campos do banco
        $id_list_ped["id_list_ped"] = isset($_GET['id_list_ped']) ? $_GET['id_list_ped'] : null;
        $dados["id_ordem_servico"] = isset($_GET['id_ordem_servico']) ? $_GET['id_ordem_servico'] : null;
        $dados["id_status"] = isset($_GET['id_status']) ? $_GET['id_status'] : 1;
        $dados["id_atividade"] = isset($_GET['id_atividade']) ? $_GET['id_atividade'] : null;
        $dados["data_abertura"] = isset($_GET['data_abertura']) ? $_GET['data_abertura'] : date("Y-m-d H:i");
        $dados["temp_min"] = isset($_GET['temp_min']) ? $_GET['temp_min'] : null;
        $dados["conclusao"] = isset($_GET['conclusao']) ? $_GET['conclusao'] : null;

        $atv = $dadosatvpd->findAtvEspecialidade($dados["id_atividade"]);
        $dados["valor_hora"] = $atv["valor_hora"];


        if ($dados["temp_min"] > 60) {
            $temp = $dados["temp_min"] / 60;                 // Valor em horas de toda a atividade
            $horas = intval($temp);                        // Qtdd de horas INTEIRAS
            $minutos = $dados["temp_min"] % 60;            // Resto da Divisão (minutos restantes)
            $tothoras = $dados["valor_hora"] * $horas;     // Valor em $$ das Horas inteiras trabalhadas
            $valorminuto = $dados["valor_hora"] / 60;        // Valor em $$ de cada minuto
            $totminutos = $valorminuto * $minutos;         // Valor em $$ dos minutos trabalhados
            $valortotal = $tothoras + $totminutos;         // Valor total a pagar pela atividade
        } else {
            if ($dados["temp_min"] < 60) {
                $valorminuto = $dados["valor_hora"] / 60;
                $valortotal = $dados["temp_min"] * $valorminuto;
            } else {
                $valortotal = $dados["valor_hora"];
            }
        }

        $dados["valor_tot"] = $valortotal;



        if ($id_list_ped["id_list_ped"] != '') {
            if ($dadosatvpd->update($dadosatvpd->getTable(), $dados, $id_list_ped)) {
                echo '{"statusresponse":"OK"}';
            } else {
                echo '{"statusresponse":"ERRO"}';
            }
        } else {
            $id = $dadosatvpd->insert($dados, $dadosatvpd->getTable());
            if ($id != null) {
                echo '{"statusresponse":"OK","id_list_ped":"' . $id . '"}';
            } else {
                echo '{"statusresponse":"ERRO"}';
            }
        }
    }

    public function listarfuncpedido() {
        if ($_GET['idlistaped']) {
            $atvlst = new \App\Model\PedidoFuncionarioM;
            $lst = $atvlst->findfuncpedido($_GET['idlistaped']);
            echo json_encode($lst);
        }
    }

    public function listarpecapedido() {
        if ($_GET['idlist']) {
            $atvlst = new \App\Model\PecaAtividadeM;
            $lst = $atvlst->findpecapedido($_GET['idlist']);
            echo json_encode($lst);
        }
    }

    public function removerfunclst() {
        if ($_GET['id_pedido_func']) {
            $dlt = new \App\Model\PedidoFuncionarioM;
            $var = $dlt->delete("id_pedido_func", $_GET['id_pedido_func']);

            if ($var) { //se true
                echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
            } else {
                echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
            }
        }
    }

    public function removerpecalst() {
        if ($_GET['id_peca_pedido']) {
            $dlt = new \App\Model\PecaAtividadeM;
            $var = $dlt->delete("id_peca_pedido", $_GET['id_peca_pedido']);

            if ($var) { //se true
                echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
            } else {
                echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
            }
        }
    }

    public function concluirOs() {
        if (isset($_GET['id_ordem_servico'])) {

            $inserir = new \App\Model\PedidoAtividadeM;
            $list = $inserir->calcularConclusao($_GET['id_ordem_servico']);
            
            
            if ($list['qtd_restante'] == 0) {
                $dadosOs = NULL;
                $os = new \App\Model\OsM; //instanciar osM pra poder dar o update nela e nao em lista_pedido
                $dadosOs['id_ordem_servico'] = $_GET['id_ordem_servico'];
                $dadosOs['id_status'] = 3;
                $dadosOs['valor_tot'] = $list['valor_total'];
                $dadosOs['conclusao'] = isset($_GET['conclusao']) ? $_GET['conclusao'] : date('Y-m-d H:i');
                $response = $os->updateOs('ordem_servico', $dadosOs,$_GET['id_ordem_servico'] );
            }
        }
    }

}
