<?php
    $style ="style_login";
    $title = 'Login';

    session_start();

    require("./includes/components/head.php");
    require('./includes/components/connect.php');
    require('./includes/components/functions.php');


    $_SESSION["msg"] = "";
    

    if(!isset($_SESSION['msg_envia-email'])){
        $_SESSION["msg_envia-email"] = "";
    }
    
    if(!isset($_SESSION['msg_confirma'])){
        $_SESSION["msg_confirma"] = "";
    }
    
    if(!isset($_SESSION["senha_atualizada_msg"])){
        $_SESSION["senha_atualizada_msg"] = "";
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

                    $user_catsitter = searchUserCatSitter($user["cod_usuario"], $pdo);

                    if($user_catsitter){
                        $_SESSION["cod_usuario"]=$user_catsitter['cod_catsitter'];
                        sendLoginEmail($email);
                        header("Location:sitter_home_page.php");
                    }else{
                        sendLoginEmail($email);
                        header("Location:tutor_home_page.php");
                    }
                }else{
                    $_SESSION["msg"]="Confirme seu e-mail!";
                }
            }else{
                $_SESSION["msg"]="Usuário ou senha inválidos!";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <?php
        require("./includes/components/header_login.php");
    ?>

    <main>
        <section class="position-forms">
            <div class="content-box center">
                <form action="login.php" method="POST">
                    <h1>Bem-vindo(a)!</h1>
                    <div class='form-container gap-no-label'>
                        <div class="input-container" >
                            <input type="email" name="email" required placeholder="email@exemplo.com">
                        </div>
                        <div class="input-container">
                            <input type="password" name="password" required placeholder="********">
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        <img src="images/icons/arrowIcon.svg" alt="Ícone de uma seta para indicar o botão de avanço">
                    </button>
    
                </form>
    
                <div class="links-container">
                    <a href="create_account.php">Criar uma conta</a>
                    <a href="password_recovery_page.php">Esqueceu a senha?</a>
                </div>
            </div>
    
            <div>
                <span class="msg-error">
                    <?php
                        echo $_SESSION["msg"];
                    ?>
                </span>
                <span class="msg-error">
                    <?php
                        echo $_SESSION["msg_confirma"];
                    ?>
                </span>
                <span class="msg-sucess">
                    <?php
                        echo $_SESSION["senha_atualizada_msg"];
                    ?>
                </span>
                <span class="msg-sucess">
                    <?php
                        echo $_SESSION["msg_envia-email"];
                    ?>
                </span>
            </div>
        </section>
       
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>        
    
</body>
</html>