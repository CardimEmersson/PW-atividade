<?php

include_once 'model/Usuario.php';

class UsuarioController
{
    public $usuario;

    public function __construct()
    {
        $this->usuario = new Usuario();
        $_REQUEST['mensagem'] = $this->usuario->getMensagem();
    }

    public function exibirPerfil()
    {
        $id = $_SESSION['Id'];

        $perfil = $this->usuario->listar('*', 'usuario', 'Id_usuario', "'$id'");

        if (!empty($perfil)) {
            $_REQUEST['perfil'] = $perfil;
        } else {
            $_REQUEST['perfil'] = array();
            $_REQUEST['mensagem'] = '';
        }

        require_once 'view/usuarioView.php';
    }

    public function criarUsuario()
    {
        header("location: http://localhost/pw-atividade/cadastro.php");
        exit;
    }

    public function alterarUsuario()
    {

        if (isset($_REQUEST['Id'])) {

            $cadUsuario = new Usuario();

            $cadUsuario = $this->usuario->listar('*', 'usuario', 'Id_usuario', $_REQUEST['Id']);

            $_REQUEST['alterarusuario'] = $cadUsuario;
        }
        include_once 'View/alterarUsuario.php';
    }

    public function cadastrarUsuario()
    {
        $novoUsuario = $this->verificarCampos();

        if ($novoUsuario != null) {
            $nome = $novoUsuario->getNome();
            $sobrenome = $novoUsuario->getSobrenome();
            $sexo = $novoUsuario->getSexo();
            $nascimento = $novoUsuario->getNascimento();
            $email = $novoUsuario->getEmail();
            $celular = $novoUsuario->getCelular();
            $senha = $novoUsuario->getSenha();

            $this->usuario->inserir(
                'usuario',
                'Nome_usuario, Sobrenome_usuario, Sexo_usuario, Nascimento_usuario, Email_usuario, Celular_usuario, Senha_usuario',
                "'$nome', '$sobrenome', '$sexo', '$nascimento', '$email', '$celular', '$senha'"
            );

            $mensagem = $this->usuario->getMensagem();

            echo "<script type='text/javascript'> window.location='http://localhost/pw-atividade/login.php?mensagem=$mensagem';</script>";
        } else {
            $mensagem = $_REQUEST['mensagem'];

            echo "<script type='text/javascript'> window.location='http://localhost/pw-atividade/cadastro.php?mensagem=$mensagem';</script>";
        }
    }

    public function deletarUsuario()
    {
        if (isset($_REQUEST['Id'])) {
            $chave = $_REQUEST['Id'];

            $this->usuario->excluir('usuario', 'Id_usuario', $chave);

            $_REQUEST['mensagem'] = $this->usuario->getMensagem();

            //encerrar sessão
            include_once 'src/sair.php';
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar excluir conta";
        }
    }

    public function atualizarUsuario()
    {
        if (isset($_POST['Id'])) {

            $chave = $_POST['Id'];
            $novoUsuario = $this->verificarCampos();

            if ($novoUsuario != null) {
                $nome = $novoUsuario->getNome();
                $sobrenome = $novoUsuario->getSobrenome();
                $sexo = $novoUsuario->getSexo();
                $nascimento = $novoUsuario->getNascimento();
                $email = $novoUsuario->getEmail();
                $celular = $novoUsuario->getCelular();
                $senha = $novoUsuario->getSenha();

                $this->usuario->alterar(
                    'usuario',
                    "Nome_usuario = '$nome', Sobrenome_usuario = '$sobrenome', Sexo_usuario = '$sexo', Nascimento_usuario = '$nascimento', Email_usuario = '$email', Celular_usuario = '$celular', Senha_usuario = '$senha'",
                    'Id_usuario',
                    "'$chave'"
                );

                $_REQUEST['mensagem'] = $this->usuario->getMensagem();

                include_once 'src/sair.php';
            } else {
                $this->alterarUsuario();
            }
        } else {
            $_REQUEST['mensagem'] = "Houve um problema ao tentar atualizar o usuario";
        }
    }

    private function verificarEmail($email)
    {
        $dado = $this->usuario->listar('Id_usuario', 'usuario', 'Email_usuario', "'$email'");

        if (!empty($dado)) {
            return true;
        }

        return false;
    }

    public function loginUsuario()
    {
        if (isset($_POST['email'])) {

            $email = addslashes($_POST['email']);
            $senha = md5(addslashes($_POST['senha']));

            if ($this->usuario->validarLogin($email, $senha)) {

                echo "<script type='text/javascript'> window.location='http://localhost/pw-atividade/sistema.php';</script>";
            } else {

                $mensagem = "Email e/ou senha estão incorretos!";

                echo "<script type='text/javascript'> window.location='http://localhost/pw-atividade/login.php?mensagem=$mensagem';</script>";
            }
        } else {
            $mensagem = "Houve um erro ao tentar fazer login";
            echo "<script type='text/javascript'> window.location='http://localhost/pw-atividade/login.php?mensagem=$mensagem';</script>";
        }
    }

    private function verificarCampos()
    {
        if (isset($_POST['nome'])) {

            $novoUsuario = new Usuario();

            $novoUsuario->setNome(addslashes($_POST['nome']));
            $novoUsuario->setSobrenome(addslashes($_POST['sobrenome']));
            $novoUsuario->setSexo(addslashes($_POST['sexo']));
            $novoUsuario->setNascimento(addslashes($_POST['nascimento']));
            $novoUsuario->setEmail(addslashes($_POST['email']));
            $novoUsuario->setCelular(addslashes($_POST['celular']));
            $novoUsuario->setSenha(md5(addslashes($_POST['senha'])));

            if ($this->verificarEmail($novoUsuario->getEmail())) {
                $_REQUEST['mensagem'] = "Este email já está cadastrado";
                return null;
            }

            return $novoUsuario;
        } else {
            $_REQUEST['mensagem'] = "Houve um problema";
            return null;
        }
    }
}
