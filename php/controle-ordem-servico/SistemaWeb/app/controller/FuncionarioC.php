<?php



namespace App\Controller;


class FuncionarioC {
    public function index(){
        \App\View::make('GerenciarFuncionarioV');
    }
    
    
    public function formfuncionario(){
        $dados=[];
         if (isset($_GET['id_funcionario'])){
            $ab = new \App\Model\FuncionarioM;
            $dados['lstfunc'] = $ab->find('id_funcionario', $_GET['id_funcionario']);
        }
        
        //print_r($dados);
        
        \App\View::make('FuncionarioV', $dados);
    }

    

    
    
    public function listarfuncionarios(){
        $os = new \App\Model\FuncionarioM;
        $listos = $os->findallfunc();
        echo json_encode($listos);
    }
    
    
    
    public function salvarFunc(){
        $dadosfunclst = new \App\Model\FuncionarioM;
       
                $dados["id_pedido_func"] = isset($_GET['id_pedido_func']) ? $_GET['id_pedido_func'] : null;
                $dados["id_list_ped"] = isset($_GET['id_list_ped']) ? $_GET['id_list_ped'] : null;
                $dados["id_funcionario"] = isset($_GET['id_funcionario']) ? $_GET['id_funcionario'] : null;
                               
                $id = $dadosfunclst->insert($dados, 'pedido_funcionario');
                
                if($id != null){
                        echo '{"statusresponse":"OK","id_pedido_func":"'.$id.'"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
        
    }
    
    
    public function removerfunc(){
         if ($_GET['id_funcionario']){
           $dlt = new \App\Model\FuncionarioM;
           $var = $dlt->delete("id_funcionario",$_GET['id_funcionario']);
           
            if($var){ //se true
                       echo '{"statusresponse":"OK","mensagem":"Removido com Sucesso"}';
                    }else{
                        echo '{"statusresponse":"ERRO","mensagem":"Erro ao Remover"}';
                    }
        }
    }
    
    
   
    
    
     public function cadastrarfunc(){
        $dadosfuncionario = new \App\Model\FuncionarioM;
        
                // Array dados recebe todos os valores do form e armazenam nas variaveis com os nomes dos campos do banco
               
                $id_funcionario["id_funcionario"] = isset($_GET['id_funcionario']) ? $_GET['id_funcionario'] : null;
                $dados["nome_funcionario"] = isset($_GET['nome']) ? $_GET['nome'] : null;
                $dados["cpf"] = isset($_GET['cpf']) ? $_GET['cpf'] : null;
                $dados["endereco"] = isset($_GET['endereco']) ? $_GET['endereco'] : null;
                $dados["tel1"] = isset($_GET['tel1']) ? $_GET['tel1'] : null;
                $dados["tel2"] = isset($_GET['tel2']) ? $_GET['tel2'] : null;
                $dados["email"] = isset($_GET['email']) ? $_GET['email'] : null;
                $dados["cargo"] = isset($_GET['cargo']) ? $_GET['cargo'] : null;
                $dados["salario_fixo"] = isset($_GET['salario_fixo']) ? $_GET['salario_fixo'] : null;
                $dados["senha"] = isset($_GET['senha']) ? $_GET['senha'] : null;
                
                
                
                
                
                if($id_funcionario["id_funcionario"] != ''){
                    if($dadosfuncionario->update($dadosfuncionario->getTable(),$dados, $id_funcionario)){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }else{
                   $id = $dadosfuncionario->insert($dados, $dadosfuncionario->getTable());
                    if($id != null){
                        echo '{"statusresponse":"OK"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
                }
        
    }
    
    
    
}
