<?php
session_start();
  // si la session user n'existe pas est qu'elle n'est pas vide alors redirection *
  // aucun interet de s'inscrire si on est deja connectÃ©

 require 'inc/config.php';

  $errors = [];
  $success = [];

 if (isset($_POST['login'])){


    foreach ($_POST as $key => $value) {
      $post[$key] = trim(strip_tags($value)); // filtre les donnÃ©s de $_POST anti faille XSS
    }



    if (!filter_var($post['input_mail_login'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Votre adresse email est invalide';
      }
      elseif (empty($post['password_login'])){
        $errors[] = 'Veuillez renseigner votre mot de pass';
    } else {

        $sql = 'SELECT * FROM users WHERE email = :mail_param';

        $requete2 = $bdd->prepare($sql);
        $requete2->bindValue(':mail_param', $post['input_mail_login']);

        $requete2->execute();
        $user = $requete2->fetch(PDO::FETCH_ASSOC);


        if($post['input_mail_login'] === $user['email']){

        if (password_verify($post['password_login'], $user['password'])){

                $success[] = 'Vous etes connecter !';
            }
            else {
                $errors[] = 'mot de pass invalide';
            }
        }
        else {
            $errors[] = 'identifants invalides';
        }
    }

    if (count($errors) == 0){

        $formValid = true;

        $_SESSION['user'] = [
                'id'        => $user['id'],
                'username'  => $user['username'],
                'email'     => $user['email'],
                'access'    => $user['access'],
        ];

        header('location: main.php');


      } else {
        $formValid = false;
    }
}
?>
<!DOCTYPE html>
<!--Déclaration de type de document (DTD) au format HTML5-->

<html lang="fr">
<!--l'attribut lang permet au navigateur de détecter la langue de la  page, utile en SEO-->

<head>
  <meta charset="utf-8">
  <!--jeu de caractères européens avec accents-->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--pour le responsive et la mise à l'échelle sur les écran UHD-->

  <title>FJR Cinéma</title>

  <meta name="description" content="Description sémantique de la page, nécessaire au SEO et au bon référencement de la page web">

  <!--Appel Bootstrap CSS-->
  <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.css">

  <!--placement de VOTRE FEUILLE DE STYLE - toujours en dernière position car c'est le dernier style déclaré qui sera appliqué-->
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">

</head>

<body class="bg-light">
  <!--PLACEZ VOTRE CONTENU HTML A PARTIR D'ICI-->

<?php require 'header.php';?>
<div class="col-md-12 text-center">

       <?php if(isset($formValid) && $formValid == true):/* la fonction isset permet de verifier si une variable existe */?>
       <div class="alert alert-success">

         <?=implode('<br>', $success);?>
       </div>
       <?php elseif (isset($formValid) && $formValid == false): ?>
       <div class="alert alert-danger">
         <?=implode('<br>', $errors);?>
       </div>
       <?php endif;?>
     </div>
  <div class="login-wrap my-5">
<div class="login-html rounded text-center">
<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Connexion</label>
<input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab">Password oublié ?</label>

<form class="login-form" method="post">
  <div class="sign-in-htm">
    <div class="group">
      <label for="input_mail_login" class="label">Email</label>
      <input id="input_mail_login" name="input_mail_login" type="email" class="input">
    </div>
    <div class="group">
      <label for="password_login" class="label">Password</label>
      <input id="passord_login" type="password" name="password_login" class="input" data-type="password">
    </div>
    <div class="group">
      <input type="submit" class="button mt-3" value="Sign In" name="login">
    </div>
    <div class="hr"></div>
  </div>
  <div class="for-pwd-htm">
    <div class="group">
      <label for="input_mail_powned" class="label">Email</label>
      <input id="input_mail_powned" name="input_mail_powned" type="email" class="input">
    </div>
    <div class="group">
      <input type="submit" class="button" value="Reset Password" name="pass_pwd">
    </div>
    <div class="hr"></div>
  </div>
</form>
</div>
</div>







<?php require 'footer.php';?>
  <!--FIN DE VOTRE CONTENU HTML-->

  <!-- A PARTIR D'ICI, ON VIENT PLACER LES FICHIERS JAVASCRIPT -->
  <!--Fichier JS de jQuery (Bootstrap en a besoin)-->
  <script src="vendor/js/jquery.js"></script>
  <!--Fichier JS de Bootstrap-->
  <script src="vendor/js/bootstrap.js"></script>

  <!-- D'abord, our finir, vous viendrez insérer votre propre fichier JS-->
  <script src="js/script.js"></script>

</body>

</html>
