<?php
$basu = $bdd->query('SELECT * FROM urgences WHERE date >= CURDATE() AND datefin <= CURDATE() ORDER BY niveau DESC LIMIT 0, 1');
$ruq = $basu->fetch();
$urgence=false;
if (isset($ruq['info']))
{
	if (isset($ruq['lien']))
	{
		echo ('
		<div class="alert alert-info fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong> '.$ruq['titre'] .' : </strong> <a href="'. $ruq['lien'].'"> '. $ruq['info'].' </a>
		</div>
		</div>');
	}
	else
	{
		echo ('
		<div class="alert alert-info fade in">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong>'.$ruq[titre].' : </strong> '. $ruq['info'].'
		</div>
		</div>');
	}
    $urgence=true;
}
?>