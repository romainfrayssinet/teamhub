<?php $this->titre = $vueBanni;
include('Vues/francais.php');
if($_COOKIE['langue'] == "Francais"){
	include('Vues/francais.php');
}
elseif($_COOKIE['langue'] == "English") {
	include('Vues/English.php');
} ?>

  <body>
		<div class="Banni">
			<h2> <?php echo $ba ?> </h2>

	    <p> <?php echo $contactadmi ?> </p>
		</div>
  </body>
