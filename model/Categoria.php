<?php
    /**
	 * <b>Categoria:</b>
	 * Essa é uma classe que tem como objetivo realizar a manipulação dos dados 
     * da tabela categoria do banco de dados, ela herda funções da classe pai chamada Model.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    require_once 'Model.php';
    class Categoria extends Model
    {
        /**@var int Código da categoria */
        private $codigo;
        /**@var string Nome da categoria */
        private $nome;

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

        /**@return int Código da categoria*/
        public function getCodigo()
        {
            return $this->codigo;
        }
        /**@param int atribuir a variável codigo*/
        public function setCodigo($codigo)
        {
            $this->codigo = $codigo;
        }
        /**@return string Nome da categoria*/
        public function getNome()
        {
            return $this->nome;
        }
        /**@param string atribuir a variável nome*/
        public function setNome($nome)
        {
            $this->nome = $nome;
        }

    }
