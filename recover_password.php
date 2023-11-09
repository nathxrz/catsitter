<?php
    $style ="style";
    $title = 'Esqueceu a senha?';

session_start();

$_SESSION["msg_envia-email"] = "";

    require("./includes/components/functions.php");
    require("./includes/components/head.php");
    
    if(isset($_POST['email'])){
        $email=$_POST["email"];

        $check_email = searchUser($email, $pdo);

        if($check_email){
            $key = sha1(uniqid( mt_rand(), true));
            createRequestToChangePassword($email, $key, $pdo);
            sendEmailToChangePassword($email, $key, $pdo);

            $_SESSION["msg_envia-email"] = "E-mail enviado!";

            header("Location:login.php");
        }else{
          $_SESSION["msg"] = "E-mail inválido";
        }
    }

    
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <?php
        require("./includes/components/header.php");
    ?>  

    <main>
        <section>
            <form action="recover_password.php" method="POST">
                <h2>Esqueceu a senha?</h2>
                <div>
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" placeholder="nome@exemplo.com" autocomplete="off" required>
                </div>

                <button type="submit" id="recoverPasswordButton" name="recoverPasswordButton" value="recoverPasswordButton">Enviar</button>
            </form>
        </section>
       
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>        
    
</body>
</html>