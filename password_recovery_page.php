<?php
    $style ="style_login";
    $title = 'Esqueceu a senha?';
    $showArrow = true;

    $_SESSION["email_enviado"] = "";

    $_SESSION["msg_error"] = "";

    require("./includes/components/functions.php");
    require("./includes/components/head.php");
    
    if(isset($_POST['email'])){
        $email=$_POST["email"];

        $check_email = searchUser($email, $pdo);

        if($check_email){
            $key = sha1(uniqid( mt_rand(), true));
            createRequestToChangePassword($email, $key, $pdo);
            sendEmailToChangePassword($email, $key, $pdo);

            $_SESSION["email_enviado"] = "E-mail enviado!";

            header("Location:login.php");
        }else{
          $_SESSION["msg_error"] = "E-mail inválido";
        }
    }
?>

<body>
    <?php
        require("./includes/components/header_login.php");
    ?>  
    <main>
        <section class="position-forms">
            <div class="content-box ">
                <form action="password_recovery_page.php" method="POST">
                    <div class="">
                        <h2>Esqueceu a senha?</h2>
                        <div class="form-container" >
                            <div class="input-container">
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" placeholder="nome@exemplo.com" autocomplete="off" required>
                            </div>
                        </div>

                        <button type="submit" class='btn-submit'>
                            Enviar
                        </button>
                    </div>
                </form>

                <div class="msg">
                    <span class="msg-error">
                        <?php echo ($_SESSION["msg_error"]); ?>
                    </span>
                </div>
            </div>

            <div class="content-box hidden">
                <h2>Verifique o seu e-mail!</h2>
            </div>

            <div>
                
            </div>
        </section>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>    
    
</body>
</html>