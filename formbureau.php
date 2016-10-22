<?php
require("_php/head.php");
?>
<body>
<?php
require("menu.php");
require("_php/base.php");
?>

<div class="container">
	<?php if (isset($_SESSION['posted']) and $_SESSION['posted'] == 114)
			echo ('<p><strong> Votre message a bien été envoyé. </strong></p>');?>
	<?php if (isset($_SESSION['posted']) and $_SESSION['posted'] == 214)
			echo ('<p><strong> Une erreur est survenue durant l\'envoi de votre message. </strong></p>');
	$_SESSION['posted'] = 14;
	?>
      <form class="form-signin" method="post" action="messagetobureau.php">
        <h3 class="form-signin-heading">Envoyer un message au bureau des membres</h3>
		<label for="sujet" class="sr-only">Sujet : </label>
        <select id="sujet" name="sujet" class="form-control">
           <option value="sujet indéfini">sujet du message : </option>
           <option value="Question sur les créneaux">Question sur les créneaux</option>
           <option value="Question sur le fonctionnement du supermarché">Question sur le fonctionnement du supermarché</option>
           <option value="Question sur les AG">Question sur les assemblées générales</option>
           <option value="Question sur les produits">Question sur les produits</option>
           <option value="Question sur mon statut">Question sur mon statut</option>
           <option value="Suggestion">Suggestion</option>
           <option value="Badge perdu">Badge perdu</option>
		   <option value="Autre demande">Autre</option>
       </select>
        <p></p>
        <label for="title" class="sr-only">Message</label>
        <input type="textarea" rows="6" id="title" name="message" class="form-control" placeholder="Entrez votre message ici" autofocus>
        <p></p>
        <button class="btn btn-danger btn-block " type="submit">Envoyer le message</button>
      </form>

    </div> <!-- /container -->
<?php require("_php/footer.php"); ?>
</body>
</html>