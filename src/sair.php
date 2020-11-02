<?php

session_start();
unset($_SESSION['Id']);
unset($_SESSION['Nome']);
header("location: http://localhost/pw-atividade/login.php");
