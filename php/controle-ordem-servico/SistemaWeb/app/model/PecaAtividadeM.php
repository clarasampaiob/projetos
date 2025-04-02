<?php

namespace App\Model;

use App\Model\Crud;



    class PecaAtividadeM extends Crud{
        
       

        protected $table = 'peca_pedido';
        private $pedidoatv;
        private $peca;
        
        
        
        public function getPedidoatv() {
            return $this->pedidoatv;
        }

        public function getPeca() {
            return $this->peca;
        }

        public function setPedidoatv($pedidoatv) {
            $this->pedidoatv = $pedidoatv;
        }

        public function setPeca($peca) {
            $this->peca = $peca;
        }

        
       public function findpecapedido($id){ // Pra listar as atv cadastradas na Os
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql = "SELECT * FROM $this->table";
            $sql.= " JOIN peca ON peca.id_peca = peca_pedido.id_peca WHERE id_list_ped = $id ";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall();
            
       }
       
       
       
      


    }
