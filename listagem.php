
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Copas do Mundo</title>
</head>
<body>

    <h1>Cadastro de Copas do Mundo</h1>

    <h3>Listagem</h3>

    <table border="1">
        <!-- Cabeçalho -->
        <tr>
            <th>ID</th>
            <th>Ano</th>
            <th>Sede</th>
            <th>Campeão</th>
            <th>Confederação Sede</th>
            <th>Quantidade de Seleções</th>
            <th>Imagem</th>
        </tr> 

        <!-- Dados -->
        <?php foreach($copas as $c): ?>
            <tr>
                <td><?= $c["id"] ?></td>
                <td><?= $c["Ano"] ?></td>
                <td>
                    <?= ?>
                </td>
                <td><?= $c["qtd_paginas"] ?></td>
                <td><?= $c["autor"] ?></td>
                <td><a href="livros_excluir.php?id=<?=$l['id']?>"
                onclick="if(!confirm('Confirma a exclusão?')) return false;"
                >Excluir</a></td>
            </tr>
        
        <?php endforeach; ?>
    </table>
    
