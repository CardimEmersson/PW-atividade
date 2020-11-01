<?php

require_once 'Usuario.php';

$usuario = new Usuario;

if(isset($_POST['email'])) {
	$email = addslashes($_POST['email']);
    $senha = md5(addslashes($_POST['senha']));
    

    if($usuario->logar($email, $senha)) {
        header("location: AreaPrivada.php");
    } else {
        $_REQUEST['mensagem'] = "Email e/ou senha estão incorretos!";
        require_once '../login.php';
    }
} else {
    $_REQUEST['mensagem'] = "Houve um erro ao tentar fazer login";
    require_once '../login.php';
}
