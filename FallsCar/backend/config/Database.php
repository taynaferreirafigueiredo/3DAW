<?php

class Database
{
    private $host = "localhost";
    private $db = "fallscar";
    private $user = "root";
    private $pass = "";
    private $conn;

    public function conectar()
    {
        try {

            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->user,
                $this->pass
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

            return $this->conn;

        } catch (PDOException $e) {

            die("Erro na conexão: " . $e->getMessage());

        }
    }
}