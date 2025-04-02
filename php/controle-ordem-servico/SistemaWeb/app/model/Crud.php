<?php

namespace App\Model;

use App\Model\DB;

    abstract class Crud extends DB{
        
       
    
        protected $table;
        var $id = null;
        
                
        
        public function insert( array $dados, $tabela ){        
                $campos  = implode(", ", array_keys($dados) ); // Keys -> nomes dos campos
                // Implode pega todos os índices da matriz, que nesse caso seriam os nomes dos campos das tabelas, e junta tudo em uma String
                $valores = "'" . implode( "', '", array_values($dados) ) . "'"; // Valores são os dados armazenados nas posições (keys)
                $stmt = DB::prepare( "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores})" );
            if($stmt->execute()){
                $this->id = DB::lastInsertId(); // O PDO sempre retorna o ultimo id gerado
                return $this->id; 
            }else{
                //$this->erro = "<br/>Erro ao Cadastrar {$tabela}!!!";
                return null; 
            }
        }

        
                        
        
        function update($table, $data, $id){
            $id_key = implode(array_keys($id));
            $id_value = implode(array_values($id));
            //print_r($id_value);
            
            $sql = "UPDATE $table SET"; 
            $i=0;
            // O foreach vai desmembrar o array, e colocar os nomes dos campos em Key, que irá receber o Value, que é o dado
            foreach ($data as $key => $value) { 
                    $sql.= " $key = :$key"; // Vai concatenar com todos os campos e valores da tabela
                    if($i < count($data) - 1) // Pega o total dos campos menos 1 pq o último não pode ter vírgula
                            $sql .=',';
                    $i++;
            }
            $sql .= ' where '.$id_key.' = :'.$id_key;
            //echo ($sql);
            $stmt = DB::prepare($sql);
            foreach ($data as $key => &$value) {
                    $stmt->bindParam(":$key", $value);
                    //echo ($key.' '.$value.'<br>');
            }
            $stmt->bindParam(":{$id_key}", $id_value, DB::PARAM_INT);
                if ($stmt->execute())
                {
                    return true;
                }
                else
                {
                echo "Erro ao cadastrar";
                print_r($stmt->errorInfo());
                return false;
                }

        }
        
        
 
        
        public function find($id, $value){
            $db = new \App\Model\DB;
            $sql = "SELECT * FROM $this->table WHERE $id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $value);
            $stmt->execute();
            return $stmt->fetch();
        }

        
        
        
        public function findall(){
            $db = new \App\Model\DB;
            $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
            $sql = "SELECT * FROM $this->table";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchall();
        }
        
 
        
        
        public function delete($id, $value){
            $db = new \App\Model\DB;
            $sql = "DELETE FROM $this->table WHERE $id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $value);
            return $stmt->execute();
        }
        
    }
