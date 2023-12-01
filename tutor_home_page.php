<?php
    session_start();
    $style ="style";
    $title = 'Home';
    
    require('./includes/components/connect.php');
    require('./includes/components/functions.php');
    require('./includes/components/authenticator.php');

    $_SESSION["msg_error"] = "";
    $_SESSION["redirect"] = "tutor_home_page.php";

    if(isset($_SESSION["cod_usuario"])){
        $pets = searchPets($_SESSION["cod_usuario"], $pdo);
        $profile = searchUser($_SESSION["email"], $pdo);
        $badges = badgeSearch($pdo);
    }

    if(!isset($_POST['pets']) and isset($_POST['btn-search'])){
        $_SESSION["msg_error"] = "Selecione os animais.";
    }else if(isset($_POST['pets']) and isset($_POST['type']) and isset($_POST['address']) and isset($_POST['date']) and isset($_POST['time'])){

            $array = [$_POST['date'], $_POST['time']];
            $sittersAvailable = searchCatSitters($array, $pdo);

            $sittersInfo = searchUserCatSitter($_SESSION["cod_usuario"], $pdo);
    }

    if(isset($_GET['schedule'])){
        $sitter = $_POST['sitter'];
        $type = $_POST['type'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $pets_schedule = $_POST['pets'];

        $array = [$type, $date, $time, $sitter, $_SESSION["cod_usuario"]];

        newSchedule($array, $pets_schedule, $pdo);

        $link = "tutor_schedule_page.php";
        redirect($link);
    }

    if(isset($_GET['filter'])){
        if($_POST['filter'] == ''){
            $array = [$_POST['date'], $_POST['time']];
            $sittersAvailable = searchCatSitters($array, $pdo);
        }else{
            $array = [$_POST['filter'], $_POST['date'], $_POST['time']];
            $sittersAvailable = searchCatSittersFilter($array, $pdo);
        }

        $sittersInfo = searchUserCatSitter($_SESSION["cod_usuario"], $pdo);
    }
    require("./includes/components/head.php");
?>

<body>
    <?php
        require("./includes/components/header.php");
    ?>
    <main>
        <section>
            <div class="content-box position-content">
                <form action="tutor_home_page.php" method="POST">
                    <div class='form-container'>
                        <div class='radio-container'>
                            <label class='radio-input'>
                                <input type="radio" id="diaria" name="type" value="1" <?php if(isset($_POST['type']) and $_POST['type'] == '1') echo ("checked"); if(!isset($_POST['type']))  echo ("checked") ?>/>
                                <div>
                                    <p>Diária:</p>
                                    <span>Visitas com duração de 45 min a 1h.</span>
                                </div>
                            </label>
    
                            <label class='radio-input'>
                                <input type="radio" id="retorno" name="type" value="2" <?php if(isset($_POST['type']) and $_POST['type'] == '2') echo ("checked")?> />
                                <div>
                                    <p>Diária com retorno:</p>
                                    <span>Visitas que necessitem que o cat sitter retorne no mesmo dia.</span>
                                </div>
                            </label>
    
                            <!-- <label class='radio-input'>
                                <input type="radio" id="emergencial" name="type" value="emergencial"/>
                                <div>
                                    <p>Emergencial:</p>
                                    <span>Busca cat sitters que estão disponíveis para atendimentos emergenciais.</span>
                                </div>
                            </label> -->
    
                            <label class='radio-input'>
                                <input type="radio" id="transporte" name="type" value="3" <?php if(isset($_POST['type']) and $_POST['type'] == '3') echo ("checked")?> />
                                <div>
                                    <p>Transporte:</p>
                                    <span>Busca cat sitters que estão disponíveis para atendimentos emergenciais.</span>
                                </div>
                            </label>
    
                            <!-- <label class='radio-input disable'>
                                <input type="radio" id="especial" name="type" value="especial" disabled/>
                                <div>
                                    <p>Especial:</p>
                                    <span>Combinação de tipos de visitas em um determinado período.</span>
                                </div>
                            </label> -->
                        </div>

                        <div class='input-container form-details-container-position'>
                            <label class='width-input-schedule'>
                                <p>Endereço:</p>
                                <select name="address" id="address" required>
                                    <option value="">Selecione seu endereço:</option>
                                    <option value="" <?php if(isset($_POST['address'])) echo ("selected")?>><?php echo $profile['rua'] . ", " . $profile['numero'] . ". " .  $profile['cidade'] ?></option>
                                </select>
                            </label>

                            <label class='width-input-schedule'>
                                <p>Data do agendamento:</p>
                                <input type="date" id="date" name="date" placeholder="De: " autocomplete="off" min="<?php echo date('Y-m-d')?>" value="<?php if(isset($_POST['date']))  echo ($_POST['date'])?>" required>
                            </label> 
                            <label class='width-input-schedule'>
                                <p>Horário:</p>
                                <select name="time" required>
                                    <option value="">Selecione o horário da visita:</option>
                                    <option value="08:30" <?php if(isset($_POST['time']) and $_POST['time'] == '08:30') echo ("selected")?>>08:30</option>
                                    <option value="09:30" <?php if(isset($_POST['time']) and $_POST['time'] == '09:30') echo ("selected")?>>09:30</option>
                                    <option value="10:30" <?php if(isset($_POST['time']) and $_POST['time'] == '10:30') echo ("selected")?>>10:30</option>
                                    <option value="11:30" <?php if(isset($_POST['time']) and $_POST['time'] == '11:30') echo ("selected")?>>11:30</option>
                                    <option value="12:30" <?php if(isset($_POST['time']) and $_POST['time'] == '12:30') echo ("selected")?>>12:30</option>
                                    <option value="13:30" <?php if(isset($_POST['time']) and $_POST['time'] == '13:30') echo ("selected")?>>13:30</option>
                                    <option value="14:30" <?php if(isset($_POST['time']) and $_POST['time'] == '14:30') echo ("selected")?>>14:30</option>
                                    <option value="15:30" <?php if(isset($_POST['time']) and $_POST['time'] == '15:30') echo ("selected")?>>15:30</option>
                                    <option value="16:30" <?php if(isset($_POST['time']) and $_POST['time'] == '16:30') echo ("selected")?>>16:30</option>
                                    <option value="17:30" <?php if(isset($_POST['time']) and $_POST['time'] == '17:30') echo ("selected")?>>17:30</option>
                                    <option value="18:30" <?php if(isset($_POST['time']) and $_POST['time'] == '18:30') echo ("selected")?>>18:30</option>
                                    <option value="19:30" <?php if(isset($_POST['time']) and $_POST['time'] == '98:30') echo ("selected")?>>19:30</option>

                                </select>
                            </label>                     
                        </div>

                        <div class='form-details-container-position'>
                            <?php 
                                foreach($pets as $pet){ ?>
                                <label class='checkbox-container'>
                                    <input type="checkbox" name='pets[]' value="<?php echo $pet['cod_pet']?>" <?php if(isset($_POST['pets']) and in_array($pet['cod_pet'], $_POST['pets'])) echo('checked') ?> > 
                                    <p><?php echo $pet['nome']?></p>
                                </label>
                            <?php } ?>
                        </div>
                        
                        <button type="submit" class="btn-submit search" name="btn-search" value="submit">
                            Pesquisar!
                        </button>

                    </div>
                </form>

                <div class='msg'>
                    <span class="msg-error">
                        <?php
                            echo $_SESSION["msg_error"];
                        ?>
                    </span>
                </div>
            </div>
        </section>

        <?php
            if(isset($sittersAvailable)){ ?>
                <section class=''>
                    <div class='content-box position-content'>
                        <div class='input-container position-filter'>
                            <form action="tutor_home_page.php?filter" id="search-filter" method="POST">
                                <div class='search-input-filter'>
                                    <select name="filter" onchange="filterByBadge()">
                                        <option value="">Tudo</option>
                                        <?php 
                                            foreach($badges as $badge) {
                                        ?>
                                        <option value="<?php echo $badge['cod_distintivo']?>" <?php if(isset($_POST['filter']) and ($badge['cod_distintivo'] == $_POST['filter'])) echo ("selected")?>><?php echo $badge['nome']?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="hidden" name='type' value='<?php echo $_POST['type']?>'>
                                    <input type="hidden" name='address' value='<?php echo $_POST['address']?>'>
                                    <input type="hidden" name='date' value='<?php echo $_POST['date']?>'>
                                    <input type="hidden" name='time' value='<?php echo $_POST['time']?>'>
                                    <?php foreach($_POST['pets'] as $pet){?>
                                    <input type="hidden" name="pets[]" value="<?php echo $pet; ?>">
                                    <?php } ?>
                                    
                                    <button class='btn-search'>
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4 11C4 7.13401 7.13401 4 11 4C14.866 4 18 7.13401 18 11C18 12.8858 17.2543 14.5974 16.0417 15.8561C16.0073 15.8825 15.9743 15.9114 15.9428 15.9429C15.9113 15.9744 15.8824 16.0074 15.856 16.0418C14.5973 17.2543 12.8857 18 11 18C7.13401 18 4 14.866 4 11ZM16.6176 18.0319C15.078 19.2635 13.125 20 11 20C6.02944 20 2 15.9706 2 11C2 6.02944 6.02944 2 11 2C15.9706 2 20 6.02944 20 11C20 13.125 19.2635 15.0781 18.0319 16.6177L21.707 20.2929C22.0975 20.6834 22.0975 21.3166 21.707 21.7071C21.3165 22.0976 20.6833 22.0976 20.2928 21.7071L16.6176 18.0319Z" fill="#326B73"/>
                                        </svg>
                                    </button>
                                </div>

                            </form>
                        </div>

                        <?php 
                            if(!$sittersAvailable){ ?>

                            <div>
                                <p>Nenhum Cat sitter disponível neste horário</p>
                            </div>
                            <?php } ?>
                        <!-- modal de confirmação de agendamento -->
                        <div class='card-content'>
                            <?php 
                                foreach($sittersAvailable as $sitters) {
                                    ?>
                            <div class="card-profile">
                                <form action="tutor_home_page.php?schedule" method="POST">
                                    <a href="view_sitter_page.php?user=<?php echo $sitters['cod_usuario']?>"><img class="img-profile" src="images/<?php echo $sitters['foto']?>" alt=""></a>
                                    <a href="view_sitter_page.php?user=<?php echo $sitters['cod_usuario']?>">
                                        <p><?php echo $sitters['nome'] . " " . $sitters['sobrenome']?></p>
                                    </a>
                                    <p class='price-view'>R$ <?php echo $sitters['preco']?></p>
                                    <input type="hidden" name='sitter' value='<?php echo $sitters['cod_catsitter']?>'>
                                    <input type="hidden" name='type' value='<?php echo $_POST['type']?>'>
                                    <input type="hidden" name='address' value='<?php echo $_POST['address']?>'>
                                    <input type="hidden" name='date' value='<?php echo $_POST['date']?>'>
                                    <input type="hidden" name='time' value='<?php echo $_POST['time']?>'>
                                    <?php foreach($_POST['pets'] as $pet){?>
                                    <input type="hidden" name="pets[]" value="<?php echo $pet; ?>">
                                    <?php } ?>

                                    <button class='btn-mark'>
                                        Agendar!
                                    </button>
                                    
                                    <a href="">
                                        <svg class="chat" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                                        </svg>
                                        
                                    </a>
                                </form>
                            </div>
                            <?php } ?>
                            
                        </div>
                    </div>
                </section>       
        <?php } ?>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>        
    
    <script src='js/script.js'></script>
</body>
</html>