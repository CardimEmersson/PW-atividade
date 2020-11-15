<?php

require_once 'Model.php';

class Usuario extends Model
{
    private $id;
    private $nome;
    private $sobrenome;
    private $sexo;
    private $nascimento;
    private $email;
    private $celular;
    private $senha;

    public $pdo;

    public function __construct()
    {
        try {
            $this->pdo = Conexao::getConexao();
        } catch (PDOException $e) {
            $this->mensagem = $e->getMessage();
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getSobrenome()
    {
        return $this->sobrenome;
    }

    public function setSobrenome($sobrenome)
    {
        $this->sobrenome = $sobrenome;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function setNascimento($nascimento)
    {
        $this->nascimento = $nascimento;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function validarLogin($email, $senha)
    {
        try {
            $sql = "SELECT Id_usuario, Nome_usuario FROM usuario WHERE Email_usuario = '$email' AND Senha_usuario = '$senha'";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $dados_recebidos = $stmt->fetch(PDO::FETCH_OBJ);

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
