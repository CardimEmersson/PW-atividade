<?php

require_once 'Usuario.php';

$usuario = new Usuario;

if (isset($_POST['email'])) {
	$email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));

    if ($usuario->logar($email, $senha)) {

        header("location: http://localhost/pw-atividade/sistema.php");
    } else {
        $mensagem = "Email e/ou senha estão incorretos!";
        header("location: http://localhost/pw-atividade/login.php?msg=$mensagem");
    }
} else {
    $mensagem = "Houve um erro ao tentar fazer login";
    header("location: http://localhost/pw-atividade/login.php?msg=$mensagem");
}
