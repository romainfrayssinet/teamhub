<?php
include('Vues/francais.php');
if($_COOKIE['langue'] == "Francais"){
	include('Vues/francais.php');
}
elseif($_COOKIE['langue'] == "English") {
	include('Vues/English.php');
}
$this->titre = $vueGroupe.$caract['g_nom'];?>

    <script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
    <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>

    <?php
    $nbrMembres = $caract['g_placesTotal'] - $caract['g_placesLibres'];
    if(isset($_SESSION['pseudo'])){ //Si l'utilisateur est connecté
      if ($caract['g_admin'] == $_SESSION['pseudo']) { //Si c'est l'admin du groupe
        $i = 1;
      }
      else{
        foreach ($membres as list($membre)) { //Boucle sur les membres du groupe pour voir si l'utilisateur appartient à ce groupe
          if ($membre == $_SESSION['pseudo']){ //S'il appartien à ce groupe
            $i = 2;
            break;
          }
          if ($membre != $_SESSION['pseudo']){ // S'il n'appartient pas à ce groupe
            if($caract['g_placesLibres'] !=0){ // S'il reste des places dans le groupe
              $i = 3;
            } else{ // S'il ne reste pas de place dans le groupe
              $i = 4;
            }
          }
        }
      }
    } else{ // Si l'utilisateur n'est pas connecté
      $i = 5;
    }
  ?>

  <div class="groupeVueGroupe">

    <?php if ($i == 1){ ?>
      <div class="imageSportVueGroupe">
        <img src="imageSports/<?php echo $image['s_image']; ?>"/>
      </div>
      <div class="infosVueGroupe">
        <div class="nomEtDescriptionVueGroupe">
          <h2> <?php echo $gr ?><?php echo $caract['g_nom']?> </h2>
          <p><?php echo $caract['g_description'] ?></p>
          <a href="#form1"> <h3> <?php echo $moddes ?> </h3></a>
          <div id = "form1" class="forms">
            <form method="post" action="">
              <p>
               <label for="Description"> <?php echo $formgroup5 ?> </label> <br> <br>
               <textarea name="Description" cols="70" rows="4"> <?php echo $_POST['Description'] ?> </textarea>
             </p>
             <p> <input type="submit" name="Modifier" value="<?php echo $modifi ?>"> </p>
           </form>
          </div>
        </div>
        <div class="infosGeneralesVueGroupe">
          <h2> <?php echo $inf ?></h2>
          <p> <b> <?php echo $ad ?> </b> <a href="index.php?page=profil&nom=<?php echo $caract['g_admin'] ?>"> <?php echo $caract['g_admin'] ?> </a> </p>
          <p> <b> <?php echo $nbpar ?> </b> <?php echo $nbrMembres."/".$caract['g_placesTotal'] ?> </p>
          <p> <b> <?php echo $s ?></b> <?php echo $caract['g_sport'] ?></p>
          <p> <b> <?php echo $dep ?></b><?php echo $caract['g_departement'] ?> </p>
          <div class="reseauxVueGroupe">
            <div class="facebookVueGroupe">
              <a name="fb_share" type="button" share_url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"> </a>
            </div>
            <div class="twitterVueGroupe">
            <a href="http://twitter.com/share" class="twitter-share-button"
            data-url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"
            data-via="TimHeub"
            data-lang="fr">Tweet</a>
            </div>
          </div>
          <a href="#form2"><h3><?php echo $adminnouvad ?></h3></a>
          <a href="#form3"><h3> <?php echo $modnbpla ?></h3></a>
          <div id="form2" class="forms">
            <form action="" method="post">
              <select name="Admin">
                <option value = ""> -- <?php echo $newadmi ?> -- </option>
                <?php foreach ($admin as list($nomAdmin)) { ?>
                <option value = "<?php echo $nomAdmin?>" > <?php echo $nomAdmin?> </option>
                <?php } ?>
              </select>
              <input type="submit" name="ModifierAdmin" value="<?php echo $modifi ?>" >
            </form>
          </div>
          <div id = "form3" class="forms">
            <form action="" method="post">
              <input type="number" name="placesTotales" placeholder="<?php echo $formgroup2 ?>" size="25" min="0"  />
              <input type="submit" name="ModifierPlaces" value="<?php echo $modifi ?>" >
            </form>
          </div>
        </div>
        <div class="actionsGroupeVueGroupe">
          <a href="index.php?page=creationevenement&nom=<?php echo $caract['g_nom']?>"><h3> <?php echo $creevent ?></h3></a>
          <a href="index.php?page=listemembres&nom=<?php echo $_GET['nom']?>"><h3><?php echo $voirmem ?></h3></a>
          <?php if ($caract['g_placesLibres'] != "0") { ?>
          <a href="#form4"> <h3> <?php echo $invrej ?></h3></a>
          <?php } ?>
          <a href="#form5"> <h3> <?php echo $banmem ?> </h3></a>
          <a href="#" onclick="if (confirm('<?php echo $sursupgr.addslashes($_GET['nom']) ?> ?')) window.location='index.php?page=suppressiongroupe&nom=<?php echo addslashes($_GET['nom']) ?>'; return false"><h3> <?php echo $sugr ?> </h3></a>
					<div id = "form4" class="forms">
						<h2><?php echo $invutili ?></h2>

						<form action="" method="post">
							<select name="nomInvite">
								<option value =""> -- <?php echo $membreselec ?> -- </option>
								<?php foreach ($aInvite as list($nomainviter)) { ?>
								<option value = "<?php echo $nomainviter?>" > <?php echo $nomainviter?> </option>
								<?php } ?>
							</select>
							<input type="submit" name="EnvoyerInvitation" value="<?php echo $env ?>" >
						</form>
					</div>
					<div id="form5" class="forms">
						<table>
							<?php foreach ($membres as list($nomMembre)) { ?>
								<?php if ($nomMembre != $_SESSION['pseudo']){ ?>
								<tr>
									<td>
										<a href="index.php?page=profil&nom=<?php echo $nomMembre ?>"> <p> <?php echo $nomMembre?></p></a>
									</td>
									<td>
										<a href="#" onclick="if (confirm('<?php echo $surban.$nomMembre ?> ?')) window.location='index.php?page=confirmationbannissementmembre&nom=<?php echo $_GET['nom'] ?>&pseudo=<?php echo $nomMembre ?>'; return false"> <input type="button" name="bannirDuGroupe" value="<?php echo $bagr ?>"> </a>
									</td>
								</tr>
								<?php } ?>
							<?php } ?>
						</table>
					</div>
        </div>
      </div>
      <div class="evenementsVueGroupe">
        <div class="mesEvenementsVueGroupe">
          <h3><?php echo $partieve ?></h3>
          <?php if($afficherMesEvenements[0][0] == ""){ ?>
            <?php echo $partiaucun ?>
          <?php } else{?>
          <table>
            <?php foreach ($afficherMesEvenements as list($nom, $createur, $date, $heure, $nomClub, $placesTotal, $placesLibres)){ ?>
            <tr>
              <td>
                <?php echo $nom ?> </a>
              </td>
              <td>
                <?php echo $le.$date ?>
              </td>
              <td>
                <?php echo $a.$heure ?>
              </td>
              <td>
                <?php echo $c.$nomClub ?>
              </td>
              <td>
                <?php
                  $participants = $placesTotal-$placesLibres;
                  if($participants == 1){
                    echo $participants.$parti;
                  }
                  if ($participants == 0){
                    echo $aucparti;
                  }
                  if($participants > 1){
                    echo $participants.$partis;
                  }
                ?>
              </td>
              <td>
                <a href="#" onclick="if (confirm('<?php echo $surquiteve ?><?php echo addslashes($nom) ?> ?')) window.location='index.php?page=quitterevenement&evenement=<?php echo addslashes($nom) ?>'; return false"> <input type = "button" name="Quitter" value="Quitter" > </a>
              </td>
              <td>
                <a href="#" onclick="if (confirm('<?php echo $sursupeve ?><?php echo addslashes($nom) ?> ?')) window.location='index.php?page=suppressionevenement&evenement=<?php echo addslashes($nom) ?>'; return false"> <input type = "button" name="Supprimer" value="Supprimer" > </a>
              </td>
            </tr>
            <?php } ?>
          </table>
          <?php } ?>
        </div>
        <div class="evenementsGroupeVueGroupe">
          <h3><?php echo $grevent ?></h3>
          <?php if($evenementsGroupe[0][0] == ""){ ?>
            <?php echo $noneevent ?>
          <?php } else{?>
          <table>
            <?php foreach ($evenementsGroupe as list($nom, $createur, $date, $heure, $nomClub, $placesTotal, $placesLibres)){ ?>
            <tr>
              <td>
                <?php echo $nom?> </a>
              </td>
              <td>
                <?php echo $le.$date ?>
              </td>
              <td>
                <?php echo $a.$heure ?>
              </td>
              <td>
                <?php echo $c.$nomClub ?>
              </td>
              <td>
                <?php
                  $participants = $placesTotal-$placesLibres;
                  if($participants == 1){
                    echo $participants.$parti;
                  }
                  if ($participants == 0){
                    echo $aucparti;
                  }
                  if($participants > 1){
                    echo $participants.$partis;
                  }
                ?>
              </td>
              <?php
                if ($placesLibres != 0){
                  if($placesLibres == 1){
              ?>
              <td>
                <?php echo $placesLibres.$plrest ?>
              </td>
              <?php } else{ ?>
              <td>
                <?php echo $placesLibres.$plrests ?>
              </td>
              <?php } ?>
              <td>
                <a href="#" onclick="if (confirm('<?php echo $surrejevent ?><?php echo addslashes($nom) ?> ?')) window.location='index.php?page=rejoindreevenement&evenement=<?php echo addslashes($nom) ?>'; return false"> <input type = "button" name="Rejoindre" value="Rejoindre" > </a>
              </td>
              <?php } else{ ?>
                <td>
                  <?php echo $nomorepl ?>
                </td>
              <?php } ?>
              <td>
                <a href="#" onclick="if (confirm('<?php echo $sursupeve ?><?php echo addslashes($nom) ?> ?')) window.location='index.php?page=suppressionevenement&evenement=<?php echo addslashes($nom) ?>'; return false"> <input type = "button" name="Supprimer" value="Supprimer" > </a>
              </td>
            </tr>
            <?php } ?>
          </table>
          <?php } ?>
        </div>
      </div>
  <?php } ?>

  <?php if ($i == 2){ ?>
    <div class="imageSportVueGroupe">
      <img src="imageSports/<?php echo $image['s_image']; ?>"/>
    </div>
    <div class="infosVueGroupe">
      <div class="nomEtDescriptionVueGroupe">
        <h2> <?php echo $gr ?><?php echo $caract['g_nom']?> </h2>
        <p><?php echo $caract['g_description'] ?></p>
      </div>
      <div class="infosGeneralesVueGroupe">
        <h2> <?php echo $inf ?></h2>
        <p> <b> <?php echo $ad ?> </b> <a href="index.php?page=profil&nom=<?php echo $caract['g_admin'] ?>"> <?php echo $caract['g_admin'] ?> </a> </p>
        <p> <b> <?php echo $nbpar ?> </b> <?php echo $nbrMembres."/".$caract['g_placesTotal'] ?> </p>
        <p> <b> <?php echo $s ?></b> <?php echo $caract['g_sport'] ?></p>
        <p> <b> <?php echo $dep ?></b><?php echo $caract['g_departement'] ?> </p>
        <div class="reseauxVueGroupe">
          <div class="facebookVueGroupe">
            <a name="fb_share" type="button" share_url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"> </a>
          </div>
          <div class="twitterVueGroupe">
          <a href="http://twitter.com/share" class="twitter-share-button"
          data-url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"
          data-via="TimHeub"
          data-lang="fr">Tweet</a>
          </div>
        </div>
      </div>
      <div class="actionsGroupeVueGroupe">
        <a href="index.php?page=creationevenement&nom=<?php echo $caract['g_nom']?>"><h3> <?php echo $creevent ?> </h3></a>
        <a href="index.php?page=listemembres&nom=<?php echo $_GET['nom']?>"><h3><?php echo $voirmem ?></h3></a>
        <a href="#" onclick="if (confirm('<?php echo $surquitgr.addslashes($_GET['nom']) ?> ?')) window.location='index.php?page=quittergroupe&nom=<?php echo addslashes($_GET['nom']) ?>'; return false"><h3>Quitter le groupe</h3></a>
      </div>
    </div>
    <div class="evenementsVueGroupe">
      <div class="mesEvenementsVueGroupe">
        <h3><?php echo $partieve ?></h3>
        <?php if($afficherMesEvenements[0][0] == ""){ ?>
          <?php echo $partiaucun ?>
        <?php } else{?>
        <table>
          <?php foreach ($afficherMesEvenements as list($nom, $createur, $date, $heure, $nomClub, $placesTotal, $placesLibres)){ ?>
          <tr>
            <td>
              <?php echo $nom?> </a>
            </td>
            <td>
              <?php echo $le.$date ?>
            </td>
            <td>
              <?php echo $a.$heure ?>
            </td>
            <td>
              <?php echo $c.$nomClub ?>
            </td>
            <td>
              <?php
                $participants = $placesTotal-$placesLibres;
                if($participants == 1){
                  echo $participants.$parti;
                }
                if ($participants == 0){
                  echo $aucparti;
                }
                if($participants > 1){
                  echo $participants.$partis;
                }
              ?>
            </td>
            <td>
              <a href="#" onclick="if (confirm('<?php echo $surquiteve ?><?php echo addslashes($nom) ?> ?')) window.location='index.php?page=quitterevenement&evenement=<?php echo addslashes($nom) ?>'; return false">  <input type = "button" name="Quitter" value="Quitter" > </a>
            </td>
            <?php if ($createur == $_SESSION['pseudo']){ ?>
            <td>
              <a href="#" onclick="if (confirm('<?php echo $sursupeve ?><?php echo addslashes($nom) ?> ?')) window.location='index.php?page=suppressionevenement&evenement=<?php echo addslashes($nom) ?>'; return false"> <input type = "button" name="Supprimer" value="Supprimer" > </a>
            </td>
            <?php } ?>
          <?php } ?>
          </tr>
        </table>
        <?php } ?>
      </div>
      <div class="evenementsGroupeVueGroupe">
        <h3><?php echo $grevent ?></h3>
        <?php if($evenementsGroupe[0][0] == ""){ ?>
          <?php echo $noneevent ?>
        <?php } else{?>
        <table>
          <?php foreach ($evenementsGroupe as list($nom, $createur, $date, $heure, $nomClub, $placesTotal, $placesLibres)){ ?>
          <tr>
            <td>
              <?php echo $nom?> </a>
            </td>
            <td>
              <?php echo $le.$date ?>
            </td>
            <td>
              <?php echo $a.$heure ?>
            </td>
            <td>
              <?php echo $c.$nomClub ?>
            </td>
            <td>
              <?php
                $participants = $placesTotal-$placesLibres;
                if($participants == 1){
                  echo $participants.$parti;
                }
                if ($participants == 0){
                  echo $aucparti;
                }
                if($participants > 1){
                  echo $participants.$partis;
                }
              ?>
            </td>
            <?php
              if ($placesLibres != 0){
                if($placesLibres == 1){
            ?>
            <td>
              <?php echo $placesLibres.$plrest ?>
            </td>
            <?php } else{ ?>
            <td>
              <?php echo $placesLibres.$plrests ?>
            </td>
            <?php } ?>
            <td>
              <a href="#" onclick="if (confirm('<?php echo $surrejevent ?><?php echo addslashes($nom) ?> ?')) window.location='index.php?page=rejoindreevenement&evenement=<?php echo addslashes($nom) ?>'; return false"> <input type = "button" name="Rejoindre" value="Rejoindre" > </a>
            </td>
            <?php } else{ ?>
              <td>
                <?php echo $nomorepl ?>
              </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <?php if ($i == 3){ ?>
    <div class="imageSportVueGroupe">
      <img src="imageSports/<?php echo $image['s_image']; ?>"/>
    </div>
    <div class="infosVueGroupe">
      <div class="nomEtDescriptionVueGroupe">
        <h2> <?php echo $gr ?><?php echo $caract['g_nom']?> </h2>
        <p><?php echo $caract['g_description'] ?></p>
      </div>
      <div class="infosGeneralesVueGroupe">
        <h2> <?php echo $inf ?></h2>
        <p> <b> <?php echo $ad ?> </b> <a href="index.php?page=profil&nom=<?php echo $caract['g_admin'] ?>"> <?php echo $caract['g_admin'] ?> </a> </p>
        <p> <b> <?php echo $nbpar ?> </b> <?php echo $nbrMembres."/".$caract['g_placesTotal'] ?> </p>
        <p> <b> <?php echo $s ?></b> <?php echo $caract['g_sport'] ?></p>
        <p> <b> <?php echo $dep ?></b><?php echo $caract['g_departement'] ?> </p>
        <div class="reseauxVueGroupe">
          <div class="facebookVueGroupe">
            <a name="fb_share" type="button" share_url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"> </a>
          </div>
          <div class="twitterVueGroupe">
          <a href="http://twitter.com/share" class="twitter-share-button"
          data-url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"
          data-via="TimHeub"
          data-lang="fr">Tweet</a>
          </div>
        </div>
      </div>
      <div class="actionsGroupeVueGroupe">
        <a href="#" onclick="if (confirm('Voulez vraiment rejoindre le groupe : <?php echo addslashes($_GET['nom']) ?> ?')) window.location='index.php?page=confirmationgroupe&nom=<?php echo addslashes($_GET['nom']) ?>'; return false"> <h3> Rejoindre le groupe <h3></a>
        <a href="index.php?page=listemembres&nom=<?php echo $_GET['nom']?>"><h3><?php echo $voirmem ?></h3></a>
      </div>
    </div>
    <div class="evenementsVueGroupe">
      <div class="mesEvenementsVueGroupe">
        <h3><?php echo $partieve ?></h3>
        <p><?php echo $devrej ?></p>
      </div>
      <div class="evenementsGroupeVueGroupe">
        <h3><?php echo $grevent ?></h3>
        <?php if($evenementsGroupe[0][0] == ""){ ?>
          <?php echo $noneevent ?>
        <?php } else{?>
        <table>
          <?php foreach ($evenementsGroupe as list($nom, $createur, $date, $heure, $nomClub, $placesTotal, $placesLibres)){ ?>
          <tr>
            <td>
              <?php echo $nom?> </a>
            </td>
            <td>
              <?php echo $le.$date ?>
            </td>
            <td>
              <?php echo $a.$heure ?>
            </td>
            <td>
              <?php echo $c.$nomClub ?>
            </td>
            <td>
              <?php
                $participants = $placesTotal-$placesLibres;
                if($participants == 1){
                  echo $participants.$parti;
                }
                if ($participants == 0){
                  echo $aucparti;
                }
                if($participants > 1){
                  echo $participants.$partis;
                }
              ?>
            </td>
            <?php
              if ($placesLibres != 0){
                if($placesLibres == 1){
            ?>
            <td>
              <?php echo $placesLibres.$plrest ?>
            </td>
            <?php } else{ ?>
            <td>
              <?php echo $placesLibres.$plrests ?>
            </td>
            <?php }
            } else{ ?>
              <td>
                <?php echo $nomorepl ?>
              </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <?php if ($i == 4){ ?>
    <div class="imageSportVueGroupe">
      <img src="imageSports/<?php echo $image['s_image']; ?>"/>
    </div>
    <div class="infosVueGroupe">
      <div class="nomEtDescriptionVueGroupe">
        <h2> <?php echo $gr ?><?php echo $caract['g_nom']?> </h2>
        <p><?php echo $caract['g_description'] ?></p>
      </div>
      <div class="infosGeneralesVueGroupe">
        <h2> <?php echo $inf ?></h2>
        <p> <b> <?php echo $ad ?> </b> <a href="index.php?page=profil&nom=<?php echo $caract['g_admin'] ?>"> <?php echo $caract['g_admin'] ?> </a> </p>
        <p> <b> <?php echo $nbpar ?> </b> <?php echo $nbrMembres."/".$caract['g_placesTotal'] ?> </p>
        <p> <b> <?php echo $s ?></b> <?php echo $caract['g_sport'] ?></p>
        <p> <b> <?php echo $dep ?></b><?php echo $caract['g_departement'] ?> </p>
        <div class="reseauxVueGroupe">
          <div class="facebook"VueGroupe>
            <a name="fb_share" type="button" share_url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"> </a>
          </div>
          <div class="twitterVueGroupe">
          <a href="http://twitter.com/share" class="twitter-share-button"
          data-url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"
          data-via="TimHeub"
          data-lang="fr">Tweet</a>
          </div>
        </div>
      </div>
      <div class="actionsGroupeVueGroupe">
				<?php
					if ($groupesAttend == array()) {
						$g = 2;
					}
					foreach ($groupesAttend as list($nomGroupeAttend)) {
						if ($nomGroupeAttend == $_GET['nom']) { ?>
			<a href="#" onclick="if (confirm('<?php echo $surrejgrauto.addslashes($_GET['nom']) ?> ?')) window.location='index.php?page=annulationnotifgroupe&nom=<?php echo addslashes($_GET['nom']) ?>&pseudo=<?php echo $_SESSION['pseudo'] ?>'; return false"> <h3> <?php echo $nprej ?> </h3></a>
			<?php
							$g=1;
							break;
						} else{
							$g=2;
						}
					}
			?>
			<?php if($g == 2){ ?>
				<a href="#" onclick="if (confirm('<?php echo $surrejgrp.addslashes($_GET['nom']).$pllib ?>?')) window.location='index.php?page=confirmationnotifgroupe&nom=<?php echo addslashes($_GET['nom']) ?>&pseudo=<?php echo $_SESSION['pseudo'] ?>'; return false"> <h3><?php echo $rejaut ?> </h3></a>
			<?php } ?>

        <a href="index.php?page=listemembres&nom=<?php echo $_GET['nom']?>"><h3><?php echo $voirmem ?></h3></a>
      </div>
    </div>
    <div class="evenementsVueGroupe">
      <div class="mesEvenementsVueGroupe">
        <h3><?php echo $partieve ?></h3>
        <p><?php echo $devrejpluspl ?></p>
      </div>
      <div class="evenementsGroupeVueGroupe">
        <h3><?php echo $grevent ?></h3>
        <?php if($evenementsGroupe[0][0] == ""){ ?>
          <?php echo $noneevent ?>
        <?php } else{?>
        <table>
          <?php foreach ($evenementsGroupe as list($nom, $createur, $date, $heure, $nomClub, $placesTotal, $placesLibres)){ ?>
          <tr>
            <td>
              <?php echo $nom?> </a>
            </td>
            <td>
              <?php echo $le.$date ?>
            </td>
            <td>
              <?php echo $a.$heure ?>
            </td>
            <td>
              <?php echo $c.$nomClub ?>
            </td>
            <td>
              <?php
                $participants = $placesTotal-$placesLibres;
                if($participants == 1){
                  echo $participants.$parti;
                }
                if ($participants == 0){
                  echo $aucparti;
                }
                if($participants > 1){
                  echo $participants.$partis;
                }
              ?>
            </td>
            <?php
              if ($placesLibres != 0){
                if($placesLibres == 1){
            ?>
            <td>
              <?php echo $placesLibres.$plrest ?>
            </td>
            <?php } else{ ?>
            <td>
              <?php echo $placesLibres.$plrests ?>
            </td>
            <?php }
            } else{ ?>
              <td>
                <?php echo $nomorepl ?>
              </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
        <?php } ?>
      </div>
    </div>
  <?php } ?>

  <?php if ($i == 5){ ?>
    <div class="imageSportVueGroupe">
      <img src="imageSports/<?php echo $image['s_image']; ?>"/>
    </div>
    <div class="infosVueGroupe">
      <div class="nomEtDescriptionVueGroupe">
        <h2> <?php echo $gr ?><?php echo $caract['g_nom']?> </h2>
        <p><?php echo $caract['g_description'] ?></p>
      </div>
      <div class="infosGeneralesVueGroupe">
        <h2> <?php echo $inf ?></h2>
        <p> <b> <?php echo $ad ?> </b> <a href="index.php?page=profil&nom=<?php echo $caract['g_admin'] ?>"> <?php echo $caract['g_admin'] ?> </a> </p>
        <p> <b> <?php echo $nbpar ?> </b> <?php echo $nbrMembres."/".$caract['g_placesTotal'] ?> </p>
        <p> <b> <?php echo $s ?></b> <?php echo $caract['g_sport'] ?></p>
        <p> <b> <?php echo $dep ?></b><?php echo $caract['g_departement'] ?> </p>
        <div class="reseauxVueGroupe">
          <div class="facebookVueGroupe">
            <a name="fb_share" type="button" share_url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"> </a>
          </div>
          <div class="twitterVueGroupe">
          <a href="http://twitter.com/share" class="twitter-share-button"
          data-url="http://teamhub.pingfiles.fr/index.php?page=groupe&nom=<?php echo $caract['g_nom']?>"
          data-via="TimHeub"
          data-lang="fr">Tweet</a>
          </div>
        </div>
      </div>
      <div class="actionsGroupeVueGroupe">
        <a href="index.php?page=inscription"><h3><?php echo $inscsite ?></h3></a>
        <a href="index.php?page=listemembres&nom=<?php echo $_GET['nom']?>"><h3><?php echo $voirmem ?></h3></a>
      </div>
    </div>
    <div class="evenementsVueGroupe">
      <div class="mesEvenementsVueGroupe">
        <h3><?php echo $partieve ?></h3>
        <p><?php echo $devinscsite ?></p>
      </div>
      <div class="evenementsGroupeVueGroupe">
        <h3><?php echo $grevent ?></h3>
        <?php if($evenementsGroupe[0][0] == ""){ ?>
          <?php echo $noneevent ?>
        <?php } else{?>
        <table>
          <?php foreach ($evenementsGroupe as list($nom, $createur, $date, $heure, $nomClub, $placesTotal, $placesLibres)){ ?>
          <tr>
            <td>
              <?php echo $nom?> </a>
            </td>
            <td>
              <?php echo $le.$date ?>
            </td>
            <td>
              <?php echo $a.$heure ?>
            </td>
            <td>
              <?php echo $c.$nomClub ?>
            </td>
            <td>
              <?php
                $participants = $placesTotal-$placesLibres;
                if($participants == 1){
                  echo $participants.$parti;
                }
                if ($participants == 0){
                  echo $aucparti;
                }
                if($participants > 1){
                  echo $participants.$partis;
                }
              ?>
            </td>
            <?php
              if ($placesLibres != 0){
                if($placesLibres == 1){
            ?>
            <td>
              <?php echo $placesLibres.$plrest ?>
            </td>
            <?php } else{ ?>
            <td>
              <?php echo $placesLibres.$plrests ?>
            </td>
            <?php }
            } else{ ?>
              <td>
                <?php echo $nomorepl ?>
              </td>
            <?php } ?>
          </tr>
          <?php } ?>
        </table>
        <?php } ?>
      </div>
    </div>
  <?php } ?>
</div>

<script src="http://code.jquery.com/jquery-2.2.3.js" integrity="sha256-laXWtGydpwqJ8JA+X9x2miwmaiKhn8tVmOVEigRNtP4=" crossorigin="anonymous"></script>
<script language="javascript" type="text/javascript">
  $(function(){
  var divs = $(".forms");
  divs.hide();
  $("a").click(function(){
    divs.filter(":visible").slideUp();
    $($(this).attr("href")).slideDown();
    return false;
  });
});
</script>
