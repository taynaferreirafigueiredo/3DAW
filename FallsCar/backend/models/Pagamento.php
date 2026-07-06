<?php

require_once __DIR__ . "/../config/Database.php";

class Pagamento
{
    private $conn;
    private $tabela = "pagamentos";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // REGISTRAR PAGAMENTO
  
    public function cadastrar($dados)
    {
        $sql = "INSERT INTO {$this->tabela}
                (valor, forma_pagamento, status, data_pagamento)
                VALUES
                (:valor, :forma_pagamento, :status, NOW())";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":valor" => $dados["valor"],
            ":forma_pagamento" => $dados["forma_pagamento"],
            ":status" => "Pago"
        ]);

        return $this->conn->lastInsertId();
    }

    // BUSCAR PAGAMENTO
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

}
?>