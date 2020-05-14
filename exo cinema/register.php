<?php

session_start();

  require 'inc/config.php';

  $errors = [];

  if ((!empty($_POST)) && isset($_POST['register'])){


    require 'checkmail.php';

      foreach ($_POST as $key => $value) {
      $post[$key] = trim(strip_tags($value)); // filtre les donnés de $_POST anti faille XSS
      }


      if (strlen($post['name_regist']) < 6) {
          $errors[] = 'Votre nom doit comporter au moins 6 caractères';

      }
      if (!filter_var($post['mail_regist'], FILTER_VALIDATE_EMAIL)) {
          //L'adresse mail n'est pas valide
          $errors[] = 'Votre adresse email est invalide';

      } elseif (checkEmailExist($post['password_regist'])){

        $errors[] = 'Votre email existe déja';

      }

      if(strlen($post['password_regist']) < 8) {

          $errors[] = 'Votre password doit contenir minimum 8 caractères';

        } elseif($post['passwordconf_regist'] !== $post['password_regist']) {

          $errors[] = 'Confirmation du password incorrecte';
      }

      if (count($errors) == 0){
          $formValid = true;
          $sql = 'INSERT INTO users (username, email, password, register_date )
             VALUES(:name_param, :mail_param, :password_param, :register_date_param)';

             $requete = $bdd->prepare($sql);

             $requete->bindValue(':name_param', $post['name_regist']);
             $requete->bindValue(':password_param', password_hash($post['password_regist'],PASSWORD_DEFAULT));
             $requete->bindValue(':mail_param', $post['mail_regist']);
             $requete->bindValue(':register_date_param', Date('Y-m-d H:i:s'));

             $requete->execute();
        } else {
          $formValid = false;
      }


$from = "from: papercut@papercut.com";
$to = "info@webforcetweet.fr";
$subject = "information utilisateur";
$message = "<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
          <body class='img-fluid' style='background-image: url(https://images.freeimages.com/images/large-previews/01a/technology-background-1632715.jpg); background-size: cover;'>

            <div class='container-fluid'>
             <div class='row'>
               <div class='col-12 text-light text-center h1 pt-5'>
               coucou
               </div>
                <div class='col-12 text-light text-center h4'>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </div>
              </div>
              <div class='text-center pt-3'>

              <a href='http://localhost/php/20200115/formulaire2.php' class='col-4 btn btn-light' type='button' name='button'>validation</a>
              </div>
            </div>
            </body>";

$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = $from;


if (count($errors) == 0) {
    $success[] = 'Register donne !';

    mail($to,$subject,$message,implode("\r\n", $headers));
    header('Location: login.php');

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
  <link rel="stylesheet" href="css/register.css">

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

  <div class="login-wrap mt-5 my-5"id="formu">
<div class="login-html text-center rounded">
<input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Inscription</label>
<input id="tab-2" type="radio" name="tab" class="for-pwd"><label for="tab-2" class="tab"></label>

<form class="login-form" method="post">
  <div class="sign-in-htm">
    <div class="group mt-2">
      <label for="name_regist" class="label">Nom</label>
      <input id="name_regist" type="text" name="name_regist" class="input">
    </div>
    <div class="group mt-2">
      <label for="mail_regist" class="label">Email</label>
      <input id="mail_regist" name="mail_regist" type="email" class="input">
    </div>
    <div class="group mt-2">
      <label for="password_regist" class="label">Password</label>
      <input id="password_regist" type="password" name="password_regist" class="input" data-type="password">
    </div>
    <div class="group mt-2">
      <label for="passwordconf_regist" class="label">Confirmation Password</label>
      <input id="passwordconf_regist" type="password" name="passwordconf_regist" class="input" data-type="password">
    </div><hr><br>
    <div class="group mt-2">
      <input type="submit" class="button" value="Sign In" name="register">
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
