<?php
    session_start();

    $_SESSION['validUser'] = false;

    if(!$_SESSION['validUser'] == true){
        header('Location: ../html/login.php');
    }

    session_unset();
    session_destroy();

?>