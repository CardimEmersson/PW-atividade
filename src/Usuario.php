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
                $mensagem = "Cadastrado com sucesso!";
                header("Location: http://localhost/pw-atividade/login.php?msg=$mensagem");
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
    }

    private function verificarEmail($email) 
    {
        $query = "SELECT Id FROM usuario WHERE Email = '$email'";

        try {
            $sql = $this->pdo->prepare($query);
            $sql->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }

        if ($sql->rowCount() > 0) {
            $mensagem = "Este email já está cadastrado";
            header("Location: http://localhost/pw-atividade/cadastro.php?msg=$mensagem");
            return false;
        } 

        return true;
    }

    public function logar($email, $senha) 
    {
        
        $query = "SELECT Id, Nome FROM usuario WHERE Email = '$email' AND Senha = '$senha'";
        try {
            $sql = $this->pdo->prepare($query);
    	    $sql->execute();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    
    	if ($sql->rowCount() > 0) {
    		$dado = $sql->fetch();
            session_start();			//criação de sessão de login
            
            if (isset($_SESSION['Id']) && isset($_SESSION['Nome'])) {
                unset($_SESSION['Id']);
                unset($_SESSION['Nome']);
            }

            $_SESSION['Id'] = $dado['Id'];
            $_SESSION['Nome'] = $dado['Nome'];
    		return true;
        }
        return false;
    }
}
