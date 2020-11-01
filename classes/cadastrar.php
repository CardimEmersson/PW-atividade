<?php

require_once 'Usuario.php';

$usuario = new Usuario;

if(isset($_POST['nome'])){
	$nome = addslashes($_POST['nome']);
	$sobrenome = addslashes($_POST['sobrenome']);
	$sexo = addslashes($_POST['sexo']);
	$nascimento = addslashes($_POST['nascimento']);
	$email = addslashes($_POST['email']);
	$celular = addslashes($_POST['celular']);
	$senha = md5(addslashes($_POST['senha']));
	$confirmarSenha = addslashes($_POST['confsenha']);
	
    $usuario->cadastrar($nome, $sobrenome, $sexo, $nascimento, $email, $celular, $senha);
    
} else {
	$_REQUEST['mensagem'] = "Houve um problema ao enviar o formulario";
	require_once '../cadastro.php';
}

