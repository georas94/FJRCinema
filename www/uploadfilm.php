<?php
session_start();

require 'inc/config.php';

// utilisateur non connecté
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
  header('Location: main.php');
  die;
}
// Ce tableau contient la liste des mimes type que j'accepte
$mimeTypesAllowed = [
	'image/png',
	'image/gif',
	'image/jpeg',
	'image/jpg',
  'image/pjpeg',
  'image/webp',
];
// Taille maximum du fichier uploadé
$maxSize = 2 * 1000 * 1000;

$uploadDirectory = 'img/affiches/'; // Dossier d'upload, chemin relatif a mon emplacement


if (!empty($_POST)) {

    $errors = [];
    $post = [];
    foreach ($_POST as $key => $value) {
         $post[$key] = trim(strip_tags($value));
    }


              if (strlen($post['input_titre']) < 5 ) {
                $errors [] = 'Veuillez entrer un titre d\'au moins 5 caractères';
              }//fermeture if titre

              if (strlen($post['input_synopsis']) < 10 ) {
                $errors [] = 'Veuillez entrer un synopsis d\'au moins 10 caractères';
              }//fermeture if synopsis

              if (strlen($post['input_duree']) < 5 ) {
                $errors [] = 'Veuillez entrer une durée d\'au moins 10 caractères';
              }//fermeture if duree

              if (strlen($post['input_realisateur']) < 5 ) {
                $errors [] = 'Veuillez entrer nom de réalisateur d\'au moins 5 caractères';
              }//fermeture if realisateur

              if (strlen($post['input_acteurs']) < 5 ) {
                $errors [] = 'Veuillez entrer un nom acteur d\'au moins 5 caractères';
              }//fermeture if acteurs

              if (strlen($post['input_b_annonce']) < 5 ) {
                $errors [] = 'Veuillez entrer une annonce d\'au moins 5 caractères';
              }//fermeture if bande annonce

              if ($post['input_mise_en_avant'] == 0) {
                $errors [] = 'Veuillez choisir une note entre 1 et 5';
              }//fermeture if mise en avant



              if(!empty($_FILES) && $_FILES['input_affiche']['error'] == UPLOAD_ERR_OK) {


                  $fileinfo = new finfo(); // Instancie la class PHP FileInfo qui va permettre d'obtenir des informations plus précises sur le mime type du fichier

                  $mimeTypeDeMonFichierActuel = $fileinfo -> file($_FILES['input_affiche']['tmp_name'], FILEINFO_MIME_TYPE); // Retourne quelque chose du style "image/jpg" ou "application/pdf"
                  // Vérifie que le mime type du fichier uploadé corresponde a un mime type autorisé
                  if (in_array($mimeTypeDeMonFichierActuel, $mimeTypesAllowed)) {

                    // Si le poid de l'image / du fichier est inférieur à la taille maxi autorisée
                    if ($_FILES['input_affiche']['size'] < $maxSize) {

                      $chars_search = [' ', 'é', 'è', 'à', 'ù'];
                      $chars_replace = ['-', 'e', 'e', 'a', 'u'];

                      // La concaténation du nom de fichier avec la fonction time() m'assure un nom de fichier unique et évite ainsi l'écrasement
                      $finalFileName = str_replace($chars_search, $chars_replace, time().'-'.$_FILES['input_affiche']['name']);


                      if (!is_dir($uploadDirectory)) { // Vérifie que le dossier existe
                        if (!mkdir($uploadDirectory, 0777)) { // Fabrique un dossier avec tous les droits (chmod 777)
                          $errors[] = 'Un problème est survenu lors de la création du répértoire d\'upload';
                        }
                      }


                      $destination = $uploadDirectory.$finalFileName; // Donnera quelque chose comme "uploads/1579517640-mon-chaton.jpg"

                      move_uploaded_file($_FILES['input_affiche']['tmp_name'], $destination);

                   //Requete SQL ajouts
                  $sqlInsertFilms = 'INSERT INTO films (titre, synopsis, duree, realisateur, acteurs, b_annonce, mise_en_avant, affiche) VALUES (:titre_param, :synopsis_param, :duree_param, :realisateur_param, :acteurs_param, :b_annonce_param, :mise_en_avant_param, :affiche_param)';
                  $requeteInsertFilms = $bdd -> prepare($sqlInsertFilms);

                  $requeteInsertFilms -> bindValue(':titre_param', $post['input_titre']);
                  $requeteInsertFilms -> bindValue(':synopsis_param', $post['input_synopsis']);
                  $requeteInsertFilms -> bindValue(':duree_param', $post['input_duree']);
                  $requeteInsertFilms -> bindValue(':realisateur_param', $post['input_realisateur']);
                  $requeteInsertFilms -> bindValue(':acteurs_param', $post['input_acteurs']);
                  $requeteInsertFilms -> bindValue(':b_annonce_param', $post['input_b_annonce']);
                  $requeteInsertFilms -> bindValue(':mise_en_avant_param', $post['input_mise_en_avant']);
                  $requeteInsertFilms -> bindValue(':affiche_param', $destination);

                  $requeteInsertFilms -> execute();


                      // La variable $utilisateur contient soit la ligne correspondante à l'adresse email
                      // soit rien

                    } else {
                      $errors[] = 'Votre fichier est trop lourd (2Mo maxi)';
                    }

                  } else {
                    $errors[] = 'Ce type de fichier n\'est pas autorisé';
                  }



                } else {
                  $errors[] = 'Vous devez sélectionner un fichier';
              }

//Compte les erreurs
          if (count($errors) === 0) {
              $formValid = true;

            }else {
                $formValid = false;
            }

}// Fermeture !emptypost
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

        <h4 class="pt-3">Upload Movie</h4>

        <form name="upload" id="upload" method="POST"  enctype="multipart/form-data">

          <div class="form-group">
            <label for="input_titre">Titre</label>
            <input type="text" class="form-control" id="input_titre" name="input_titre">
          </div>

          <div class="form-group">
            <label for="input_synopsis">Synopsis</label>
            <textarea name="input_synopsis" class="form-control" id="input_synopsis"></textarea>
          </div>

          <div class="form-group">
            <label for="input_duree">Durée</label>
            <input type="text" class="form-control" id="input_duree" name="input_duree">
          </div>


          <div class="form-group">
            <label for="input_realisateur">Réalisateur</label>
            <input type="text" class="form-control" id="input_realisateur" name="input_realisateur">
          </div>

          <div class="form-group">
            <label for="input_acteurs">Acteurs</label>
            <input type="text" class="form-control" id="input_acteurs" name="input_acteurs">
          </div>



          <div class="form-group">
            <label for="input_b_annonce">Bande annonce</label>
            <input type="text" class="form-control" id="input_b_annonce" name="input_b_annonce">
          </div>

          <div class="form-group">
            <label for="input_mise_en_avant">Note</label>
            <select class="custom-select" name="input_mise_en_avant" id="input_mise_en_avant">
              <option value="0">Notes...</option>
              <option value="1">1 / 5</option>
              <option value="2">2 / 5</option>
              <option value="3">3 / 5</option>
              <option value="4">4 / 5</option>
              <option value="5">5 / 5</option>
            </select>
          </div>


          <div class="affiche custom-file p-3 text-center pb-5">
            <label class="input_affiche " for="input_affiche">Uploader une affiche</label>
            <input type="file" name="input_affiche" class="custom-file-input" id="input_affiche">
          </div>

          <button type="submit" name="submit" value="submit" class="btn btn-outline-dark btn-block my-3">Upload</button>
        </form>
      </div>

      <div>
        <?php if(isset($formValid) && $formValid == true) :?>
        <div class="alert alert-success d-flex justify-content-center">
          <?php echo 'Votre film a été bien posté !';?>
        </div>

        <?php elseif(isset($formValid) && $formValid == false) :?>
        <div class="alert alert-danger d-flex justify-content-center">
          <?php echo implode('<br>', $errors) ;?>
        </div>
        <?php endif;?>
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
