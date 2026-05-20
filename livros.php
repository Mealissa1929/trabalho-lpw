<?php

//Exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();
//print_r($conexao);

$msgErro = "";
$titulo = "";
$genero = "";
$qtdPag = "";
$autor = "";

//Salvar o livro
if(isset($_POST['titulo'])) {
    //1- Receber os dados do formulário
    $titulo = trim($_POST['titulo']) ? trim($_POST['titulo']) : null;
    $genero = trim($_POST['genero']) ? trim($_POST['genero']) : null ;
    $qtdPag = is_numeric($_POST['paginas']) ? $_POST['paginas'] : null;
    $autor = trim($_POST['autor']) ? trim($_POST['autor']) : null;

    //1.1- Validar os dados
    $msgs = array();
    if(!$titulo)
        array_push($msgs, "Informe o título!");
    elseif (strlen($titulo)<3)
        array_push($msgs, "Informe um título com no mínimo 3 caracteres!");
    elseif (strlen($titulo)>50)
        array_push($msgs, "Informe um título com no máximo 50 caracteres!");

    if(!$genero)
        array_push($msgs, "Informe o gênero!");

    if(!$qtdPag)
        array_push($msgs, "Informe o número de páginas!");
    else if($qtdPag<=0)
        array_push($msgs, "Informe um número válido de páginas!");

    if(!$autor)
        array_push($msgs, "Informe o autor!");

    $livroExiste = procurarLivro($titulo, $conexao);
    if($livroExiste)
         array_push($msgs, "Este livro já está registrado!");
    
    if (empty($msgs)){
    //2- Inserir o livro no banco de dados
    $sql = "INSERT INTO livros (titulo, genero, qtd_paginas, autor)
            Values (?,?,?,?)";
    $stm = $conexao->prepare($sql);
    $stm->execute([$titulo, $genero, $qtdPag, $autor]);

    //3- Redirecionar para a página de listagem
    header("location: livros.php");
    } else {
        //exibir as mensagens de erro
        $msgErro = implode("<br>",$msgs);
    }
}

//Listagem dos livros
$sql = "SELECT * FROM livros";
$stm = $conexao->prepare($sql);
$stm->execute();
$livros = $stm->fetchAll();

//echo "<pre>" . print_r($livros, true) . "</pre>";

function procurarLivro($titulo, $conexao){
    $sql = "SELECT titulo FROM livros WHERE titulo = ?";
    $stm = $conexao->prepare($sql);
    $stm->execute([$titulo]);
    return count($stm->fetchAll())>0;
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de livros</title>
</head>
<body>

    <h1>Cadastro de livros</h1>

    <h3>Listagem</h3>

    <table border="1">
        <!-- Cabeçalho -->
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Gênero</th>
            <th>Páginas</th>
            <th>autor</th>
            <th></th>
        </tr> 

        <!-- Dados -->
        <?php foreach($livros as $l): ?>
            <tr>
                <td><?= $l["id"] ?></td>
                <td><?= $l["titulo"] ?></td>
                <td>
                    <?php
                        if($l['genero'] == 'D')
                            echo "Drama";
                        else if($l['genero'] == 'F')
                            echo "Ficção";
                        else if($l['genero'] == 'R')
                            echo "Romance";
                        else if($l['genero'] == 'O')
                            echo "Outro";                        
                    ?>
                </td>
                <td><?= $l["qtd_paginas"] ?></td>
                <td><?= $l["autor"] ?></td>
                <td><a href="livros_excluir.php?id=<?=$l['id']?>"
                onclick="if(!confirm('Confirma a exclusão?')) return false;"
                >Excluir</a></td>
            </tr>
        
        <?php endforeach; ?>
    </table>
    


    <h3>Formulário</h3>

    <form action="" method="POST" onsubmit="return validarForm();">

        <input type="text" placeholder="Informe o título"
            name="titulo" id="titulo" value="<?=$titulo?>">

        <br><br>

        <select name="genero" id="genero" >
            <option value="">---Selecione o gênero---</option>
            <option value="D" <?= $genero == 'D' ? 'selected' : ''?>>Drama</option>
            <option value="F" <?= $genero == 'F' ? 'selected' : ''?>>Ficção</option>
            <option value="R" <?= $genero == 'R' ? 'selected' : ''?>>Romance</option>
            <option value="O" <?= $genero == 'O' ? 'selected' : ''?>>Outro</option>
        </select>

        <br><br>

        <input type="number" name="paginas" id="paginas" 
            placeholder="Informe o número de páginas" value="<?=$qtdPag?>">

        <br><br>

        <input type="text" placeholder="Informe o autor" 
            name="autor" id="autor" value="<?=$autor?>">

        <br><br>

        <button>Gravar</button>

    </form>

    <div id="erro" style="color: red; display: none">Exemplo de erro</div>

    <div style="color: red;"> <?=$msgErro?> </div>

    <!--<script src="validacao.js"></script>-->
    
</body>
</html>