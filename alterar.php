<?php

$matricula = "";
$nome = "";
$email = "";

if (isset($_GET["matricula"])) {

    $matBusca = $_GET["matricula"];

    $arquivo = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

    while (($linha = fgets($arquivo)) !== false) {

        if (trim($linha) != "") {

            $dados = explode(";", $linha);

            if ($dados[0] == $matBusca) {
                $matricula = $dados[0];
                $nome = $dados[1];
                $email = $dados[2];
                break;
            }
        }
    }

    fclose($arquivo);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arquivo = fopen("alunos.txt", "r");
    $linhas = array();

    while (($linha = fgets($arquivo)) !== false) {

        if (trim($linha) != "") {

            $dados = explode(";", $linha);

            if ($dados[0] == $matricula) {
                // substitui pelos novos dados
                $linhas[] = $matricula . ";" . $nome . ";" . $email . "\n";
            } else {
                $linhas[] = $linha;
            }
        }
    }

    fclose($arquivo);

    // reescreve o arquivo
    $arquivo = fopen("alunos.txt", "w");

    foreach ($linhas as $l) {
        fwrite($arquivo, $l);
    }

    fclose($arquivo);

    $mensagem = "Aluno atualizado com sucesso!";
}

?>

<!DOCTYPE html>
<html>
<body>

<h1>Alterar Aluno</h1>

<form method="POST">

    Matrícula: <input type="text" name="matricula" value="<?php echo $matricula; ?>" readonly><br><br>
    Nome: <input type="text" name="nome" value="<?php echo $nome; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <input type="submit" value="Atualizar">

</form>

<br>

<?php
if (isset($mensagem)) {
    echo "<strong>$mensagem</strong>";
}
?>

</body>
</html>
$matricula = "";
$nome = "";
$email = "";

if (isset($_GET["matricula"])) {

    $matBusca = $_GET["matricula"];

    $arquivo = fopen("alunos.txt", "r") or die("Erro ao abrir arquivo");

    while (($linha = fgets($arquivo)) !== false) {

        if (trim($linha) != "") {

            $dados = explode(";", $linha);

            if ($dados[0] == $matBusca) {
                $matricula = $dados[0];
                $nome = $dados[1];
                $email = $dados[2];
                break;
            }
        }
    }

    fclose($arquivo);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matricula = $_POST["matricula"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];

    $arquivo = fopen("alunos.txt", "r");
    $linhas = array();

    while (($linha = fgets($arquivo)) !== false) {

        if (trim($linha) != "") {

            $dados = explode(";", $linha);

            if ($dados[0] == $matricula) {
                // substitui pelos novos dados
                $linhas[] = $matricula . ";" . $nome . ";" . $email . "\n";
            } else {
                $linhas[] = $linha;
            }
        }
    }

    fclose($arquivo);

    // reescreve o arquivo
    $arquivo = fopen("alunos.txt", "w");

    foreach ($linhas as $l) {
        fwrite($arquivo, $l);
    }

    fclose($arquivo);

    $mensagem = "Aluno atualizado com sucesso!";
}

?>

<!DOCTYPE html>
<html>
<body>

<h1>Alterar Aluno</h1>

<form method="POST">

    Matrícula: <input type="text" name="matricula" value="<?php echo $matricula; ?>" readonly><br><br>
    Nome: <input type="text" name="nome" value="<?php echo $nome; ?>" required><br><br>
    Email: <input type="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <input type="submit" value="Atualizar">

</form>

<br>

<?php
if (isset($mensagem)) {
    echo "<strong>$mensagem</strong>";
}
?>

</body>
</html>