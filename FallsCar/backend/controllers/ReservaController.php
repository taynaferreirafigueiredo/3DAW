<?php

require_once __DIR__ . "/../models/Reserva.php";
require_once __DIR__ . "/../models/Veiculo.php";

class ReservaController
{
    private $reserva;
    private $veiculo;

    public function __construct()
    {
        $this->reserva = new Reserva();
        $this->veiculo = new Veiculo();
    }

    // CRIAR RESERVA

    public function cadastrar($dados)
    {
        // Verifica se o veículo existe
        $veiculo = $this->veiculo->buscarPorId($dados["veiculo_id"]);

        if (!$veiculo) {
            return [
                "sucesso" => false,
                "mensagem" => "Veículo não encontrado."
            ];
        }

        // Verifica disponibilidade
        if ($veiculo["status"] != "Disponível") {
            return [
                "sucesso" => false,
                "mensagem" => "Veículo indisponível."
            ];
        }

        // Dias permitidos
        if (
            $dados["dias"] != 7 &&
            $dados["dias"] != 15 &&
            $dados["dias"] != 30
        ) {
            return [
                "sucesso" => false,
                "mensagem" => "A locação deve ser de 7, 15 ou 30 dias."
            ];
        }

        // Cadastra reserva
        $resultado = $this->reserva->cadastrar($dados);

        if ($resultado) {

            // Atualiza status do veículo
            $this->veiculo->alterarStatus(
                $dados["veiculo_id"],
                "Reservado"
            );

            return [
                "sucesso" => true,
                "mensagem" => "Reserva realizada com sucesso."
            ];
        }

        return [
            "sucesso" => false,
            "mensagem" => "Erro ao realizar reserva."
        ];
    }

    // LISTAR RESERVAS DO CLIENTE
   
    public function listar($clienteId)
    {
        return $this->reserva->listarPorCliente($clienteId);
    }

    // BUSCAR RESERVA
   
    public function buscar($id)
    {
        return $this->reserva->buscarPorId($id);
    }

    // ATUALIZAR RESERVA

    public function atualizar($dados)
    {
        return $this->reserva->atualizar($dados);
    }

    // CANCELAR RESERVA
  
    public function cancelar($id)
    {
        $reserva = $this->reserva->buscarPorId($id);

        if (!$reserva) {
            return [
                "sucesso" => false,
                "mensagem" => "Reserva não encontrada."
            ];
        }

        $this->reserva->cancelar($id);

        // Libera novamente o veículo
        $this->veiculo->alterarStatus(
            $reserva["veiculo_id"],
            "Disponível"
        );

        return [
            "sucesso" => true,
            "mensagem" => "Reserva cancelada com sucesso."
        ];
    }
}
?>