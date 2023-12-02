<?php
    session_start();
    $style ="style_login";
    $title = 'Login';
    $showArrow = false;

    require('./includes/components/connect.php');
    require('./includes/components/functions.php');

    $_SESSION["msg_error"] = "";
    
    
    if(!isset($_SESSION['msg_confirma_email'])){
        $_SESSION["msg_confirma_email"] = "";
    }

    if(!isset($_SESSION['msg_confirma'])){
        $_SESSION["msg_confirma"] = "";
    }
    
    if(!isset($_SESSION["senha_atualizada"])){
        $_SESSION["senha_atualizada"] = "";
    }

    if(!isset($_SESSION["email_enviado"])){
        $_SESSION["email_enviado"] = "";
    }

    if(!isset($_SESSION["senha_atualizada_error"])){
        $_SESSION["senha_atualizada_error"] = "";
    }

    if(isset($_POST['email']) and isset($_POST['password'])){
        $email=$_POST["email"];
        $password=$_POST["password"];

        if(!(empty($email) or empty($password))){

            $login = validateLogin($email, $password, $pdo);
            $user = searchUser($email, $pdo);

            if($login){

                if($user['confirma_email'] == 1){
                    
                    $_SESSION["logged"]=true;
                    $_SESSION["email"]=$email;
                    $_SESSION["cod_usuario"]=$user['cod_usuario'];


                    if($user['adm'] == 1){
                        $_SESSION["adm"]=true;
                        header("Location:adm_home_page.php");
                        exit;
                    }

                    $user_catsitter = searchUserCatSitter($user["cod_usuario"], $pdo);

                    if($user_catsitter){
                        $_SESSION["cod_catsitter"]=$user_catsitter['cod_catsitter'];
                        sendLoginEmail($email);
                        header("Location:sitter_schedule_page.php");
                    }else{
                        sendLoginEmail($email);
                        header("Location:tutor_home_page.php");
                    }
                }else{
                    $_SESSION["msg_confirma_email"]="Confirme seu e-mail!";
                }
            }else{
                $_SESSION["msg_error"]="Usuário ou senha inválidos!";
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
            <div class="content-box center">
                <form action="login.php" onsubmit="return valida_form()" method="POST">
                    <h1>Bem-vindo(a)!</h1>
                    <div class='form-container gap-no-label'>
                        <div class="input-container" >
                            <input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']?>" placeholder="email@exemplo.com" autocomplete="off">
                        </div>
                        <div class="input-container">
                            <input type="password" name="password" id="password" value="<?php if(isset($_POST['password'])) echo $_POST['password']?>" required placeholder="********" autocomplete="off">
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" id="btn-forms" name="login" value="login">
                        <img src="images/icons/arrowIcon.svg" alt="Ícone de uma seta para indicar o botão de avanço">
                    </button>
    
                </form>
    
                <div class="links-container">
                    <a href="create_account.php">Criar uma conta</a>
                    <a href="password_recovery_page.php">Esqueceu a senha?</a>
                </div>

                <div class='msg'>
                    <span class="msg-error">
                        <?php
                            echo $_SESSION["msg_error"];
                        ?>
                    </span>
                    <span class="msg-error">
                        <?php
                            echo $_SESSION["msg_confirma_email"];
                        ?>
                    </span>
                    <span class="msg-error">
                        <?php
                            echo $_SESSION["senha_atualizada_error"];
                        ?>
                    </span>
                    <span class="msg-sucess">
                        <?php
                            echo $_SESSION["senha_atualizada"];
                        ?>
                    </span>
                    <span class="msg-sucess">
                        <?php
                            echo $_SESSION["email_enviado"];
                        ?>
                    </span>
                    <span class="msg-sucess">
                        <?php
                            echo $_SESSION['msg_confirma'];
                        ?>
                    </span>
                </div>

            </div>
        </section>
       
    </main>

    <?php
        require("./includes/components/footer.php");

        $_SESSION["senha_atualizada"] = "";

        $_SESSION["senha_atualizada_error"] = "";

        $_SESSION["email_enviado"] = "";

        $_SESSION['msg_confirma'] = "";

        $_SESSION["msg_confirma_email"] = "";
    ?>        
    
</body>
</html>