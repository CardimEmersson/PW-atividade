<?php


class Conexao
{
	public static $pdo;

	private function __construct()
	{
	}
	
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
