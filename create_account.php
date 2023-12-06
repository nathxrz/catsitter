<?php
    session_start();
    $style ="style_login";
    $title = 'Cadastro';
    $msg_error = '';
    $showArrow = true;

    require("./includes/components/functions.php");

    $_SESSION["msg_error"] = "";

    $_SESSION["msg_confirma_email"]= "";

    if(isset($_GET['create'])){
        if (isset($_POST['name']) and isset($_POST['lastname']) and isset($_POST['birth']) and isset($_POST['gender']) and isset($_POST['cpf']) and isset($_POST['telephone']) and isset($_POST['cep']) and isset($_POST['street']) and isset($_POST['number']) and isset($_POST['city']) and isset($_POST['state']) and isset($_POST['country']) and isset($_POST['email']) and isset($_POST['password']) and isset($_POST['PasswordConfirmation'])){ 
    
            $user = $_POST['type'];
    
            $name = $_POST['name'];
            $lastname = $_POST['lastname'];
            $birth = $_POST['birth'];
            $gender = $_POST['gender'];
            $cpf = $_POST['cpf'];
            $telephone = $_POST['telephone'];
    
            $cep = $_POST['cep'];
            $street = $_POST['street'];
            $number = $_POST['number'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $country = $_POST['country'];
            $complement = $_POST['complement'];
    
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
            $array = [$name, $lastname, $birth, $gender, $cpf, $cep, $street, $number, $city, $state, $country, $complement, $email, $password];
    
            $registerUser = registerUser($user, $cpf, $email, $telephone, $array, $pdo);
    
            if ($registerUser) {
                emailConfirmRegistration($email, $pdo);
                $_SESSION["msg_confirma_email"]="Confirme seu e-mail!";
                header("Location:login.php");
            } else {
                $_SESSION["msg_error"] = "Usuário existente.";
            }
        }else{
            $_SESSION["msg_error"] = "* Preencha todos os campos obrigatórios.";
        }
    }
    require("./includes/components/head.php");   
?>

<body>
    <?php
        require("./includes/components/header_login.php");
    ?>  
    <main>
        <section class="position-forms">
            <div class="content-box form-step-container">
                <form action="create_account.php?create" class="color-text" onsubmit="return validaCreateAccount()" method="POST">
                <!-- form 1 -->   
                    <div id="form-01" class="form-step"> 
                        <h2>Você é tutor ou cat sitter?</h2>
                        <div class='radio-container'>
                            <div class="input-radio" id="btn-type-user">
                                <label for="tutor">Tutor</label>
                                <input type="radio" id="tutor" name="type" value="tutor" checked/>
                            </div>
                            <div class="input-radio">
                                <label for="catsitter">Cat Sitter</label>
                                <input type="radio" id="catsitter" name="type" value="catsitter"/>
                            </div>
                        </div>
                    </div>
    
                    <!-- form 2 --> 
                    <div id="form-02" class="form-step hidden">
                        <h2>Informações pessoais</h2>
                        <div class="form-container">
                            <div class="input-container">
                                <label for="name">Nome *</label>
                                <input type="text" id="name" class="validateString" name="name" placeholder="Nome do usuário" autocomplete="off" required>
                            </div>
                            <div class="input-container">
                                <label for="lastname">Sobrenome *</label>
                                <input type="text" id="lastname" class="validateString" name="lastname" placeholder="Sobrenome" autocomplete="off" required>
                            </div>
                            <div class="input-container">
                                <label for="birth">Data de nascimento *</label>
                                <input type="date" id="birth" name="birth" max="<?php echo (date('Y-m-d', strtotime('-16 years'))) ?>" placeholder="Data de nascimento" autocomplete="off" required>
                            </div>
                            <div class="input-container">
                                <label for="gender">Gênero *</label>
                                <select name="gender" id="gender" required>
                                    <option value="Feminino">Feminino</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Outro">Outro</option>
                                    <option value="Não informado">Não informado</option>
                                </select>
                            </div>
                            <div class="input-container">
                                <label for="cpf">CPF *</label>
                                <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" autocomplete="off" required>
                            </div>
                            <div class="input-container">
                                <label for="telephone">Telefone *</label>
                                <input type="tel" id="telephone" name="telephone" placeholder="(xx) xxxxx-xxxx" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- form 3 --> 
                    <div id="form-03" class="form-step hidden">
                        <h2>Endereço</h2>
                        <div class='form-container'>
                            <div class="input-container">
                                <label for="cep">CEP *</label>
                                <input type="text" id="cep" name="cep" placeholder="xxxxx-xxx" autocomplete="off" required>
                            </div>

                            <div class="input-container input-row">
                                <div class='large'>
                                    <label for="street">Rua *</label>
                                    <input type="text" id="street" name="street" id='street' placeholder="Bento Martins" autocomplete="off" required>
                                </div>
                                <div class='small'>
                                    <label for="number">nº *</label>
                                    <input type="text" class="validateNumbers" id="number" name="number" id='number' placeholder="12345" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="input-container input-row">
                                <div class='medium'>
                                    <label for="city">Cidade *</label>
                                    <input type="text" class="validateString" id="city" name="city" id='city' placeholder="Pelotas" autocomplete="off" required>
                                </div>
                                <div class='medium'>
                                    <label for="state">Estado *</label>
                                    <input type="text" class="validateString" id="state" name="state" id='state' placeholder="RS" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="input-container input-row">
                                <div class='small'>
                                    <label for="country">País *</label>
                                    <input type="text" class="validateString" id="country" name="country" id='country' placeholder="Brasil" autocomplete="off" required>
                                </div>
                                <div class='large'>
                                    <label for="complement">Complemento</label>
                                    <input type="text" id="complement" name="complement" placeholder="bloco 2" autocomplete="off">
                                </div>
                            </div>
                        </div>
                     </div>
    
                    <!-- form 4 -->
                    <div id="form-04" class="form-step hidden">
                        <h2>Cadastro</h2>
                        <div class="form-container" >
                            <div class="input-container">
                                <label for="email">E-mail *</label>
                                <input type="email" id="email" name="email" placeholder="nome@exemplo.com" autocomplete="off" required>
                            </div>
                            <div class="input-container">
                                <label for="password">Senha *</label>
                                <input type="password" id="password" name="password" placeholder="********" autocomplete="off" required>
                            </div>
                            <div class="input-container">
                                <label for="PasswordConfirmation">Confirme sua senha *</label>
                                <input type="password" id="PasswordConfirmation" name="PasswordConfirmation" placeholder="********" autocomplete="off" required> 
                            </div>
        
                        </div>
                        
                        <button type="submit" id="btn-account" class='btn-submit'>
                            Criar conta!
                        </button>
                    </div>
                    <div class='arrows'>
                        <div>
                            <button type="button" class="reset-btn-decoration arrow-left hidden" id="arrow-left" alt="Ícone para voltar.">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.7071 4.29289C12.3166 3.90237 11.6834 3.90237 11.2929 4.29289L4.29289 11.2929C3.90237 11.6834 3.90237 12.3166 4.29289 12.7071L11.2929 19.7071C11.6834 20.0976 12.3166 20.0976 12.7071 19.7071C13.0976 19.3166 13.0976 18.6834 12.7071 18.2929L7.41421 13H19C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11H7.41421L12.7071 5.70711C13.0976 5.31658 13.0976 4.68342 12.7071 4.29289Z" fill="#0D3C43" fill-opacity="0.55"/>
                                </svg>
                            </button>
                        </div>
                        <div>
                            <button type="button" class="reset-btn-decoration arrow-right" id="arrow-Right" alt="Ícone para Avançar.">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.2929 4.29289C11.6834 3.90237 12.3166 3.90237 12.7071 4.29289L19.7071 11.2929C20.0976 11.6834 20.0976 12.3166 19.7071 12.7071L12.7071 19.7071C12.3166 20.0976 11.6834 20.0976 11.2929 19.7071C10.9024 19.3166 10.9024 18.6834 11.2929 18.2929L16.5858 13H5C4.44772 13 4 12.5523 4 12C4 11.4477 4.44772 11 5 11H16.5858L11.2929 5.70711C10.9024 5.31658 10.9024 4.68342 11.2929 4.29289Z" fill="#0D3C43"/>
                                </svg>

                            </button>
                        </div>
                    </div>
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