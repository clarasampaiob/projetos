<?php


namespace App\Model;


class PecaM extends Crud{
    
        

        protected $table = 'peca';
        private $nome;
        private $custo;
        private $venda;
        
        
        public function getNome() {
            return $this->nome;
        }

        public function getCusto() {
            return $this->custo;
        }

        public function getVenda() {
            return $this->venda;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setCusto($custo) {
            $this->custo = $custo;
        }

        public function setVenda($venda) {
            $this->venda = $venda;
        }


        
        
}
