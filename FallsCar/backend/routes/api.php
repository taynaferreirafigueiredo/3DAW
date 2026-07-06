<?php

require_once "../controllers/ClienteController.php";
require_once "../controllers/VeiculoController.php";
require_once "../controllers/ReservaController.php";
require_once "../controllers/PagamentoController.php";

$rota = $_GET["rota"] ?? "";

switch ($rota) {

    // CLIENTE


    case "cadastro":

        $controller = new ClienteController();

        echo json_encode(
            $controller->cadastrar($_POST)
        );

        break;

    case "login":

        $controller = new ClienteController();

        echo json_encode(
            $controller->login(
                $_POST["email"],
                $_POST["senha"]
            )
        );

        break;

    // VEÍCULOS

    case "veiculos":

        $controller = new VeiculoController();

        echo json_encode(
            $controller->listarDisponiveis()
        );

        break;

    // RESERVAS
   
    case "reservar":

        $controller = new ReservaController();

        echo json_encode(
            $controller->cadastrar($_POST)
        );

        break;

    case "reservas":

        $controller = new ReservaController();

        echo json_encode(
            $controller->listar($_GET["cliente"])
        );

        break;

    case "cancelar":

        $controller = new ReservaController();

        echo json_encode(
            $controller->cancelar($_POST["id"])
        );

        break;

    // PAGAMENTO

    case "pagamento":

        $controller = new PagamentoController();

        echo json_encode(
            $controller->pagar($_POST)
        );

        break;

    default:

        echo json_encode([
            "erro" => "Rota não encontrada."
        ]);

}