<?php
session_start();
 require 'inc/config.php';

 $sqlHoraires = 'SELECT * FROM planningouverture';
 $requeteHoraires = $bdd -> prepare($sqlHoraires);
 $requeteHoraires->execute();
 $horaires = $requeteHoraires -> fetchAll(PDO::FETCH_ASSOC);

 if (!empty($_POST)) {

     $errors = [];
     $post = [];

     foreach ($_POST as $key => $value) {
         $post[$key] = trim(strip_tags($value));
     }

     if (strlen($post['input_name']) < 3 || strlen($post['input_name']) > 20 ) {
         $errors [] = 'Veuillez entrer un prénom entre 3 et 20 caractères';
     }

   if (!filter_var($post['input_email'], FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Veuillez entrer un email valide';
   }

     if (strlen($post['input_message']) < 25) {
         $errors [] = 'Veuillez entrer une message d\'au moins 25 caractères';

     }

     if (count($errors) == 0) {

         $insertMessages = 'INSERT INTO formulaire (name, email, messages) VALUES (:name_param, :email_param, :messages_param)';
         $requeteMessages = $bdd -> prepare($insertMessages);
         $requeteMessages -> bindValue(':name_param', $post['input_name']);
         $requeteMessages -> bindValue(':email_param', $post['input_email']);
         $requeteMessages -> bindValue(':messages_param', $post['input_message']);

             if ($requeteMessages -> execute()) {

                         $formValid = true;
                         $to = 'info@webforcetweet.fr';
                         $subject = 'Nouveau message FJR cinéma : '.$post['input_name'];
                         $message = 'Merci pour ton inscription '.$post['input_name'].
                         ' Tu peux dès à présent te connecter !';
                         $headers = 'From: Papercut@papercut.com'.
                         "\r\n".
                         'Reply-To: Papercut@papercut.com'.
                         "\r\n";
                         mail($to, $subject, $message, $headers);

                 }// Fermeture IF REQUETE EXECUTE
         }//fERMETURE COUNT ERROR
         else {
             $formValid = false;
         }
 }// fermeture empty $_POST


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
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>

<body class="bg-light">

  <?php require 'header.php';?>



  <main class="container bg-light">

    <section class="sliderAffiche container">
      <div class="d-flex align-items-center row pb-5">
        <hr class="w-25 bg-secondary col-sm-2">
        <h1 class="titresSliders d-flex justify-content-center display-3 pl-1 pr-1">A l'affiche ! </h1>
        <hr class="w-25 bg-secondary col-sm-2">
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/slide.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/slide2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/slide3.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Suivant</span>
        </a>
        <a class="carousel-control-next " href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Précédent</span>
        </a>
      </div>
    </section>

    <section class="sliderBoxoffice container pb-5">
      <div class="d-flex align-items-center justify-content-center row py-5">
        <hr class="w-25 bg-secondary col-sm-2">
        <h1 class="titresSliders d-flex justify-content-center display-3 pl-1 pr-1">Box office </h1>
        <hr class="w-25 bg-secondary col-sm-2">
      </div>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="img/slide.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/slide2.jpg" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="img/slide3.jpg" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Suivant</span>
        </a>
        <a class="carousel-control-next " href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Précédent</span>
        </a>
      </div>
    </section>

    <section class="container sectioncard row justify-content-center pt-5">
      <div class="card border-0 col-sm-5" style="width: 18rem;">
        <img src="img/film1.jpg" class="card-img-top" alt="Film 1">
        <div class="card-body">
          <p class="card-text text-center">Il est supeeer vous devriez le voir abslument.</p>
        </div>
      </div>

      <div class="card border-0 col-sm-5" style="width: 18rem;">
        <img src="img/film2.jpg" class="card-img-top" alt="Film 2">
        <div class="card-body">
          <p class="card-text text-center">Il est supeeer vous devriez le voir abslument.</p>
        </div>
      </div>

      <div class="card border-0 col-sm-5" style="width: 18rem;">
        <img src="img/film3.jpg" class="card-img-top" alt="Film 3">
        <div class="card-body">
          <p class="card-text text-center">Il est supeeer vous devriez le voir abslument.</p>
        </div>
      </div>

      <div class="card border-0 col-sm-5" style="width: 18rem;">
        <img src="img/film4.jpg" class="card-img-top" alt="Film 4">
        <div class="card-body">
          <p class="card-text text-center">Il est supeeer vous devriez le voir abslument.</p>
        </div>
      </div>

      <div class="card border-0 col-sm-5" style="width: 18rem;">
        <img src="img/film5.jpg" class="card-img-top" alt="Film 5">
        <div class="card-body">
          <p class="card-text text-center">Il est supeeer vous devriez le voir abslument.</p>
        </div>
      </div>

      <div class="card border-0 col-sm-5" style="width: 18rem;">
        <img src="img/film6.jpg" class="card-img-top" alt="Film 6">
        <div class="card-body">
          <p class="card-text text-center">Il est super vous devriez le voir absolument.</p>
        </div>
      </div>

    </section>


                <section class="mb-5 row">

                    <div class="horaires col-sm-12 col-lg-6 text-center w-50 mx-auto text-light rounded pt-3 mb-5">
                        <?php foreach ($horaires as $horaireMagasin):?>
                            <?=$horaireMagasin['jours'].' '.': '.$horaireMagasin['ouverture'] .' - '. $horaireMagasin['fermeture'].'<br><br>' ;?>
                        <?php endforeach;?>
                    </div>

                    <div class="formulaireContact col-sm-12 mt-3">
                    <form class="container d-flex flex-column align-items-center" method="POST">
                        <div class="form-group w-75">
                            <label for="input_name">Nom et prénom</label>
                            <input type="text" id="input_name" name="input_name" class="form-control" placeholder="Veuillez entrer votre nom et prénom">
                        </div>
                        <div class="form-group w-75">
                            <label for="input_email">Email</label>
                            <input type="text" class="form-control" id="input_email" name="input_email"
                                placeholder="Veuillez entrer votre Email">
                        </div>
                        <div class="form-group w-75">
                            <label for="input_message" class="">Message</label>
                            <textarea name="input_message" placeholder="Votre message" id="input_message" cols="10" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="w-75">
                            <button class="text-center btn btn-block btn-success rounded" type="submit" name="submit_form">Envoyer !</button>
                        </div>
                    </form>

                    <?php if (isset($formValid) && $formValid == true) :?>
                        <div class="d-flex justify-content-center alert alert-success mt-3">
                             <p><?= 'Votre message à bien été envoyé !' ?></p>
                        </div>

                    <?php elseif (isset($formValid) && $formValid == false) :?>
                        <div class="d-flex justify-content-center alert alert-danger">
                             <p><?= implode('<br>', $errors) ?></p>
                        </div>
                        <?php endif; ?>
                </div>

                </section>


  </main>

<?php require 'footer.php';?>
  <!--Fichier JS de jQuery (Bootstrap en a besoin)-->
  <script src="vendor/js/jquery.js"></script>
  <!--Fichier JS de Bootstrap-->
  <script src="vendor/js/bootstrap.js"></script>

  <!-- D'abord, our finir, vous viendrez insérer votre propre fichier JS-->
  <script src="js/script.js"></script>
</body>
