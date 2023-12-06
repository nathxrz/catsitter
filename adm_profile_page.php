<?php
    session_start();
    $style ="style";
    $title = 'Perfil';

    require('./includes/components/authenticator.php');
    require('./includes/components/connect.php');
    require('./includes/components/functions.php');

    adminFirewall();

    if(isset($_SESSION["cod_usuario"])){
        $profile = searchUser($_SESSION["email"], $pdo);
        $foneUser = getFoneById($_SESSION["cod_usuario"], $pdo);
    }

    if(isset($_GET['newPassword'])){
        if(isset($_POST['password']) and isset($_POST['new_password'])){
            if(password_verify($_POST['password'], $profile['senha'])){
                $password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
                $array = [$password, md5($_SESSION['email'])];
                updatePassword($array, $pdo);

                $link = "adm_profile_page.php";
                redirect($link);
            }else{
                $_SESSION['msg_error'] = 'Senha atual incorreta.';
            }
        }else{
            $_SESSION['msg_error'] = 'Preencha todos os campos obrigatórios. *';
        }   
    }
    require("./includes/components/head.php");
?>

<body>
    <?php
        require("./includes/components/header.php");
    ?>
    <main> 
        <section class='profile position-content'>
            <a class="close logout" href="logout.php">
                <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 12.5C0 12.8315 0.131696 13.1495 0.366117 13.3839C0.600537 13.6183 0.918479 13.75 1.25 13.75H10.7375L7.8625 16.6125C7.74534 16.7287 7.65235 16.867 7.58889 17.0193C7.52542 17.1716 7.49275 17.335 7.49275 17.5C7.49275 17.665 7.52542 17.8284 7.58889 17.9807C7.65235 18.133 7.74534 18.2713 7.8625 18.3875C7.9787 18.5047 8.11695 18.5977 8.26928 18.6611C8.4216 18.7246 8.58498 18.7572 8.75 18.7572C8.91502 18.7572 9.0784 18.7246 9.23072 18.6611C9.38305 18.5977 9.5213 18.5047 9.6375 18.3875L14.6375 13.3875C14.7513 13.2686 14.8405 13.1284 14.9 12.975C15.025 12.6707 15.025 12.3293 14.9 12.025C14.8405 11.8716 14.7513 11.7314 14.6375 11.6125L9.6375 6.6125C9.52095 6.49595 9.38259 6.4035 9.23031 6.34043C9.07803 6.27735 8.91482 6.24489 8.75 6.24489C8.58518 6.24489 8.42197 6.27735 8.26969 6.34043C8.11741 6.4035 7.97905 6.49595 7.8625 6.6125C7.74595 6.72905 7.6535 6.86741 7.59043 7.01969C7.52735 7.17197 7.49489 7.33518 7.49489 7.5C7.49489 7.66482 7.52735 7.82803 7.59043 7.98031C7.6535 8.13259 7.74595 8.27095 7.8625 8.3875L10.7375 11.25H1.25C0.918479 11.25 0.600537 11.3817 0.366117 11.6161C0.131696 11.8505 0 12.1685 0 12.5ZM16.25 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V7.5C0 7.83152 0.131696 8.14946 0.366117 8.38388C0.600537 8.6183 0.918479 8.75 1.25 8.75C1.58152 8.75 1.89946 8.6183 2.13388 8.38388C2.3683 8.14946 2.5 7.83152 2.5 7.5V3.75C2.5 3.41848 2.6317 3.10054 2.86612 2.86612C3.10054 2.6317 3.41848 2.5 3.75 2.5H16.25C16.5815 2.5 16.8995 2.6317 17.1339 2.86612C17.3683 3.10054 17.5 3.41848 17.5 3.75V21.25C17.5 21.5815 17.3683 21.8995 17.1339 22.1339C16.8995 22.3683 16.5815 22.5 16.25 22.5H3.75C3.41848 22.5 3.10054 22.3683 2.86612 22.1339C2.6317 21.8995 2.5 21.5815 2.5 21.25V17.5C2.5 17.1685 2.3683 16.8505 2.13388 16.6161C1.89946 16.3817 1.58152 16.25 1.25 16.25C0.918479 16.25 0.600537 16.3817 0.366117 16.6161C0.131696 16.8505 0 17.1685 0 17.5V21.25C0 22.2446 0.395088 23.1984 1.09835 23.9017C1.80161 24.6049 2.75544 25 3.75 25H16.25C17.2446 25 18.1984 24.6049 18.9017 23.9017C19.6049 23.1984 20 22.2446 20 21.25V3.75C20 2.75544 19.6049 1.80161 18.9017 1.09835C18.1984 0.395088 17.2446 0 16.25 0Z" fill="white"/>
                </svg>
            </a>

            <button id='theme-btn'>Mudar tema</button>

            <div class='user-info'>
                <div class='profile-user'>
                    <img class="img-profile" src="images/<?php echo $profile['foto']?>" alt="Foto do usuário">
                    <h3><?php echo $profile['nome'] ." ". $profile['sobrenome']?></h3>
                </div>
            </div>

            <div class='card-profile-content'>
                <div class="content-box profile-content">
                    <h2>Informações de Cadastro</h2>

                    <div class='info-container-profile'>
                        <p>E-mail: </p>
                        <span><?php echo $profile['email']?></span>
                    </div>

                    <button id="btn-reset-password" class='reset-password-btn'>
                        Redefinir senha
                    </button>
                </div>
            </div>
        </section>

        <!-- form troca senha-->
        <section id="form-reset-password" class="position-forms modal <?php if($_SESSION['msg_error'] == 'Senha atual incorreta.' or $_SESSION['msg_error'] == 'Senha mínima de 8 caracteres'){ echo(''); } else { echo('hidden'); }?>">
            <div class="content-box">
                <button id="btn-close-reset-password" class='close close-form reset-btn-decoration'>
                    <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                    </svg>
                </button>
                <form action="adm_profile_page.php?newPassword" onsubmit="return verifyLimitPassword()" method="POST">
                    <h2>Redefinir nova senha</h2>
                    <div class="form-container">
                        <div class="input-container">
                            <label for="password">Senha atual</label>
                            <input type="password" id="current-password" name="password" placeholder="********" autocomplete="off" required>
                        </div>
                        <div class="input-container">
                            <label for="new_password">Nova senha</label>
                            <input type="password" id="new-password" name="new_password" placeholder="********" autocomplete="off" required>
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login">
                        Atualizar!
                    </button>
                    
                </form>

                <div class='msg'>
                    <span class="msg-error">
                        <?php echo ($_SESSION["msg_error"]); ?>
                    </span>
                </div>

            </div>
        </section>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>        
    
</body>
</html>