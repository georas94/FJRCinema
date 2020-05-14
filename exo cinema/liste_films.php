<?php 

require 'inc/config.php';



 $sqlAffiches = 'SELECT * FROM films';
 $requeteAffiches = $bdd -> prepare($sqlAffiches);
 $requeteAffiches->execute();
 $toutes_mes_affiches = $requeteAffiches -> fetchAll(PDO::FETCH_ASSOC);




?>
<!DOCTYPE html>

<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FJR Cinéma</title>
  <meta name="description" content="Description sémantique de la page, nécessaire au SEO et au bon référencement de la page web">
  <link rel="stylesheet" type="text/css" href="vendor/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/header.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <style>
  .display-3{
      font-size:2.2em;
  }
  </style>
</head>



<body class="bg-light">
  <?php require 'header.php';?>


  <div class="container">
  <div class="row">
    <?php foreach ($toutes_mes_affiches as $une_affiche):?>
      <div class="col-sm-12 col-md-6 mt-3 d-flex justify-content-center flex-column">
        <h3 class="display-3 text-center"><?php echo $une_affiche['titre'];?></h3>
        <img class="img-fluid mx-auto" src="img/affiches/<?php echo $une_affiche['affiche'];?>">  
        <a href="affiche.php?id=<?php echo $une_affiche['id'];?>" class="text-center mb-5 pt-2"></a>
      </div>
  <?php endforeach ;?>
  </div>
  </div>
















  <?php require 'footer.php';?>
  <script src="vendor/js/jquery.js"></script>
  <script src="vendor/js/bootstrap.js"></script>
  <script src="js/script.js"></script>
</body>
  </html>
