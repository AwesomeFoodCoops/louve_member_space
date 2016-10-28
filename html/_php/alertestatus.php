<?php 

if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'up_to_date')
	echo ('
  <div class="alert alert-success fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Vous êtes à jour</strong>
  </div>');
 else if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'alert')
	echo ('
  <div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Attention</strong> Vous avez des services en retard.
  </div>');
 else if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'suspended')
	echo ('
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alerte</strong> Vous avez été suspendu, merci de contacter le bureau des membres.
  </div>');
  else if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'delay')
	echo ('
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alerte</strong> Votre participation est temportairement gelée.
  </div>');
  else if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'unpayed')
	echo ('
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alerte</strong> Vous avez un paiement en retard, vous êtes momentanément suspendu, merci de contacter le bureau des membres.
  </div>');
  else if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'blocked')
	echo ('
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alerte</strong> Vous avez été bloqué, merci de contacter le bureau des membres.
  </div>');
  else if (isset($_SESSION['louvestatus']) AND $_SESSION['louvestatus'] === 'unsuscribed')
	echo ('
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alerte</strong> Vous avez été désinscrit, merci de contacter le bureau des membres.
  </div>');
  else
	echo ('
  <div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Erreur</strong> Un problème technique nous empêche actuellement de connaitre votre status. Réessayez plus tard ou contactez le bureau des membres.
  </div>'); 
  //alert suspended delay unpayed blocked unsuscribed
/*elseif (isset($req['status']) AND $req['status'] == 2)
	echo ('
  <div class="alert alert-warning fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Attention</strong> Vous avez des services en retard.
  </div>');
 
elseif (isset($req['status']) AND $req['status'] == 3)
	echo ('
  <div class="alert alert-danger fade in">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Alerte</strong> Vous avez été désinscrit, merci de contacter le bureau des membres.
  </div>
</div>');*/
?>