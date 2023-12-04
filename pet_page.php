<?php
    session_start();
    $style ="style";
    $title = 'Pets';

    require('./includes/components/authenticator.php');
    require("./includes/components/functions.php");

    $_SESSION["msg_error"] = '';

    if(isset($_GET['addPet'])){
        if(isset($_POST['name']) and isset($_POST['sex']) and isset($_POST['breed'])){
            $name = $_POST['name'];
            $sex = $_POST['sex'];
            $breed = $_POST['breed'];
            if(isset($_POST['birth'])){
                $birth = $_POST['birth'];
            }else{
                $birth = '';
            }
    
            $source_file_name = $_FILES['file']['name'];  
            $file_size = $_FILES['file']['size']; 
            $temporary_file = $_FILES['file']['tmp_name'];
            $file_name = date('YmdHisu') . '.' . pathinfo($source_file_name, PATHINFO_EXTENSION);
            move_uploaded_file($temporary_file, "images/$file_name");
    
            $array = [$name, $birth, $sex, $breed, $file_name, $_SESSION['cod_usuario']];
            $registerPet = registerPet($array, $pdo);
    
            if($registerPet){
                $link = "pet_page.php";
                redirect($link);
            }else{
                $_SESSION['msg_error'] = "Não foi possível adicionar seu pet :(";
            }
        }else{
            $_SESSION['msg_error'] = "Preencha todos os campos obrigatórios. *";
        }
    }
    
    if (isset($_GET['delete'])) {
        $cod_pet = $_GET['delete'];
        $searchSchedule = searchSchedulePet($_SESSION['cod_usuario'], $cod_pet, $pdo);

        if(!$searchSchedule){
            $delete_pet = deletePet($_SESSION['cod_usuario'], $cod_pet, $pdo);
        }else{
            $_SESSION["msg_error"] = 'Não foi possível deletar o pet, pois ele está vínculado a um (ou mais) agendamento(s)!';
        }
    }

    if(isset($_SESSION['cod_usuario'])){
        $pets = searchPets($_SESSION['cod_usuario'], $pdo);
    }
    require("./includes/components/head.php");
?>

<body>
    <?php
        require("./includes/components/header.php");
    ?>

    <main>
        <section class=''>
            <div class="content-box position-content">
                <?php if(!$pets){ ?>
                    <div class=''>
                        <p class='color-text'>Nenhum gato cadastrado.</p>
                    </div>
                <?php }else{ ?>

                <div class='card-content'>
                <?php foreach ($pets as $pet) { ?>
                    <div class="card-profile">
                        
                        <a href="pet_profile_page.php?pet=<?php echo ($pet['cod_pet'])?>">
                            <img class="img-profile" src="images/<?php echo ($pet['foto'])?>" alt="">
                            
                            <p><?php echo ($pet['nome']) ?></p>
                        </a>
                        
                        <a href="pet_page.php?delete=<?php echo ($pet['cod_pet'])?>" class='icon-delete-profile' >
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18ZM20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19ZM14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z" fill="white"/>
                            </svg>
                        </a>
                    </div>
                <?php } ?>
            
            </div>
            
           <?php } ?>
                    

                <div class='msg'>
                    <span class="msg-error">
                        <?php echo ($_SESSION["msg_error"]); ?>
                    </span>
                </div>

                <button id="add-pet-btn" class='btn-profile-position reset-btn-decoration'>
                    <svg width="43" height="43" viewBox="0 0 43 43" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M21.4993 12.5416C22.4889 12.5416 23.291 13.3438 23.291 14.3333V19.7083H28.666C29.6555 19.7083 30.4577 20.5104 30.4577 21.5C30.4577 22.4895 29.6555 23.2916 28.666 23.2916H23.291V28.6666C23.291 29.6561 22.4889 30.4583 21.4993 30.4583C20.5098 30.4583 19.7077 29.6561 19.7077 28.6666V23.2916H14.3327C13.3432 23.2916 12.541 22.4895 12.541 21.5C12.541 20.5104 13.3432 19.7083 14.3327 19.7083H19.7077V14.3333C19.7077 13.3438 20.5098 12.5416 21.4993 12.5416Z" fill="#BF6C2C"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M1.79102 21.5C1.79102 10.6153 10.6147 1.79163 21.4993 1.79163C32.384 1.79163 41.2077 10.6153 41.2077 21.5C41.2077 32.3846 32.384 41.2083 21.4993 41.2083C10.6147 41.2083 1.79102 32.3846 1.79102 21.5ZM21.4993 5.37496C12.5938 5.37496 5.37435 12.5944 5.37435 21.5C5.37435 30.4055 12.5938 37.625 21.4993 37.625C30.4049 37.625 37.6243 30.4055 37.6243 21.5C37.6243 12.5944 30.4049 5.37496 21.4993 5.37496Z" fill="#BF6C2C"/>
                    </svg>
                </button>
            </div>
        </section>

        <section id="form-add-pet" class="position-forms modal hidden">
            <div class='content-box'>
                <button id="btn-close-add-pet" class='close reset-btn-decoration'>
                    <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                    </svg>
                </button>
                
                <form action="pet_page.php?addPet" method="POST" enctype="multipart/form-data">
                    <h2>Informações do seu pet</h2>
                    <div class="form-container">
                        <div class="input-container">
                            <label for="name">Qual o nome do seu gatinho(a)? *</label>
                            <input type="text" id="name" name="name" placeholder="Bartholomeu" autocomplete="off" required>
                        </div>
                        <div class="input-container">
                            <label for="sex">Qual o sexo? *</label>
                            <select name="sex" id="sex" required>
                                <option value="Fêmea">Fêmea</option>
                                <option value="Macho">Macho</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <label for="birth">Data de nascimento:</label>
                            <input type="date" id="birth" max="<?php echo date('Y-m-d')?>" name="birth" placeholder="Data de nascimento" >
                        </div>
                        <div class="input-container">
                            <label for="breed">Qual a raça do seu felino? *</label>
                            <input type="text" class="validateString" id="breed" name="breed" placeholder="Viralata" autocomplete="off" required>
                        </div>

                        <div class="input-container">
                            <label for="file">Adicione uma foto do pet: *</label>
                            <input type="file" id="file" name="file" accept=".png, .jpg, .jpeg" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit" name="submit" value="submit">
                        Adicionar pet!
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