<?php $this->titre = "Administration - Administrateur Groupe"; ?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="stylesheet" href="Contenu/vueModifAdmin.css" />
		<title>Modifier l'Administrateur</title>
	</head>
	<body>

		<h2>Modifier l'administrateur</h2>

    <form action="" method="post">
      <select name="Admin">
        <option value = ""> -- Selectionnez un nouvel admin -- </option>
        <?php foreach ($admin as list($nomAdmin)) { ?>
        <option value = "<?php echo $nomAdmin?>" > <?php echo $nomAdmin?> </option>
        <?php } ?>
      </select>
      <input type="submit" name="Modifier" value="Modifier" >
    </form>


  </body>
</html>
