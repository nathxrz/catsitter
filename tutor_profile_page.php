<?php
    session_start();
    $style ="style";
    $title = 'Perfil';

    require('./includes/components/authenticator.php');
    require('./includes/components/connect.php');
    require('./includes/components/functions.php');

    $_SESSION["msg_error"] = '';

    if(isset($_GET['editBasicInfo'])){
        if(isset($_POST['name']) and isset($_POST['lastname']) and isset($_POST['birth']) and isset($_POST['gender']) and isset($_POST['cpf']) and isset($_POST['telephone'])){
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $birth = $_POST['birth'];
            $gender = $_POST['gender'];
            $cpf = $_POST['cpf'];
            $telephone = $_POST['telephone'];
            $array = [$name, $lastname, $birth, $gender, $cpf, $_SESSION['cod_usuario']];

            updateInfoBasic($array, $pdo);
            updateFone($_SESSION['cod_usuario'], $telephone, $pdo);

            $link = "tutor_profile_page.php";
            redirect($link);
        }else{
            $_SESSION["msg_error"] = 'Preencha todos os campos obrigatórios. *';
        }        
    }

    if(isset($_GET['editAddress'])){
        if(isset($_POST['cep']) and isset($_POST['street']) and isset($_POST['number']) and isset($_POST['city']) and isset($_POST['state']) and isset($_POST['country']) and isset($_POST['complement'])){
            $cep = $_POST['cep'];
            $street = $_POST['street'];
            $number = $_POST['number'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            $complement = $_POST['complement'];
            $array = [$cep, $street, $number, $city, $state, $country, $complement, $_SESSION['cod_usuario']];

            updateAddress($array, $pdo);

            $link = "tutor_profile_page.php";
            redirect($link);
        }else{
            $_SESSION["msg_error"] = 'Preencha todos os campos obrigatórios. *';
        }        
    }

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

                $link = "tutor_profile_page.php";
                redirect($link);
            }else{
                $_SESSION['msg_error'] = 'Senha atual incorreta.';
            }
        }else{
            $_SESSION['msg_error'] = 'Preencha todos os campos obrigatórios. *';
        }   
    }

    if(isset($_GET['editFoto'])){
        $user = $_SESSION['cod_usuario'];

        $source_file_name = $_FILES['file']['name'];  
        $file_size = $_FILES['file']['size']; 
        $temporary_file = $_FILES['file']['tmp_name'];
        $file_name = date('YmdHisu') . '.' . pathinfo($source_file_name, PATHINFO_EXTENSION);
        move_uploaded_file($temporary_file, "images/$file_name"); 

        updateFotoUser($user, $file_name, $pdo);

        $link = "tutor_profile_page.php";
        redirect($link);
    }
    require("./includes/components/head.php");
?>

<body>
    <?php
        require("./includes/components/header.php");
    ?>

    <main> 
        <section class='profile position-content'>
            <a class="close" href="logout.php">
                <svg width="20" height="25" viewBox="0 0 20 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 12.5C0 12.8315 0.131696 13.1495 0.366117 13.3839C0.600537 13.6183 0.918479 13.75 1.25 13.75H10.7375L7.8625 16.6125C7.74534 16.7287 7.65235 16.867 7.58889 17.0193C7.52542 17.1716 7.49275 17.335 7.49275 17.5C7.49275 17.665 7.52542 17.8284 7.58889 17.9807C7.65235 18.133 7.74534 18.2713 7.8625 18.3875C7.9787 18.5047 8.11695 18.5977 8.26928 18.6611C8.4216 18.7246 8.58498 18.7572 8.75 18.7572C8.91502 18.7572 9.0784 18.7246 9.23072 18.6611C9.38305 18.5977 9.5213 18.5047 9.6375 18.3875L14.6375 13.3875C14.7513 13.2686 14.8405 13.1284 14.9 12.975C15.025 12.6707 15.025 12.3293 14.9 12.025C14.8405 11.8716 14.7513 11.7314 14.6375 11.6125L9.6375 6.6125C9.52095 6.49595 9.38259 6.4035 9.23031 6.34043C9.07803 6.27735 8.91482 6.24489 8.75 6.24489C8.58518 6.24489 8.42197 6.27735 8.26969 6.34043C8.11741 6.4035 7.97905 6.49595 7.8625 6.6125C7.74595 6.72905 7.6535 6.86741 7.59043 7.01969C7.52735 7.17197 7.49489 7.33518 7.49489 7.5C7.49489 7.66482 7.52735 7.82803 7.59043 7.98031C7.6535 8.13259 7.74595 8.27095 7.8625 8.3875L10.7375 11.25H1.25C0.918479 11.25 0.600537 11.3817 0.366117 11.6161C0.131696 11.8505 0 12.1685 0 12.5ZM16.25 0H3.75C2.75544 0 1.80161 0.395088 1.09835 1.09835C0.395088 1.80161 0 2.75544 0 3.75V7.5C0 7.83152 0.131696 8.14946 0.366117 8.38388C0.600537 8.6183 0.918479 8.75 1.25 8.75C1.58152 8.75 1.89946 8.6183 2.13388 8.38388C2.3683 8.14946 2.5 7.83152 2.5 7.5V3.75C2.5 3.41848 2.6317 3.10054 2.86612 2.86612C3.10054 2.6317 3.41848 2.5 3.75 2.5H16.25C16.5815 2.5 16.8995 2.6317 17.1339 2.86612C17.3683 3.10054 17.5 3.41848 17.5 3.75V21.25C17.5 21.5815 17.3683 21.8995 17.1339 22.1339C16.8995 22.3683 16.5815 22.5 16.25 22.5H3.75C3.41848 22.5 3.10054 22.3683 2.86612 22.1339C2.6317 21.8995 2.5 21.5815 2.5 21.25V17.5C2.5 17.1685 2.3683 16.8505 2.13388 16.6161C1.89946 16.3817 1.58152 16.25 1.25 16.25C0.918479 16.25 0.600537 16.3817 0.366117 16.6161C0.131696 16.8505 0 17.1685 0 17.5V21.25C0 22.2446 0.395088 23.1984 1.09835 23.9017C1.80161 24.6049 2.75544 25 3.75 25H16.25C17.2446 25 18.1984 24.6049 18.9017 23.9017C19.6049 23.1984 20 22.2446 20 21.25V3.75C20 2.75544 19.6049 1.80161 18.9017 1.09835C18.1984 0.395088 17.2446 0 16.25 0Z" fill="white"/>
                </svg>
            </a>

            <div class='user-info'>
                <div class='profile-user'>
                    <img class="img-profile" src="images/<?php echo $profile['foto']?>" alt="">
                    <h3><?php echo $profile['nome'] ." ". $profile['sobrenome']?></h3>
                </div>
                <button id="btn-foto-profile" class='reset-btn-decoration btn-edit-image'>
                    <svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="13.5" cy="13.5" r="13.5" fill="#BF6C2C"/>
                        <g clip-path="url(#clip0_208_14979)">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.459 5.83008C18.1029 5.83008 17.7503 5.90022 17.4212 6.0365C17.0922 6.17278 16.7933 6.37253 16.5415 6.62435L6.97897 16.1868C6.8918 16.274 6.82889 16.3824 6.79646 16.5013L5.73396 20.3972C5.66708 20.6424 5.73673 20.9047 5.91647 21.0844C6.09621 21.2642 6.35848 21.3338 6.60371 21.2669L10.4995 20.2044C10.6185 20.172 10.7269 20.1091 10.814 20.0219L20.3765 10.4594C20.6283 10.2076 20.8281 9.90865 20.9644 9.57964C21.1007 9.25063 21.1708 8.898 21.1708 8.54188C21.1708 8.18576 21.1007 7.83313 20.9644 7.50412C20.8281 7.17511 20.6283 6.87616 20.3765 6.62435C20.1247 6.37253 19.8258 6.17278 19.4968 6.0365C19.1678 5.90022 18.8151 5.83008 18.459 5.83008ZM17.9634 7.34533C18.1205 7.28024 18.2889 7.24674 18.459 7.24674C18.6291 7.24674 18.7975 7.28024 18.9546 7.34533C19.1118 7.41042 19.2545 7.50582 19.3748 7.62608C19.4951 7.74635 19.5905 7.88912 19.6556 8.04625C19.7206 8.20338 19.7541 8.3718 19.7541 8.54188C19.7541 8.71196 19.7206 8.88038 19.6556 9.03751C19.5905 9.19464 19.4951 9.33742 19.3748 9.45768L9.94531 18.8872L7.42686 19.574L8.11371 17.0556L17.5432 7.62608C17.6635 7.50582 17.8062 7.41042 17.9634 7.34533Z" fill="white"/>
                        </g>
                        <defs>
                        <clipPath id="clip0_208_14979">
                        <rect width="17" height="17" fill="white" transform="translate(5 5)"/>
                        </clipPath>
                        </defs>
                    </svg>
                </button>
            </div>

            <div class='card-profile-content'>

                <div class="content-box profile-content">
                    <h2>Informações básicas</h2>
    
                    <div class='info-container-profile'>
                        <p>Data de nascimento: </p>
                        <span><?php echo date('d/m/Y', strtotime($profile['dt_nascimento']))?></span>
                    </div>
    
                    <div class='info-container-profile'>
                        <p>Gênero: </p>
                        <span><?php echo $profile['genero']?></span>
                    </div>
    
                    <div class='info-container-profile'>
                        <p>CPF: </p>
                        <span><?php echo $profile['cpf']?></span>
                    </div>

                    <div class='info-container-profile'>
                        <p>Telefone: </p>
                        <span><?php echo $foneUser['telefone']?></span>
                    </div>
    
                    <button id="btn-info-profile" class='reset-btn-decoration btn-profile-position'>
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_208_13714)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.459 0.830078C13.1029 0.830078 12.7503 0.900221 12.4212 1.0365C12.0922 1.17278 11.7933 1.37253 11.5415 1.62435L1.97897 11.1868C1.8918 11.274 1.82889 11.3824 1.79646 11.5013L0.73396 15.3972C0.667078 15.6424 0.736727 15.9047 0.916467 16.0844C1.09621 16.2642 1.35848 16.3338 1.60371 16.2669L5.49954 15.2044C5.61847 15.172 5.72687 15.1091 5.81404 15.0219L15.3765 5.45941C15.6283 5.2076 15.8281 4.90865 15.9644 4.57964C16.1007 4.25063 16.1708 3.898 16.1708 3.54188C16.1708 3.18576 16.1007 2.83313 15.9644 2.50412C15.8281 2.17511 15.6283 1.87616 15.3765 1.62435C15.1247 1.37253 14.8258 1.17278 14.4968 1.0365C14.1678 0.900221 13.8151 0.830078 13.459 0.830078ZM12.9634 2.34533C13.1205 2.28024 13.2889 2.24674 13.459 2.24674C13.6291 2.24674 13.7975 2.28024 13.9546 2.34533C14.1118 2.41042 14.2545 2.50582 14.3748 2.62608C14.4951 2.74635 14.5905 2.88912 14.6556 3.04625C14.7206 3.20338 14.7541 3.3718 14.7541 3.54188C14.7541 3.71196 14.7206 3.88038 14.6556 4.03751C14.5905 4.19464 14.4951 4.33742 14.3748 4.45768L4.94531 13.8872L2.42686 14.574L3.11371 12.0556L12.5432 2.62608C12.6635 2.50582 12.8062 2.41042 12.9634 2.34533Z" fill="#BF6C2C"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_208_13714">
                            <rect width="17" height="17" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>

                <div class="content-box profile-content">
                    <h2>Endereço</h2>

                    <div class='info-container-profile'>
                        <p>CEP: </p>
                        <span><?php echo $profile['cep']?></span>
                    </div>

                    <div class='info-group-container'>
                        <div class='info-group'>
                            <div class='info-container-profile'>
                                <p>Rua: </p>
                                <span><?php echo $profile['rua']?></span>
                            </div>
    
                            <div class='info-container-profile'>
                                <p>Cidade: </p>
                                <span><?php echo $profile['cidade']?></span>
                            </div>
    
                            <div class='info-container-profile'>
                                <p>País: </p>
                                <span><?php echo $profile['pais']?></span>
                            </div>
            
                        </div>
                        
                        <div class='info-group'>
                            <div class='info-container-profile'>
                                <p>nº: </p>
                                <span><?php echo $profile['numero']?></span>
                            </div>
        
                            <div class='info-container-profile'>
                                <p>Estado: </p>
                                <span><?php echo $profile['estado']?></span>
                            </div>

                            <?php if(!$profile['complemento'] == ''){ ?>
                                <div class='info-container-profile'>
                                    <p>Complemento: </p>
                                    <span><?php echo $profile['complemento']?></span>
                                </div>
                            <?php } ?>
                        </div>
                    </div>


                    <button id="btn-info-address" class='reset-btn-decoration btn-profile-position'>
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_208_13714)">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M13.459 0.830078C13.1029 0.830078 12.7503 0.900221 12.4212 1.0365C12.0922 1.17278 11.7933 1.37253 11.5415 1.62435L1.97897 11.1868C1.8918 11.274 1.82889 11.3824 1.79646 11.5013L0.73396 15.3972C0.667078 15.6424 0.736727 15.9047 0.916467 16.0844C1.09621 16.2642 1.35848 16.3338 1.60371 16.2669L5.49954 15.2044C5.61847 15.172 5.72687 15.1091 5.81404 15.0219L15.3765 5.45941C15.6283 5.2076 15.8281 4.90865 15.9644 4.57964C16.1007 4.25063 16.1708 3.898 16.1708 3.54188C16.1708 3.18576 16.1007 2.83313 15.9644 2.50412C15.8281 2.17511 15.6283 1.87616 15.3765 1.62435C15.1247 1.37253 14.8258 1.17278 14.4968 1.0365C14.1678 0.900221 13.8151 0.830078 13.459 0.830078ZM12.9634 2.34533C13.1205 2.28024 13.2889 2.24674 13.459 2.24674C13.6291 2.24674 13.7975 2.28024 13.9546 2.34533C14.1118 2.41042 14.2545 2.50582 14.3748 2.62608C14.4951 2.74635 14.5905 2.88912 14.6556 3.04625C14.7206 3.20338 14.7541 3.3718 14.7541 3.54188C14.7541 3.71196 14.7206 3.88038 14.6556 4.03751C14.5905 4.19464 14.4951 4.33742 14.3748 4.45768L4.94531 13.8872L2.42686 14.574L3.11371 12.0556L12.5432 2.62608C12.6635 2.50582 12.8062 2.41042 12.9634 2.34533Z" fill="#BF6C2C"/>
                            </g>
                            <defs>
                            <clipPath id="clip0_208_13714">
                            <rect width="17" height="17" fill="white"/>
                            </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>                
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

        <!-- form info pessoal -->
        <section id="form-info-profile" class="position-forms modal hidden">
            <div class="content-box">
                <button id="btn-close-info-profile" class='close reset-btn-decoration'>
                    <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                    </svg>
                </button>
                <form action="tutor_profile_page.php?editBasicInfo" method="POST">                
                    <h2>Informações pessoais</h2>
                    <div class="form-container">
                        <div class="input-container">
                            <label for="name">Nome *</label>
                            <input type="text" class="validateString" id="name" name="name" placeholder="Nome do usuário" autocomplete="off" value="<?php echo $profile['nome']?>" required>
                        </div>
                        <div class="input-container">
                            <label for="lastname">Sobrenome *</label>
                            <input type="text" class="validateString" id="lastname" name="lastname" placeholder="Sobrenome" autocomplete="off" value="<?php echo $profile['sobrenome']?>" required>
                        </div>
                        <div class="input-container">
                            <label for="birth">Data de nascimento *</label>
                            <input type="date" id="birth" name="birth" max="<?php echo (date('Y-m-d', strtotime('-16 years'))) ?>" placeholder="Data de nascimento" autocomplete="off" value="<?php echo date('d/m/Y', strtotime($profile['dt_nascimento']))?>" required>
                        </div>
                        <div class="input-container">
                            <label for="gender">Gênero *</label>
                            <select name="gender" id="gender">
                                <option value="Feminino" <?php if($profile['genero'] == 'Feminino') echo "selected"?>>Feminino</option>
                                <option value="Masculino" <?php if($profile['genero'] == 'Masculino') echo "selected"?>>Masculino</option>
                                <option value="Outro" <?php if($profile['genero'] == 'Outro') echo "selected"?>>Outro</option>
                                <option value="Não informado" <?php if($profile['genero'] == 'Não informado') echo "selected"?>>Não informado</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="cpf">CPF *</label>
                            <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" autocomplete="off" value="<?php echo $profile['cpf']?>" required>
                        </div>
                        <div class="input-container">
                            <label for="telephone">Telefone *</label>
                            <input type="tel" id="telephone" name="telephone" placeholder="(xx) xxxxx-xxxx" autocomplete="off" value="<?php echo $foneUser['telefone']?>" required>
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
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

        <!-- form endereço -->
        <section id="form-address" class="position-forms modal hidden">
            <div class="content-box">
                <button id="btn-close-address" class='close reset-btn-decoration'>
                    <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                    </svg>
                </button>
                <form action="tutor_profile_page.php?editAddress" method="POST">

                
                    <h2>Endereço</h2>
                    <div class='form-container'>
                        <div class="input-container">
                            <label for="cep">CEP</label>
                            <input type="text" id="cep" name="cep" placeholder="xxxxx-xxx" autocomplete="off" value="<?php echo $profile['cep']?>" required>
                        </div>

                        <div class="input-container input-row">
                            <div class='large'>
                                <label for="street">Rua</label>
                                <input type="text" class="validateString" id="street" name="street" placeholder="Bento Martins" autocomplete="off" value="<?php echo $profile['rua']?>" required>
                            </div>
                            <div class='small'>
                                <label for="number">nº</label>
                                <input type="text" class="validateNumbers" id="number" name="number" placeholder="12345" autocomplete="off" value="<?php echo $profile['numero']?>" required>
                            </div>
                        </div>

                        <div class="input-container input-row">
                            <div class='medium'>
                                <label for="city">Cidade</label>
                                <input type="text" class="validateString" id="city" name="city" placeholder="Pelotas" autocomplete="off" value="<?php echo $profile['cidade']?>" required>
                            </div>
                            <div class='medium'>
                                <label for="state">Estado</label>
                                <input type="text" class="validateString" id="state" name="state" placeholder="RS" autocomplete="off" value="<?php echo $profile['estado']?>" required>
                            </div>
                        </div>

                        <div class="input-container input-row">
                            <div class='small'>
                                <label for="country">País</label>
                                <input type="text" class="validateString" id="country" name="country" placeholder="Brasil" autocomplete="off" value="<?php echo $profile['pais']?>" required>
                            </div>
                            <div class='large'>
                                <label for="complement">Complemento</label>
                                <input type="text" id="complement" name="complement" placeholder="bloco 2" value="<?php echo $profile['complemento']?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
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

                <!-- form foto -->
        <section id="form-foto-profile" class="position-forms modal hidden">
            <div class="content-box">
                <button id="btn-close-foto-profile" type='button' class='close reset-btn-decoration'>
                    <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                    </svg>
                </button>
                <form action="tutor_profile_page.php?editFoto" method="POST" enctype="multipart/form-data">

                
                    <h2>Foto de perfil</h2>
                    <div class='form-container'>
                    <img class="img-profile img-position-form" src="images/<?php echo $profile['foto']?>" alt="">
                         <div class="input-container">
                            <label for="file">Adicione uma foto de perfil: *</label>
                            <input type="file" id="file" name="file" accept=".png, .jpg, .jpeg" required>
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Editar!
                    </button>
                    
                </form>
            </div>
        </section>

        <!-- form troca senha-->
        <section id="form-reset-password" class="position-forms modal <?php if($_SESSION['msg_error'] == 'Senha atual incorreta.' or $_SESSION['msg_error'] == 'Senha mínima de 8 caracteres'){ echo(''); } else { echo('hidden'); }?>">
            <div class="content-box">
                <button id="btn-close-reset-password" class='close reset-btn-decoration'>
                    <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                    </svg>
                </button>
                <form action="tutor_profile_page.php?newPassword" onsubmit="return verifyLimitPassword()" method="POST">
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