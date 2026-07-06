<?php

require_once __DIR__ . "/../models/Cliente.php";

class ClienteController
{
    private $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    // CADASTRAR CLIENTE
    public function cadastrar($dados)
    {
        if (
            empty($dados["nome"]) ||
            empty($dados["cpf"]) ||
            empty($dados["email"]) ||
            empty($dados["senha"])
        ) {
            return [
                "sucesso" => false,
                "mensagem" => "Preencha todos os campos obrigatórios."
            ];
        }

        $resultado = $this->cliente->cadastrar($dados);

        if ($resultado) {
            return [
                "sucesso" => true,
                "mensagem" => "Cliente cadastrado com sucesso."
            ];
        }

        return [
            "sucesso" => false,
            "mensagem" => "Erro ao cadastrar cliente."
        ];
    }

    // LOGIN
    public function login($email, $senha)
    {
        $cliente = $this->cliente->login($email);

        if (!$cliente) {
            return [
                "sucesso" => false,
                "mensagem" => "E-mail não encontrado."
            ];
        }

        if (!password_verify($senha, $cliente["senha"])) {
            return [
                "sucesso" => false,
                "mensagem" => "Senha incorreta."
            ];
        }

        return [
            "sucesso" => true,
            "cliente" => $cliente
        ];
    }

    // BUSCAR CLIENTE
    public function buscar($id)
    {
        return $this->cliente->buscarPorId($id);
    }

    // ATUALIZAR

    public function atualizar($dados)
    {
        return $this->cliente->atualizar($dados);
    }

    // EXCLUIR

    public function excluir($id)
    {
        return $this->cliente->excluir($id);
    }
}