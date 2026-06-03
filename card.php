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
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php">Cadastro</a>
        <span>|</span>
        <a href="listagem.php">Listagem</a>
    </nav>

    <div class="card-copa">

        <div class="card-header">
            <img src="<?= $copa->getImagem() ?>" alt="Imagem da Copa <?= $copa->getAno() ?>">
            <h2>Copa <?= $copa->getAno() ?></h2>
        </div>

        <div class="card-body">
            <div class="card-row">
                <span class="card-label">Ano</span>
                <span class="card-value"><?= $copa->getAno() ?></span>
            </div>
            <div class="card-row">
                <span class="card-label">Sede</span>
                <span class="card-value"><?= $copa->getSede() ?></span>
            </div>
            <div class="card-row">
                <span class="card-label">Campeão</span>
                <span class="card-value"><?= $copa->getCampeao() ?></span>
            </div>
            <div class="card-row">
                <span class="card-label">Confederação sede</span>
                <span class="card-value"><?= $copa->getConfederacaoInt() ?></span>
            </div>
            <div class="card-row">
                <span class="card-label">Seleções</span>
                <span class="card-value"><?= $copa->getQuantidadeSelecoes() ?></span>
            </div>
        </div>

        <div class="card-footer">
            <a href="listagem.php">← Voltar para listagem</a>
        </div>

    </div>

</body>
</html>
