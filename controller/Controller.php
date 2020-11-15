<?php

include_once 'ProdutoController.php';
include_once 'CategoriaController.php';
include_once 'UsuarioController.php';

class Controller
{
    private $produtoController;
    private $categoriaController;
    private $usuarioController;

    public function __construct()
    {
        $this->produtoController = new ProdutoController();
        $this->categoriaController = new CategoriaController();
        $this->usuarioController = new usuarioController();
    }

    public function home()
    {
        require_once 'view/home.php';
    }

    public function produtos()
    {
        if (isset($_REQUEST["metodo"])) {
            $metodo = $_REQUEST["metodo"];

            switch ($metodo) {
                case 'criarProduto':
                    $this->produtoController->criarProduto();
                    break;
                case 'deletarProduto':
                    $this->produtoController->deletarProduto();
                    break;
                case 'alterarProduto':
                    $this->produtoController->alterarProduto();
                    break;
                case 'cadastrarProduto':
                    $this->produtoController->cadastrarProduto();
                    break;
                case 'atualizarProduto':
                    $this->produtoController->atualizarProduto();
                    break;
                case 'deletarProduto':
                    $this->produtoController->deletarProduto();
                    break;
                case 'filtroProduto':
                    $this->produtoController->filtroProduto();
                    break;
                default:
                    $this->produtoController->exibirProdutos();
                    break;
            }
        } else {
            $this->produtoController->exibirProdutos();
        }
    }

    public function categorias()
    {
        if (isset($_REQUEST["metodo"])) {
            $metodo = $_REQUEST["metodo"];

            switch ($metodo) {
                case 'criarCategoria':
                    $this->categoriaController->criarCategoria();
                    break;
                case 'deletarCategoria':
                    $this->categoriaController->deletarCategoria();
                    break;
                case 'alterarCategoria':
                    $this->categoriaController->alterarCategoria();
                    break;
                case 'cadastrarCategoria':
                    $this->categoriaController->cadastrarCategoria();
                    break;
                case 'atualizarCategoria':
                    $this->categoriaController->atualizarCategoria();
                    break;

                default:
                    $this->categoriaController->exibirCategorias();
                    break;
            }
        } else {
            $this->categoriaController->exibirCategorias();
        }
    }

    public function usuario()
    {
        if (isset($_REQUEST["metodo"])) {
            $metodo = $_REQUEST["metodo"];

            switch ($metodo) {
                case 'criarUsuario':
                    $this->usuarioController->criarUsuario();
                    break;
                case 'deletarUsuario':
                    $this->usuarioController->deletarUsuario();
                    break;
                case 'alterarUsuario':
                    $this->usuarioController->alterarUsuario();
                    break;
                case 'cadastrarUsuario':
                    $this->usuarioController->cadastrarUsuario();
                    break;
                case 'atualizarUsuario':
                    $this->usuarioController->atualizarUsuario();
                    break;
                case 'loginUsuario':
                    $this->usuarioController->loginUsuario();
                    break;
                case 'exibirPerfil':
                    $this->usuarioController->exibirPerfil();
                    break;
                default:
                    $this->usuarioController->exibirPerfil();
                    break;
            }
        } else {
            $this->usuarioController->exibirPerfil();
        }
    }
}
