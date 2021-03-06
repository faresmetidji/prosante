<?php
session_start();
require_once"../classes/Data_Base.class.php";
require_once"../include/connexion.conf.inc.php";

$db = new Data_Base(SGBD,HOST,DBNAME,USER,PASSWORD);

// S'il n'y a pas de session alors on ne va pas sur cette page
    if (!isset($_SESSION['id'])){
        header('Location: ../authentification/connexion.php');
        exit;
    }

    // On récupère les informations de l'utilisateur connecté
      $afficher_profil = $db->query("SELECT * FROM professionnels WHERE id ='".$_SESSION['id']."'");

    $afficher_profil = $afficher_profil->fetch();

?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" >
        <link rel="stylesheet" href="../style/style1.css">
        <title>Mon profil</title>
    </head>

    <body>
    <?php
    require_once"../include/menu.php";
     ?>

  <div class="container">
      <div class="innerprofil">

          <div class="titleprofil">
              <h3>Profil de <?= $afficher_profil['nom'] . " " .  $afficher_profil['prenom']; ?></h3>
          </div>

          <div class="profilpic">
            <?php
                  if(file_exists($afficher_profil['photo']) && isset($_SESSION['avatar'])){

               ?>

                  <img src="<?=  $afficher_profil['photo']; ?>"  class="photo">


               <?php
                  }else{
               ?>
                  <img src="../public/profilpic/default/user.png" class="photo" >

               <?php
                  }
               ?>



          </div>

          <div class="content">

            <div class="infoprofil">
            <div> Vos informations : </div>
                <ul>
                    <li>Votre id est : <?= $afficher_profil['id'] ?></li>
                    <li>Votre mail est : <?= $afficher_profil['mail'] ?></li>
                    <li>Votre adresse est : <?= $afficher_profil['adresse'] ?></li>
                    <li>Votre telephone est : <?= $afficher_profil['telephone'] ?></li>
                    <li>Votre specialite est : <?= $afficher_profil['specialite'] ?></li>
                </ul>
            </div>
            <div class="">
              <a href="profilpicupload.php">Modifier votre photo</a>
            </div>
          </div>

      </div>

  </div>





            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" ></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" ></script>
            <script src="../bootstrap/js/bootstrap.min.js" ></script>
    </body>
</html>
