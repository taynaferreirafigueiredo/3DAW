<?php

require_once __DIR__ . "/../models/Veiculo.php";

class VeiculoController
{
    private $veiculo;

    public function __construct()
    {
        $this->veiculo = new Veiculo();
    }

    // LISTAR TODOS OS VEÍCULOS

    public function listar()
    {
        return $this->veiculo->listar();
    }

    // LISTAR APENAS DISPONÍVEIS

    public function listarDisponiveis()
    {
        return $this->veiculo->listarDisponiveis();
    }

    // BUSCAR VEÍCULO POR ID
    public function buscar($id)
    {
        return $this->veiculo->buscarPorId($id);
    }

}
?>