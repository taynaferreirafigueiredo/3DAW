<?php

require_once __DIR__ . "/../models/Pagamento.php";
require_once __DIR__ . "/../config/Database.php";

class PagamentoController
{
    private $pagamento;
    private $conn;

    public function __construct()
    {
        $this->pagamento = new Pagamento();

        $database = new Database();
        $this->conn = $database->conectar();
    }

    // REALIZAR PAGAMENTO
   
    public function pagar($dados)
    {
        if (
            empty($dados["valor"]) ||
            empty($dados["forma_pagamento"]) ||
            empty($dados["reserva_id"])
        ) {

            return [
                "sucesso" => false,
                "mensagem" => "Dados do pagamento incompletos."
            ];

        }

        // Cadastra pagamento
        $pagamentoId = $this->pagamento->cadastrar($dados);

        // Atualiza a reserva
        $sql = "UPDATE reservas
                SET pagamento_id = :pagamento_id,
                    status = 'Confirmada'
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":pagamento_id" => $pagamentoId,
            ":id" => $dados["reserva_id"]
        ]);

        return [
            "sucesso" => true,
            "mensagem" => "Pagamento realizado com sucesso."
        ];
    }

    // BUSCAR PAGAMENTO
    public function buscar($id)
    {
        return $this->pagamento->buscarPorId($id);
    }

}

?>