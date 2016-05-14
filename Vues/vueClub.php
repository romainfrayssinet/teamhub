<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="Contenu/vueClub.css" />
		<title>Liste des Clubs </title>
	</head>
	<body>
		<div class="club">
      <h2>Club <?php echo $caractClub['c_nom']?> </h2>
      <img src="imagesClubs/<?php echo $caractClub['c_image']; ?>"/>
      <p> Adresse :
      <?php echo $caractClub['c_adresse'] ?>
      </p>
      <p> Code Postal :
      <?php echo $caractClub['c_cp'] ?>
      </p>
      <p> Numéro de téléphone :
      <?php echo $caractClub['c_numero'] ?>
      </p>
			<div class="horaires">
				<table>
	        <tr>
	          <td> Lundi </td>
						<td> de <?php echo $caractClub['c_hoLundiDebut'] ?> à <?php echo $caractClub['c_hoLundiFin'] ?> </td>
	        </tr>
	        <tr>
						<td> Mardi </td>
						<td> de <?php echo $caractClub['c_hoMardiDebut'] ?> à <?php echo $caractClub['c_hoMardiFin'] ?> </td>
	        </tr>
					<tr>
						<td> Mercredi </td>
						<td> de <?php echo $caractClub['c_hoMercrediDebut'] ?> à <?php echo $caractClub['c_hoMercrediFin'] ?> </td>
					</tr>
					<tr>
						<td> Jeudi </td>
						<td> de <?php echo $caractClub['c_hoJeudiDebut'] ?> à <?php echo $caractClub['c_hoJeudiFin'] ?> </td>
					</tr>
					<tr>
						<td> Vendredi </td>
						<td> de <?php echo $caractClub['c_hoVendrediDebut'] ?> à <?php echo $caractClub['c_hoVendrediFin'] ?> </td>
					</tr>
					<tr>
						<td> Samedi </td>
						<td> de <?php echo $caractClub['c_hoSamediDebut'] ?> à <?php echo $caractClub['c_hoSamediFin'] ?> </td>
					</tr>
					<tr>
						<td> Dimanche </td>
						<td> de <?php echo $caractClub['c_hoDimancheDebut'] ?> à <?php echo $caractClub['c_hoDimancheFin'] ?> </td>
					</tr>
	      </table>
			</div>
			<div class="commentairesHoraires">
					<?php echo $caractClub['c_hoCommentaire'] ?>
			</div>
		</div>

		<div class="commentaires">
			<div class="derniers">
				<table>
					<th>
						<h3>Les derniers commentaires</h3>
						___________________
					</th>
					<?php if ($derniereNoteClub[0]==""){ ?>
						<tr>
							<td>
								<b>Il n'y a pas encore de commentaire ... </b>
							</td>
						</tr>
					<?php } ?>
					<?php foreach ($derniereNoteClub as list($pseudo, $note, $commentaire, $date)){?>
						<tr>
							<td class="infosCommentaire"> <b><?php echo $pseudo?></b>, le <?php echo $date ?> : </td>
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
			</div>
			<div class="meilleurs">
				<table>
					<th>
						<h3> Les meilleurs commentaires</h3>
						___________________
					</th>
					<?php if ($derniereNoteClub[0]==""){ ?>
						<tr>
							<td>
								<b>Il n'y a pas encore de commentaire ... </b>
							</td>
						</tr>
					<?php } ?>
					<?php foreach ($meilleureNoteClub as list($pseudo, $note, $commentaire, $date)){?>
						<tr>
							<td class = "infosCommentaire"> <b><?php echo $pseudo?></b>, le <?php echo $date ?> : </td>
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
			</div>
			<div class="pires">
				<table>
					<th>
						<h3>Les moins bons commentaires</h3>
						___________________
					</th>
					<?php if ($derniereNoteClub[0]==""){ ?>
						<tr>
							<td>
								<b>Il n'y a pas encore de commentaire ... </b>
							</td>
						</tr>
					<?php } ?>
					<?php foreach ($pireNoteClub as list($pseudo, $note, $commentaire, $date)){?>
						<tr>
							<td class = "infosCommentaire"> <b><?php echo $pseudo?></b>, le <?php echo $date ?> : </td>
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
			</div>
		</div>

		<div class="Formulaire">
			<div class="noterCommenter">

				<?php
				foreach($membresNote as list($nomMembre)){
					if($nomMembre != $_SESSION['pseudo']){
						$i=1;
					} else{
						$i=2;
						break;
					}
				}
				?>

				<?php if($i == 2){ ?>
					<b> Merci d'avoir donné votre avis sur ce club ! </b>
				<?php } else{?>
					<h3>Notez et Commentez ce club !</h3>
					<form name = "formulaireNotation" method="post" action = "">
						<div class="rating"><!--
					  --><input name="noteClub" value="5" id="e5" type="radio"><label for="e5">☆</label><!--
						--><input name="noteClub" value="4" id="e4" type="radio"><label for="e4">☆</label><!--
						--><input name="noteClub" value="3" id="e3" type="radio"><label for="e3">☆</label><!--
						--><input name="noteClub" value="2" id="e2" type="radio"><label for="e2">☆</label><!--
						--><input name="noteClub" value="1" id="e1" type="radio"><label for="e1">☆</label>
						</div>
						<p>
						 <label for="commentaireClub"> Ajoutez un commentaire ! </label> <br/><br/>
						 <textarea name="commentaireClub"> </textarea>
					 	</p>
					 <p> <input type="submit" name="Noter" value="Noter"> </p>
				 </form>
			 <?php } ?>
			</div>
		</div>

  </body>
</html>
