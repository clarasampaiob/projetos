<?php

namespace App\Controller;
class OsC {
    public function index(){
        \App\View::make('GerenciarOsV');
    }

    public function formOs(){
        // Página pra Aparecer na Página Inicial
        
        //Chamando a Classe ClienteM e o Método findall
        $cliente = new \App\Model\ClienteM; 
        $dados['clientes'] = $cliente->findall();
        
        //Chamando a Classe AutomovelM e o Método findall
        $auto = new \App\Model\AutomovelM;
        $dados['automovel'] = $auto->findall();
        
        ////Chamando a Classe StatusM e o Método findall
        $stts = new \App\Model\StatusM;
        $dados['status'] = $stts->findall();
        
        //Lista de Problemas
        $listap = new \App\Model\PedidoAtividadeM;
        $dados['listped'] = $listap->findall();
        
        $atvdd = new \App\Model\AtividadeM;
        $dados['atv'] = $atvdd->findall();
        
        
        // se tiver id vai chamar o objeto q já existe
        if (isset($_GET['id_ordem_servico'])){
            $ab = new \App\Model\OsM;
            $dados['ordserv'] = $ab->find('id_ordem_servico', $_GET['id_ordem_servico']);
        }
        
        
        //Recebe a String que é o nome da página da view e o array dados q vai jogar os clientes no campo cliente e os outros dados nos seus devidos campos
        \App\View::make('osV',$dados);
    }
    
   

    public function salvarOs(){
        $dadosOs = new \App\Model\OsM;
        
                // Array dados recebe todos os valores do form e armazenam nas variaveis com os nomes dos campos do banco
                $id_ordem_servico["id_ordem_servico"] = isset($_GET['id_ordem_servico']) ? $_GET['id_ordem_servico'] : '';
                $dados["id_status"] = isset($_GET['id_status']) ? $_GET['id_status'] : null;
                $dados["id_cliente"] = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
                $dados["id_automovel"] = isset($_GET['id_automovel']) ? $_GET['id_automovel'] : null;
                $dados["data_agendamento"] = isset($_GET['data_agendamento']) ? $_GET['data_agendamento'] : null;
                $dados["data_abertura"] = isset($_GET['data_abertura']) ? $_GET['data_abertura'] : null;
               // $dados["valor_tot"] = isset($_GET['valor_tot']) ? $_GET['valor_tot'] : null;
               // $dados["conclusao_os"] = isset($_GET['conclusao_os']) ? $_GET['conclusao_os'] : null;
                
                /*$dadosOs->setStatus($id_status);
                $dadosOs->setCliente($id_cliente);
                $dadosOs->setAutomovel($id_automovel);
                $dadosOs->setAgendamento($data_agendamento);
                $dadosOs->setAbertura($data_abertura);*/
                
               
                
                if($id_ordem_servico["id_ordem_servico"] != ''){
                    if($dadosOs->update($dadosOs->getTable(),$dados, $id_ordem_servico)){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }else{
                   $id = $dadosOs->insert($dados, $dadosOs->getTable());
                    if($id != null){
                        echo '{"statusresponse":"OK","id_ordem_servico":"'.$id.'"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }
        
    }
    
    
    
    public function finalizarOs(){
        $dadosOs = new \App\Model\OsM;
        
                // Array dados recebe todos os valores do form e armazenam nas variaveis com os nomes dos campos do banco
                $id_ordem_servico["id_ordem_servico"] = isset($_GET['id_ordem_servico']) ? $_GET['id_ordem_servico'] : '';
                $dados["id_status"] = isset($_GET['id_status']) ? $_GET['id_status'] : null;
                $dados["id_cliente"] = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
                $dados["id_automovel"] = isset($_GET['id_automovel']) ? $_GET['id_automovel'] : null;
                $dados["data_agendamento"] = isset($_GET['data_agendamento']) ? $_GET['data_agendamento'] : null;
                $dados["data_abertura"] = isset($_GET['data_abertura']) ? $_GET['data_abertura'] : null;
                $dados["valor_tot"] = isset($_GET['valor_tot']) ? $_GET['valor_tot'] : null;
                $dados["conclusao_os"] = isset($_GET['conclusao_os']) ? $_GET['conclusao_os'] : null;
                
                /*$dadosOs->setStatus($id_status);
                $dadosOs->setCliente($id_cliente);
                $dadosOs->setAutomovel($id_automovel);
                $dadosOs->setAgendamento($data_agendamento);
                $dadosOs->setAbertura($data_abertura);*/
                
               
                
                if($id_ordem_servico["id_ordem_servico"] != ''){
                    if($dadosOs->update($dadosOs->getTable(),$dados, $id_ordem_servico)){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }else{
                   $id = $dadosOs->insert($dados, $dadosOs->getTable());
                    if($id != null){
                        echo '{"statusresponse":"OK","id_ordem_servico":"'.$id.'"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }
        
    }
    
    
    
    public function listarOs(){
        $os = new \App\Model\OsM;
        $listos = $os->findallOs();
        echo json_encode($listos);
    }
    
    public function removeros(){
         if ($_GET['id_ordem_servico']){
           $dlt = new \App\Model\OsM;
           $var = $dlt->delete("id_ordem_servico",$_GET['id_ordem_servico']);
           
            if($var){ //se true
                       echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
                    }else{
                        echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
                    }
        }
    }
    
    
}