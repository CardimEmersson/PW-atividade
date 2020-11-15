<?php

include_once 'model/Produto.php';
include_once 'utils/ValidarImagem.php';

class ProdutoController
{
    public $produto;

    public function __construct()
    {
        $this->produto = new Produto();
        $_REQUEST['mensagem'] = $this->produto->getMensagem();
    }

    public function exibirProdutos()
    {

        $produtos = $this->produto->listarTudo('produto');
        $categorias = $this->produto->listarCategorias();

        if (!empty($produtos) && !empty($categorias)) {
            $_REQUEST['produtos'] = $produtos;
            $_REQUEST['categorias'] = $categorias;
        } else {
            $_REQUEST['produtos'] = array();
            $_REQUEST['categorias'] = array();
            $_REQUEST['mensagem'] = '';
        }

        require_once 'view/produtoView.php';
    }

    public function criarProduto()
    {
        $this->listarCategorias();

        include_once 'View/cadastrarProduto.php';
    }

    public function alterarProduto()
    {
        $this->listarCategorias();

        if (isset($_REQUEST['Id'])) {

            $cadProduto = new Produto();

            $cadProduto = $this->produto->listar('*', 'produto', 'Id_produto', $_REQUEST['Id']);
            $cadProdutoCategoria = $this->produto->buscarCategorias($_REQUEST['Id']);

            $_REQUEST['alterarproduto'] = $cadProduto;
            $_REQUEST['alterarprodutocategoria'] = $cadProdutoCategoria;
        }
        include_once 'View/alterarProduto.php';
    }

    public function cadastrarProduto()
    {

        $novoProduto = $this->verificarCampos();

        if (!empty($novoProduto)) {
            $nome = $novoProduto->getNome();
            $imagem = $novoProduto->getImagem();
            $preco = $novoProduto->getPreco();
            $descricao = $novoProduto->getDescricao();
            $quantidade = $novoProduto->getQuantidade();
            $categorias = $novoProduto->getCategoria();

            $this->produto->inserir(
                "produto",
                "Nome_produto, Url_imagem, Preco_produto, Descricao_produto, Quantidade_produto",
                "'$nome', '$imagem', '$preco', '$descricao', '$quantidade'"
            );

            $_REQUEST['mensagem'] = $this->produto->getMensagem();

            $chave = $this->produto->ultimoRegistro('Id_produto', 'produto');

            foreach ($categorias as $categoria) {
                $this->produto->inserir(
                    "produto_categoria",
                    "Fk_produto, Fk_categoria",
                    "'$chave->Id_produto', '$categoria'"
                );
            }

            $this->exibirProdutos();
        } else {
            $this->criarProduto();
        }
    }

    public function deletarProduto()
    {
        if (isset($_REQUEST['Id'])) {
            $chave = $_REQUEST['Id'];
            if ($this->deletarImagem($chave)) {

                $this->produto->excluir('produto_categoria', 'Fk_produto', $chave);

                $this->produto->excluir('produto', 'Id_produto', $chave);

                $_REQUEST['mensagem'] = $this->produto->getMensagem();

                $this->exibirProdutos();
            } else {
                $this->exibirProdutos();
            }
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar excluir o produto";
            $this->exibirProdutos();
        }
    }

    public function atualizarProduto()
    {
        if (isset($_POST['Id'])) {
            $chave = $_POST['Id'];

            $novoProduto = $this->verificarCampos();

            if (!empty($novoProduto)) {
                $nome = $novoProduto->getNome();

                $preco = $novoProduto->getPreco();
                $descricao = $novoProduto->getDescricao();
                $quantidade = $novoProduto->getQuantidade();

                $categorias = $novoProduto->getCategoria();


                if ($novoProduto->getImagem() == null) {

                    $set = "Nome_produto = '$nome', Preco_produto = '$preco', Descricao_produto = '$descricao', Quantidade_produto = '$quantidade'";
                } else {

                    if ($this->deletarImagem($chave)) {
                        $this->produto->alterar('produto', "url_imagem = ''", 'Id_produto', $chave);

                        $imagem = $novoProduto->getImagem();

                        $set = "Nome_produto = '$nome', url_imagem = '$imagem', Preco_produto = '$preco', Descricao_produto = '$descricao', Quantidade_produto = '$quantidade'";
                    } else {
                        $this->exibirProdutos();
                    }
                }

                $this->produto->alterar(
                    'produto',
                    $set,
                    'Id_produto',
                    $chave
                );

                $_REQUEST['mensagem'] = $this->produto->getMensagem();

                $this->produto->excluir(
                    'produto_categoria',
                    'Fk_produto',
                    $chave
                );

                foreach ($categorias as $categoria) {
                    $this->produto->inserir(
                        "produto_categoria",
                        "Fk_produto, Fk_categoria",
                        "'$chave', '$categoria'"
                    );
                }

                header("location: ?link=produtos&metodo=exibirProduto");
                exit;
            } else {
                $this->exibirProdutos();
            }
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar alterar o produto";
            $this->exibirProdutos();
        }
    }

    private function listarCategorias()
    {
        $listaCategorias = $this->produto->listarTudo('categoria');

        if (!empty($listaCategorias)) {
            $_REQUEST['listaCategorias'] = $listaCategorias;
        } else {
            $_REQUEST['listaCategorias'] = array();
            $_REQUEST['mensagem'] = $this->produto->getMensagem();
        }
    }

    private function verificarCampos()
    {
        if (isset($_POST['nome'])) {

            $novoProduto = new Produto();

            if (!empty($_FILES['arquivo']['name'])) {
                $nomeImagem = $this->verificarImagem($_FILES['arquivo']);

                if (empty($nomeImagem)) {
                    return null;
                }
                $novoProduto->setImagem($nomeImagem);
            }

            $preco = $this->validaPreco($_POST['preco']);

            $novoProduto->setNome($_POST['nome']);
            $novoProduto->setPreco($preco);
            $novoProduto->setDescricao($_POST['descricao']);
            $novoProduto->setQuantidade($_POST['quantidade']);
            $novoProduto->setCategoria($_POST['categoria']);

            return $novoProduto;
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar alterar o produto";
            return null;
        }
    }

    private function verificarImagem($arquivo)
    {
        $imagem = $arquivo;
        $nomeImagem = $imagem['name'];

        $existe = $this->produto->listar('url_imagem', 'produto', 'url_imagem', "'$nomeImagem'");

        if (!$existe) {

            $up = new ValidarImagem();
            $nomeImagem = $up->uploadImagem($imagem);

            if ($nomeImagem) {
                return $nomeImagem;
            } else {
                $mensagem = $up->getMensagem();
                $_REQUEST['mensagem'] = $mensagem;
                return null;
            }
        } else {
            $_REQUEST['mensagem'] = "já existe imagem com esse nome!";
            return null;
        }
    }

    private function deletarImagem($codigo)
    {
        $imagem = $this->produto->listar('url_imagem', 'produto', 'Id_produto', $codigo);
        $nomeImagem = $imagem->url_imagem;
        $deletar = new ValidarImagem();

        if ($deletar->excluirImagem($nomeImagem)) {
            return true;
        } else {
            $_REQUEST['mensagem'] = "Não foi possível excluir a imagem da pasta!";
            return false;
        }
    }

    private function validaPreco($valor)
    {
        $verificaPonto = ".";
        if (strpos("[" . $valor . "]", "$verificaPonto")) {
            $valor = str_replace('.', '', $valor);
            $valor = str_replace(',', '.', $valor);
        } else {
            $valor = str_replace(',', '.', $valor);
        }
        return $valor;
    }

    public function filtroProduto()
    {
        if (isset($_POST['pesq_nome'])) {
            $nome = $_POST['pesq_nome'];
            $preco = $_POST['pesq_preco'];
            $quantidade = $_POST['pesq_quantidade'];

            ////////
            if (!empty($nome) && empty($preco) && empty($quantidade)) {
                $sql = "Nome_produto = '$nome'";
            }
            if (!empty($nome) && !empty($preco) && empty($quantidade)) {
                $sql = "Nome_produto = '$nome' AND Preco_produto = '$preco'";
            }
            if (!empty($nome) && !empty($preco) && !empty($quantidade)) {
                $sql = "Nome_produto = '$nome' AND Preco_produto = '$preco' AND Quantidade_produto = '$quantidade'";
            }

            if (empty($nome) && !empty($preco) && !empty($quantidade)) {
                $sql = "Preco_produto = '$preco' AND Quantidade_produto = '$quantidade'";
            }
            if (empty($nome) && empty($preco) && !empty($quantidade)) {
                $sql = "Quantidade_produto = '$quantidade'";
            }
            if (!empty($nome) && empty($preco) && !empty($quantidade)) {
                $sql = "Nome_produto = '$nome' AND Quantidade_produto = '$quantidade'";
            }
            if (empty($nome) && !empty($preco) && empty($quantidade)) {
                $sql = "preco_produto = '$preco'";
            }
            if (empty($nome) && empty($preco) && empty($quantidade)) {
                $this->exibirProdutos();
            }
            ////////

            if (!empty($sql)) {
                $dados_prod = $this->produto->pesquisarProdutos($sql);
                $dados_cat = $this->produto->listarCategorias();
            } else {
                $dados_prod = $this->produto->listarTudo('produtos');
                $dados_cat = $this->produto->listarCategorias();
            }

            if (!empty($dados_prod) && !empty($dados_cat)) {
                $_REQUEST['produtos'] = $dados_prod;
                $_REQUEST['categorias'] = $dados_cat;
            } else {
                $_REQUEST['produtos'] = array();
                $_REQUEST['categorias'] = array();
                $_REQUEST['mensagem'] = '';
            }

            require_once 'view/produtoView.php';
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar pesquisar o produto";
            $this->exibirProdutos();
        }
    }
}
