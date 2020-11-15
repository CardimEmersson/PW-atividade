<?php

require_once 'Conexao.php';
class Model
{
	protected $mensagem = '';

	public function getMensagem()
	{
		return $this->mensagem;
	}

	public function listar($colunas, $tabela, $coluna, $dado)
	{
		$sql = "SELECT $colunas FROM $tabela WHERE $coluna = $dado";
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$dados_recebidos = $stmt->fetch(PDO::FETCH_OBJ);
			return $dados_recebidos;
		} catch (PDOException $e) {
			$this->mensagem = $e->getMessage();
			return null;
		}
	}

	public function listarTudo($tabela)
	{
		try {
			$stmt = $this->pdo->prepare("SELECT * FROM $tabela");
			$stmt->execute();
			$dados_recebidos = $stmt->fetchAll(PDO::FETCH_OBJ);
			return $dados_recebidos;
		} catch (PDOException $e) {
			$this->mensagem = $e->getMessage();
			return null;
		}
	}

	public function inserir($tabela, $colunas, $dados)
	{

		$sql = "INSERT INTO $tabela ($colunas) VALUES ($dados)";
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$this->mensagem = 'Registro cadastrado com sucesso';
		} catch (PDOException $e) {
			$this->mensagem = $e->getMessage();
			die($this->mensagem);
		}
	}

	public function excluir($tabela, $coluna, $dado)
	{
		$sql = "DELETE FROM $tabela WHERE $coluna = $dado";
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$this->mensagem = 'Registro excluido com sucesso';
		} catch (PDOException $e) {
			$this->mensagem = $e->getMessage();
			die($this->mensagem);
		}
	}

	public function alterar($tabela, $campos, $coluna, $dado)
	{
		$sql = "UPDATE $tabela SET $campos WHERE $coluna = $dado";
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$this->mensagem = 'Registro alterado com sucesso';
		} catch (PDOException $e) {
			$this->mensagem = $e->getMessage();
			die($this->mensagem);
		}
	}

	public function ultimoRegistro($coluna, $tabela)
	{
		$sql = "SELECT $coluna FROM $tabela ORDER BY $coluna DESC LIMIT 1";
		try {
			$stmt = $this->pdo->prepare($sql);
			$stmt->execute();
			$dados_recebidos = $stmt->fetch(PDO::FETCH_OBJ);
			return $dados_recebidos;
		} catch (PDOException $e) {
			$this->mensagem = $e->getMessage();
			return null;
		}
	}
}
