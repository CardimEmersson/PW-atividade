<?php

include_once 'model/Categoria.php';

class CategoriaController
{
    public $categoria;

    public function __construct()
    {
        $this->categoria = new Categoria();
        $_REQUEST['mensagem'] = $this->categoria->getMensagem();
    }

    public function exibirCategorias()
    {
        $categorias = $this->categoria->listarTudo('categoria');

        if (!empty($categorias)) {
            $_REQUEST['categorias'] = $categorias;
        } else {
            $_REQUEST['categorias'] = array();
            $_REQUEST['mensagem'] = '';
        }

        require_once 'view/categoriaView.php';
    }

    public function criarCategoria()
    {
        include_once 'View/cadastrarCategoria.php';
    }

    public function alterarCategoria()
    {
        if (isset($_REQUEST['Id'])) {

            $cadCategoria = new Categoria();
            $cadCategoria = $this->categoria->listar('*', 'categoria', 'Id_categoria', $_REQUEST['Id']);
            $_REQUEST['alterarcategoria'] = $cadCategoria;
        }
        include_once 'View/alterarCategoria.php';
    }

    public function cadastrarCategoria()
    {
        $novaCategoria = $this->verificarCampos();

        if (!empty($novaCategoria)) {
            $nome = $novaCategoria->getNome();

            $this->categoria->inserir(
                "categoria",
                "Nome_categoria",
                "'$nome'"
            );

            $_REQUEST['mensagem'] = $this->categoria->getMensagem();
            $this->criarCategoria();
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao enviar o formulario!";
            $this->criarCategoria();
        }
    }

    public function deletarCategoria()
    {
        if (isset($_REQUEST['Id'])) {
            $chave = $_REQUEST['Id'];

            $dados = $this->categoria->listar('*', 'produto_categoria', 'Fk_categoria', $chave);

            if (!empty($dados)) {

                $_REQUEST['mensagem'] = "Não foi possivél excluir, pois existe produto(s) com essa categoria";

                $this->exibirCategorias();
            } else {

                $this->categoria->excluir('categoria', 'Id_categoria', $chave);

                $_REQUEST['mensagem'] = $this->categoria->getMensagem();
            }

            $this->exibirCategorias();
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar excluir a categoria";
            $this->exibirCategorias();
        }
    }

    public function atualizarCategoria()
    {
        if (isset($_POST['Id'])) {
            $chave = $_POST['Id'];
            $novaCategoria = $this->verificarCampos();

            if (!empty($novaCategoria)) {
                $nome = $novaCategoria->getNome();

                $this->categoria->alterar(
                    'categoria',
                    "Nome_categoria = '$nome'",
                    'Id_categoria',
                    $chave
                );
                $_REQUEST['mensagem'] = $this->categoria->getMensagem();

                $this->exibirCategorias();
            } else {
                $_REQUEST['mensagem'] = "Houve um problema ao enviar o formulario!";
                $this->exibirCategorias();
            }
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar alterar a categoria";
            $this->exibirCategorias();
        }
    }

    private function verificarCampos()
    {
        if (isset($_POST['nome'])) {

            $novaCategoria = new Categoria();

            $novaCategoria->setNome($_POST['nome']);

            return $novaCategoria;
        } else {
            return null;
        }
    }
}
