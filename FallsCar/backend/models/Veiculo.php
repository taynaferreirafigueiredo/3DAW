<?php

require_once __DIR__ . "/../config/Database.php";

class Veiculo
{
    private $conn;
    private $tabela = "veiculos";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // LISTAR TODOS OS VEÍCULOS
   
    public function listar()
    {
        $sql = "SELECT * FROM {$this->tabela} ORDER BY marca, modelo";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BUSCAR VEÍCULO PELO ID
   
    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM {$this->tabela}
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // LISTAR APENAS DISPONÍVEIS

    public function listarDisponiveis()
    {
        $sql = "SELECT *
                FROM {$this->tabela}
                WHERE status = 'Disponível'
                ORDER BY marca, modelo";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ALTERAR STATUS
    public function alterarStatus($id, $status)
    {
        $sql = "UPDATE {$this->tabela}
                SET status = :status
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":status" => $status,
            ":id" => $id
        ]);
    }

}
?>