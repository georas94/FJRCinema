<?php

require 'inc/config.php';

$sql = 'SELECT id, titre, synopsis, duree, realisateur, acteurs, b_annonce FROM films';

    $requete = $bdd->prepare($sql);
    $requete->execute();
    $select_titre = $requete->fetchAll(PDO::FETCH_ASSOC);

    foreach($select_titre as $film);

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


  <div class="form-sec col-md-5	m-5 border rounded bg-danger text-light shadow">

  <h4 class="pt-3">Update Movie</h4>

 <form name="update" id="update" method="post" action="submit">

    <div class="form-group">
      <label for="titre">Titre</label>
      <input type="text" class="form-control" id="titre" placeholder="<?php echo $film['titre'];?>" name="update">
    </div>

    <div class="form-group">
      <label>Réalisateur</label>
      <input type="text" class="form-control" id="realisateur" placeholder="<?php echo $film['realisateur'];?>" name="update">
    </div>

    <div class="form-group">
      <label for="acteurs">Acteurs</label>
      <input type="text" class="form-control" id="acteurs" placeholder="<?php echo $film['acteurs'];?>" name="update">
    </div>
	<div class="form-group">
      <label for="duree" >Durée</label>
      <input type="text" class="form-control" id="duree" placeholder="<?php echo $film['durée'];?>" name="update">
    </div>

	<div class="form-group">
      <label for="synopsis" >Synopsis</label>
      <textarea name="update" class="form-control" id="synopsis" placeholder="<?php echo $film['synopsis'];?>"></textarea>
    </div>

    <div class="form-group">
        <label for="b_annonce" >Bande annonce</label>
        <input type="text" class="form-control" id="b_annonce" placeholder="<?php echo $film['b_annonce'];?>" name="update">
      </div>


    <button type="submit" name="update" value="update" class="btn btn-outline-dark btn-block my-3">Update</button>
  </form>
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
