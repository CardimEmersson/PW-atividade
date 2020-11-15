<?php

	/**
	 * <b>Conexao:</b>
	 * Essa é uma classe que tem como objetivo realizar a conexão com o banco de dados.
	 * @author Emersson cardim
	 * @copyright (c) 2020, Emersson C. Mota
	 * @access public
	 * 
	 */
	class Conexao
	{
		/**@var object Instância da classe PDO */
		public static $pdo;
		
		private function __construct()
		{

		}
		/**
		 * <b>Buscar conexão</b>
		 * irá tentar realizar a conexão com o banco de dados.
		 * @return object Instância da classe PDO
		 */
		
		public static function getConexao()
		{	
			if (!isset(self::$pdo)) {
				try {
					self::$pdo = new PDO('mysql:host=localhost; dbname=pw_atividade', 'root', ''); 
					self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					self::$pdo->exec('set names utf8');
					return self::$pdo;
				} catch (PDOException $e) {
					die($e->getMessage());
				}
			} else {
				return self::$pdo;
			}				    	
		}
	}
