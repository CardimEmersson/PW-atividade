<?php

require_once 'Model.php';
class Categoria extends Model
{
    private $codigo;
    private $nome;

    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = Conexao::getConexao();
        } catch (PDOException $e) {
            $this->mensagem = $e->getMessage();
        }
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
}
