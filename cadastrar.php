<?php
   // arquivo de conexão com o banco de dados:
   include_once("conectar.php");

   // Recebendo os dados a inserir
   $novo_nome = $_POST['nome'];
   $novo_sobrenome = $_POST['sobrenome'];
   $novo_sexo = $_POST['sexo'];

?>

<html>
   <head>
      <link href="estilos.css" rel="stylesheet" type="text/css">
      <title>Inserção</title>
   </head>
   <body>

      <!-- Criando tabela e cabeçalho de dados: -->
      <?php
      	if ((empty($_POST['nome']) == false) and (empty($_POST['sobrenome']) == false) and (empty($_POST['sexo']) == false)) { //verifica se estão preenchidos
           $sql = "INSERT INTO cadastro (NomeCliente, SobrenomeCliente, Sexo) values ('$novo_nome', '$novo_sobrenome', '$novo_sexo')";
           echo "<br> vai executar o sql";
      	   $resultado = mysqli_query($strcon,$sql) or die("Erro ao tentar gravar as informações!");
           echo "$novo_nome cadastrado com sucesso";
        }
      ?>
   </body>
</html>
