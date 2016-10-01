<?php
require("_php/head.php");
?>
<body>
<?php
require("menu.php");
require("_php/base.php");
?>

<div class="container">
	<?php if ($_SESSION['posted'] == 117)
			echo ('<p><strong> L\'urgence a bien été enregistrée. </strong></p>');?>
	<?php if ($_SESSION['posted'] == 217)
			echo ('<p><strong> Code de vérification incorect. </strong></p>');?>
		
	<h3> Urgence du moment : </h3>
	<?php
	$basu = $bdd->query('SELECT * FROM urgences WHERE date = CURDATE() ORDER BY insertion DESC LIMIT 0, 1');
	$check = 0;
	while($ruq = $basu->fetch())
	{	
		$check = 1;
		if (isset($ruq['info']))
		{
			if (isset($ruq['lien']))
			{
				echo ('
				<p> contenu <strong> '.$ruq['titre'] .' : </strong> <a href="'. $ruq['lien'].'"> '. $ruq['info'].' </a> | <a href="delurgence.php">Supprimer cette urgence </a></p>
				');
			}
			else
			{
			echo ('
			<p>contenu : <strong>'.$ruq[titre].' : </strong> '. $ruq['info'].'</a> | <a href="delurgence.php">Supprimer cette urgence </a></p>
			');
			}
		}
	}
	if ($check == 0)
		echo ('<p> Pas d\'urgence actuellement </p>');
	
	?>
	
      <form class="form-signin" method="post" action="addurgence.php">
        <h3 class="form-signin-heading">Ajouter une urgence</h3>
        <label for="title" class="sr-only">Titre de l'urgence</label>
        <input type="text" id="title" name="title" class="form-control" placeholder="Entrez le titre (ex: Urgent, Info, A savoir, Evenement, ...)" autofocus>
        <p></p>
		<label for="info" class="sr-only">Titre de l'urgence</label>
        <input type="text" id="info" name="info" class="form-control" placeholder="Entrez le message de l'urgence" required >
        <p></p>
		<label for="lien" class="sr-only">Lien vers plus d'informations</label>
        <input type="lien" id="lien" name="lien" class="form-control" placeholder="lien de l'urgence http://... (facultatif)"  >
        <p></p>
        <label for="date" >Date de parution de l'Urgence :</label>
        <input type="date" id="date" name="date" class="form-control" required>
		<p></p>
		<label for="datefin" >Date de fin de parution de l'Urgence :</label>
        <input type="date" id="datefin" name="datefin" class="form-control" required>
		<p></p>
		<label for="date" >niveau de l'urgence (1 peu urgent - 5 vraiment très urgent) :</label>
        <input type="number" id="date" name="date" class="form-control" min="1" max="5" required>
		<p></p>
		<label for="verif" class="sr-only">verification</label>
        <input type="password" id="verif" name="verif" class="form-control" placeholder="Entrez le code de vérification" required >
        <p></p>
        <button class="btn btn-danger btn-block " type="submit">Ajouter une urgence</button>
      </form>

    </div> <!-- /container -->
<?php require("_php/footer.php"); ?>
</body>
</html>