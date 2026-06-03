<?php

require_once("dao/CopaDAO.php");

$dao = new CopaDAO();

// Exclusão
if(isset($_GET['excluir'])) {
    $dao->excluir($_GET['excluir']);
    header("location: listagem.php");
    exit;
}

// Listagem
$copas = $dao->listar();

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Listagem de Copas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav>
        <a href="index.php">Cadastro</a>
        <span>|</span>
        <a href="listagem.php">Listagem</a>
    </nav>

    <h1>Copas Cadastradas</h1>

    <a href="index.php">Nova Copa</a>

    <br><br>

    <table>

        <tr>
            <th>ID</th>
            <th>Ano</th>
            <th>Sede</th>
            <th>Campeão</th>
            <th>Confederação</th>
            <th>Quantidade de Seleções</th>
            <th>Imagem</th>
            <th>Ações</th>
        </tr>

        <?php foreach($copas as $c): ?>

        <tr>
            <td><?= $c->getId() ?></td>
            <td><?= $c->getAno() ?></td>
            <td><?= $c->getSede() ?></td>
            <td><?= $c->getCampeao() ?></td>
            <td><?= $c->getConfederacaoInt() ?></td>
            <td><?= $c->getQuantidadeSelecoes() ?></td>

            <td>
                <?php if($c->getImagem()): ?>
                    <img src="<?= $c->getImagem() ?>" width="100">
                <?php endif; ?>
            </td>

            <td>
                <a href="listagem.php?excluir=<?= $c->getId() ?>"
                   onclick="return confirm('Confirma a exclusão?')">
                   Excluir
                </a>

                |

                <a href="card.php?id=<?= $c->getId() ?>">
                   Ver Card
                </a>
            </td>
        </tr>

        <?php endforeach; ?>

    </table>

</body>
</html>
