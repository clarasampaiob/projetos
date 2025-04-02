<?php

namespace App\Model;

use App\Model\Crud;



    class PedidoFuncionarioM extends Crud{
        
        
        

        protected $table = 'pedido_funcionario';
        private $pedidoatv;
        private $funcionario;
        
        
        
        public function getPedidoatv() {
            return $this->pedidoatv;
        }

        public function getFuncionario() {
            return $this->funcionario;
        }

        public function setPedidoatv($pedidoatv) {
            $this->pedidoatv = $pedidoatv;
        }

        public function setFuncionario($funcionario) {
            $this->funcionario = $funcionario;
        }


        
       
        
        
         public function findfuncpedido($id){ // Pra listar as atv cadastradas na Os
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql = "SELECT * FROM $this->table";
            $sql.= " JOIN funcionario ON funcionario.id_funcionario = pedido_funcionario.id_funcionario WHERE id_list_ped = $id ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall();
        }
         

           
    }
