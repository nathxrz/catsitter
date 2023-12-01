<?php
session_start();

require('./includes/components/connect.php');
require('./includes/components/functions.php');
require('./includes/components/authenticator.php');

if(isset($_GET['filter']) and $_GET['filter'] != ''){
    $array = [$_GET['filter'], $_GET['date'], $_GET['time']];
    $sittersAvailable = searchCatSittersFilter($array, $pdo);
}else{
    $array = [$_GET['date'], $_GET['time']];
    $sittersAvailable = searchCatSitters($array, $pdo);
}
    $sittersInfo = searchUserCatSitter($_SESSION["cod_usuario"], $pdo);


header("Content-Type: application/json");
echo json_encode($sittersAvailable);

?>

