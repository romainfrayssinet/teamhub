<?php $this->titre = $vueModerationCommentaire;
include('Vues/francais.php');
if($_COOKIE['langue'] == "Francais"){
	include('Vues/francais.php');
}
elseif($_COOKIE['langue'] == "English") {
	include('Vues/English.php');
} ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="Contenu/vueModerationCommentairesClub.css" />
		<title>Modérer des commentaires</title>
	</head>

	<?php
		require_once 'Controleurs/controleurAdministration.php';
		$admin = new controleurAdministration();
		$verifAdmin = $admin->verifAdmin();
			if($verifAdmin == true){
				$a=0;
			} else{
				$a=1;
			}
	?>
	<body>

	<?php if($a == 0){ ?>
    <table>
      <th>
        <h3><?php echo $commclub.$caractClub['c_nom']?> </h3>
        ___________________
      </th>
      <?php foreach ($NoteClub as list($id, $pseudo, $note, $commentaire, $date)){?>
        <tr>
          <td class="infosCommentaire"> <b><?php echo $pseudo?></b>, le <?php echo $date ?> : <a href="#" onclick="if (confirm('<?php echo $sursupcomm ?>')) window.location='index.php?page=suppressioncommentaire&id=<?php echo $id ?>'; return false"> <input type ="button" value="Supprimer"> </a> </td>
        </tr>
        <tr>
          <td>
            <?php echo $commentaire?>
          </td>
        </tr>
        <tr>
          <td>
            <?php for ($i=0; $i < $note; $i++) { ?>
              <img src="Autres/etoile.png" height="15px" width="15px" />
            <?php } ?>
          </td>
        </tr>
        <tr>
          <td>
            ___________________
          </td>
        </tr>
  		<?php } ?>
			</table>
		<?php } ?>

		<?php if($a == 1){ ?>
			<?php echo $nonacces ?>
		<?php } ?>


	</body>
