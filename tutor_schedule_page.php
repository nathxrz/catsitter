<?php
    session_start();
    $style ="style";
    $title = 'Agenda';

    require('./includes/components/authenticator.php');
    require('./includes/components/functions.php');

    $_SESSION["redirect"] = "tutor_schedule_page.php";

    tutorFirewall();

    if (isset($_GET['delete'])) {
        $cod_schedule = $_GET['delete'];
        $delete_schedule = deleteSchedule($cod_schedule, $pdo);
    }
    
    if(isset($_SESSION["cod_usuario"])){
        $schedules = searchSchedule($_SESSION['cod_usuario'], $pdo);
        $profile = searchUser($_SESSION["email"], $pdo);      
    }

    require("./includes/components/head.php");
?>

<body>
    <?php
        require("./includes/components/header.php");
    ?>

    <main>
        <section class='padding-form'>
            <div class="content-box position-content-schedule">
                <?php
                    if(isset($schedules) and !$schedules){ ?>
                        <div>
                            <p class='color-text'>Nenhum agendamento cadastrado.</p>
                        </div>
                <?php } else { 
                        foreach($schedules as $schedule) { 
                            $catsitter = searchUserCatSitterSchedule($schedule['cod_catsitter'], $pdo);
                        ?>
                <div class="card-schedule">

                    <a href="view_sitter_page.php?user=<?php echo $catsitter['cod_usuario']?>">
                        <img class="img-profile" src="images/<?php echo $catsitter['foto']?>" alt="Foto do usuário.">
                    </a>

                    <div class='appointment-information'>
                        <a href="view_sitter_page.php?user=<?php echo $catsitter['cod_usuario']?>">
                            <p><?php echo $catsitter['nome'] . " " . $catsitter['sobrenome'] ?></p>
                        </a>
                        <div>
                            <p>Dia: </p>
                            <span><?php echo date('d/m/Y', strtotime($schedule['dt_agendamento'])) ?></span>
                        </div>
                        <div>
                            <p>Horário: </p>
                            <span><?php echo $schedule['horario'] ?></span>
                        </div>
                        <div>
                            <p>Tipo: </p>
                            <span><?php if($schedule['cod_servico'] == 1){ echo ('Diária'); } else if($schedule['cod_servico'] == 2){ echo ('Diária com retorno'); } else { echo ('Transporte');}  ?></span>
                        </div>
                        <div>
                            <p>Endereço: </p>
                            <span><?php echo $profile['rua'] . ", " . $profile['numero'] . ". " .  $profile['cidade'] ?></span>
                        </div>
                        <div>
                        <?php 
                            $pets = searchPetsSchedule($schedule['cod_agendamento'], $pdo);
                        ?>
                            <p>Pets: </p>
                        <?php 
                            foreach($pets as $pet){
                        ?>
                            <span><a href="pet_profile_page.php?pet=<?php echo ($pet['cod_pet'])?>"><?php echo $pet['nome'] ?></a></span>
                        <?php } ?>
                        </div>
                    </div>

                    <div class='icons-shedule'>
                        <button class='reset-btn-decoration'>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                            </svg>
                        </button>

                        <a href="tutor_schedule_page.php?delete=<?php echo ($schedule['cod_agendamento'])?>" class='reset-btn-decoration'>
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0_39_10849)">
                                <path d="M10.9997 20.1667C16.0623 20.1667 20.1663 16.0627 20.1663 11C20.1663 5.93743 16.0623 1.83337 10.9997 1.83337C5.93706 1.83337 1.83301 5.93743 1.83301 11C1.83301 16.0627 5.93706 20.1667 10.9997 20.1667Z" stroke="#B50000" stroke-width="1.83333" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.51855 4.51917L17.4802 17.4808" stroke="#B50000" stroke-width="1.83333" stroke-linecap="round" stroke-linejoin="round"/>
                                </g>
                                <defs>
                                <clipPath id="clip0_39_10849">
                                <rect width="22" height="22" fill="white"/>
                                </clipPath>
                                </defs>
                            </svg>
                        </a>
                    </div>
                </div>
                <?php } } ?>

            </div>
        </section>
       
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>        
    
</body>
</html>