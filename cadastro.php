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
    <title>CADASTRO-USUARIO</title>

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

        <div class="col-12 text-right">
            <a href="login.php" class="btn btn-lg btn-primary">Voltar</a>
        </div>

        <?php if (isset($_GET['mensagem'])) { ?>
            <div class="w-50 mx-auto text-center alert alert-info" role="alert">
                <?php echo $_GET['mensagem']; ?>
            </div>
        <?php } ?>

        <div class="card col-12 col-lg-6 mx-auto my-3">
            <div class="card-body">
                <h1 class="text-center">Cadastro</h1>
                <span>*campos obrigatórios</span>

                <form action="?link=usuario&metodo=cadastrarUsuario" method="POST" class="px-2 mx-auto my-4">
                    <div class="row">
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="nome">*Nome:</label>
                                <input class="form-control" type="text" name="nome" id="nome" placeholder="Digite seu nome" required>
                            </div>
                        </div>
                        <div class="col-12 col-lg-6">
                            <div class="form-group">
                                <label for="sobrenome">*Sobrenome:</label>
                                <input class="form-control" type="text" name="sobrenome" id="sobrenome" placeholder="Digite seu Sobrenome" required>

                            </div>
                        </div>

                        <div class="col-12 col-lg-5">
                            <div class="form-group">

                                <label for="sexo">*Sexo:</label>
                                <select name="sexo" class="form-control" id="sexo" required>
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Feminino</option>
                                    <option value="N">Não Declarado</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 col-lg-7">
                            <div class="form-group">
                                <label for="nascimento">*Data de nascimento</label>
                                <input class="form-control" type="date" name="nascimento" id="nascimento" value="" required maxlength="10" name="date" pattern="[0-9]{2}\/[0-9]{4}$" min="1920-01-01" max="2019-12-31">
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">*Email:</label>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Digite seu e-mail" required>
                    </div>

                    <div class="form-group">
                        <label for="celular">*Celular/Whatsapp</label>
                        <input class="form-control celular" type="tel" name="celular" id="celular" placeholder="Digite seu numero" required>
                    </div>

                    <div class="form-group">
                        <label for="senha">*Senha:</label>
                        <input class="form-control" type="password" name="senha" id="senha" placeholder="Digite uma senha" minlength="8" required>
                    </div>

                    <div class="form-group">
                        <label for="confsenha">*Confirmar senha:</label>
                        <input class="form-control" type="password" name="confsenha" id="confsenha" placeholder="Confirme sua senha" minlength="8" required>

                    </div>

                    <button type="submit" class="btn btn-block btn-primary" onclick="validarSenha()">Enviar Cadastro</button>

                </form>

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

    <script src="public/js/jquery.mask.min.js"></script>

    <script src="public/js/validacao.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>