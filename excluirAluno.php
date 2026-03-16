<!DOCTYPE html>
<html>
<head>
<title>Lista de Alunos</title>
</head>

<body>

<h1>Listar Alunos</h1>

<table border ="1">
<tr>
<th>Matricula</th>
<th>Nome</th>
<th>Email</th>
<th>Excluir</th>
</tr>

<?php

if(isset($_GET["matricula"])){

    $matExcluir = $_GET["matricula"];

    $arquivo = fopen("alunos.txt","r");
    $linhas = array();

    while(($linha = fgets($arquivo)) !== false){

        if(trim($linha) != ""){

            $dados = explode(";", $linha);

            if(isset($dados[0]) && $dados[0] != $matExcluir){
                $linhas[] = $linha;
            }
        }
    }

    fclose($arquivo);

    $arquivo = fopen("alunos.txt","w");

    foreach($linhas as $l){
        fwrite($arquivo, $l);
    }

    fclose($arquivo);
}

$arqAluno = fopen("alunos.txt","r") or die("erro ao abrir arquivo");

while(($linha = fgets($arqAluno)) !== false){

    if(trim($linha) != ""){

        $colunaDados = explode(";", $linha);

        if(count($colunaDados) >= 3){

            echo "<tr>";
            echo "<td>".$colunaDados[0]."</td>";
            echo "<td>".$colunaDados[1]."</td>";
            echo "<td>".$colunaDados[2]."</td>";

            echo "<td>
            <a href='?matricula=".$colunaDados[0]."'>
            Excluir
            </a>
            </td>";

            echo "</tr>";
        }
    }
}

fclose($arqAluno);

?>

</table>

</body>
</html>