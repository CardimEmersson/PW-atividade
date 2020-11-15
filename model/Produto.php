<?php
    /**
	 * <b>Produto:</b>
	 * Essa é uma classe que tem como objetivo realizar a manipulação dos dados 
     * da tabela produto do banco de dados, elas herda funções da classe pai chamada Model.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    require_once 'Model.php';
   
    class Produto extends Model
    {
        /**@var int Código do produto */
        private $codigo;
        /**@var string Nome do produto */
        private $nome;
        /**@var string Nome da imagem do produto */
        private $url_imagem;
        /**@var float Preço do produto */
        private $preco;
        /**@var string Descrição do produto */
        private $descricao;
        /**@var int Quantidade de produtos */
        private $quantidade;
        /**@var object Códigos das categorias do produto*/
        private $categoria;

        /**@var object Instância da conexão */
        public $pdo;

        public function __construct()
        {
            try{
                $this->pdo = Conexao::getConexao();
            } catch (PDOException $e){
                $this->mensagem = $e->getMessage();
            }
        }
        /**@return int Código do produto*/
        public function getCodigo()
        {
            return $this->codigo;
        }
        /**@param int atribuir a variável codigo*/
        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }
        /**@return string Nome do produto*/
        public function getNome()
        {
            return $this->nome;
        }
        /**@param string atribuir a variável nome*/
        public function setNome($nome)
        {
            $this->nome = $nome;
        }
        /**@return int Nome da imagem do produto*/
        public function getImagem()
        {
            return $this->url_imagem;
        }
        /**@param string atribuir a variável url_imagem*/
        public function setImagem($imagem)
        {
            $this->url_imagem = $imagem;
        }
        /**@return float Preço do produto*/
        public function getPreco()
        {
            return $this->preco;
        }
        /**@param float atribuir a variável preco*/
        public function setPreco($preco)
        {
            $this->preco = $preco;
        }
        /**@return int Descrição do produto*/
        public function getDescricao()
        {
            return $this->descricao;
        }
        /**@param string atribuir a variável descricao*/
        public function setDescricao($descricao)
        {
            $this->descricao = $descricao;
        }
        /**@return int Quantidade de produtos*/
        public function getQuantidade()
        {
            return $this->quantidade;
        }
        /**@param int atribuir a variável quantidade*/
        public function setQuantidade($quantidade)
        {
            $this->quantidade = $quantidade;
        }
        /**@return object Código da categoria do produto*/
        public function getCategoria()
        {
            return $this->categoria;
        }
        /**@param object atribuir a variável categoria*/
        public function setCategoria($categoria)
        {
            $this->categoria = $categoria;
        }
        //

        /**
         * <b>Listar as categorias:</b>
         * Realizará uma busca das categorias do produto já cadastradas
         * @return object Categorias do produto
         * @return null
         */
        public function listarCategorias(){
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

        /**
         * <b>Buscar categorias:</b>
         * Realizará uma busca das categorias de um produto específico
         * @param int Código do produto
         * @return object Categorias do produto
         * @return null
         */        
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
			} catch(PDOException $e) {
				$this->mensagem = $e->getMessage();
				return null;
			}
        }
    }
?>