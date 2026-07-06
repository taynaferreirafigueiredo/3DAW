<?php

require_once __DIR__ . "/../config/Database.php";

class Reserva
{
    private $conn;
    private $tabela = "reservas";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // CRIAR RESERVA
  
    public function cadastrar($dados)
    {
        $sql = "INSERT INTO {$this->tabela}
                (cliente_id, veiculo_id, data_retirada, data_devolucao, dias, status)
                VALUES
                (:cliente_id, :veiculo_id, :data_retirada, :data_devolucao, :dias, :status)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":cliente_id" => $dados["cliente_id"],
            ":veiculo_id" => $dados["veiculo_id"],
            ":data_retirada" => $dados["data_retirada"],
            ":data_devolucao" => $dados["data_devolucao"],
            ":dias" => $dados["dias"],
            ":status" => "Pendente"
        ]);
    }

    // LISTAR RESERVAS DO CLIENTE
 
    public function listarPorCliente($clienteId)
    {
        $sql = "SELECT reservas.*,
                       veiculos.marca,
                       veiculos.modelo,
                       veiculos.placa
                FROM reservas
                INNER JOIN veiculos
                    ON reservas.veiculo_id = veiculos.id
                WHERE cliente_id = :cliente_id
                ORDER BY reservas.id DESC";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":cliente_id" => $clienteId
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BUSCAR RESERVA

    public function buscarPorId($id)
    {
        $sql = "SELECT *
                FROM {$this->tabela}
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ALTERAR RESERVA
    public function atualizar($dados)
    {
        $sql = "UPDATE {$this->tabela}
                SET
                    data_retirada = :data_retirada,
                    data_devolucao = :data_devolucao,
                    dias = :dias
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":data_retirada" => $dados["data_retirada"],
            ":data_devolucao" => $dados["data_devolucao"],
            ":dias" => $dados["dias"],
            ":id" => $dados["id"]
        ]);
    }

    // CANCELAR RESERVA

    public function cancelar($id)
    {
        $sql = "UPDATE {$this->tabela}
                SET status = 'Cancelada'
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }

}
?>