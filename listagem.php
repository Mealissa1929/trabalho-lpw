<?php

require_once("dao/CopaDAO.php");

$dao = new CopaDAO();
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

<table border="1">

    <tr>
        <th>ID</th>
        <th>Ano</th>
        <th>Sede</th>
        <th>Campeão</th>
        <th>Confederação</th>
        <th>Quantidade</th>
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
            <img src="<?= $c["imagem"] ?>" width="100">
        </td>

        <td>
            <a href="copas_excluir.php?id=<?= $c['id'] ?>"
               onclick="return confirm('Confirma a exclusão?')">
               Excluir
            </a>
        </td>
    </tr>

    <?php endforeach; ?>

</table>

<br>

<a href="cards.php">Visualizar em Cards</a>

</body>
</html>
