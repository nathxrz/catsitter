<?php 
  session_start();
  session_destroy();  
  unset($_SESSION["logged"]);
  unset($_SESSION["email"]);
  header("Location:login.php");   
?>