<?php

    session_start();
    if(!isset($_SESSION['Id']) && !isset($_SESSION['Nome'])){
        header("location: http://localhost/pw-atividade/login.php");
        exit;
    }

    include_once 'controller/Controller.php';
    $controller = new Controller();
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
        <script src="https://kit.fontawesome.com/38428a9f9c.js" crossorigin="anonymous"></script>

    <title>SISTEMA-USUARIO</title>
  </head>
  <body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nome'])) {?>
      <div class="container">



      <a class="navbar-brand h1 mb-0" href="sistema.php">Sistema de Produtos</a>
      <button class="navbar-toggler" type="button" data-toggler="collapse" data-target="#navbar-Site">
        <span class="navbar-toggler-icon"></span>

      </button>

      <div class="collapse navbar-collapse justify-content-end container" id="navbarSite">

        <ul class="navbar-nav">

          <li class="nav-item">
          <a class="nav-link" href="?link=usuario&metodo=exibirPerfil"><i class="fas fa-user-circle"></i> <?php echo $_SESSION['Nome'] ?></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="src/sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </ul>


      </div>
</nav>
    <div class="container">
        <div class="row">
            <div class="col-md-12">


                <?php } ?>


                <?php if(isset($_GET['mensagem'])){ ?>
                    <div class="col-12 text-center alert alert-info" role="alert">
                        <?php echo $_GET['mensagem']; ?>
                    </div>
                <?php } ?>




                <?php
                    if (isset($_REQUEST["link"])){

                        $link = $_REQUEST["link"];
                        switch ($link) {
                            case 'produtos':
                                $controller->produtos();
                                break;
                            case 'categorias':
                                $controller->categorias();
                                break;
                            case 'usuario':
                                $controller->usuario();
                                break;
                            default:
                                $controller->home();
                                break;
                        }
                    } else {
                        $controller->home();
                    }
                ?>

            </div>
        </div>

    </div>
    <!-- Plugin para fazer máscaras em campos de formulário -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" type="text/javascript"></script>
    <!-- Mascara de input -->
    <script src="public/js/maskmoney.js" type="text/javascript"></script>
    <!-- Select2 -->
    <script src="public/js/multiselect.js" type="text/javascript"></script>
    <!-- Verificar senha -->
    <script src="public/js/validacao.js"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!-- Bootstrap.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  </body>
</html>
