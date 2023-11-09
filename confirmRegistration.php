<?php

session_start();

    require("./includes/components/functions.php");
    
    if(isset($_GET['email'])){

        confirmRegistration($_GET['email'], $pdo);
        $_SESSION['msg_confirma'] = 'E-mail confirmado! Faça o Login.';
        header("Location:login.php");
    }
?>