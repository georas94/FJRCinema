<?php

session_start();

require 'inc/config.php';

// utilisateur non connecté
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
  header('Location: main.php');
  die;
}

$errors = [];
$success = [];

$sql = 'SELECT * FROM films WHERE id = :id_param';

    $requete = $bdd->prepare($sql);
    $requete->bindValue(':id_param', $_GET['id']);
    $requete->execute();
    $select_titre = $requete->fetchAll(PDO::FETCH_ASSOC);

    foreach($select_titre as $film);

if (isset($_POST['update']) && (!empty($_POST))){


   $target_dir = "img/";
   $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

   $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

   foreach ($_POST as $key => $value) {
     $post[$key] = trim(strip_tags($value)); // permet de néttoyer les donnés (anti faille XSS)
   }

   // Vérifie si le fichier est bien une image
   if(isset($_POST["update"])) {
       $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
       if($check !== false) {


       } else {
             $errors[] = "le fichier n'est pas une image.";

       }
   }
   // Vérifie si le fichier existe deja
   if (file_exists($target_file)) {
         $errors[] = "désolé, ce fichier existe déja.";

   }
   // Vérifie la taille du fichier
   if ($_FILES["fileToUpload"]["size"] > 1 * 1000 * 1000) {
         $errors[] = "désolé, le fichier est trop grand.";

   }
   // Filtrage par type de fichier
   if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
   && $imageFileType != "gif" ) {
         $errors[] = "désolé, uniquement les fichiers. JPG, JPEG, PNG & GIF sont acceptés.";

   }

   // Vérifie si le formulaire est valide
   if (count($errors) == 0){

        $formValid = true;
        $sqlup = 'UPDATE films SET titre = :titre_new_param, synopsis = :synopsis_new_param, realisateur = :realisateur_new_param, affiche = :affiche_new_param, acteurs = :acteurs_new_param, b_annonce = :b_annonce_new_param, duree = :duree_new_param, mise_en_avant = :note_new_param WHERE id = :id_param';
        $requete2 = $bdd->prepare($sqlup);
        $requete2->bindValue(':id_param', $_GET['id']);
        $requete2->bindValue(':titre_new_param', $post['input_new_titre']);
        $requete2->bindValue(':synopsis_new_param', $post['input_new_synopsis']);
        $requete2->bindValue(':realisateur_new_param', $post['input_new_realisateur']);
        $requete2->bindValue(':acteurs_new_param', $post['input_new_acteurs']);
        $requete2->bindValue(':b_annonce_new_param', $post['input_new_b_annonce']);
        $requete2->bindValue(':duree_new_param', $post['input_new_duree']);
        $requete2->bindValue(':note_new_param', $post['input_new_note']);
        $requete2->bindValue(':affiche_new_param', basename($_FILES["fileToUpload"]['name']));
        $requete2->execute();

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        $success[] = "Le fichier ". basename($_FILES["fileToUpload"]["name"]). " à bien été uploader.";
        $success[] = 'M.A.J donne !';

     } else {
        $formValid = false;
        $errors[] = "Votre film n'a pas été mis à jour.";

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

  <link rel="stylesheet" type="text/css" href="css/footer.css">

  <link rel="stylesheet" type="text/css" href="admin.css">

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

<div class="container-fluid bg-light">
<div class="row justify-content-center bg-light">


  <div class="form-sec col-md-5	m-5 border rounded bg-danger text-light shadow">

  <h4 class="pt-3">Update Movie</h4>

 <form value="update" id="update" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label for="titre">Titre</label>
      <input type="text" class="form-control" id="titre" value="<?php echo $film['titre'];?>" name="input_new_titre">
    </div>

    <div class="form-group">
      <label>Réalisateur</label>
      <input type="text" class="form-control" id="realisateur" value="<?php echo $film['realisateur'];?>" name="input_new_realisateur">
    </div>

    <div class="form-group">
      <label for="acteurs">Acteurs</label>
      <input type="text" class="form-control" id="acteurs" value="<?php echo $film['acteurs'];?>" name="input_new_acteurs">
    </div>
	<div class="form-group">
      <label for="duree">Durée</label>
      <input type="text" class="form-control" id="duree" value="<?php echo $film['duree'];?>" name="input_new_duree">
    </div>

	<div class="form-group">
      <label for="synopsis">Synopsis</label>
      <input name="input_new_synopsis" class="form-control" id="synopsis" value="<?php echo$film['synopsis'];?>"></input>
    </div>

    <div class="form-group">
        <label for="b_annonce">Bande annonce : https://www.youtube.com/watch?v=</label>
        <input type="text" class="form-control" id="b_annonce" value="<?php echo $film['b_annonce'];?>" name="input_new_b_annonce">
      </div>

      <div class="form-group">
						<label for="note">Note</label>
						<select name="input_new_note" id="note" class="form-control">
              <option value="none"><?php echo $film['mise_en_avant']?></option>
              <option value="0">0 / 5</option>
              <option value="1">1 / 5</option>
              <option value="2">2 / 5</option>
              <option value="3">3 / 5</option>
              <option value="4">4 / 5</option>
              <option value="5">5 / 5</option>
            </select>
					</div>

      <div class="form-group">
           <label for="fileToUpload">Affiche du film : <?php echo $film['affiche'];?></label>
           <input type="file" name="fileToUpload" id="fileToUpload" class="form-control btn btn-light p-1" accept="image/*">
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
