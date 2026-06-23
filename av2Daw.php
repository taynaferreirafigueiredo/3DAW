<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Reserva de Veículo - Falls Car</title>

    <script>
        function validarFormulario() {
            let cpf = document.getElementById("cpf").value;
            let habilitacao = document.getElementById("habilitacao").value;

            if (cpf.length != 11) {
                alert("CPF deve conter 11 números.");
                return false;
            }

            if (habilitacao.length < 5) {
                alert("Número da habilitação inválido.");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

    <h1>Reserva de Veículo - Falls Car</h1>

    <form action="processar.php" method="POST" onsubmit="return validarFormulario()">

        <label>Nome Completo:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>CPF:</label><br>
        <input type="text" id="cpf" name="cpf" maxlength="11" required><br><br>

        <label>Endereço:</label><br>
        <input type="text" name="endereco" required><br><br>

        <label>Número da Habilitação:</label><br>
        <input type="text" id="habilitacao" name="habilitacao" required><br><br>

        <label>Telefone:</label><br>
        <input type="tel" name="telefone" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Data de Retirada:</label><br>
        <input type="date" name="retirada" required><br><br>

        <label>Data de Devolução:</label><br>
        <input type="date" name="devolucao" required><br><br>

        <label>Período de Aluguel:</label><br>
        <select name="periodo" required>
            <option value="7 dias">7 dias</option>
            <option value="15 dias">15 dias</option>
            <option value="30 dias">30 dias</option>
        </select><br><br>

        <label>Motorista Adicional?</label><br>
        <input type="radio" name="motorista_adicional" value="Sim"> Sim
        <input type="radio" name="motorista_adicional" value="Não" checked> Não
        <br><br>

        <label>Deseja contratar seguro?</label><br>
        <input type="radio" name="seguro" value="Sim"> Sim
        <input type="radio" name="seguro" value="Não" checked> Não
        <br><br>

        <input type="submit" value="Reservar Veículo">

    </form>

</body>
</html>
