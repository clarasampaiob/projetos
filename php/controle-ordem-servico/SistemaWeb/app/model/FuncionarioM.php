<?php


namespace App\Model;


class FuncionarioM extends Crud{
    
        

        protected $table = 'funcionario';
        private $nome;
        private $cpf;
        private $endereco;
        private $tel1;
        private $tel2;
        private $email;
        private $cargo;
        private $salario;
        private $senha;
        
        
        
        public function getTable() {
            return $this->table;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function setTable($table) {
            $this->table = $table;
        }

        public function setSenha($senha) {
            $this->senha = $senha;
        }

                
        public function getNome() {
            return $this->nome;
        }

        public function getCpf() {
            return $this->cpf;
        }

        public function getEndereco() {
            return $this->endereco;
        }

        public function getTel1() {
            return $this->tel1;
        }

        public function getTel2() {
            return $this->tel2;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getCargo() {
            return $this->cargo;
        }

        public function getSalario() {
            return $this->salario;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setCpf($cpf) {
            $this->cpf = $cpf;
        }

        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        public function setTel1($tel1) {
            $this->tel1 = $tel1;
        }

        public function setTel2($tel2) {
            $this->tel2 = $tel2;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setCargo($cargo) {
            $this->cargo = $cargo;
        }

        public function setSalario($salario) {
            $this->salario = $salario;
        }


        
        public function findallfunc(){
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql = "SELECT * FROM $this->table";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall();
        }
        
        
        
        
        
        
       
}
