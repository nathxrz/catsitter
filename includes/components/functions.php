<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require("connect.php");

function registerUser($user, $cpf, $email, $telephone, $array, $pdo){
    $query_registration = $pdo->prepare('select * from usuarios where cpf = :cpf or email = :email');
    $query_registration->bindValue(':cpf', $cpf);
    $query_registration->bindValue(':email', $email);
    $query_registration->execute();

    if($query_registration->rowCount() === 0){
        $register_user = $pdo->prepare('insert into usuarios (nome, sobrenome, dt_nascimento, genero, cpf, cep, rua, numero, cidade, estado, pais, complemento, email, senha) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $register_user->execute($array);

        $cod_user= $pdo->lastInsertId();

        $register_fone = $pdo->prepare('insert into telefones (telefone, cod_usuario) values (:telephone, :user)');
        $register_fone->bindValue(':telephone', $telephone);
        $register_fone->bindValue(':user', $cod_user);
        $register_fone->execute();

        if($user == 'catsitter'){

            $register_user_catssiter = $pdo->prepare('insert into cat_sitters (cod_usuario) values (:cod_usuario)');
            $register_user_catssiter->bindValue(':cod_usuario', $cod_user);
            $register_user_catssiter->execute();

            return true;
        }

        return true;

    }else{
        return false;
    }
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
    $mail->Password = 'ggex vuer fngu pver';

    $mail->setFrom('nathaliaMailerPhp@gmail.com','CatSitters');

    $mail->addAddress($email);

    $mail->CharSet = "utf-8";

    $mail->Subject = $title;

    $mail->Body = $message;

    $mail->isHTML(true);

    $mail->send();
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

function searchUserCod($cod, $pdo){
    $user = $pdo->prepare('select * from usuarios where cod_usuario = :cod');
    $user->bindValue(':cod', $cod);
    $user->execute();
    
    return $user->fetch();
}

function getFoneById($cod_usuario, $pdo){
    $fone = $pdo->prepare('select * from telefones where cod_usuario = :cod_usuario');
    $fone->bindValue(':cod_usuario', $cod_usuario);
    $fone->execute();
    
    return $fone->fetch();
}

function searchUserCatSitter($user, $pdo){
    $user_catsitter = $pdo->prepare('select * from cat_sitters where cod_usuario = :user');
    $user_catsitter->bindValue(':user', $user);
    $user_catsitter->execute();
    
    return $user_catsitter->fetch();
}

function searchUserCatSitterSchedule($user, $pdo){
    $user_catsitter = $pdo->prepare('select * from usuarios u left join cat_sitters c using (cod_usuario) where cod_catsitter = :user');
    $user_catsitter->bindValue(':user', $user);
    $user_catsitter->execute();
    
    return $user_catsitter->fetch();
}

function searchPetsSchedule($cod_agend, $pdo){
    $pets = $pdo->prepare('select * from gatos g left join agendamento_pets ap using (cod_pet) where ap.cod_agendamento = :cod_agend');
    $pets->bindValue(':cod_agend', $cod_agend);
    $pets->execute();
    
    return $pets->fetchAll();
}

function deleteSchedule($cod_schedule, $pdo){
    $delete_schedule = $pdo->prepare('delete from agendamentos where cod_agendamento = :cod_schedule');
    $delete_schedule->bindValue(':cod_schedule', $cod_schedule);
    $delete_schedule->execute();

    return true;
}

function updateInfoBasic($array, $pdo){
    $updateInfo = $pdo->prepare('update usuarios set nome = ?, sobrenome = ?, dt_nascimento = ?, genero = ?, cpf = ? where cod_usuario = ?');
    $updateInfo->execute($array);

    return $updateInfo;
}

function updateAddress($array, $pdo){
    $updateAddress = $pdo->prepare('update usuarios set cep = ?, rua = ?, numero = ?, cidade = ?, estado = ?, pais = ?, complemento = ? where cod_usuario = ?');
    $updateAddress->execute($array);

    return $updateAddress;
}

function updateInfoWork($array, $pdo){
    $updatePrice = $pdo->prepare('update cat_sitters set preco = ? where cod_catsitter = ?');
    $updatePrice->execute($array);

    return $updatePrice;
}

function searchCatSitters($array, $pdo){
    $catsitters = $pdo->prepare('select * from cat_sitters c inner join usuarios u where c.cod_usuario = u.cod_usuario and c.preco is not null and not exists (select * from agendamentos a where dt_agendamento = ? and horario = ? and a.cod_catsitter = c.cod_catsitter )');
    $catsitters->execute($array);

    return $catsitters->fetchAll();
}

function checksIfTheUserIsASitter($cod, $pdo){
    $user = $pdo->prepare('select * from cat_sitters where cod_usuario = :cod');
    $user->bindValue(':cod', $cod);
    $user->execute();

    if($user->rowCount() == 1){
        return true;
    }else{
        return false;
    }
}

function searchCatSittersFilter($array, $pdo){
    $catsitters = $pdo->prepare('select * from cat_sitters c inner join usuarios u join distintivo_catsitter d where c.cod_usuario = u.cod_usuario and d.cod_usuario = c.cod_usuario and d.cod_distintivo = ? and c.preco is not null and not exists (select * from agendamentos a where dt_agendamento = ? and horario = ? and a.cod_catsitter = c.cod_catsitter)');
    $catsitters->execute($array);

    return $catsitters->fetchAll();
}


function newSchedule($array, $pets_schedule, $pdo){
    $createSchedule = $pdo->prepare('insert into agendamentos (cod_servico, dt_agendamento, horario, cod_catsitter, cod_usuario) values (?,?,?,?,?)');
    $createSchedule->execute($array);
    $cod_agendamento = $pdo->lastInsertId();

    foreach($pets_schedule as $pet){
        $insert_pets = $pdo->prepare('insert into agendamento_pets (cod_agendamento, cod_pet) values (:cod_agendamento, :cod_pet)');    
        $insert_pets->bindValue(':cod_agendamento', $cod_agendamento);
        $insert_pets->bindValue(':cod_pet', $pet);
        $insert_pets->execute();
    }

    return true;
}

function searchSchedule($user, $pdo){
    $search_schedule = $pdo->prepare('select * from agendamentos where cod_usuario = :user order by dt_agendamento asc, horario asc');
    $search_schedule->bindValue(':user', $user);
    $search_schedule->execute();

    return $search_schedule->fetchAll();
}

function searchSchedulePet($user, $codpet, $pdo){
    $search_schedule = $pdo->prepare('select * from agendamento_pets ap join agendamentos a using(cod_agendamento) where a.cod_usuario = :user and ap.cod_pet = :codpet');
    $search_schedule->bindValue(':user', $user);
    $search_schedule->bindValue(':codpet', $codpet);
    $search_schedule->execute();

    if($search_schedule->rowCount() > 0){
        return true;
    }else{
        return false;
    }
}

function searchScheduleSitter($user, $pdo){
    $search_schedule = $pdo->prepare('select * from agendamentos where cod_catsitter = :user order by dt_agendamento asc, horario asc');
    $search_schedule->bindValue(':user', $user);
    $search_schedule->execute();

    return $search_schedule->fetchAll();
}

function searchTutor($user, $pdo){
    $tutor = $pdo->prepare('select * from usuarios where cod_usuario = :user');
    $tutor->bindValue(':user', $user);
    $tutor->execute();

    return $tutor->fetch();
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
    $mail->Password = 'ggex vuer fngu pver';

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
    $message = "Você solicitou a alteração de senha da nossa plataforma, clique no link a seguir para inserir sua nova senha. <a href='http://localhost/catsitter/set_new_password_page.php?email=$hash&confirmation=$key' >Criar nova senha</a>";

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
    $mail->Password = 'ggex vuer fngu pver';

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

function registerPet($array, $pdo){
    $registre_pet = $pdo->prepare('insert into gatos (nome, dt_nascimento, sexo, raca, foto, cod_usuario) values (?, ?, ?, ?, ?, ?)');
    $registre_pet->execute($array);
    return $registre_pet;
}

function searchPets($user, $pdo){
    $pet = $pdo->prepare('select * from gatos where cod_usuario = :user order by nome asc');
    $pet->bindValue(':user', $user);
    $pet->execute();
    
    return $pet->fetchAll();
}

function getPetById($cod_pet, $pdo){
    $pet = $pdo->prepare('select * from gatos where cod_pet = :cod_pet');
    $pet->bindValue(':cod_pet', $cod_pet);
    $pet->execute();
    
    return $pet->fetch();
}

function deletePet($user, $cod_pet, $pdo){
    $delete = $pdo->prepare('delete from gatos where cod_pet = :cod_pet and cod_usuario = :user');
    $delete->bindValue(':cod_pet', $cod_pet);
    $delete->bindValue(':user', $user);
    $delete->execute();

    return true;
}

function updateRoutine($user, $cod_pet, $routine, $pdo){
    $add_routine = $pdo->prepare('update gatos set rotina = :routine where cod_pet = :cod_pet and cod_usuario = :user');
    $add_routine->bindValue(':routine', $routine);
    $add_routine->bindValue(':cod_pet', $cod_pet);
    $add_routine->bindValue(':user', $user);
    $add_routine->execute();

    return true;
}

function updateMedicalRecord($user, $cod_pet, $medical_record, $pdo){
    $add_medical_record = $pdo->prepare('update gatos set ficha_medica = :medical_record where cod_pet = :cod_pet and cod_usuario = :user');
    $add_medical_record->bindValue(':medical_record', $medical_record);
    $add_medical_record->bindValue(':cod_pet', $cod_pet);
    $add_medical_record->bindValue(':user', $user);
    $add_medical_record->execute();

    return true;
}

function updateFone($user, $telephone, $pdo){
    $updateTel = $pdo->prepare('update telefones set telefone = :telephone where cod_usuario = :user');
    $updateTel->bindValue(':telephone', $telephone);
    $updateTel->bindValue(':user', $user);
    $updateTel->execute();

    return true;
}

function updateInfoPet($array, $pdo){
    $updatePet = $pdo->prepare('update gatos set nome = ?, dt_nascimento = ?, sexo = ?, raca = ? where cod_pet = ? and cod_usuario = ?');
    $updatePet->execute($array);

    return true;
}

function updateFotoPet($user, $cod_pet, $file_name, $pdo){
    $updateFoto = $pdo->prepare('update gatos set foto = :file_name where cod_pet = :cod_pet and cod_usuario = :user');
    $updateFoto->bindValue(':file_name', $file_name);
    $updateFoto->bindValue(':cod_pet', $cod_pet);
    $updateFoto->bindValue(':user', $user);
    $updateFoto->execute();

    return true;
}

function updateFotoUser($user, $file_name, $pdo){
    $updateFoto = $pdo->prepare('update usuarios set foto = :file_name where cod_usuario = :user');
    $updateFoto->bindValue(':file_name', $file_name);
    $updateFoto->bindValue(':user', $user);
    $updateFoto->execute();

    return true;
}

function redirect($link){
    header('Location: ' . $link);
    exit();
}

function badgeSearch($pdo){
    $badges = $pdo->prepare('select * from distintivos');
    $badges->execute();

    return $badges->fetchAll();
}

function addYourBadges($user, $yourBadges, $pdo){
    $deleteBagdes = $pdo->prepare('delete from distintivo_catsitter where cod_usuario = :user');
    $deleteBagdes->bindValue(':user', $user);
    $deleteBagdes->execute();

    foreach ($yourBadges as $badge) {
        $addbadges = $pdo->prepare('insert into distintivo_catsitter (cod_distintivo, cod_usuario) values (:badge, :user)');
        $addbadges->bindValue(':badge', $badge);
        $addbadges->bindValue(':user', $user);
        $addbadges->execute();
    }
    return true;
}

function searchYourBadges($user, $pdo){
    $yourBadges = $pdo->prepare('select * from distintivos join distintivo_catsitter using(cod_distintivo) where cod_usuario = :user');
    $yourBadges->bindValue(':user', $user);
    $yourBadges->execute();

    return $yourBadges->fetchAll();
}
function deleteBadge($cod_badge, $pdo){
    $delBadge = $pdo->prepare('delete from distintivos where cod_distintivo = :cod_badge');
    $delBadge->bindValue(':cod_badge', $cod_badge);
    $delBadge->execute();

    return true;
}

function registerBadge($array, $pdo){
    $addBadge = $pdo->prepare('insert into distintivos (nome, descricao) values ( ?, ?)');
    $addBadge->execute($array);

    return true;
}

function searchUsers($pdo){
    $users = $pdo->prepare('select * from usuarios where adm = 0 order by nome asc');
    $users->execute();

    return $users->fetchAll();
}

function deleteUser($user, $pdo){

    if(searchUserCatSitter($user, $pdo)){
        $delSitter = $pdo->prepare('delete from cat_sitters where cod_usuario = :user');
        $delSitter->bindValue(':user', $user);
        $delSitter->execute();
    }

    $delUser = $pdo->prepare('delete from usuarios where cod_usuario = :user');
    $delUser->bindValue(':user', $user);
    $delUser->execute();

    return true;
}

function searchUsersName($search, $type, $pdo){
    $all = "select * from usuarios where adm = 0 and nome like :nome or sobrenome like :sobrenome order by nome asc";
    $tutor = "select * from usuarios where adm = 0 and (nome like :nome or sobrenome like :sobrenome) and not exists (select * from cat_sitters where usuarios.cod_usuario = cat_sitters.cod_usuario) order by usuarios.nome asc";
    $catsitter = "select * from usuarios join cat_sitters using(cod_usuario) where nome like :nome or sobrenome like :sobrenome order by usuarios.nome asc";

    if($type == 'tudo') {
        $query = $all;
    }else if($type == 'tutor'){
        $query = $tutor;
    }else {
        $query = $catsitter;
    }


    $users = $pdo->prepare($query);
    $users->bindValue(':nome', $search . '%');
    $users->bindValue(':sobrenome', $search . '%');
    $users->execute();

    return $users->fetchAll();
}

function searchUsersFilter($type, $pdo){
    $all = "select * from usuarios where adm = 0 order by nome asc";
    $tutor = "select * from usuarios where adm = 0 and not exists (select * from cat_sitters where usuarios.cod_usuario = cat_sitters.cod_usuario) order by usuarios.nome asc";
    $catsitter = "select * from usuarios join cat_sitters using(cod_usuario) order by usuarios.nome asc";

    if($type == 'tudo') {
        $query = $all;
    }else if($type == 'tutor'){
        $query = $tutor;
    }else {
        $query = $catsitter;
    }

    $users = $pdo->prepare($query);
    $users->execute();

    return $users->fetchAll();
}

function catSitterFirewall(){
    if(!isset($_SESSION['cod_catsitter'])) {
        redirect('tutor_profile_page.php');
    }
}

function adminFirewall(){
    if(!isset($_SESSION['adm'])) {
        redirect('tutor_profile_page.php');
    }
}

function tutorFirewall(){
    if(isset($_SESSION['cod_catsitter'])) {
        redirect('sitter_profile_page.php');
    }
}
?>