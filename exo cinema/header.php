<?php


?>
  <header>

    <nav class="navbar navbar-expand-lg navbar-light bg-dark">

      <a class="navbar-brand" href="main.php"><img src="img/logo/FJR_logo.png" class="FJR_logo img-fluid" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse text-light pr-2" id="navbarSupportedContent">
        <ul class="navbar-nav ">

          <li class="nav-item">
            <a class="nav-link text-light" href="liste_films.php">A l'affiche</a>
          </li>
          

          <?php if(isset($_SESSION['user']) && !empty($_SESSION['user']) && ($_SESSION['user']['access']) === 'admin'):?>
            <div class="btn-group mr-3">
              <button type="button" class="btn btn-danger">Administration</button>
              <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="sr-only">Toggle Dropdown</span>
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="uploadfilm.php">Upload</a>
                <a class="dropdown-item" href="liste_films_admin.php">Update</a>
              </div>
            </div>
          <?php endif;?>

        </ul>
          <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="text" placeholder="..." aria-label="Search">
          <button class="btn btn-outline-secondary my-2 my-sm-0 text-light" type="submit">Recherche</button>
        </form>

        <?php

        if (!isset($_SESSION['user'])){


          echo'bonjour !';
          echo'<div class="row justify-content-end">
          <a href="login.php" class="btn btn-outline-success my-2 my-sm-0 mx-2" type="submit">Login</a>
          <a href="register.php" class="btn btn-outline-danger my-2 my-sm-0 mx-2" type="submit">Register</a>
        </div>';
        } else {


          echo'<p class="mt-3">Bonjour '.$_SESSION['user']['username'].'. </p>';
          echo'<a href="deconnexion.php" class="btn btn-outline-danger my-2 my-sm-0 mx-2" name="exit" type="submit">Déconnexion</a>';
            }
        ?>

      </div>
    </nav>
