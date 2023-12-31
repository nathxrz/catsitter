<?php
    session_start();
    $style ="style_login";
    $title = 'Alteração de senha';
    $showArrow = true;

    require("./includes/components/functions.php");

    $_SESSION["senha_atualizada"] = "";

    $_SESSION["senha_atualizada_error"] = "";

    $email= $_GET['email'];
    $key = $_GET['confirmation'];

    $_SESSION["msg_error"] = "";

    $check_key = checkKey($email, $key, $pdo);

    if(!$check_key){
        echo('Não é possível atualizar a senha!');
        exit;
    }

    if(isset($_POST['email'])){
        if($check_key){
            if($_POST['newPassword'] == $_POST['newPasswordConfirmation']){
                $password=password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
                $array = [$password, $email];
                $update_password = updatePassword($array, $pdo);
        
                if($update_password){
                    deleteRequest($email, $key, $pdo);
    
                    $_SESSION["senha_atualizada"] = "Senha atualizada com sucesso!";
    
                    header("Location:login.php");
                    exit;
                }else{
                    $_SESSION["senha_atualizada_error"] = "Erro ao atualizar a senha.";
    
                    header("Location:login.php");
                    exit;
                }
            }else{
                $_SESSION["msg_error"] = "Senhas não conferem.";
            }
            
        }

    }
    require("./includes/components/head.php"); 
?>

<body>
    <?php
            require("./includes/components/header_login.php");
    ?>

    <main>
        <section class="position-forms">
            <div class="content-box" >
                <form action="set_new_password_page.php?email=<?php echo($email) ?>&confirmation=<?php echo($key) ?> " onsubmit="return validaCreateAccount()" method="POST">
                    <h2>Nova senha:</h2>
                    <div class="form-container">
                        <div class="input-container">
                            <label for="newPassword">Nova senha:</label>
                            <input type="password" id="password" name="newPassword" placeholder="********" autocomplete="off">
                            <input type="hidden" id="email" name="email" value='<?php echo $email ?>'>
                            <input type="hidden" id="confirmation" name="confirmation" value='<?php echo $key ?>'>
                        </div>
                        <div class="input-container">
                            <label for="PasswordConfirmation">Confirme sua senha</label>
                            <input type="password" id="PasswordConfirmation" name="newPasswordConfirmation" placeholder="********" autocomplete="off" required>
                        </div>
                    </div>
                    
                    <button type="submit" class='btn-submit'>
                        Criar conta!
                    </button>
                    <div class='msg'>
                        <span class="msg-error">
                            <?php echo ($_SESSION["msg_error"]); ?>
                        </span>
                    </div>
                    
                </form>

            </div>
        </section>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>  

</body>
</html>