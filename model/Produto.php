<?php

require_once 'Model.php';

class Produto extends Model
{
    private $codigo;
    private $nome;
    private $url_imagem;
    private $preco;
    private $descricao;
    private $quantidade;
    private $categoria;

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

    public function getImagem()
    {
        return $this->url_imagem;
    }

    public function setImagem($imagem)
    {
        $this->url_imagem = $imagem;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function listarCategorias()
    {
        try {
            $sql = "SELECT prod.Id_produto as Id_produto, cat.Nome_categoria as Nome_categoria FROM produto prod INNER JOIN produto_categoria prod_cat on prod.Id_produto = prod_cat.Fk_produto INNER JOIN categoria cat on cat.Id_categoria = prod_cat.Fk_categoria";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $dados_recebidos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $dados_recebidos;
        } catch (Exception $e) {
            $this->mensagem = $e->getMessage();
            return null;
        }
    }

    public function buscarCategorias($id)
    {
        try {
            $sql = "SELECT Fk_categoria FROM produto_categoria WHERE Fk_produto = $id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $dados_recebidos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $dados_recebidos;
        } catch (Exception $e) {
            $this->mensagem = $e->getMessage();
            return null;
        }
    }

    public function pesquisarProdutos($sql)
    {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM produto WHERE $sql");
            $stmt->execute();
            $dados_recebidos = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $dados_recebidos;
        } catch (PDOException $e) {
            $this->mensagem = $e->getMessage();
            return null;
        }
    }
}
