<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = $_POST["a"];
        $b = $_POST["b"];
        $operacao = $_POST["operacao"];

        if ($operacao == "soma") {
            $resultado = $a + $b;
        } elseif ($operacao == "subtracao") {
            $resultado = $a - $b;
        } elseif ($operacao == "multiplicacao") {
            $resultado = $a * $b;
        } elseif ($operacao == "divisao") {
            if ($b != 0) {
                $resultado = $a / $b;
            } else {
                $resultado = "Erro: divisão por zero";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<body>

<h1><?php echo 'Calculadora'; ?></h1>

<form method='POST'>

    a: <input type='text' name='a'><br>
    b: <input type='text' name='b'><br><br>

    <input type='radio' name='operacao' value='soma' required> Somar<br>
    <input type='radio' name='operacao' value='subtracao'> Subtrair<br>
    <input type='radio' name='operacao' value='multiplicacao'> Multiplicar<br>
    <input type='radio' name='operacao' value='divisao'> Dividir<br><br>

    <input type='submit' value='Calcular'>
    <br><br>

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        echo 'Resultado: ' . $resultado;
    }
?>

</form>

</body>
</html>