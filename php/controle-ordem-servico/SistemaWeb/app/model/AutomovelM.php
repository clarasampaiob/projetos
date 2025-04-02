<?php

//Apelido para o Caminho (ROTA)
namespace App\Model;

use App\Model\Crud;

class AutomovelM extends Crud{
	
        
    
        protected $table = 'automovel';   
	private $cliente;
	private $chassi;
	private $modelo;
	private $marca;
	private $cor;
	private $ano;
	private $local;
        
        
        
        
        public function getTable() {
            return $this->table;
        }

        public function setTable($table) {
            $this->table = $table;
        }
               
        
        public function getCliente() {
            return $this->cliente;
        }

        public function getChassi() {
            return $this->chassi;
        }

        public function getModelo() {
            return $this->modelo;
        }

        public function getMarca() {
            return $this->marca;
        }

        public function getCor() {
            return $this->cor;
        }

        public function getAno() {
            return $this->ano;
        }

        public function getLocal() {
            return $this->local;
        }

        public function setCliente($cliente) {
            $this->cliente = $cliente;
        }

        public function setChassi($chassi) {
            $this->chassi = $chassi;
        }

        public function setModelo($modelo) {
            $this->modelo = $modelo;
        }

        public function setMarca($marca) {
            $this->marca = $marca;
        }

        public function setCor($cor) {
            $this->cor = $cor;
        }

        public function setAno($ano) {
            $this->ano = $ano;
        }

        public function setLocal($local) {
            $this->local = $local;
        }


        
        
// ------------------------------------------------------------------------------------------------------------- //       
        
       
        
            public function getCarrosCliente($idcliente = null){            
                    $db = new \App\Model\DB;
                    //Receber os dados com os caracteres configurados do Banco
                    $db->exec("SET CHARACTER SET utf8"); 
                    $sql = "SELECT * FROM $this->table";
                    $sql.=" WHERE id_cliente = $idcliente";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();
                    return $stmt->fetchAll(db::FETCH_ASSOC); 
                    // Vai retornar o nome da coluna e o registro que está relacionado ao id do cliente
            }

// ------------------------------------------------------------------------------------------------------------- //         
              
            
       
            
            public function findallautos(){
                $db = new \App\Model\DB;
                //Receber os dados com os caracteres configurados do Banco
                $db->exec("SET CHARACTER SET utf8"); 
                $sql = "SELECT * FROM $this->table";
                $sql .= " JOIN cliente ON cliente.id_cliente = automovel.id_cliente";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                return $stmt->fetchall();
            }
 
// ------------------------------------------------------------------------------------------------------------- //  
}