<?php

require_once __DIR__ . "/../config/Database.php";

class Cliente
{
    private $conn;
    private $tabela = "clientes";

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // CADASTRAR CLIENTE

    public function cadastrar($dados)
    {
        $sql = "INSERT INTO {$this->tabela}
                (nome, cpf, email, senha, telefone, endereco, cnh)
                VALUES
                (:nome, :cpf, :email, :senha, :telefone, :endereco, :cnh)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":nome" => $dados["nome"],
            ":cpf" => $dados["cpf"],
            ":email" => $dados["email"],
            ":senha" => password_hash($dados["senha"], PASSWORD_DEFAULT),
            ":telefone" => $dados["telefone"],
            ":endereco" => $dados["endereco"],
            ":cnh" => $dados["cnh"]
        ]);
    }

    // LOGIN
    public function login($email)
    {
        $sql = "SELECT * FROM {$this->tabela}
                WHERE email = :email";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            ":email" => $email
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // BUSCAR CLIENTE
  
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
    // ATUALIZAR
    public function atualizar($dados)
    {
        $sql = "UPDATE {$this->tabela}
                SET
                    nome = :nome,
                    telefone = :telefone,
                    endereco = :endereco
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":nome" => $dados["nome"],
            ":telefone" => $dados["telefone"],
            ":endereco" => $dados["endereco"],
            ":id" => $dados["id"]
        ]);
    }

    // EXCLUIR
    public function excluir($id)
    {
        $sql = "DELETE FROM {$this->tabela}
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":id" => $id
        ]);
    }

}

?>