<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of PecaAtividadeC
 *
 * @author Clara Sampaio
 */
class PecaAtividadeC {
    
    
    public function salvarpecalista(){
        $dadospecalst = new \App\Model\PecaAtividadeM;
       
                
                $dados["id_list_ped"] = isset($_GET['id_list_ped']) ? $_GET['id_list_ped'] : null;
                $dados["id_peca"] = isset($_GET['id_peca']) ? $_GET['id_peca'] : null;
                               
                $id = $dadospecalst->insert($dados, 'peca_pedido');
                
                if($id != null){
                        echo '{"statusresponse":"OK","peca_pedido":"'.$id.'"}';
                    }else{
                        echo '{"statusresponse":"ERRO"}';
                    }
        
    }
}
