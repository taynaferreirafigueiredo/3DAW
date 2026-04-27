<?php

define('ARQUIVO', 'perguntas.txt');

function carregarPerguntas() {
    if (!file_exists(ARQUIVO)) return [];
    return json_decode(file_get_contents(ARQUIVO), true) ?? [];
}

function salvarPerguntas($perguntas) {
    file_put_contents(ARQUIVO, json_encode($perguntas, JSON_PRETTY_PRINT));
}

function gerarId($perguntas) {
    return count($perguntas) ? max(array_column($perguntas, 'id')) + 1 : 1;
}

function buscarPorId($id) {
    foreach (carregarPerguntas() as $p) {
        if ($p['id'] == $id) return $p;
    }
    return null;
}

$perguntas = carregarPerguntas();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($_POST['acao'] == 'criar_multipla') {
        $perguntas[] = [
            'id' => gerarId($perguntas),
            'tipo' => 'multipla',
            'pergunta' => $_POST['pergunta'],
            'opcoes' => array_filter($_POST['opcoes']),
            'correta' => $_POST['correta']
        ];
    }

    if ($_POST['acao'] == 'criar_texto') {
        $perguntas[] = [
            'id' => gerarId($perguntas),
            'tipo' => 'texto',
            'pergunta' => $_POST['pergunta'],
            'resposta' => $_POST['resposta']
        ];
    }

    if ($_POST['acao'] == 'excluir') {
        $perguntas = array_values(array_filter($perguntas, fn($p) => $p['id'] != $_POST['id']));
    }

    if ($_POST['acao'] == 'editar_multipla') {
        foreach ($perguntas as &$p) {
            if ($p['id'] == $_POST['id']) {
                $p['pergunta'] = $_POST['pergunta'];
                $p['opcoes'] = array_filter($_POST['opcoes']);
                $p['correta'] = $_POST['correta'];
            }
        }
    }

    if ($_POST['acao'] == 'editar_texto') {
        foreach ($perguntas as &$p) {
            if ($p['id'] == $_POST['id']) {
                $p['pergunta'] = $_POST['pergunta'];
                $p['resposta'] = $_POST['resposta'];
            }
        }
    }

    salvarPerguntas($perguntas);
}

$busca = null;
if (isset($_GET['buscar_id'])) {
    $busca = buscarPorId($_GET['buscar_id']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sistema Completo</title>
</head>
<body>

<h1>SISTEMA DE PERGUNTAS</h1>

<h2>Criar Múltipla Escolha</h2>
<form method="POST">
<input type="hidden" name="acao" value="criar_multipla">
Pergunta: <input name="pergunta" required><br>
Opção 1: <input name="opcoes[]"><br>
Opção 2: <input name="opcoes[]"><br>
Opção 3: <input name="opcoes[]"><br>
Opção 4: <input name="opcoes[]"><br>
Resposta correta: <input name="correta"><br>
<button>Criar</button>
</form>

<h2>Criar Pergunta Texto</h2>
<form method="POST">
<input type="hidden" name="acao" value="criar_texto">
Pergunta: <input name="pergunta" required><br>
Resposta: <input name="resposta" required><br>
<button>Criar</button>
</form>

<h2>Buscar Pergunta por ID</h2>
<form method="GET">
<input name="buscar_id">
<button>Buscar</button>
</form>

<?php if ($busca): ?>
<h3>Resultado:</h3>
<p><?= $busca['pergunta'] ?></p>
<?php endif; ?>

<h2>Lista de Perguntas</h2>

<?php foreach ($perguntas as $p): ?>
<div style="border:1px solid #000; margin:10px; padding:10px;">

<strong>ID:</strong> <?= $p['id'] ?><br>
<strong>Pergunta:</strong>

<form method="POST">
<input type="hidden" name="id" value="<?= $p['id'] ?>">

<?php if ($p['tipo'] == 'multipla'): ?>
<input type="hidden" name="acao" value="editar_multipla">
<input name="pergunta" value="<?= $p['pergunta'] ?>"><br>

<?php foreach ($p['opcoes'] as $op): ?>
<input name="opcoes[]" value="<?= $op ?>"><br>
<?php endforeach; ?>

Correta: <input name="correta" value="<?= $p['correta'] ?>"><br>

<?php else: ?>
<input type="hidden" name="acao" value="editar_texto">
<input name="pergunta" value="<?= $p['pergunta'] ?>"><br>
Resposta: <input name="resposta" value="<?= $p['resposta'] ?>"><br>
<?php endif; ?>

<button>Salvar Alterações</button>
</form>

<form method="POST">
<input type="hidden" name="acao" value="excluir">
<input type="hidden" name="id" value="<?= $p['id'] ?>">
<button>Excluir</button>
</form>

</div>
<?php endforeach; ?>

</body>
</html>
