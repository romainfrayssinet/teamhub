<?php $this->titre = "Administration - Club"; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="Contenu/vueClubsAModifierPhotos.css" />
		<title>Modifer un Club </title>
	</head>
	<body>

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

		<?php if($a == 0){ ?>
		<h2>Choisir quelle photo de club modifier </h2>
    <?php foreach ($listeClubs as list($nomclubs)) { ?>
			<table>
				<tr>
					<td> <?php echo $nomclubs?> </td>
					<td> <a href="index.php?page=modifphotoclub&club=<?php echo $nomclubs?>" > <input type="button" name="Modifier" value="Modifier"> </a> </td>
				</tr>
			</table>
    <?php } ?>
	<?php } ?>

	<?php if($a == 1){ ?>
		Vous n'avez pas accès à cette page.
	<?php } ?>

  </body>
</html>
