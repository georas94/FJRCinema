<?php

function checkEmailExist($email_saisi){

    global $bdd;

    $sql = 'SELECT mail FROM users WHERE mail = :check_email';
    $check = $bdd->prepare($sql);
    $check->bindValue(':check_email', $email_saisi);
    $check->execute();

    $has_email = $check->fetch();

    if (!empty($has_email)){

      return true;

    } else {

      return false;
    }
}

/* exemple utilisation */
/*
if(checkEmailExist('toto')){
  $errors[] = 'Votre email existe déja';
}
*/
