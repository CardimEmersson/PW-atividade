<?php
    session_start();
    if(!isset($_SESSION['Id']) && !isset($_SESSION['Nome'])){
		header("location: http://localhost/pw-atividade/login.php");
		exit;
	}
?>
<!doctype html>
<html lang="pt-br">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>Sistema ADM</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <?php if (isset($_SESSION['Id']) && isset($_SESSION['Nome'])) {?>
                    <div class="col-12 text-right">
                        <h6 class="mt-2"><?php echo $_SESSION['Nome'] ?></h6>
                        <a href="src/sair.php" class="btn btn-lg btn-danger mb-2">Sair</a>
                    </div>
            <?php } ?>


            <?php if(isset($_GET['msg'])){ ?>
                <div class="col-12 text-center alert alert-info" role="alert">
                    <?php echo $_GET['msg']; ?>
                </div> 
            <?php } ?>

            <div class="col-md-12">
                <header class="text-center bg-dark pt-3 pb-3">
                    <h1 class="text-white">Sistema ADM</h1>
                </header>

                <main class="mt-5 p-5 d-flex justify-content-center">
                    <div class="w-50 d-flex flex-column justify-content-center">
                        <a href="" class="btn btn-primary btn-block p-3">
                            Produtos
                        </a>
                        <a href="" class="btn btn-primary btn-block p-3">Categorias</a>
                    </div>
                </main>

            </div>
        </div>

    </div>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <!-- Bootstrap.js -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>