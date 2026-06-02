<?php

require_once("util/conexao.php");
Class CopaDAO{

     private $conn;

    public function __construct() {
        $this->conn = Conexao::getConexao();
    }
  public function listar() {

        $sql = "SELECT * FROM copas ORDER BY ano";

        $stm = $this->conn->prepare($sql);
        $stm->execute();

        return $stm->fetchAll();
    }

    public function inserir(Copa $copa) {

        $sql = "INSERT INTO copas
                (ano, sede, campeao, confederacao_sede,
                 quantidade_selecoes, imagem)
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

    public function excluir($id) {

        $sql = "DELETE FROM copas WHERE id = ?";

        $stm = $this->conn->prepare($sql);
        $stm->execute([$id]);
    }

}

