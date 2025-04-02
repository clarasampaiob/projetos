<?php


namespace App\Model;

use App\Model\Crud;


class StatusM extends Crud{
    
   

        protected $table = 'status';
        private $nome;
        
        
        public function getNome() {
            return $this->nome;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }


        
      
}
