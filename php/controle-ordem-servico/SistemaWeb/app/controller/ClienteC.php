<?php



namespace App\Controller;


class ClienteC {
    public function index(){
        \App\View::make('GerenciarClienteV');
    }
    

    

    public function formcli(){
        
         if (isset($_GET['id_cliente'])){
            $ab = new \App\Model\ClienteM;
            $dadosatv['lstcli'] = $ab->find('id_cliente', $_GET['id_cliente']);
        }
        
        \App\View::make('clienteV', $dadosatv);
    }
    
     public function cadastrarcli(){
         
         
         \App\View::make('clienteV');
     }
    
    public function removercli(){
         if ($_GET['id_cliente']){
           $dlt = new \App\Model\ClienteM;
           $var = $dlt->delete("id_cliente",$_GET['id_cliente']);
           
            if($var){ //se true
                       echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
                    }else{
                        echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
                    }
        }
    }
    
    
    public function listarcli(){
        $os = new \App\Model\ClienteM;
        $listos = $os->findallcli();
        echo json_encode($listos);
    }
    
    
    public function salvarcliente(){
        $dadoscliente = new \App\Model\ClienteM;
        
                // Array dados recebe todos os valores do form e armazenam nas variaveis com os nomes dos campos do banco
               
                $id_cliente["id_cliente"] = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
                $dados["nome_cliente"] = isset($_GET['nomecliente']) ? $_GET['nomecliente'] : null;
                $dados["cpf_cnpj"] = isset($_GET['cpfcnpj']) ? $_GET['cpfcnpj'] : null;
                $dados["endereco"] = isset($_GET['endereco']) ? $_GET['endereco'] : null;
                $dados["email"] = isset($_GET['email']) ? $_GET['email'] : null;
                $dados["tel1"] = isset($_GET['tel1']) ? $_GET['tel1'] : null;
                $dados["tel2"] = isset($_GET['tel2']) ? $_GET['tel2'] : null;
                
                
                
                if($id_cliente["id_cliente"] != ''){
                    if($dadoscliente->update($dadoscliente->getTable(),$dados, $id_cliente)){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }else{
                   $id = $dadoscliente->insert($dados, $dadoscliente->getTable());
                    if($id != null){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }
        
    }
    
    
}
