<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of Login
 *
 * @author Clara Sampaio
 */
class Login {
    public function login(){
        
        //Chamando a Classe FuncionarioM e o Método findall
        $func = new \App\Model\FuncionarioM;
        $func = $func->findall();
        
         require_once viewsPath() . 'page-login.php';
    }
    
    
    public function testeLogin(){
        if(isset($_POST['id_funcionario'])&& isset($_POST['senha'])){
            $func = new \App\Model\FuncionarioM;
            $funcionario = $func->find('id_funcionario', $_POST['id_funcionario']);
                if($funcionario['senha'] == $_POST['senha']){
                   $_SESSION['login'] = $funcionario['id_funcionario']; //variável global
                   $_SESSION['senha'] = $funcionario['senha'];
  
                   \App\View::make('GerenciarOsV');
                   
                   
                }else{
                    $this->login();
                }
        }
        
      
    
    }
    
    
    
    public function logout(){
        unset ($_SESSION['login']);
        unset ($_SESSION['senha']);
       
    }
}
