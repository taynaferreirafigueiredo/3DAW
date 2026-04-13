<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $nomeCompleto = $_POST["nome"];
    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $arquivo = fopen("usuarios.txt", "a") or die("Erro ao abrir arquivo");

    $linha = $username . ";" . $nomeCompleto . ";" . $email .\n";

    fwrite($arquivo, $linha);
    fclose($arquivo);

    echo "<strong>Usuario cadastrado com sucesso!</strong><br><br>";
}
?>

<!DOCTYPE html>
<html>
<body>

<h1>Cadastrar jogador</h1>

<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Nome: <input type="text" name="nomeCompleto" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Senha <input type="senha" name="senha" required><br><br>
    <input type="submit" value="Cadastrar">


    </form>

<br>
<a href="index.php">Ver jogadores cadastrados</a>

</body>
</html>