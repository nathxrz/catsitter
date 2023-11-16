<?php
    $style ="style";
    $title = 'Perfil';

    require("./includes/components/head.php");

?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <?php
        require("./includes/components/header.php");
    ?>

    <main> 
        <section class='profile position-content'>
            <button class="reset-btn-decoration close" >
                <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.6742 18.4998L30.3867 8.80271C30.677 8.51241 30.8401 8.11868 30.8401 7.70813C30.8401 7.29758 30.677 6.90385 30.3867 6.61355C30.0964 6.32325 29.7027 6.16016 29.2921 6.16016C28.8816 6.16016 28.4879 6.32325 28.1976 6.61355L18.5005 16.326L8.80339 6.61355C8.51309 6.32325 8.11936 6.16016 7.70881 6.16016C7.29826 6.16016 6.90453 6.32325 6.61423 6.61355C6.32392 6.90385 6.16083 7.29758 6.16083 7.70813C6.16083 8.11868 6.32392 8.51241 6.61423 8.80271L16.3267 18.4998L6.61423 28.1969C6.46973 28.3402 6.35504 28.5107 6.27677 28.6986C6.1985 28.8864 6.1582 29.0879 6.1582 29.2915C6.1582 29.495 6.1985 29.6965 6.27677 29.8844C6.35504 30.0722 6.46973 30.2427 6.61423 30.386C6.75754 30.5305 6.92805 30.6452 7.11592 30.7235C7.30379 30.8018 7.50529 30.8421 7.70881 30.8421C7.91233 30.8421 8.11383 30.8018 8.3017 30.7235C8.48956 30.6452 8.66007 30.5305 8.80339 30.386L18.5005 20.6735L28.1976 30.386C28.3409 30.5305 28.5114 30.6452 28.6993 30.7235C28.8871 30.8018 29.0886 30.8421 29.2921 30.8421C29.4957 30.8421 29.6972 30.8018 29.885 30.7235C30.0729 30.6452 30.2434 30.5305 30.3867 30.386C30.5312 30.2427 30.6459 30.0722 30.7242 29.8844C30.8025 29.6965 30.8427 29.495 30.8427 29.2915C30.8427 29.0879 30.8025 28.8864 30.7242 28.6986C30.6459 28.5107 30.5312 28.3402 30.3867 28.1969L20.6742 18.4998Z" fill="white"/>
                </svg>
            </button>

            <div class='user-info'>
                <img class="img-profile" src="images/foto.png" alt="">
                <h3>Nathalia Machado</h3>
            </div>

            <div class='card-profile-content'>

                <div class="content-box profile-content">
                    <h2>Informações básicas</h2>
    
                    <div class='info-container-profile'>
                        <p>Data de nascimento: </p>
                        <span>20/03/1999</span>
                    </div>
    
                    <div class='info-container-profile'>
                        <p>Gênero: </p>
                        <span>Femino</span>
                    </div>
    
                    <div class='info-container-profile'>
                        <p>CPF: </p>
                        <span>XXX.XXX.XXX.XX</span>
                    </div>

                    <div class='info-container-profile'>
                        <p>Telefone: </p>
                        <span>(XX) XXXXX-XXXX</span>
                    </div>
                </div>

                <div class="content-box profile-content">
                    <h2>Endereço</h2>

                    <div class='info-container-profile'>
                        <p>CEP: </p>
                        <span>XXXXX-XXX</span>
                    </div>

                    <div class='info-group-container'>
                        <div class='info-group'>
                            <div class='info-container-profile'>
                                <p>Rua: </p>
                                <span>Almirante Barroso</span>
                            </div>
    
                            <div class='info-container-profile'>
                                <p>Cidade: </p>
                                <span>Pelotas</span>
                            </div>
    
                            <div class='info-container-profile'>
                                <p>País: </p>
                                <span>Brasil</span>
                            </div>
            
                        </div>
                        
                        <div class='info-group'>
                            <div class='info-container-profile'>
                                <p>nº: </p>
                                <span>2733</span>
                            </div>
        
                            <div class='info-container-profile'>
                                <p>Estado: </p>
                                <span>Rio Grande do Sul</span>
                            </div>
    
                            <div class='info-container-profile'>
                                <p>Complemento: </p>
                                <span>ap. 301b</span>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="content-box profile-content">
                        <h2>Informações de Cadastro</h2>
    
                        <div class='info-container-profile'>
                            <p>Pets: </p>
                              <a href="view_pet_page.php">Bartholomeu</a>
                              <a href="view_pet_page.php">Bartholomeu</a>
                        </div>
                    </div>
            </div>
        </section>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>        
    
</body>
</html>