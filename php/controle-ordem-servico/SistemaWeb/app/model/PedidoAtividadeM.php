<?php

namespace App\Model;

use App\Model\Crud;



class PedidoAtividadeM extends Crud{
    
    
       

        protected $table = 'lista_pedido';
        private $status;
        private $os;
        private $atv;
        private $abertura;
        private $tempmin;
        private $valorhora;
        private $valortot;
        private $conclusao;
        
        
        
        
        
        public function getTable() {
            return $this->table;
        }

        public function getStatus() {
            return $this->status;
        }

        public function getOs() {
            return $this->os;
        }

        public function getAtv() {
            return $this->atv;
        }

        public function getAbertura() {
            return $this->abertura;
        }

        public function getTempmin() {
            return $this->tempmin;
        }

        public function getValorhora() {
            return $this->valorhora;
        }

        public function getValortot() {
            return $this->valortot;
        }

        public function getConclusao() {
            return $this->conclusao;
        }

        public function setTable($table) {
            $this->table = $table;
        }

        public function setStatus($status) {
            $this->status = $status;
        }

        public function setOs($os) {
            $this->os = $os;
        }

        public function setAtv($atv) {
            $this->atv = $atv;
        }

        public function setAbertura($abertura) {
            $this->abertura = $abertura;
        }

        public function setTempmin($tempmin) {
            $this->tempmin = $tempmin;
        }

        public function setValorhora($valorhora) {
            $this->valorhora = $valorhora;
        }

        public function setValortot($valortot) {
            $this->valortot = $valortot;
        }

        public function setConclusao($conclusao) {
            $this->conclusao = $conclusao;
        }


        public function findAtvEspecialidade($id){
            $sql = "SELECT * FROM atividade";
            $sql.= " JOIN especialidade ON especialidade.id_especialidade = atividade.id_especialidade WHERE id_atividade = :id ";
            $stmt = DB::prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
        }
        
        
        
         public function findPedidoAtv($id){ // Pra listar as atv cadastradas na Os
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql = "SELECT * FROM $this->table";
            $sql.= " JOIN atividade ON atividade.id_atividade = lista_pedido.id_atividade WHERE id_ordem_servico = $id ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall();
        }
        
      
        
        
        public function findallatv($id){
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql = "SELECT * FROM $this->table";
            $sql.= " JOIN atividade ON atividade.id_atividade = lista_pedido.id_atividade";
            $sql.= " JOIN status ON status.id_status = lista_pedido.id_status WHERE id_ordem_servico = $id ORDER BY data_abertura,  lista_pedido.id_status desc";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall();
        }
      
        
        
       public function calcularConclusao($id){ // Pra listar as atv cadastradas na Os
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql  = "SELECT sum(valor_tot) as valor_total, "
                     . "(SELECT count(id_ordem_servico) "
                     . "FROM `lista_pedido` "
                     . "WHERE id_ordem_servico = $id "
                     . "and (id_status <> 3 and id_status <> 4)) as qtd_restante "
                     . "from lista_pedido where id_ordem_servico = $id "
                     . "and id_status <> 4 and id_status = 3";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetch(DB::FETCH_ASSOC); // fetch recebe uma linha, fetchall retorna todas
       }
       
       
       
       
       
       
}
       

