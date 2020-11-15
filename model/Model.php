<?php
	/**
	 * <b>Model:</b>
	 * Essa é uma classe genérica que tem como objetivo realizar a manipulação dos dados 
     * 
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
	require_once 'Conexao.php';
    class Model
    {
		/**@var string Mensagem para notificação de erros ou acertos */
		protected $mensagem = '';

		/**@return string Mensagem*/
		public function getMensagem()
		{
			return $this->mensagem;
		}

		/**
         * <b>Listar:</b>
         * Realizará uma busca nos registros de uma determinada tabela
		 * @param string $colunas = Nome das colunas da tabela 
		 * @param string $tabela = Nome da tabela 
		 * @param string $coluna = Nome da coluna da tabela
		 * @param string $dado = Nome do dado da coluna
         * @return object Registros vindos do banco de dados
         * @return null
         */
        public function listar($colunas, $tabela, $coluna, $dado)
        {		
            $sql = "SELECT $colunas FROM $tabela WHERE $coluna = $dado";
            try {
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute();
				$dados_recebidos = $stmt->fetch(PDO::FETCH_OBJ);
				return $dados_recebidos;
			} catch(PDOException $e) {
				$this->mensagem = $e->getMessage();
				return null;
			}
		}
		
		/**
         * <b>Listar tudo:</b>
         * Realizará uma busca de todos os registros de uma determinada tabela
		 * @param string $tabela = Nome da tabela 
         * @return object Registros vindos do banco de dados
         * @return null
         */
        public function listarTudo($tabela)
		{
            try {
				$stmt = $this->pdo->prepare("SELECT * FROM $tabela");
				$stmt->execute();
				$dados_recebidos = $stmt->fetchAll(PDO::FETCH_OBJ);
				return $dados_recebidos;
			} catch(PDOException $e) {
				$this->mensagem = $e->getMessage();
				return null;
			}
        }

		/**
         * <b>Inserir:</b>
         * Realizará a inserção de dados em uma determinada tabela
		 * @param string $tabela = Nome da tabela 
		 * @param string $colunas = Nome das colunas da tabela
		 * @param string $dados = Dados que serão inseridos
         */
        public function inserir($tabela,$colunas,$dados)
		{
			
			$sql = "INSERT INTO $tabela ($colunas) VALUES ($dados)";
			try {
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute();
				$this->mensagem = 'Registro cadastrado com sucesso';
			} catch(PDOException $e){
				$this->mensagem = $e->getMessage();
				die($this->mensagem);
			}
		}

		/**
         * <b>Excluir:</b>
         * Realizará a exclusão de registros em uma determinada tabela
		 * @param string $tabela = Nome da tabela 
		 * @param string $coluna = Nome da coluna da tabela
		 * @param string $dado = $dado = Nome do dado da coluna
         */
		public function excluir($tabela,$coluna,$dado)
		{
			$sql = "DELETE FROM $tabela WHERE $coluna = $dado";
			try{
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute();
				$this->mensagem = 'Registro excluido com sucesso';
			} catch (PDOException $e){
				$this->mensagem = $e->getMessage();
				die($this->mensagem);
			}
			
		}

		/**
         * <b>Alterar:</b>
         * Realizará a alteração de registros em uma determinada tabela
		 * @param string $tabela = Nome da tabela 
		 * @param string $campos = Nome das coluna e dos dados que serão alterados
		 * @param string $coluna = Nome da coluna da tabela
		 * @param string $dado = $dado = Nome do dado da coluna
         */
		public function alterar($tabela, $campos, $coluna, $dado)
		{
			$sql = "UPDATE $tabela SET $campos WHERE $coluna = $dado";
			try{
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute();
				$this->mensagem = 'Registro alterado com sucesso';
			} catch (PDOException $e){
				$this->mensagem = $e->getMessage();
				die($this->mensagem);
			}
			
		}
		
		/**
         * <b>Ultimo registro:</b>
         * Realizará a busca do ultimo registro inserido em uma determinada tabela
		 * @param string $coluna = Nome das coluna da tabela
		 * @param string $tabela = Nome da tabela
		 * @return object Registro vindo do banco de dados
         */
		public function ultimoRegistro($coluna, $tabela)
		{
			$sql = "SELECT $coluna FROM $tabela ORDER BY $coluna DESC LIMIT 1";
			try {
				$stmt = $this->pdo->prepare($sql);
				$stmt->execute();
				$dados_recebidos = $stmt->fetch(PDO::FETCH_OBJ);
				return $dados_recebidos;
			} catch(PDOException $e) {
				$this->mensagem = $e->getMessage();
				return null;
			}
		}

    }