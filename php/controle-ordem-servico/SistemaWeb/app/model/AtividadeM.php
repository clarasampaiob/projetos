<?php


namespace App\Model;


class AtividadeM extends Crud{
    
        
    
        protected $table = 'atividade';  
        private $especialidade;
        private $nomeatv;
        private $tempo;
        
        
        public function getEspecialidade() {
            return $this->especialidade;
        }

        public function getNomeatv() {
            return $this->nomeatv;
        }

        public function getTempo() {
            return $this->tempo;
        }

        public function setEspecialidade($especialidade) {
            $this->especialidade = $especialidade;
        }

        public function setNomeatv($nomeatv) {
            $this->nomeatv = $nomeatv;
        }

        public function setTempo($tempo) {
            $this->tempo = $tempo;
        }


        
        
       
}
