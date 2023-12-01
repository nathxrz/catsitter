<?php
    session_start();
    $style ="style";
    $title = 'Pets';

    require('./includes/components/authenticator.php');
    require("./includes/components/functions.php"); 

    $_SESSION['msg_error'] = '';

    if(isset($_GET['addRotina'])){
        if(isset($_POST['routine']) and isset($_POST['cod_pet'])){
            $routine = $_POST['routine'];
            $cod_pet = $_POST['cod_pet']; 
    
            updateRoutine($_SESSION['cod_usuario'],$cod_pet, $routine, $pdo);
    
            $link = "pet_profile_page.php?&pet=".$_GET['pet'];
            redirect($link);
        }
    }

    if(isset($_GET['addFicha'])){
        if(isset($_POST['medical_record']) and isset($_POST['cod_pet'])){
            $medical_record = $_POST['medical_record'];
            $cod_pet = $_POST['cod_pet']; 
    
            updateMedicalRecord($_SESSION['cod_usuario'],$cod_pet, $medical_record, $pdo);
    
            $link = "pet_profile_page.php?&pet=".$_GET['pet'];
            redirect($link);
        }
    }

    if(isset($_GET['editTelefone'])){
        if(isset($_POST['telephone'])){
            $telephone = $_POST['telephone'];
            updateFone($_SESSION['cod_usuario'], $telephone, $pdo);
    
            $link = "pet_profile_page.php?&pet=".$_GET['pet'];
            redirect($link);
        }
    }

    if(isset($_GET['editInfoPet'])){
        if(isset($_POST['cod_pet']) and isset($_POST['name']) and isset($_POST['sex']) and isset($_POST['breed'])){
            $cod_pet = $_POST['cod_pet'];
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $breed = $_POST['breed'];
            if(isset($_POST['birth'])){
                $birth = $_POST['birth'];
            }else{
                $birth = '';
            }
    
            $array = [$name, $birth, $sex, $breed, $cod_pet, $_SESSION['cod_usuario']];
            $updateInfoPet = registerPet($array, $pdo);  
            
            $link = "pet_profile_page.php?&pet=".$_GET['pet'];
            redirect($link);
        }
    }

    if(isset($_GET['editFoto'])){
        $cod_pet = $_POST['cod_pet'];

        $source_file_name = $_FILES['file']['name'];  
        $file_size = $_FILES['file']['size']; 
        $temporary_file = $_FILES['file']['tmp_name'];
        $file_name = date('YmdHisu') . '.' . pathinfo($source_file_name, PATHINFO_EXTENSION);
        move_uploaded_file($temporary_file, "images/$file_name"); 

        updateFotoPet($_SESSION['cod_usuario'], $cod_pet, $file_name, $pdo);

        $link = "pet_profile_page.php?&pet=".$_GET['pet'];
        redirect($link);
    }

    if(isset($_GET['pet'])){
        $cod_pet = $_GET['pet'];

        $pet_profile = getPetById($cod_pet, $pdo);
        $tutor_fone = getFoneById($_SESSION['cod_usuario'], $pdo);
    }
    require("./includes/components/head.php");
?>

<body>
    <?php
        require("./includes/components/header.php");
    ?>

    <main> 
        <section class='profile position-content'>
            <button id="close-btn" class="reset-btn-decoration close" >
                <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.4998L30.3867 8.80271C30.677 8.51241 30.8401 8.11868 30.8401 7.70813C30.8401 7.29758 30.677 6.90385 30.3867 6.61355C30.0964 6.32325 29.7027 6.16016 29.2921 6.16016C28.8816 6.16016 28.4879 6.32325 28.1976 6.61355L18.5005 16.326L8.80339 6.61355C8.51309 6.32325 8.11936 6.16016 7.70881 6.16016C7.29826 6.16016 6.90453 6.32325 6.61423 6.61355C6.32392 6.90385 6.16083 7.29758 6.16083 7.70813C6.16083 8.11868 6.32392 8.51241 6.61423 8.80271L16.3267 18.4998L6.61423 28.1969C6.46973 28.3402 6.35504 28.5107 6.27677 28.6986C6.1985 28.8864 6.1582 29.0879 6.1582 29.2915C6.1582 29.495 6.1985 29.6965 6.27677 29.8844C6.35504 30.0722 6.46973 30.2427 6.61423 30.386C6.75754 30.5305 6.92805 30.6452 7.11592 30.7235C7.30379 30.8018 7.50529 30.8421 7.70881 30.8421C7.91233 30.8421 8.11383 30.8018 8.3017 30.7235C8.48956 30.6452 8.66007 30.5305 8.80339 30.386L18.5005 20.6735L28.1976 30.386C28.3409 30.5305 28.5114 30.6452 28.6993 30.7235C28.8871 30.8018 29.0886 30.8421 29.2921 30.8421C29.4957 30.8421 29.6972 30.8018 29.885 30.7235C30.0729 30.6452 30.2434 30.5305 30.3867 30.386C30.5312 30.2427 30.6459 30.0722 30.7242 29.8844C30.8025 29.6965 30.8427 29.495 30.8427 29.2915C30.8427 29.0879 30.8025 28.8864 30.7242 28.6986C30.6459 28.5107 30.5312 28.3402 30.3867 28.1969L20.6742 18.4998Z" fill="white"/>
                </svg>
            </button>

            <div class='user-info'>
                <div class='profile-user'>
                    <img class="img-profile" src="images/<?php echo $pet_profile['foto']?>" alt="">
                    <h3><?php echo $pet_profile['nome']?></h3>
                </div>
                <button class='reset-btn-decoration btn-edit-image'>
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
    
                    <?php if(!$pet_profile['dt_nascimento'] == ''){ ?>
                        <div class='info-container-profile'>
                            <p>Data de nascimento: </p>
                            <span><?php echo $pet_profile['dt_nascimento']?></span>
                        </div>
                    <?php } ?>
    
                    <div class='info-container-profile'>
                        <p>Sexo: </p>
                        <span><?php echo $pet_profile['sexo']?></span>
                    </div>
    
                    <div class='info-container-profile'>
                        <p>Raça: </p>
                        <span><?php echo $pet_profile['raca']?></span>
                    </div>
    
                    <button class='reset-btn-decoration btn-profile-position'>
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
                    <h2>Rotina</h2>
    
                    <div class='info-container-profile'>
                        <?php if($pet_profile['rotina'] == null){ ?>
                        <p>Nenhuma rotina informada.</p>
                        <?php } else { ?>
                        <p><?php echo $pet_profile['rotina']?></p>
                        <?php } ?>
                    </div>
    
                    <button class='reset-btn-decoration btn-profile-position hidden'>
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
    
                    <button class='reset-btn-decoration btn-profile-position'>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H13V5Z" fill="#BF6C2C"/>
                        </svg>
                    </button>
    
                </div>

                <div class="content-box profile-content">
                    <h2>Ficha médica</h2>
    
                    <div class='info-container-profile'>
                        <?php if($pet_profile['ficha_medica'] == null){ ?>
                        <p>Nenhuma rotina informada.</p>
                        <?php } else { ?>
                        <p><?php echo $pet_profile['ficha_medica']?></p>
                        <?php } ?>
                    </div>
    
                    <button class='reset-btn-decoration btn-profile-position hidden'>
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
    
                    <button class='reset-btn-decoration btn-profile-position'>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H13V5Z" fill="#BF6C2C"/>
                        </svg>
                    </button>
    
                </div>

                <div class="content-box profile-content">
                    <h2>Contato de emergência</h2>
    
                    <div class='info-container-profile'>
                        <span><?php echo $tutor_fone['telefone']?></span>
                    </div>
    
                    <button class='reset-btn-decoration btn-profile-position'>
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

                <!-- <div class="content-box profile-content">
                    <h2>Galeira de fotos</h2>

                    <div class='info-container-profile'>
                        <p>Nenhuma foto adicionada.</p>
                    </div>
    
                    <button class='reset-btn-decoration btn-profile-position hidden'>
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
    
                    <button class='reset-btn-decoration btn-profile-position'>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5V11H5C4.44772 11 4 11.4477 4 12C4 12.5523 4.44772 13 5 13H11V19C11 19.5523 11.4477 20 12 20C12.5523 20 13 19.5523 13 19V13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H13V5Z" fill="#BF6C2C"/>
                        </svg>
                    </button>
    
                </div> -->
                
            </div>

        </section>

        <!-- form rotina -->
        <section class="position-forms modal hidden">
            <div class="content-box">
                <form action="pet_profile_page.php?addRotina&pet=<?php echo $_GET['pet']?>" method="POST">

                    <button type='button' class='close reset-btn-decoration'>
                        <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                        </svg>
                    </button>
                
                    <h2>Rotina</h2>
                    <div class='form-container'>
                        <div class="input-container" >
                            <textarea name="routine" id="routine" cols="30" rows="10"><?php echo $pet_profile['rotina']?></textarea>
                        </div>
                    </div>

                    <input type="hidden" value='<?php echo $pet_profile['cod_pet']?>' name='cod_pet'>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Adicionar!
                    </button>

                    <button type="submit" class="btn-submit hidden" name="login" value="login">
                        Atualizar!
                    </button>
                    
                </form>
            </div>
        </section>

        <!-- form ficha medica -->
        <section class="position-forms modal hidden">
            <div class="content-box">
                <form action="pet_profile_page.php?addFicha&pet=<?php echo $_GET['pet']?>" method="POST">

                    <button class='close reset-btn-decoration'>
                        <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                        </svg>
                    </button>
                
                    <h2>Ficha Médica</h2>
                    <div class='form-container'>
                        <div class="input-container" >
                            <textarea name="medical_record" id="medical_record" cols="30" rows="10"><?php echo $pet_profile['ficha_medica']?></textarea>
                        </div>
                    </div>

                    <input type="hidden" value='<?php echo $pet_profile['cod_pet']?>' name='cod_pet'>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Adicionar!
                    </button>

                    <button type="submit" class="btn-submit hidden" name="login" value="login">
                        Atualizar!
                    </button>
                    
                </form>
            </div>
        </section>

        <!-- form contato de emergencia update hidden-->
        <section class="position-forms modal hidden">
            <div class="content-box">
                <form action="pet_profile_page.php?editTelefone&pet=<?php echo $_GET['pet']?>" method="POST">

                    <button class='close reset-btn-decoration'>
                        <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                        </svg>
                    </button>
                
                    <h2>Contato de emergência *</h2>
                    <div class='form-container'>
                        <div class="input-container">
                                <input type="tel" id="telephone" name="telephone" placeholder="(xx) xxxxx-xxxx" autocomplete="off" value='<?php echo $tutor_fone['telefone']?>' required>
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Atualizar!
                    </button>
                    
                </form>
                
            </div>
        </section>

        <!-- form infos básicas -->
        <section class="position-forms modal hidden">
            <div class="content-box">
            <form action="pet_profile_page.php?editInfoPet&pet=<?php echo $_GET['pet']?>" method="POST" >
                    
                    <button class='close reset-btn-decoration'>
                        <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                        </svg>
                    </button>

                    <h2>Informações do seu pet</h2>
                    <div class="form-container">
                        <div class="input-container">
                            <label for="name">Qual o nome do seu gatinho(a)? *</label>
                            <input type="text" class="validateString" id="name" name="name" placeholder="Bartholomeu" value="<?php echo $pet_profile['nome']?>" required>
                        </div>
                        <div class="input-container">
                            <label for="sex">Qual o sexo? *</label>
                            <select name="sex" id="sex" required>
                                <option value="Fêmea" <?php if($pet_profile['sexo'] == 'Fêmea') echo "selected"?>>Fêmea</option>
                                <option value="Macho" <?php if($pet_profile['sexo'] == 'Macho') echo "selected"?>>Macho</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="birth">Data de nascimento:</label>
                            <input type="date" id="birth" name="birth" placeholder="Data de nascimento" value="<?php echo $pet_profile['dt_nascimento']?>">
                        </div>
                        <div class="input-container">
                            <label for="breed">Qual a raça do seu felino? *</label>
                            <input type="text" class="validateString" id="breed" name="breed" placeholder="Bartholomeu" value="<?php echo $pet_profile['raca']?>" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" name="submit" value="submit">
                        Atualizar informações!
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
        <section class="position-forms modal hidden">
            <div class="content-box">
                <form action="pet_profile_page.php?editFoto&pet=<?php echo $_GET['pet']?>" method="POST" enctype="multipart/form-data">

                    <button type='button' class='close reset-btn-decoration'>
                        <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                        </svg>
                    </button>
                
                    <h2>Foto de perfil</h2>
                    <div class='form-container'>
                    <img class="img-profile img-position-form" src="images/<?php echo $pet_profile['foto']?>" alt="">
                         <div class="input-container">
                            <label for="file">Adicione uma foto do pet: *</label>
                            <input type="file" id="file" name="file" accept=".png, .jpg, .jpeg" required>
                        </div>
                    </div>

                    <input type="hidden" value='<?php echo $pet_profile['cod_pet']?>' name='cod_pet'>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Editar!
                    </button>
                    
                </form>
            </div>
        </section>

    <!-- form galeria-->
        <section class="position-forms modal hidden">
            <div class="content-box">
                <form action="pet_profile_page.php" method="POST">

                    <button class='close reset-btn-decoration'>
                        <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                        </svg>
                    </button>
                
                    <h2>Selecionar Fotos</h2>
                    <div class='form-container'>
                        <div class="input-container">
                            <input type="file" id="foto" accept=".png, .jpg, .jpeg" multiple name="foto" autocomplete="off">
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Adicionar!
                    </button>
                    
                </form>
            </div>
        </section>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>        
    
</body>
</html>