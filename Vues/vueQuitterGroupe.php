<?php $this->titre = "Confirmation - Groupe"; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Contenu/vueQuitterGroupe.css" />
    <title> Quitter Groupe </title>
  </head>

  <body>

    <h2> Vous avez quitté : <?php echo $nom ?> ! </h2>

    <p> Vous allez être redirigé vers vos groupes. </p>

  </body>

<?php header('refresh:3;url=index.php?page=mesgroupes') ?>
</html>
