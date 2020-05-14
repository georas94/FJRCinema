<?php

session_start();

require 'inc/config.php';

// utilisateur non connecté
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
  header('Location: main.php');
  die;
}

$sql = 'SELECT * FROM films';

    $requete = $bdd->prepare($sql);
    $requete->execute();
    $select_titre = $requete->fetchAll(PDO::FETCH_ASSOC);



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

  <link rel="stylesheet" type="text/css" href="css/footer.css">

  <link rel="stylesheet" type="text/css" href="admin.css">

</head>

<body class="bg-light">
  <!--PLACEZ VOTRE CONTENU HTML A PARTIR D'ICI-->


<?php require 'header.php';?>

<div class="container-fluid bg-light">
<div class="row justify-content-center bg-light">


  <div class="form-sec col-md-10	m-5 border rounded bg-light text-dark shadow">

  <h4 class="pt-3">Liste Films</h4>

  <div class="table-responsive">
                <table class="table">
                  <tr>

                    <th>Titre</th>
                    <th>ID</th>
                    <th>Lien</th>
                  </tr>

                  <tbody>
                    <!--VOTRE CODE PHP ICI-->


                    <?php foreach($select_titre as $film):?>
                    <tr>
                      <td><?=nl2br($film['titre']);?></td>
                      <td><?=nl2br($film['id']);?></td>
                      <td><a href="updatefilm.php?id=<?php echo $film['id'];?>">Mettre à jour</a></td>

                    </tr>
                  <?php endforeach;?>

                  </tbody>
                </table>
              </div>

  </div>

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
