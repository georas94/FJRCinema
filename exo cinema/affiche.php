<?php
session_start();

require 'inc/config.php';

$read = $bdd->prepare('SELECT *
                        FROM films
                            WHERE id = :id_film_selectionne ');
$read->bindValue(':id_film_selectionne', $_GET['id']);
$read->execute();

// Je n'ai qu'un seul résultat puisque je filtre par un ID (clause WHERE dans la requete SQL);
// Un seul résultat = fetch()
// Plusieurs = fetchAll()

// La variable $detail_Film contiendra les infos sur mon film sous forme de tableau. Les clés de celui-ci correspondent aux colonnes SQL
$detail_Film = $read->fetch(PDO::FETCH_ASSOC);

// Formulaire soumis
if(!empty($_POST)){

    $errors = [];
    $post = [];
    // Nettoyage
    foreach($_POST as $key => $value) {
        $post[$key] = trim(strip_tags($value));
    }

    if(strlen($post['messages']) < 3){
        $errors[] = 'Votre messages doit contenir au minimum 3 caractères';
    }

    if (filter_var($post['email'], FILTER_VALIDATE_EMAIL) == false) {
        $errors[] = 'Votre  est message invalide';
    }

    if (!is_numeric($post['input_note']) || ($post['input_note'] < 0 || $post['input_note'] > 5)) {
        $errors[] = 'Veuillez choisir une note comprises entre 0 et 5';
    }

    if (count($errors) > 0) {
        $formValid = false;

    }
    else {

        $sql = 'INSERT INTO formulaire (name, messages, email, note, id_film ) VALUES (:data_name, :data_messages, :data_email, :data_note, :data_id_film)';
        $insert = $bdd-> prepare($sql);
        $insert-> bindValue(':data_name', $post['username']);
        $insert-> bindValue(':data_messages', $post['messages']);
        $insert-> bindValue(':data_email', $post['email']);
        $insert-> bindValue(':data_note', $post['input_note']);
        $insert-> bindValue(':data_id_film', $_GET['id']);


        if ($insert-> execute()) {

            $formValid = true;
        }
         else {
            echo 'ERREUR SQL :';
            var_dump($insert-> errorInfo());

            die();
        }
    }
}
$sql = 'SELECT * FROM formulaire WHERE id_film = :id_message_param';
$request = $bdd->prepare($sql);
$request -> bindValue(':id_message_param', $_GET['id']);
$request->execute();
$all_messages = $request->fetchAll(PDO::FETCH_ASSOC);

?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link href="css/affiche.css" rel="stylesheet">
     <link href="css/header.css" rel="stylesheet">
     <link href="css/footer.css" rel="stylesheet">
    <title>Nos film</title>

</head>
<?php require 'header.php';?>
<body class="bg-dark text-light">
    <div class="container my-5">
        <div class="row">
            <div class="col">
                <h1 class="text-center">
                    <?php echo $detail_Film['titre'];?>
                </h1>
                <hr>
                <div class="text-center"><strong>Réalisateur:</strong><?php echo $detail_Film['realisateur'];?></div>
            </div>
        </div>
    </div>

    <div class="container-fluid ">
        <div class="row">
            <div class="col">
                <img id="img1" class="img-fluid" src="img/affiches/<?php echo $detail_Film['affiche'];?>" alt="foto">

            </div>
        </div>
    </div><br><br><br>




    <div class="container text-center my-5">
        <div class="row">
            <div class="col-12 ">
                <div class="text-center">
                    <strong>Acteurs: </strong><?php echo $detail_Film['acteurs'];?>
                </div>
                <br>
                <hr>
                <div class="text-center"><strong>Durée: </strong>
                    <?php echo $detail_Film['duree'];?>
                </div>
                <br>
                <hr>
                <div class="text-center"><strong>Synopsis: </strong>
                    <?php echo $detail_Film['synopsis'];?>
                </div>
                <br>
                <hr>
            </div>


             <div class="container">
               <iframe class="m-5" width="560" height="315" src="https://www.youtube.com/embed/<?php echo $detail_Film['b_annonce'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

             </div>


            <div class="col-6 text-center">
                <?php if(isset($formValid) && $formValid == true):?>
                <div class="alert alert-success">
                    Votre avis a bien été ajouté ! Merci.
                </div>
                <?php elseif(isset($formValid) && $formValid == false):?>
                <div class="alert alert-danger">
                    <?=implode('<br>', $errors);?>
                </div>
                <?php endif;?>


                <form method="post" class=" p-2 mb-1" id="avis">
                    <h2 class="text-center text-light">Avis</h2>
                    <div class="form-group">
                         <label for="email" class="sr-only">username</label><br>
                        <input type="text" name="username" id="username" class="form-control " placeholder="Pseudo" required>
                        <label for="email" class="sr-only">Email</label><br>
                        <input type="email" name="email" id="email" class="form-control " placeholder="votre@email.fr" required>
                    </div>
                    <hr>
                    <textarea name="messages" class="form-control form-control-lg" placeholder="Ecrivez votre avis" required></textarea><br>

                    <div class="form-group">
                        <label for="note">Note</label>
                        <select name="input_note" id="note" class="form-control">
                            <option value="none">--choisisez une note--</option>
                            <option value="0">0 / 5</option>
                            <option value="1">1 / 5</option>
                            <option value="2">2 / 5</option>
                            <option value="3">3 / 5</option>
                            <option value="4">4 / 5</option>
                            <option value="5">5 / 5</option>
                        </select>
                    </div>
                    <div class="text-center mt-3 px-3">
                        <button type="submit" class="btn btn-danger btn-rounded">Envoyer</button>

                    </div>

            </div>

                <div class="col-2">
                    <?php foreach($all_messages as $message):?>
		                <div class="row no-gutters border-bottom">

			            <div class="col-6">
				        <h4 class="username">
					<?=$message['name'];?>
				</h4>
				<p class="message"><?=$message['messages'];?></p>
			</div>
		</div>
		<?php endforeach;?>

                </div>
            </div>
        </div>

  <?php require 'footer.php'; ?>
</body>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
  integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
