<?php
    /**
	 * <b>Categoria Controller:</b>
	 * Essa é uma classe que tem como objetivo realizar controle da categoria na aplicação.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    include_once 'model/Categoria.php';
    
    class CategoriaController
    {
        /**@var object Instância da classe categoria */
        public $categoria;
        
        public function __construct()
        {
            $this->categoria = new Categoria();
            $_REQUEST['mensagem'] = $this->categoria->getMensagem();
        }

        /**
        * <b>Exibir categorias:</b>
        * Realizará a chamada para página de exibição das categorias
        */
        public function exibirCategorias()
        {
            $categorias = $this->categoria->listarTudo('categoria');

            if(!empty($categorias)) {
                $_REQUEST['categorias'] = $categorias;
            } else {
                $_REQUEST['categorias'] = array();
                $_REQUEST['mensagem'] = '';
            }

            require_once 'view/categoriaView.php';
        }
        
        /**
         * <b>Criar categoria:</b>
         * Realizará a chamada para página de cadastro das categorias
         */
        public function criarCategoria()
        {
            include_once 'View/cadastrarCategoria.php';
        }

        /**
         * <b>Alterar categoria:</b>
         * Realizará a chamada para a página de alteração de uma determinada categoria
         */
        public function alterarCategoria()
        {
            if (isset($_REQUEST['Id'])) {

                $cadCategoria = new Categoria();
                $cadCategoria = $this->categoria->listar('*', 'categoria', 'Id_categoria', $_REQUEST['Id']);
                $_REQUEST['alterarcategoria'] = $cadCategoria;
            }
            include_once 'View/alterarCategoria.php';
        }

        /**
         * <b>Cadastrar categoria:</b>
         * Realizará a chamada para cadastro dos dados da categoria enviada via formulario
         */
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

        /**
         * <b>Deletar categoria:</b>
         * Realizará a chamada para exclusão de um registro de categoria
         */
        public function deletarCategoria()
        {
            if (isset($_REQUEST['Id'])) {
                $chave = $_REQUEST['Id'];

                $dados = $this->categoria->listar('*', 'produto_categoria', 'Fk_categoria', $chave);

                if (!empty($dados)) {

                    $_REQUEST['mensagem'] = "Não foi possivél excluir, pois existe produto(s) com essa categoria";

                    $this->exibirCategorias();
                } else {

                    $this->categoria->excluir('categoria','Id_categoria', $chave);
    
                    $_REQUEST['mensagem'] = $this->categoria->getMensagem();
                }


                // $this->categoria->excluir('produto_categoria', 'Fk_categoria', $chave);
                                
                $this->exibirCategorias();

            } else {
                $_REQUEST['mensagem'] = "Houve um problema ao tentar excluir a categoria";
                $this->exibirCategorias();
            }
        }

        /**
         * <b>Atualizar categoria:</b>
         * Realizará a chamada para alteração de um registro de categoria
         */
        public function atualizarCategoria()
        {
            if (isset($_POST['Id'])) {
                $chave = $_POST['Id'];
                $novaCategoria = $this->verificarCampos();
                if(!empty($novaCategoria)) {
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

        /**
         * <b>Verificar campos:</b>
         * Realizará a validação das informações enviadas via formulario
         * @return Categoria $novaCategoria = objeto com os dados validados
         * @return null 
         */
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
