<?php
/* *
 *  Cette page présente ses infos au membre de la Louve.
 * 
 *  La classe utilisée pour le membre est dans cl_LouveUser.php.
 *  L'objet est conservé dans la session.
 * */
require '_php/head.php';
require 'menu.php';
require '_php/base.php';
?>

<div class="container">
 <div class="row">
   
 
         <div class="col-lg-12">
            <h3 class="entete"><strong>Mes infos</strong></h3> 
            <div class="louve-box"> 
			
			<?php 
						
				$base = $bdd->query('SELECT * FROM members WHERE login =\'' . $_SESSION['login'] . '\'');
				$req = $base->fetch();
				
				if( !isset($_SESSION['name']) )
				    $_SESSION['name'] = 'Nemo';

				if( !isset($req) ) {
				    echo ('<p>Données temporairement indisponible (0x1) </p>');
				} else {
					
					echo ('<p> Bonjour '. $_SESSION['name'] .'.<p>');
					echo ('<p> Votre numéro de téléphone est '. $_SESSION['mobile'] .' . <p>');
					echo ('<p> Votre e-mail est '. $_SESSION['mail'] .'. <p>');
					echo ('<p> Votre LouveID est '. $req['login'] .'. <p>');
					if ($req['coordinateur'] == 1)
						echo ('<p> <strong>Vous êtes coordinateur.</strong> <p>');
					if ($req['status'] == 1)
						echo ('<p> <br/><strong>Vous êtes à jour !</strong> <p>');
					else if ($req['status'] == 2)
						echo ('<p> <br/><strong>Attention, vous avez des services en retard !</strong> <p>');
					else if ($req['status'] == 3)
						echo ('<p> <br/><strong>Vous êtes désinscrit. Contactez le bureau des memebres et ratrrapez vos créneaux manqués pour continuer à faire vos courses à la louve.</strong> <p>');
					echo ('<p> <br/><strong>Pour modifier ces informations contactez le bureau des membres. </strong><p>');
					echo ('<a href="changepwd.php">
						   <button class="btn btn-default type="submit">modifier mon mot de passe</button>
				           </a>');
			    }
			?>
			</div>
        </div>
    </div>
</div>
<?php require '_php/footer.php'; ?>
