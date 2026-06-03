<?php
Class Copa{
    private int $id;
    private int $ano;
    private string $sede;
    private string $campeao;
    private string $confederacaoSede;
    private string $imagem;
    private int $quantidadeSelecoes;

    public function __construct(int $ano, string $sede, string $campeao, string $confSede, string $imagem, int $qtdSelecoes)
    {
        $this->ano = $ano;
        $this->sede = $sede;
        $this->campeao = $campeao;
        $this->confederacaoSede = $confSede;
        $this->imagem = $imagem;
        $this->quantidadeSelecoes = $qtdSelecoes;
    }

    public function getConfederacaoInt(){
        if($this->confederacaoSede == "U")
            return "UEFA";
        else if($this->confederacaoSede == "CC")
            return "CONCACAF";
        else if($this->confederacaoSede == "CM")
            return "CONMEBOL";
        else if($this->confederacaoSede == "CA")
            return "CAF";
        else if($this->confederacaoSede == "O")
             return "OFC";
        else if($this->confederacaoSede == "A")
             return "AFC";
    }

    /**
     * Get the value of id
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of ano
     */
    public function getAno(): int
    {
        return $this->ano;
    }

    /**
     * Set the value of ano
     */
    public function setAno(int $ano): self
    {
        $this->ano = $ano;

        return $this;
    }

    /**
     * Get the value of sede
     */
    public function getSede(): string
    {
        return $this->sede;
    }

    /**
     * Set the value of sede
     */
    public function setSede(string $sede): self
    {
        $this->sede = $sede;

        return $this;
    }

    /**
     * Get the value of campeao
     */
    public function getCampeao(): string
    {
        return $this->campeao;
    }

    /**
     * Set the value of campeao
     */
    public function setCampeao(string $campeao): self
    {
        $this->campeao = $campeao;

        return $this;
    }

    /**
     * Get the value of confederacaoSede
     */
    public function getConfederacaoSede(): string
    {
        return $this->confederacaoSede;
    }

    /**
     * Set the value of confederacaoSede
     */
    public function setConfederacaoSede(string $confederacaoSede): self
    {
        $this->confederacaoSede = $confederacaoSede;

        return $this;
    }

    /**
     * Get the value of imagem
     */
    public function getImagem(): string
    {
        return $this->imagem;
    }

    /**
     * Set the value of imagem
     */
    public function setImagem(string $imagem): self
    {
        $this->imagem = $imagem;

        return $this;
    }

    /**
     * Get the value of quantidadeSelecoes
     */
    public function getQuantidadeSelecoes(): int
    {
        return $this->quantidadeSelecoes;
    }

    /**
     * Set the value of quantidadeSelecoes
     */
    public function setQuantidadeSelecoes(int $quantidadeSelecoes): self
    {
        $this->quantidadeSelecoes = $quantidadeSelecoes;

        return $this;
    }
}
