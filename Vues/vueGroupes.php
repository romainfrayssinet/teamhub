<?php $this->titre = "Groupes - Rejoindre"; ?>
	<body>
    <div class="groupesVueGroupes">
			<?php $groupe = new groupes() ?>
  		<h2>Groupes</h2>

  		<table>
				<?php if ($groupes[0] == "" or $groupes == ""){ ?>
					<tr>
						<td>
							Aucun Groupe n'est disponible ...
						</td>
					</tr>
					<tr>
						<td>
							Vous pouvez en créer un ! <a href="index.php?page=creationgroupe"><input type="button" name="creerGroupe" value="Créer un groupe"></a>
						</td>
					</tr>
				<?php } ?>
  			<?php foreach ($groupes as list($nom, $admin, $placesLibres)){ ?>
  			<tr>
					<td>
						<?php $afficherImageSport = $groupe->afficherImage($nom)->fetch(); ?>
						<img src="imageSports/<?php echo $afficherImageSport['s_image']; ?>"/>
					</td>
  				<td>
  					<a href="index.php?page=groupe&nom=<?php echo $nom?>"> <?php echo $nom?> </a>
  				</td>

  				<td>
  					<?php echo "  créé par : ".$admin ?>
  				</td>

  				<td>
  					<?php
  					if($placesLibres > 1){
  						echo "il y a ".$placesLibres." places restantes";
  					} else {
  						echo "il y a ".$placesLibres. " place restante";
  					}
  					?>
  				</td>

  				<td>
  					<?php if($placesLibres != 0){ ?>
						<a href="#" onclick="if (confirm('Voulez vraiment rejoindre le groupe : <?php echo addslashes($nom) ?> ?')) window.location='index.php?page=confirmationgroupe&nom=<?php echo addslashes($nom) ?>'; return false"> <input name="Rejoindre" type="button" value="Rejoindre le groupe"> </a>
  					<?php }
							else{
								$g=0;
								if ($groupesAttend == array()) {
									$g=2;
								}
								foreach ($groupesAttend as list($nomGroupeAttend)) {
									if ($nomGroupeAttend == $nom) { ?>
						<a href="#" onclick="if (confirm('Voulez vous vraiment ne plus rejoindre automatiquement le groupe <?php echo addslashes($nom) ?> ?')) window.location='index.php?page=annulationnotifgroupe&nom=<?php echo addslashes($nom) ?>&pseudo=<?php echo $_SESSION['pseudo'] ?>'; return false"> <input name="nePlusNotifier" type="button" value="Ne plus Rejoindre"> </a>
						<?php
										$g=1;
										break;
									} else{
										$g=2;
									}
								}
						?>
						<?php if($g == 2){ ?>
							<a href="#" onclick="if (confirm('Voulez vous vraiment rejoindre le groupe <?php echo addslashes($nom) ?> quand une place se libère ?')) window.location='index.php?page=confirmationnotifgroupe&nom=<?php echo addslashes($nom) ?>&pseudo=<?php echo $_SESSION['pseudo'] ?>'; return false"> <input name="notifier" type="button" value="Rejoindre Automatiquement"> </a>
						<?php } ?>
				<?php } ?>
  				</td>
  			</tr>
  			<?php } ?>
  		</table>
    </div>
  </body>
</html>
