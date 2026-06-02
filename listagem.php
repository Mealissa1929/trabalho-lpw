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
</head>
<body>

    <nav>
        <a href="index.php">Cadastro</a> |
        <a href="listagem.php">Listagem</a>
    </nav>

    <hr>

    <h1>Copas Cadastradas</h1>

    <a href="index.php">Nova Copa</a>

    <br><br>

    <table border="1">

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
            <td><?= $c["id"] ?></td>
            <td><?= $c["ano"] ?></td>
            <td><?= $c["sede"] ?></td>
            <td><?= $c["campeao"] ?></td>
            <td><?= $c["confederacao"] ?></td>
            <td><?= $c["quantidade"] ?></td>

            <td>
                <?php if($c["imagem"]): ?>
                    <img src="<?= $c["imagem"] ?>" width="100">
                <?php endif; ?>
            </td>

            <td>

                <a href="listagem.php?excluir=<?= $c['id'] ?>"
                   onclick="return confirm('Confirma a exclusão?')">
                   Excluir
                </a>

                |

                <a href="card.php?id=<?= $c['id'] ?>">
                   Ver Card
                </a>

            </td>

        </tr>

        <?php endforeach; ?>

    </table>

</body>
</html>
