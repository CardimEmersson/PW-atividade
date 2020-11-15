<?php
session_start();

include_once 'controller/Controller.php';
$controller = new Controller();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN-USUARIO</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body style="background: #f5f5f5;">

    <div class="container mt-5 d-flex flex-column">
        <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nome'])) { ?>
            <div class="col-12 text-right">
                <h6><?php echo $_SESSION['Nome'] ?></h6>
                <a href="src/sair.php" class="btn btn-lg btn-danger mb-2">Sair</a>
            </div>
        <?php } ?>

        <?php if (isset($_GET['mensagem'])) { ?>
            <div class="w-50 mx-auto text-center alert alert-info" role="alert">
                <?php echo $_GET['mensagem']; ?>
            </div>
        <?php } ?>

        <div class="card w-50 mx-auto">
            <div class="card-body">
                <h1 class="text-center">Login</h1>

                <form action="?link=usuario&metodo=loginUsuario" method="POST" class=" px-5 mx-auto my-4">

                    <div class="form-group">
                        <label for="usuario">Email</label>
                        <input class="form-control" type="text" name="email" placeholder="Usuário" id="email" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input class="form-control" type="password" name="senha" placeholder="Senha" id="senha" required>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary">Logar</button>

                </form>

                <a href="?link=usuario&metodo=criarUsuario" class="d-block text-center mt-2">Ainda não possui cadastro? <strong>Cadastre-se!</strong></a>

            </div>
        </div>
    </div>

    <?php
    if (isset($_REQUEST["link"])) {

        $link = $_REQUEST["link"];
        switch ($link) {
            case 'usuario':
                $controller->usuario();
                break;
        }
    }
    ?>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>