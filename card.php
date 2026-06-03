<?php

require_once("util/Conexao.php");
require_once("modelo/Copa.php");
require_once("dao/CopaDAO.php");

$dao = new CopaDAO();
$copa = $dao->buscarPorId($_GET['id']);

if(!$copa) {
    header("location: listagem.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Card - Copa <?= $copa->getAno() ?></title>
</head>
<body>

    <nav>
        <a href="index.php">Cadastro</a> |
        <a href="listagem.php">Listagem</a>
    </nav>

    <hr>

    <h1>Copa do Mundo <?= $copa->getAno() ?></h1>

    <img src="<?= $copa->getImagem() ?>" width="200">

    <br><br>

    <strong>Ano:</strong> <?= $copa->getAno() ?> <br>
    <strong>Sede:</strong> <?= $copa->getSede() ?> <br>
    <strong>Campeão:</strong> <?= $copa->getCampeao() ?> <br>
    <strong>Confederação Sede:</strong> <?= $copa->getConfederacaoInt() ?> <br>
    <strong>Quantidade de Seleções:</strong> <?= $copa->getQuantidadeSelecoes() ?> <br>

    <br>

    <a href="listagem.php">Voltar</a>

</body>
</html>
