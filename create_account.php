<?php
    $style ="style_login";
    $title = 'Cadastro';

    session_start();
        
    require("./includes/components/functions.php");
    require("./includes/components/head.php");

    $_SESSION["msg_confirma"] = "";
    $_SESSION["msg_error"] = "";

    if (isset($_POST['name']) and isset($_POST['cpf']) and isset($_POST['email']) and isset($_POST['password'])) { 

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
            $_SESSION["msg_confirma"]="Confirme seu e-mail!";
            header("Location:login.php");
        } else {
            $_SESSION["msg_error"] = "Usuário existente.";
        }
    }
        
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <?php
        require("./includes/components/headerLogin.php");
    ?>  
    <main>
        <section class="position-content-login">
            <div class="content-box">
                <form action="create_account.php" method="POST">
                <!-- form 1 -->   
                    <div class="disable"> 
                        <h2>Você é tutor ou cat sitter?</h2>
                        <div class='radio-container'>
                            <div class="input-radio">
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
                    <div class="disable" >
                        <h2>Informações pessoais</h2>
                        <div class="input-container">
                            <div>
                                <label for="name">Nome</label>
                                <input type="text" id="name" name="name" placeholder="Nome do usuário" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="lastname">Sobrenome</label>
                                <input type="text" id="lastname" name="lastname" placeholder="Sobrenome" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="birth">Data de nascimento</label>
                                <input type="date" id="birth" name="birth" placeholder="Data de nascimento" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="gender">Gênero</label>
                                <select name="gender" id="gender">
                                    <option value="Feminino">Feminino</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Outro">Outro</option>
                                    <option value="Não informado">Não informado</option>
                                </select>
                            </div>
                            <div>
                                <label for="cpf">CPF</label>
                                <input type="text" id="cpf" name="cpf" placeholder="xxx.xxx.xxx-xx" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="telephone">Telefone</label>
                                <input type="text" id="telephone" name="telephone" placeholder="(xx) xxxxx-xxxx" autocomplete="off" required>
                            </div>
                        </div>
                    </div>
                    
                    <!-- form 3 --> 
                    <div class="disable">
                        <h2>Endereço</h2>
                        <div class='input-container'>
                            <div>
                                <label for="cep">CEP</label>
                                <input type="text" id="cep" name="cep" placeholder="xxxxx-xxx" autocomplete="off" required>
                            </div>

                            <div class="input-row">
                                <div class='large'>
                                    <label for="street">Rua</label>
                                    <input type="text" id="street" name="street" placeholder="Bento Martins" autocomplete="off" required>
                                </div>
                                <div class='small'>
                                    <label for="number">nº</label>
                                    <input type="text" id="number" name="number" placeholder="12345" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="input-row">
                                <div class='medium'>
                                    <label for="city">Cidade</label>
                                    <input type="text" id="city" name="city" placeholder="Pelotas" autocomplete="off" required>
                                </div>
                                <div class='medium'>
                                    <label for="state">Estado</label>
                                    <input type="text" id="state" name="state" placeholder="RS" autocomplete="off" required>
                                </div>
                            </div>

                            <div class="input-row">
                                <div class='small'>
                                    <label for="country">País</label>
                                    <input type="text" id="country" name="country" placeholder="Brasil" autocomplete="off" required>
                                </div>
                                <div class='large'>
                                    <label for="complement">Complemento</label>
                                    <input type="text" id="complement" name="complement" placeholder="bloco 2" autocomplete="off">
                                </div>
                            </div>
                        </div>
                     </div>
    
                    <!-- form 4 -->
                    <div class="">
                        <h2>Cadastro</h2>
                        <div class="input-container" >
                            <div>
                                <label for="email">E-mail</label>
                                <input type="email" id="email" name="email" placeholder="nome@exemplo.com" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="password">Senha</label>
                                <input type="password" id="password" name="password" placeholder="********" autocomplete="off" required>
                            </div>
                            <div>
                                <label for="PasswordConfirmation">Senha</label>
                                <input type="password" id="PasswordConfirmation" name="PasswordConfirmation" placeholder="********" autocomplete="off" required>
                            </div>
        
                            <button type="submit" class='btn-submit'>
                                Criar conta!
                            </button>
                        </div>
                    </div>
                    <div class='arrows'>
                        <img src="images/icons/iconLeft.svg" alt="Ícone para voltar.">
                        <img src="images/icons/iconRight.svg" alt="Ícone para prosseguir.">
                    </div>
                </form>
            </div>

            <div>
                <span class="msg-error">
                <?php
                    echo ($_SESSION["msg_confirma"]);
                ?>
                <?php
                    echo ($_SESSION["msg_error"]);
                ?>
                </span>
            </div>
        </section>
    </main>

    <?php
        require("./includes/components/footer.php");
    ?>    
    
</body>
</html>