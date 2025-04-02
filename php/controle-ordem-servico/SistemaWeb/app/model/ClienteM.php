<?php

namespace App\Model;

use App\Model\Crud;


class ClienteM extends Crud{
    
    
        

        protected $table = 'cliente';
        private $nome;
        private $cpfcnpj;
        private $endereco;
        private $email;
        private $tel1;
        private $tel2;


        public function getTable() {
            return $this->table;
        }

        public function setTable($table) {
            $this->table = $table;
        }

        
        public function getNome() {
            return $this->nome;
        }

        public function getCpfcnpj() {
            return $this->cpfcnpj;
        }

        public function getEndereco() {
            return $this->endereco;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getTel1() {
            return $this->tel1;
        }

        public function getTel2() {
            return $this->tel2;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setCpfcnpj($cpfcnpj) {
            $this->cpfcnpj = $cpfcnpj;
        }

        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setTel1($tel1) {
            $this->tel1 = $tel1;
        }

        public function setTel2($tel2) {
            $this->tel2 = $tel2;
        }


        public function findallcli(){
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql = "SELECT * FROM $this->table";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall();
        }
         
       
    
    
}
