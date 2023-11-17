<?php
    $style ="style";
    $title = 'Home';

    session_start();

    require("./includes/components/head.php");
    require('./includes/components/connect.php');
    require('./includes/components/functions.php');


?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <?php
        require("./includes/components/header.php");
    ?>
    <main>
    <section class=''>
            <div class="content-box position-content">
                <h2>Distintivos</h2>

                <div class='badges-content'>
                    <div class='content-box info-container-profile'>
                        <p>Emergencial: </p>
                        <span>Está disponível para atendimentos emergenciais.</span>

                        <button class='close reset-btn-decoration'>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18ZM20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19ZM14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z" fill="#BF6C2C"/>
                            </svg>
                        </button>
                    </div>
                    
                    <div class='content-box info-container-profile'>
                        <p>Emergencial: </p>
                        <span>Está disponível para atendimentos emergenciais.</span>

                        <button class='close reset-btn-decoration'>
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 18C10.2652 18 10.5196 17.8946 10.7071 17.7071C10.8946 17.5196 11 17.2652 11 17V11C11 10.7348 10.8946 10.4804 10.7071 10.2929C10.5196 10.1054 10.2652 10 10 10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11V17C9 17.2652 9.10536 17.5196 9.29289 17.7071C9.48043 17.8946 9.73478 18 10 18ZM20 6H16V5C16 4.20435 15.6839 3.44129 15.1213 2.87868C14.5587 2.31607 13.7956 2 13 2H11C10.2044 2 9.44129 2.31607 8.87868 2.87868C8.31607 3.44129 8 4.20435 8 5V6H4C3.73478 6 3.48043 6.10536 3.29289 6.29289C3.10536 6.48043 3 6.73478 3 7C3 7.26522 3.10536 7.51957 3.29289 7.70711C3.48043 7.89464 3.73478 8 4 8H5V19C5 19.7956 5.31607 20.5587 5.87868 21.1213C6.44129 21.6839 7.20435 22 8 22H16C16.7956 22 17.5587 21.6839 18.1213 21.1213C18.6839 20.5587 19 19.7956 19 19V8H20C20.2652 8 20.5196 7.89464 20.7071 7.70711C20.8946 7.51957 21 7.26522 21 7C21 6.73478 20.8946 6.48043 20.7071 6.29289C20.5196 6.10536 20.2652 6 20 6ZM10 5C10 4.73478 10.1054 4.48043 10.2929 4.29289C10.4804 4.10536 10.7348 4 11 4H13C13.2652 4 13.5196 4.10536 13.7071 4.29289C13.8946 4.48043 14 4.73478 14 5V6H10V5ZM17 19C17 19.2652 16.8946 19.5196 16.7071 19.7071C16.5196 19.8946 16.2652 20 16 20H8C7.73478 20 7.48043 19.8946 7.29289 19.7071C7.10536 19.5196 7 19.2652 7 19V8H17V19ZM14 18C14.2652 18 14.5196 17.8946 14.7071 17.7071C14.8946 17.5196 15 17.2652 15 17V11C15 10.7348 14.8946 10.4804 14.7071 10.2929C14.5196 10.1054 14.2652 10 14 10C13.7348 10 13.4804 10.1054 13.2929 10.2929C13.1054 10.4804 13 10.7348 13 11V17C13 17.2652 13.1054 17.5196 13.2929 17.7071C13.4804 17.8946 13.7348 18 14 18Z" fill="#BF6C2C"/>
                            </svg>
                        </button>
                    </div>               
                </div>


                <button class='btn-profile-position reset-btn-decoration'>
                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M20.043 7.70866C20.043 6.85722 19.3527 6.16699 18.5013 6.16699C17.6499 6.16699 16.9596 6.85722 16.9596 7.70866V16.9587H7.70964C6.8582 16.9587 6.16797 17.6489 6.16797 18.5003C6.16797 19.3518 6.8582 20.042 7.70964 20.042H16.9596V29.292C16.9596 30.1434 17.6499 30.8337 18.5013 30.8337C19.3527 30.8337 20.043 30.1434 20.043 29.292V20.042H29.293C30.1444 20.042 30.8346 19.3518 30.8346 18.5003C30.8346 17.6489 30.1444 16.9587 29.293 16.9587H20.043V7.70866Z" fill="#BF6C2C"/>
                    </svg>
                </button>
            </div>
        </section>

        <section class="position-forms modal hidden">
            <div class="content-box">
                <form action="adm_home_page.php" method="POST">

                    <button class='close reset-btn-decoration'>
                        <svg width="25" height="25" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20.6742 18.5L30.3867 8.8029C30.677 8.5126 30.8401 8.11886 30.8401 7.70831C30.8401 7.29777 30.677 6.90403 30.3867 6.61373C30.0964 6.32343 29.7027 6.16034 29.2921 6.16034C28.8816 6.16034 28.4879 6.32343 28.1976 6.61373L18.5005 16.3262L8.80339 6.61373C8.51309 6.32343 8.11936 6.16034 7.70881 6.16034C7.29826 6.16034 6.90453 6.32343 6.61423 6.61373C6.32392 6.90403 6.16083 7.29777 6.16083 7.70831C6.16083 8.11886 6.32392 8.5126 6.61423 8.8029L16.3267 18.5L6.61423 28.1971C6.46973 28.3404 6.35504 28.5109 6.27677 28.6988C6.1985 28.8866 6.1582 29.0881 6.1582 29.2916C6.1582 29.4952 6.1985 29.6967 6.27677 29.8845C6.35504 30.0724 6.46973 30.2429 6.61423 30.3862C6.75754 30.5307 6.92805 30.6454 7.11592 30.7237C7.30379 30.802 7.50529 30.8423 7.70881 30.8423C7.91233 30.8423 8.11383 30.802 8.3017 30.7237C8.48956 30.6454 8.66007 30.5307 8.80339 30.3862L18.5005 20.6737L28.1976 30.3862C28.3409 30.5307 28.5114 30.6454 28.6993 30.7237C28.8871 30.802 29.0886 30.8423 29.2921 30.8423C29.4957 30.8423 29.6972 30.802 29.885 30.7237C30.0729 30.6454 30.2434 30.5307 30.3867 30.3862C30.5312 30.2429 30.6459 30.0724 30.7242 29.8845C30.8025 29.6967 30.8427 29.4952 30.8427 29.2916C30.8427 29.0881 30.8025 28.8866 30.7242 28.6988C30.6459 28.5109 30.5312 28.3404 30.3867 28.1971L20.6742 18.5Z" fill="#326B73"/>
                        </svg>
                    </button>
                
                    <h2>Inserir novo distintivo</h2>
                    <div class='form-container'>
                        <div class="input-container">
                            <label for="name">Nome</label>
                            <input type="text" id="name" name="name" placeholder="Cuidados especiais" autocomplete="off" required>
                        </div>

                        <div class="input-container" >
                            <label for="descr">Descrição</label>
                            <textarea name="descr" id="descr" cols="30" rows="10"></textarea>
                        </div>
                    </div>
    
                    <button type="submit" class="btn-submit" name="login" value="login">
                        Adicionar!
                    </button>
                    
                </form>
            </div>
        </section>

        <section class=''>
            <div class='content-box position-content'>
                <div class='position-filter'>
                    <div class='radio-adm-content'>
                        <label class='radio-adm-input'>
                            <input type="radio" id="tudo" name="type" value="tudo" checked/>
                            <p>Tudo</p>
                        </label>

                        <label class='radio-adm-input'>
                            <input type="radio" id="tutor" name="type" value="tutor"/>
                            <p>Tutor</p>
                        </label>

                        <label class='radio-adm-input'>
                            <input type="radio" id="catsitter" name="type" value="catsitter"/>
                            <p>Cat sitter</p>
                        </label>
                    </div>

                    <div class='input-container'>
                        <input type="text" placeholder='Pesquisar Cat sitter'>
                    </div>
                </div>
                
                <!-- modal de confirmação de agendamento -->
                <div class='card-content'>
                    <div class="card-profile">
                        <a href=""><img class="img-profile" src="images/foto.png" alt=""></a>
                        <p>Nome completo</p>
                        <button class='btn-mark'>
                            Agendar!
                        </button>
                        
                        <a href="">
                            <svg class="chat" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-profile">
                        <a href=""><img class="img-profile" src="images/foto.png" alt=""></a>
                        <p>Nome completo</p>
                        <button class='btn-mark'>
                            Agendar!
                        </button>
                        
                        <a href="">
                            <svg class="chat" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-profile">
                        <a href=""><img class="img-profile" src="images/foto.png" alt=""></a>
                        <p>Nome completo</p>
                        <button class='btn-mark'>
                            Agendar!
                        </button>
                        
                        <a href="">
                            <svg class="chat" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-profile">
                        <a href=""><img class="img-profile" src="images/foto.png" alt=""></a>
                        <p>Nome completo</p>
                        <button class='btn-mark'>
                            Agendar!
                        </button>
                        
                        <a href="">
                            <svg class="chat" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                            </svg>
                        </a>
                    </div>

                    <div class="card-profile">
                        <a href=""><img class="img-profile" src="images/foto.png" alt=""></a>
                        <p>Nome completo</p>
                        <button class='btn-mark'>
                            Agendar!
                        </button>
                        
                        <a href="">
                            <svg class="chat" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.99987 11C7.80208 11 7.60875 11.0586 7.4443 11.1685C7.27985 11.2784 7.15167 11.4346 7.07599 11.6173C7.0003 11.8 6.9805 12.0011 7.01908 12.1951C7.05767 12.3891 7.15291 12.5673 7.29276 12.7071C7.43261 12.847 7.61079 12.9422 7.80478 12.9808C7.99876 13.0194 8.19982 12.9996 8.38255 12.9239C8.56528 12.8482 8.72145 12.72 8.83134 12.5556C8.94122 12.3911 8.99987 12.1978 8.99987 12C8.99987 11.7348 8.89451 11.4804 8.70697 11.2929C8.51944 11.1054 8.26508 11 7.99987 11ZM11.9999 11C11.8021 11 11.6087 11.0586 11.4443 11.1685C11.2798 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.1529 12.5673 11.2928 12.7071C11.4326 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1998 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8313 12.5556C12.9412 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8945 11.4804 12.707 11.2929C12.5194 11.1054 12.2651 11 11.9999 11ZM15.9999 11C15.8021 11 15.6087 11.0586 15.4443 11.1685C15.2798 11.2784 15.1517 11.4346 15.076 11.6173C15.0003 11.8 14.9805 12.0011 15.0191 12.1951C15.0577 12.3891 15.1529 12.5673 15.2928 12.7071C15.4326 12.847 15.6108 12.9422 15.8048 12.9808C15.9988 13.0194 16.1998 12.9996 16.3825 12.9239C16.5653 12.8482 16.7215 12.72 16.8313 12.5556C16.9412 12.3911 16.9999 12.1978 16.9999 12C16.9999 11.7348 16.8945 11.4804 16.707 11.2929C16.5194 11.1054 16.2651 11 15.9999 11ZM11.9999 2C10.6866 2 9.38629 2.25866 8.17303 2.7612C6.95978 3.26375 5.85738 4.00035 4.9288 4.92893C3.05343 6.8043 1.99987 9.34784 1.99987 12C1.99112 14.3091 2.79066 16.5485 4.25987 18.33L2.25987 20.33C2.12111 20.4706 2.02711 20.6492 1.98974 20.8432C1.95236 21.0372 1.97329 21.2379 2.04987 21.42C2.13292 21.5999 2.26757 21.7511 2.43671 21.8544C2.60586 21.9577 2.80187 22.0083 2.99987 22H11.9999C14.652 22 17.1956 20.9464 19.0709 19.0711C20.9463 17.1957 21.9999 14.6522 21.9999 12C21.9999 9.34784 20.9463 6.8043 19.0709 4.92893C17.1956 3.05357 14.652 2 11.9999 2ZM11.9999 20H5.40987L6.33987 19.07C6.52612 18.8826 6.63066 18.6292 6.63066 18.365C6.63066 18.1008 6.52612 17.8474 6.33987 17.66C5.03045 16.352 4.21504 14.6305 4.03256 12.7888C3.85007 10.947 4.31181 9.09901 5.33909 7.55952C6.36638 6.02004 7.89566 4.88436 9.66638 4.34597C11.4371 3.80759 13.3397 3.8998 15.0501 4.60691C16.7604 5.31402 18.1727 6.59227 19.0463 8.22389C19.9199 9.85551 20.2007 11.7395 19.841 13.555C19.4813 15.3705 18.5032 17.005 17.0734 18.1802C15.6436 19.3554 13.8506 19.9985 11.9999 20Z" fill="#326B73"/>
                            </svg>
                        </a>
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