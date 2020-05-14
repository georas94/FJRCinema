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
    <div class="py-5">

    </div>



  <?php require 'footer.php';?>
    <!--Fichier JS de jQuery (Bootstrap en a besoin)-->
    <script src="vendor/js/jquery.js"></script>
    <!--Fichier JS de Bootstrap-->
    <script src="vendor/js/bootstrap.js"></script>

    <!-- D'abord, our finir, vous viendrez insérer votre propre fichier JS-->
    <script src="js/script.js"></script>
  </body>
  </html>
