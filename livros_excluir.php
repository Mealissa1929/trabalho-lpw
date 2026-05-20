<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once("util/Conexao.php");

$conexao = Conexao::getConexao();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM livros WHERE id = (?)";
    $stm = $conexao->prepare($sql);
    $stm->execute([$id]);


    header("Location: livros.php");
    exit;
} else {
    echo "ID inválido";
    echo "<a href='livros.php'>Voltar</a>";
}
