<?php

require_once("util/Conexao.php");
require_once("modelo/Copa.php");
require_once("dao/CopaDAO.php");

$copa = new Copa("", "", "", "", "", "");
$msgErro = "";
$msgs = array();
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

    $anoAtual = date("Y");
    
    if(!$ano)
     array_push($msgs, "Informe o ano!");
        else if($ano < 1930)
    array_push($msgs, "Não existiam Copas do Mundo antes de 1930!");
        else if(($ano - 1930) % 4 != 0)
    array_push($msgs, "Informe um ano de Copa válido!");
        else if($ano == 1942 || $ano == 1946)
    array_push($msgs, "Não houve Copa do Mundo neste ano!");
        else if($ano > $anoAtual){
    array_push($msgs, "Espere a copa acontecer para adicionar!");
}

    if(!$sede){
        array_push($msgs, "Informe a sede!");
    }
    else if(strlen($sede) < 3){
        array_push($msgs, "A sede deve ter pelo menos 3 caracteres!");
    }
    else if(strlen($sede) > 50){
        array_push($msgs, "A sede deve ter no máximo 50 caracteres!");
    }

    if(!$campeao){
        array_push($msgs, "Informe o campeão!");
    }
    else if(strlen($campeao) < 3){
        array_push($msgs, "O campeão deve ter pelo menos 3 caracteres!");
    }
    else if(strlen($campeao) > 50){
        array_push($msgs, "O campeão deve ter no máximo 50 caracteres!");
    }

    if(!$confSede){
        array_push($msgs, "Informe a confederação sede!");
    }
    else if(
            $confSede != "U" &&
            $confSede != "CC" &&
            $confSede != "CM" &&
            $confSede != "CA" &&
            $confSede != "O" &&
            $confSede != "A"){
    array_push($msgs, "Confederação inválida!");
}

    if(!$imagem){
        array_push($msgs, "Informe a imagem!");
    }
    else if(!filter_var($imagem, FILTER_VALIDATE_URL)){
        array_push($msgs, "Informe um link válido de imagem!");
    }

    if(!$qtdSele){
        array_push($msgs, "Informe a quantidade de seleções!");
    }
    else if(
        $qtdSele != 13 &&
        $qtdSele != 16 &&
        $qtdSele != 24 &&
        $qtdSele != 32 &&
        $qtdSele != 48){
    array_push($msgs, "Quantidade de seleções inválida!");
}


   if (empty($msgs)){

    $copa = new Copa($ano, $sede, $campeao, $confSede, $imagem, $qtdSele);

    $dao = new CopaDAO();
    $dao->inserir($copa);

    header("location: listagem.php");
    exit;

    } else {

    $msgErro = implode("<br>", $msgs);

    }
}
?>
    
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Copas do Mundo</title>
</head>
<body>

    <nav>
        <a href="index.php">Cadastro</a> |
        <a href="listagem.php">Listagem</a>
    </nav>

    <hr>

    <h1>Cadastro de Copas do Mundo</h1>

    <h3>Formulário</h3>

   <form action="" method="POST">

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
            <option value="">---Selecione a confederação sede---</option>
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
            <option value="24" <?= $copa->getQuantidadeSelecoes() == '24' ? 'selected' : ''?>>24</option>
            <option value="32" <?= $copa->getQuantidadeSelecoes() == '32' ? 'selected' : ''?>>32</option>
            <option value="48" <?= $copa->getQuantidadeSelecoes() == '48' ? 'selected' : ''?>>48</option>
        </select>

        <br><br>

        <input type="text" placeholder="Link da imagem de representação da copa" 
            name="imagem" id="imagem" value="<?=$copa->getImagem()?>">

        <br><br>

        <button>Gravar</button>

    </form>

    <div style="color:red;">
        <?= $msgErro ?>
    </div>

</body>
</html>
