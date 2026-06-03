<?php

require_once("util/conexao.php");
require_once("modelo/Copa.php");

Class CopaDAO{

     private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }

 public function listar() {
    $sql = "SELECT * FROM copas ORDER BY ano";
    $stm = $this->conn->prepare($sql);
    $stm->execute();
    
    $copas = [];
    while($row = $stm->fetch()) {
        $copa = new Copa(
            $row['ano'],
            $row['sede'],
            $row['campeao'],
            $row['confederacao'],
            $row['imagem'],
            $row['quantidade']
        );
        $copa->setId($row['id']);
        $copas[] = $copa;
    }
    return $copas;
}

    public function inserir(Copa $copa) {

        $sql = "INSERT INTO copas
                (ano, sede, campeao, confederacao,
                 quantidade, imagem)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stm = $this->conn->prepare($sql);

        $stm->execute([
            $copa->getAno(),
            $copa->getSede(),
            $copa->getCampeao(),
            $copa->getConfederacaoSede(),
            $copa->getQuantidadeSelecoes(),
            $copa->getImagem()
        ]);
    }
public function buscarPorId($id) {
    $sql = "SELECT * FROM copas WHERE id = ?";
    $stm = $this->conn->prepare($sql);
    $stm->execute([$id]);
    $row = $stm->fetch();

    if(!$row) return null;

    $copa = new Copa(
        $row['ano'],
        $row['sede'],
        $row['campeao'],
        $row['confederacao'],
        $row['imagem'],
        $row['quantidade']
    );
    $copa->setId($row['id']);
    return $copa;
}

    public function excluir($id) {

        $sql = "DELETE FROM copas WHERE id = ?";

        $stm = $this->conn->prepare($sql);
        $stm->execute([$id]);
    }

}

