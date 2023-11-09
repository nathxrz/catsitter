<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require("connect.php");

function registerUser($user, $cpf, $email, $telephone, $array, $pdo){
    $query_registration = $pdo->prepare('select * from usuarios where cpf = :cpf or email = :email'); //o cat sitter pode ja ter cadastro como tutor, preciso validar aqui!
    $query_registration->bindValue(':cpf', $cpf);
    $query_registration->bindValue(':email', $email);
    $query_registration->execute();

    if($query_registration->rowCount() === 0){
        $registre_user = $pdo->prepare('insert into usuarios (nome, sobrenome, dt_nascimento, genero, cpf, cep, rua, numero, cidade, estado, pais, complemento, email, senha) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $registre_user->execute($array);

        if($user == 'catsitter'){
            $cod_user = searchUser($email, $pdo);

            $registre_user_catssiter = $pdo->prepare('insert into cat_sitters (cod_usuario) values (:cod_usuario)');
            $registre_user_catssiter->bindValue(':cod_usuario', $cod_user['cod_usuario']);
            $registre_user_catssiter->execute();

            return true;
        }

        return true;

    }else{
        return false;
    }
}

function validateLogin($email, $formPassword, $pdo){
    $query= searchUser($email, $pdo);
  
    if($query){
        $storedPassword = $query['senha'];
        if(password_verify($formPassword, $storedPassword)){
            return $query;      
        }else{
            return false;
        }
    }else{
        return false;
    }
}

function searchUser($email, $pdo){
    $user = $pdo->prepare('select * from usuarios where email = :email');
    $user->bindValue(':email', $email);
    $user->execute();
    
    return $user->fetch();
}

function emailConfirmRegistration($email, $pdo){
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    require "PHPMailer/src/Exception.php";

    $hash = md5($email);
    $title = "Confirme seu cadastro!";

    $message = "<p>Seja bem-vindo(a) a nossa plataforma de agendamentos de cat sitter! Para confirmar seu cadastro <a href='http://localhost/catsitter/confirmRegistration.php?email=$hash' >clique aqui</a> e utilize nossos serviços! </p>";

    // $mensagem = "<p>Seja bem-vindo(a) a nossa plataforma de agendamentos de cat sitter! Para confirmar seu cadastro <a href='https://aulatsiaula.000webhostapp.com/projeto/confirmRegistration.php?email=$hash' >clique aqui</a> e utilize nossos serviços! </p>";

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    $mail->Username = 'nathaliaMailerPhp@gmail.com';
    $mail->Password = 'v m m u d a r r w s e o d z i t';

    $mail->setFrom('nathaliaMailerPhp@gmail.com','CatSitters');

    $mail->addAddress($email);

    $mail->CharSet = "utf-8";

    $mail->Subject = $title;

    $mail->Body = $message;

    $mail->isHTML(true);

    $mail->send();
}

function confirmRegistration($email, $pdo){
    $update = $pdo->prepare('update usuarios set confirma_email = 1 where md5(email) = :email');
    $update->bindValue(':email', $email);
    $update->execute();
}

function sendLoginEmail($email){ 
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    require "PHPMailer/src/Exception.php";

    $assunto = "Acesso na Plataforma!";
    $mensagem = "<p>Olá, você acessou a nossa plataforma de agendamento de serviços a domicílio. Seja bem-vindo(a)!</p>";

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    $mail->Username = 'nathaliaMailerPhp@gmail.com';
    $mail->Password = 'v m m u d a r r w s e o d z i t';

    $mail->setFrom('nathaliaMailerPhp@gmail.com','Catsitters');

    $mail->addAddress($email);

    $mail->CharSet = "utf-8";

    $mail->Subject = $assunto;

    $mail->Body = $mensagem;

    $mail->isHTML(true);

    $mail->send();
}

function createRequestToChangePassword($user, $key, $pdo){
    $request = $pdo->prepare('insert into recuperacao_senha (email, confirmacao) values (:user,:key)');
    $request->bindValue(':user', $user);
    $request->bindValue(':key', $key);
    $request->execute();       
}

function updatePassword($array, $pdo){
    $query = $pdo->prepare('update usuarios set senha = ? where md5(email) = ?');
    $query->execute($array);

    return true;
}

function sendEmailToChangePassword($email, $key, $pdo){
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    require "PHPMailer/src/Exception.php";

    $hash = md5($email);
    $title = "Alteração de senha";
    $message = "Você solicitou a alteração de senha da nossa plataforma, clique no link a seguir para inserir sua nova senha. <a href='http://localhost/catsitter/formToEnterNewPassword.php?email=$hash&confirmacao=$key' >Criar nova senha</a>";

    $mail = new PHPMailer();

    $mail->isSMTP();

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    $mail->Username = 'nathaliaMailerPhp@gmail.com';
    $mail->Password = 'v m m u d a r r w s e o d z i t';

    $mail->setFrom('nathaliaMailerPhp@gmail.com','Catsitters');

    $mail->addAddress($email);

    $mail->CharSet = "utf-8";

    $mail->Subject = $title;

    $mail->Body = $message;

    $mail->isHTML(true);

    $mail->send();
}

function checkKey($email, $key, $pdo){
    $check_key = $pdo->prepare('select * from recuperacao_senha where md5(email) = :email and confirmacao = :key');
    $check_key->bindValue(':email', $email);
    $check_key->bindValue(':key', $key);
    $check_key->execute();

    if($check_key->rowCount() === 1){
        return true;
    }else{
        return false;
    }
}

function deleteRequest($email, $key, $pdo){
    $delete_request = $pdo->prepare('delete from recuperacao_senha where md5(email) = :email and confirmacao = :key');
    $delete_request->bindValue(':email', $email);
    $delete_request->bindValue(':key', $key);
    $delete_request->execute();
}


// function pesquisaPessoas($nome, $pdo){
//     $pessoas = $pdo->prepare('select * from pessoa where nome like :nome"%" and adm = 0 order by nome asc');
//     $pessoas->bindValue(':nome', $nome);
//     $pessoas->execute();

//     if($pessoas->rowCount() === 0){
//         return false;
//     }else{
//         return $pessoas->fetchAll();
//     }
// }

// function excluiUsuario($codpessoa, $pdo){
//     $excluiUsuario = $pdo->prepare('delete from pessoa where codpessoa = :codpessoa');
//     $excluiUsuario->bindValue(':codpessoa', $codpessoa);
//     $excluiUsuario->execute();

//     return true;
// }

// function selecionaPessoa($codpessoa, $pdo){
//     $pessoa = $pdo->prepare('select * from pessoa where codpessoa = :codpessoa');
//     $pessoa->bindValue(':codpessoa', $codpessoa);
//     $pessoa->execute();

//     return $pessoa->fetch();
// }

// function verificaAdm($email, $pdo){
//     $pessoa = $pdo->prepare('select * from pessoa where email = :email and adm = 1');
//     $pessoa->bindValue(':email', $email);
//     $pessoa->execute();

//     if($pessoa->rowCount() === 1){
//         return true;
//     }else{
//         return false;
//     }
// }

// function editaPerfil($codpessoa, $nome, $cpf, $email, $pdo){
//     $pesquisaDuplicacaoPessoa = $pdo->prepare('select * from pessoa where (cpf = :cpf or email = :email) and codpessoa != :codpessoa');
//     $pesquisaDuplicacaoPessoa->bindValue(':cpf', $cpf);
//     $pesquisaDuplicacaoPessoa->bindValue(':email', $email);
//     $pesquisaDuplicacaoPessoa->bindValue(':codpessoa', $codpessoa);
//     $pesquisaDuplicacaoPessoa->execute();

//     if($pesquisaDuplicacaoPessoa->rowCount() === 0){
//         $editaPessoa = $pdo->prepare('update pessoa set nome = :nome, cpf = :cpf, email = :email where codpessoa = :codpessoa');
//         $editaPessoa->bindValue(':nome', $nome);
//         $editaPessoa->bindValue(':cpf', $cpf);
//         $editaPessoa->bindValue(':email', $email);
//         $editaPessoa->bindValue(':codpessoa', $codpessoa);
//         $editaPessoa->execute();

//         return true;
//     }else{
//         return false;
//     }
// }



// function enviaEmailParaEditarSenha($email, $pdo){

//     require "PHPMailer/src/PHPMailer.php";
//     require "PHPMailer/src/SMTP.php";
//     require "PHPMailer/src/Exception.php";

//     $hash = md5($email);
//     $assunto = "Recuperação de senha";
//     $mensagem = "<a href='https://aulatsiaula.000webhostapp.com/projeto/formEditaSenha.php?email=$hash' >RECUPERAR SENHA</a>";

//     $mail = new PHPMailer();

//     $mail->isSMTP();

//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

//     $mail->SMTPDebug = 0;
//     $mail->SMTPAuth = true;

//     $mail->Host = 'smtp.gmail.com';
//     $mail->Port = 587;
//     $mail->SMTPOptions = [
//         'ssl' => [
//             'verify_peer' => false,
//             'verify_peer_name' => false,
//             'allow_self_signed' => true,
//         ]
//     ];

//     $mail->Username = 'nathaliaMailerPhp@gmail.com';
//     $mail->Password = 'v m m u d a r r w s e o d z i t';

//     $mail->setFrom('nathaliaMailerPhp@gmail.com','Catsitters');

//     $mail->addAddress($email);

//     $mail->CharSet = "utf-8";

//     $mail->Subject = $assunto;

//     $mail->Body = $mensagem;

//     $mail->isHTML(true);

//     $mail->send();
// }


?>