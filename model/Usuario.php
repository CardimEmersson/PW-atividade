<?php
    /**
	 * <b>Usuario:</b>
	 * Essa é uma classe que tem como objetivo realizar a manipulação dos dados 
     * da tabela usuario do banco de dados, ela herda funções da classe pai chamada Model.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
    require_once 'Model.php';
    
    class Usuario extends Model
    {
        /**@var int Id do usuario */
        private $id;
        /**@var string Nome da categoria */
        private $nome;
        /**@var string Nome da categoria */
        private $sobrenome;
        /**@var string Nome da categoria */
        private $sexo;
        /**@var string Nome da categoria */
        private $nascimento;
        /**@var string Nome da categoria */
        private $email;
        /**@var string Nome da categoria */
        private $celular;
        /**@var string Nome da categoria */
        private $senha;

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
        public function getId()
        {
            return $this->id;
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
        /**@return string Nome da categoria*/
        public function getSobrenome()
        {
            return $this->sobrenome;
        }
        /**@param string atribuir a variável nome*/
        public function setSobrenome($sobrenome)
        {
            $this->sobrenome = $sobrenome;
        }
        /**@return string Nome da categoria*/
        public function getSexo()
        {
            return $this->sexo;
        }
        /**@param string atribuir a variável nome*/
        public function setSexo($sexo)
        {
            $this->sexo = $sexo;
        }
        /**@return string Nome da categoria*/
        public function getNascimento()
        {
            return $this->nascimento;
        }
        /**@param string atribuir a variável nome*/
        public function setNascimento($nascimento)
        {
            $this->nascimento = $nascimento;
        }
        /**@return string Nome da categoria*/
        public function getEmail()
        {
            return $this->email;
        }
        /**@param string atribuir a variável nome*/
        public function setEmail($email)
        {
            $this->email = $email;
        }
        /**@return string Nome da categoria*/
        public function getCelular()
        {
            return $this->celular;
        }
        /**@param string atribuir a variável nome*/
        public function setCelular($celular)
        {
            $this->celular = $celular;
        }
        /**@return string Nome da categoria*/
        public function getSenha()
        {
            return $this->senha;
        }
        /**@param string atribuir a variável nome*/
        public function setSenha($senha)
        {
            $this->senha = $senha;
        }

        /**
         * <b>Listar as categorias:</b>
         * Realizará uma busca das categorias do produto já cadastradas
         * @return object Categorias do produto
         * @return null
         */
        public function validarLogin($email, $senha){
            try {
                $sql = "SELECT Id_usuario, Nome_usuario FROM usuario WHERE Email_usuario = '$email' AND Senha_usuario = '$senha'";

                $stmt = $this->pdo->prepare($sql);
                $stmt->execute();

                if ($stmt->rowCount() > 0) {
                    $dados_recebidos = $stmt->fetch(PDO::FETCH_OBJ);

                    //session_start();            //criação de sessão de login

                    if (isset($_SESSION['Id']) && isset($_SESSION['Nome'])) {
                        unset($_SESSION['Id']);
                        unset($_SESSION['Nome']);
                    }

                    $_SESSION['Id'] = $dados_recebidos->Id_usuario;
                    $_SESSION['Nome'] = $dados_recebidos->Nome_usuario;
                    return true;
                }
                return false;
            } catch (Exception $e) {
                $this->mensagem = $e->getMessage();
                return null;
            }
        }

    }
