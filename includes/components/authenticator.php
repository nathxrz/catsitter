<?php 
    if((!isset($_SESSION['email'])) && (!isset($_SESSION['logged']))){
        header("Location:login.php");
        exit;
    }
?>