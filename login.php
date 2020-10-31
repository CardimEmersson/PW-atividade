<?php
include('conexao.php');

if (empty($_POST['usuario']) || (empty($_POST['senha'])) {
  header('Location: index.php');

  exit()
  // code...
}

$usuario = mysqli_real_escape_string($conexao, $_post['usuario']);
$senha = mysqli_real_escape_string($conexao, $_post['senha']);

$query = "select usuario from usuario where usuario = '$usuario' and senha = md5('$senha')";
$result = mysqli_query($conexao, $query);

$row = mysqli_num_rows($result);




 ?>
