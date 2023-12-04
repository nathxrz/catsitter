<?php
    session_start();
    $style ="style";
    $title = 'Home';

    require('./includes/components/authenticator.php');
    require('./includes/components/connect.php');
    require('./includes/components/functions.php');

    $_SESSION["redirect"] = "adm_home_page.php";

    if (isset($_GET['delete'])) {
        $cod_badge= $_GET['delete'];
        $delete_badge = deleteBadge($cod_badge, $pdo);
    
        if ($delete_badge) {
            $_SESSION['msg-confirma'] = 'Distintivo excluído com sucesso!';

            $link = "adm_home_page.php";
            redirect($link);
        }
    }

    if (isset($_GET['deleteUser'])) {
        $user = $_GET['deleteUser'];
        $delete_user = deleteUser($user, $pdo);

        $link = "adm_home_page.php";
        redirect($link);
    }

    if(isset($_SESSION["cod_usuario"])){
        $profile = searchUser($_SESSION["email"], $pdo);
        $foneUser = getFoneById($_SESSION["cod_usuario"], $pdo);

        $badges = badgeSearch($pdo);
        $users = searchUsers($pdo);
    }

    if(isset($_GET['addBadge'])){
        if(isset($_POST['name']) and isset($_POST['descr'])){
            $name = $_POST['name'];
            $descr = $_POST['descr'];
            $array = [$name, $descr];
            
            $addBadge = registerBadge($array, $pdo);
    
            if($addBadge){
                $link = "adm_home_page.php";
                redirect($link);
            }else{
                $_SESSION['msg_error'] = "Não foi possível adicionar seu o distintivo :(";
            }
        }else{
            $_SESSION['msg_error'] = "Preencha todos os campos obrigatórios. *";
        }
    }

    if(isset($_GET["searchUsers"])){
        $search = $_POST["search"];
        $type = $_POST["type"];
        if($_POST["search"] != ''){
            $users = searchUsersName($search, $type, $pdo);
        }else{
            $users = searchUsersFilter( $type, $pdo);
        }
        
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
                <h2>Distintivos</h2>

                <div class='badges-content'>

                <?php 
                    if(!$badges){ ?>
                        <div class='info-container-profile'>
                            <p class='color-text'>Nenhum distintivo selecionado.</p>
                        </div>
                <?php }else{ 
                    
                    foreach($badges as $badge){ ?>
                    <div class='content-box info-container-profile badges-width'>
                        <p><?php echo $badge['nome'] ?>: </p>
                        <span><?php echo $badge['descricao'] ?></span>

                        <a href="adm_home_page.php?delete=<?php echo ($badge['cod_distintivo'])?>" class='close reset-btn-decoration'>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18ZM20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19ZM14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z" fill="#BF6C2C"/>
                            </svg>
                        </a>
                    </div>
                <?php } } ?>                   
                </div>

                <button id="btn-adm-add-badges" class='btn-profile-position reset-btn-decoration'>
                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.043 7.70866C20.043 6.85722 19.3527 6.16699 18.5013 6.16699C17.6499 6.16699 16.9596 6.85722 16.9596 7.70866V16.9587H7.70964C6.8582 16.9587 6.16797 17.6489 6.16797 18.5003C6.16797 19.3518 6.8582 20.042 7.70964 20.042H16.9596V29.292C16.9596 30.1434 17.6499 30.8337 18.5013 30.8337C19.3527 30.8337 20.043 30.1434 20.043 29.292V20.042H29.293C30.1444 20.042 30.8346 19.3518 30.8346 18.5003C30.8346 17.6489 30.1444 16.9587 29.293 16.9587H20.043V7.70866Z" fill="#BF6C2C"/>
                    </svg>
                </button>
            </div>
        </section>

        <!-- form distintivo -->
        <section id="form-adm-add-badges" class="position-forms modal hidden">
            <div class="content-box">
                <button id="btn-close-adm-add-badges" class='close reset-btn-decoration'>
                    <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                    </svg>
                </button>
                <form action="adm_home_page.php?addBadge" method="POST">
                    <h2>Inserir novo distintivo</h2>
                    <div class='form-container'>
                        <div class="input-container">
                            <label for="name">Nome *</label>
                            <input type="text" id="name" name="name" placeholder="Cuidados especiais" autocomplete="off" required>
                        </div>

                        <div class="input-container" >
                            <label for="descr">Descrição *</label>
                            <textarea name="descr" id="descr" cols="30" rows="10" required></textarea>
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Adicionar!
                    </button>
                    
                </form>
            </div>
        </section>

        <section>
            <div class='content-box position-content'>
                <form action="adm_home_page.php?searchUsers" method='POST'>
                    <div class='position-filter'>
                        <div class='radio-adm-content'>
                            <label class='radio-adm-input'>
                                <input type="radio" id="tudo" name="type" value="tudo" <?php if(isset($_POST['type']) and $_POST['type'] == 'tudo') echo 'checked' ?> checked/>
                                <p>Tudo</p>
                            </label>
    
                            <label class='radio-adm-input'>
                                <input type="radio" id="tutor" name="type" value="tutor" <?php if(isset($_POST['type']) and $_POST['type'] == 'tutor') echo 'checked' ?>/>
                                <p>Tutor</p>
                            </label>
    
                            <label class='radio-adm-input'>
                                <input type="radio" id="catsitter" name="type" value="catsitter" <?php if(isset($_POST['type']) and $_POST['type'] == 'catsitter') echo 'checked' ?>/>
                                <p>Cat sitter</p>
                            </label>
                        </div>
    
                        <div class='search-input badges-width'>
                            <input class="" type="text" placeholder='Pesquisar usuários' name='search' autocomplete="off">
                            <button type="submit" class="btn-search" name="submit" value="submit">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11C18 12.8858 17.2543 14.5974 16.0417 15.8561C16.0073 15.8825 15.9743 15.9114 15.9428 15.9429C15.9113 15.9744 15.8824 16.0074 15.856 16.0418C14.5973 17.2543 12.8857 18 11 18C7.13401 18 4 14.866 4 11ZM16.6176 18.0319C15.078 19.2635 13.125 20 11 20C6.02944 20 2 15.9706 2 11C2 6.02944 6.02944 2 11 2C15.9706 2 20 6.02944 20 11C20 13.125 19.2635 15.0781 18.0319 16.6177L21.707 20.2929C22.0975 20.6834 22.0975 21.3166 21.707 21.7071C21.3165 22.0976 20.6833 22.0976 20.2928 21.7071L16.6176 18.0319Z" fill="#326B73"/>
                                </svg>
                            </button>
                        </div>

                    </div>
                    
                    <!-- lista de usuários -->
                    <div class='card-content'>
                    <?php
                        if(isset($users) and !$users){ ?>
                            <div class='info-container-profile'>
                            <p class='color-text'>Nenhum usuário encontrado.</p>
                        </div>
                    <?php } else {
                        foreach($users as $user){ ?>

                        <div class="card-profile">
                            <a href="view_<?php if(checksIfTheUserIsASitter($user['cod_usuario'], $pdo)){ echo ('sitter'); } else { echo ('tutor');} ?>_page.php?user=<?php echo $user['cod_usuario']?>">
                                <img class="img-profile" src="images/<?php echo $user['foto']?>" alt="">
                            </a>
                            <p><?php echo $user['nome'] . " ". $user['sobrenome']?></p>

                            <a href="adm_home_page.php?deleteUser=<?php echo ($user['cod_usuario'])?>" class='icon-delete-profile' >
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18ZM20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19ZM14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z" fill="white"/>
                                </svg>
                            </a>
                        </div>
                    
                    <?php } } ?>

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