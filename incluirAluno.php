<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    // Abre arquivo para adicionar (append)
    $arquivo = fopen("alunos.txt", "a") or die("Erro ao abrir arquivo");

    // Formato: matricula;nome;email
    $linha = $matricula . ";" . $nome . ";" . $email . "\n";

    fwrite($arquivo, $linha);
    fclose($arquivo);

    $mensagem = "Aluno cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html>
<body>

<h1>Cadastrar Aluno</h1>

<form method="POST">

    Matrícula: <input type="text" name="matricula" required><br><br>
    Nome: <input type="text" name="nome" required><br><br>
    Email: <input type="email" name="email" required><br><br>

    <input type="submit" value="Cadastrar">

</form>

<br>

<?php
    if (isset($mensagem)) {
        echo "<strong>$mensagem</strong>";
    }
?>

</body>
</html>