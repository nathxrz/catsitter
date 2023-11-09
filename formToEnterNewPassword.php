<?php
    $style ="style";
    $title = 'Alteração de senha';

    session_start();

    require("./includes/components/functions.php");

    $email= $_GET['email'];
    $key = $_GET['confirmacao'];

    $_SESSION["msg"] = "";

    $check_key = checkKey($email, $key, $pdo);

    if(!$check_key){
        echo('Não é possível atualizar a senha!');
        exit;
    }

    if(isset($_POST['email'])){
        if($check_key){   
            $password=password_hash($_POST['newPassword'], PASSWORD_DEFAULT);
            $array = [$password, $email];
            $update_password = updatePassword($array, $pdo);
    
            if($update_password){
                deleteRequest($email, $key, $pdo);

                $_SESSION["senha_atualizada_msg"] = "Senha atualizada com sucesso!";

                header("Location:login.php");
            }else{
                $_SESSION["senha_atualizada_msg"] = "Erro ao atualizar a senha";

                header("Location:login.php");
            }
            
        }

    }
    require("./includes/components/header.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <?php
        require("./includes/components/header.php");
    ?>  
    <main>
        <section>
            <h2>Inserir nova senha</h2>
                <form action="formToEnterNewPassword.php?email=<?php echo($email) ?>&confirmacao=<?php echo($key) ?> " method="POST">
                    <div>
                        <label for="newPassword">Nova senha:</label>
                        <input type="password" id="newPassword" name="newPassword" placeholder="********" autocomplete="off">
                        <input type="hidden" id="email" name="email" value='<?php echo $email ?>'>
                        <input type="hidden" id="confirmacao" name="confirmacao" value='<?php echo $key ?>'>
                        
                        <button>Salvar!</button>
                      </div>
                </form>
        </section>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>  
</body>
</html>