<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;


class AutomovelC {
    public function index(){
        \App\View::make('GerenciarAutomovelV');
    }
    
    public function formauto(){
        
        //Chamando a Classe ClienteM e o Método findall
        $cliente = new \App\Model\ClienteM; 
        $dadosauto['cliauto'] = $cliente->findall();
        
        if (isset($_GET['id_automovel'])){
            $ab = new \App\Model\AutomovelM;
            $dadosauto['automovel'] = $ab->find('id_automovel', $_GET['id_automovel']);
        }
        
        \App\View::make('automovelV',$dadosauto);
    }
    
    
    
// ---------------------------------------------------------------------------------------------------------------------- //    
    
    // PATH: OsV > Jquery /getCarrosCliente > envia idcliente
    // PATH: AutomovelC > listarCarrosCliente > recebe idcliente do Jquery
    // PATH: listarCarrosCliente > chama getCarrosCliente no Model AutomovelM
    // PATH: index /getCarrosCliente (URL Jquery) >> instância de listarCarrosCliente
    // listarCarrosCliente(): 
    // Função que recebe a SQL somente com os carros que possuem cliente
    // Verifica se existem registros e os atribui ao array dadosauto['carcli']
    // Envia o array para o Jquery na URL /getCarrosCliente
        
    
    
        public function listarCarrosCliente(){
            // idcliente é enviado pelo Jquery na URL /getCarrosCliente na View da OS
            if(isset($_GET['idcliente'])){
                $carclient = new \App\Model\AutomovelM;
                // Chamando a função getCarrosCliente do AutomovelM q tem a SQL p/ trazer automoveis com cliente
                $dadosauto['carcli'] = $carclient->getCarrosCliente($_GET['idcliente']);
                // Se houver resultados nessa SQL, $dadosauto['carcli'] recebe os valores
                if(count($dadosauto['carcli'])>0){
                    $dadosauto['statusresponse'] = 'OK';
                }else{
                    $dadosauto['statusresponse'] = 'ERRO'; 
                }
                echo json_encode($dadosauto);
            }
        }
    
// ---------------------------------------------------------------------------------------------------------------------- //  
        
        
      // PATH: AutomovelM > findallautos > envia SQL
      // PATH: AutomovelC > listarautos > recebe dados de findallautos
      // PATH: index /listarautos > instância de listarautos de AutomovelC
      // PATH: GerenciarAutomovelV > Jquery /listarautos > recebe dados de listarautos de AutomovelC
      // listarautos():  
      // Função que recebe os dados da tabela automovel e da tabela cliente
      // Permite usar o nome do cliente no lugar do id
      // envia os dados para preencher a tabela do Jquery na View GerenciarAutomovelV
        
                
        public function listarautos(){
            $os = new \App\Model\AutomovelM;
            $listos = $os->findallautos();
            echo json_encode($listos);
        }
        
// ---------------------------------------------------------------------------------------------------------------------- //         
        
        
        
        
    
    public function removerauto(){
         if ($_GET['id_automovel']){
           $dlt = new \App\Model\AutomovelM;
           $var = $dlt->delete("id_automovel",$_GET['id_automovel']);
           
            if($var){ //se true
                       echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
                    }else{
                        echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
                    }
        }
    }
    
    
    public function salvarautomovel(){
        $dadosautomovel = new \App\Model\AutomovelM;
        
                // Array dados recebe todos os valores do form e armazenam nas variaveis com os nomes dos campos do banco
               
                $id_automovel["id_automovel"] = isset($_GET['id_automovel']) ? $_GET['id_automovel'] : null;
                $dados["id_cliente"] = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
                $dados["chassi"] = isset($_GET['chassi']) ? $_GET['chassi'] : null;
                $dados["modelo"] = isset($_GET['modelo']) ? $_GET['modelo'] : null;
                $dados["marca"] = isset($_GET['marca']) ? $_GET['marca'] : null;
                $dados["cor"] = isset($_GET['cor']) ? $_GET['cor'] : null;
                $dados["ano"] = isset($_GET['ano']) ? $_GET['ano'] : null;
                $dados["local"] = isset($_GET['local']) ? $_GET['local'] : null;
                
                
                
                if($id_automovel["id_automovel"] != ''){
                    if($dadosautomovel->update($dadosautomovel->getTable(),$dados, $id_automovel)){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }else{
                   $id = $dadosautomovel->insert($dados, $dadosautomovel->getTable());
                    if($id != null){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }
        
    }
    
    
    
    
}
