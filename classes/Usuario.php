<?php

require_once 'Conexao.php';

class Usuario
{

    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = Conexao::getConexao();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function cadastrar($nome, $sobrenome, $sexo, $nascimento, $email, $celular, $senha)
    {
        if ($this->verificarEmail($email)) {
            $query = "INSERT INTO usuario (nome, sobrenome, sexo, nascimento, email, celular, senha) VALUES
                    ('$nome', '$sobrenome', '$sexo', '$nascimento', '$email', '$celular', '$senha')";
            try {
                $sql = $this->pdo->prepare($query);
                $sql->execute();
                $_REQUEST['mensagem'] = "Cadastrado com sucesso!";
                require_once '../login.php';
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    private function verificarEmail($email) {
        //verificar se já existe e-mail cadastrado
        $query = "SELECT Id FROM usuario WHERE Email = '$email'";

        try {
            $sql = $this->pdo->prepare($query);
            $sql->execute();
            // $dados = $sql->fetch(PDO::FETCH_OBJ);
            // echo $dados;
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if($sql->rowCount() > 0) {
            $_REQUEST['mensagem'] = "Este email já está cadastrado";
            require_once '../cadastro.php';
            return false;
        } 

        return true;
    }

    public function logar($email, $senha) {
        
        $query = "SELECT Id FROM usuario WHERE Email = '$email' AND Senha = '$senha'";
        try {
            $sql = $this->pdo->prepare($query);
    	    $sql->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    
    	if($sql->rowCount() > 0){
    		$dado = $sql->fetch();
    		session_start();			//criação de sessão de login
    		$_SESSION['Id'] = $dado['Id'];
    		return true;

    	}else{
    		return false;
    	}
    }
}
