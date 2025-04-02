<?php

namespace App\Model;

use App\Model\Crud;

class OsM extends Crud {
    

    protected $table = 'ordem_servico';
    private $status;
    private $cliente;
    private $automovel;
    private $abertura;
    private $agendamento;
    private $conclusao;
    private $valortot;

    public function getValortot() {
        return $this->valortot;
    }

    public function setValortot($valortot) {
        $this->valortot = $valortot;
    }

    public function getTable() {
        return $this->table;
    }

    public function getAgendamento() {
        return $this->agendamento;
    }

    public function setAgendamento($agendamento) {
        $this->agendamento = $agendamento;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getCliente() {
        return $this->cliente;
    }

    public function getAutomovel() {
        return $this->automovel;
    }

    public function getAbertura() {
        return $this->abertura;
    }

    public function getConclusao() {
        return $this->conclusao;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function setCliente($cliente) {
        $this->cliente = $cliente;
    }

    public function setAutomovel($automovel) {
        $this->automovel = $automovel;
    }

    public function setAbertura($abertura) {
        $this->abertura = $abertura;
    }

    public function setConclusao($conclusao) {
        $this->conclusao = $conclusao;
    }

    public function findallOs() {
        $db = new \App\Model\DB;
        $db->exec("SET CHARACTER SET utf8"); //Receber os dados com os caracteres configurados do Banco
        $sql = "SELECT * FROM $this->table";
        $sql .= " JOIN cliente ON cliente.id_cliente = ordem_servico.id_cliente";
        $sql .= " JOIN status ON status.id_status = ordem_servico.id_status";
        $sql .= " ORDER BY nome_status, data_agendamento asc";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchall();
    }

    function updateOs($table, $data, $id) {
        $db = new \App\Model\DB;
        $conclusao = $data['conclusao'];
        $valor_total = $data['valor_tot'];
        $sql = "update $this->table set id_status = 3, conclusao_os = '$conclusao', valor_tot = $valor_total where id_ordem_servico =  $id";
        echo $sql;
        $stmt = $db->prepare($sql);
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Erro ao cadastrar";
            print_r($stmt->errorInfo());
            return false;
        }
    }

}
