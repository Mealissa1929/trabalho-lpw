<?php

//Exibir erros
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");
require_once("modelo/Copa.php");
require_once("dao/CopaDAO.php");

$conexao = Conexao::getConexao();

$copa = new Copa("", "", "", "", "", "");
$msgErro = "";
$ano = "";
$sede = "";
$campeao = "";
$confSede = "";
$imagem = "";
$qtdSele = "";

if(isset($_POST['ano'])) {
    $ano = is_numeric($_POST['ano']) ? $_POST['ano'] : null;
    $sede = trim($_POST['sede']) ? trim($_POST['sede']) : null ;
    $campeao = trim($_POST['campeao']) ? trim($_POST['campeao']) : null ;
    $confSede = trim($_POST['confederacao']) ? trim($_POST['confederacao']) : null ;
    $imagem = trim($_POST['imagem']) ? trim($_POST['imagem']) : null ;
    $qtdSele = is_numeric($_POST['quantidadeSelecoes']) ? $_POST['quantidadeSelecoes'] : null ;

    $copa = new Copa($ano, $sede, $campeao, $confSede, $imagem, $qtdSele);

    //1.1- Validar os dados
    $msgs = array();
    
    if (empty($msgs)){
    //2- Inserir o livro no banco de dados

    //3- Redirecionar para a página de listagem
    header("location: index.php");
    } else {
        //exibir as mensagens de erro
        $msgErro = implode("<br>",$msgs);
    }
}



?>
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
    


    <h3>Formulário</h3>

    <form action="" method="POST" onsubmit="return validarForm();">

        <input type="number" placeholder="Informe o ano"
            name="ano" id="ano" value="<?=$copa->getAno()?>">

        <br><br>

        <input type="text" placeholder="Informe o país sede" 
            name="sede" id="sede" value="<?=$copa->getSede()?>">

        <br><br>

             <input type="text" placeholder="Informe a seleção campeã" 
            name="campeao" id="campeao" value="<?=$copa->getCampeao()?>">

        <br><br>

        <select name="confederacao" id="confederacao" >
            <option value="">---Selecione a conefederação sede---</option>
            <option value="U" <?= $copa->getConfederacaoSede() == 'U' ? 'selected' : ''?>>UEFA</option>
            <option value="CC" <?= $copa->getConfederacaoSede() == 'CC' ? 'selected' : ''?>>CONCACAF</option>
            <option value="CM" <?= $copa->getConfederacaoSede() == 'CM' ? 'selected' : ''?>>CONMEBOL</option>
            <option value="CA" <?= $copa->getConfederacaoSede() == 'CA' ? 'selected' : ''?>>CAF</option>
            <option value="O" <?= $copa->getConfederacaoSede() == 'O' ? 'selected' : ''?>>OFC</option>
            <option value="A" <?= $copa->getConfederacaoSede() == 'A' ? 'selected' : ''?>>AFC</option>
        </select>

        <br><br>

         <select name="quantidadeSelecoes" id="quantidadeSelecoes" >
            <option value="">---Selecione a quantidade de seleções---</option>
            <option value="13" <?= $copa->getQuantidadeSelecoes() == '13' ? 'selected' : ''?>>13</option>
            <option value="16" <?= $copa->getQuantidadeSelecoes() == '16' ? 'selected' : ''?>>16</option>
            <option value="32" <?= $copa->getQuantidadeSelecoes() == '32' ? 'selected' : ''?>>32</option>
            <option value="48" <?= $copa->getQuantidadeSelecoes() == '48' ? 'selected' : ''?>>48</option>
        </select>

        <br><br>

        <input type="text" placeholder="Link da imagem de representação da copa" 
            name="imagem" id="imagem" value="<?=$copa->getImagem()?>">

        <br><br>

        <button>Gravar</button>

    </form>

    <div style="color: red;"> <?=$msgErro?> </div>

</body>
</html>
