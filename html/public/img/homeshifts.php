<div class="container">
    <div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Mon prochain créneau</strong></h3>
    <div class="louve-creneau">
    <?php

    $shifts = $GLOBALS['User']->getNextShifts();
    if ( isset($shifts[0]) && null !== $shifts[0])
    {
        $nexttime = $shifts[0];
        echo ('<h3> '. $nexttime .'</h3>');
    }
    else {
        echo ("<h3>Vous n'êtes inscrit a aucun créneau futur.</h3>");
    }
    ?>

    <p> Une absence prévue? </p>
    <button class="btn btn-default"><span class="glyphicon glyphicon-earphone"></span> Contactez vos coordinateurs</button>
    </div>
</div>

<div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Le magasin</strong></h3>
    <div class="louve-creneau">
    <?php
	$day = date('D');
	$min = date('i');
	$hrs = date('H');
	echo '<h4><strong><img src="img/map.png" alt="map" />116 Rue des Poissonniers, 75018 Paris</Strong></h4>';
	if ($day == 'Mon')
	{
		echo '<h3>Le magasin est fermé aujourd\'hui. A demain.</h3>';
		echo '<h4 style="color : red">Actuellement fermé</h4>';
	}
	else if ($day == 'Sun')
	{
		echo '<h3>Le magasin est ouvert aujourd\'hui de 8h30 à 12h30.</h3>';
		if ($hrs < 8 OR $hrs > 13)
			echo '<h4 style="color : red">Actuellement fermé</h4>';
		else if ($hrs == 8 AND $min < 30)
			echo '<h4 style="color : red">Actuellement fermé</h4>';
		else if ($hrs == 12 AND $min > 30)
			echo '<h4 style="color : red">Actuellement fermé</h4>';
		else if ($hrs == 12 AND $min < 30)
			echo '<h4 style="color : orange">Fermeture imminente</h4>';
		else 
			echo '<h4 style="color : green">Actuellement ouvert</h4>';
	}
	else
	{
		echo '<h3>Le magasin est ouvert aujourd\'hui de 9h à 21h.</h3>';
		if ($hrs < 9 OR $hrs > 21)
			echo '<h4 style="color : red">Actuellement fermé</h4>';
		else if ($hrs == 20)
			echo '<h4 style="color : orange">Fermeture imminente</h4>';
		else 
			echo '<h4 style="color : green">Actuellement ouvert</h4>';
	}
	echo '<p> Ces horaires sont susceptibles de varier lors de certains évènements. Consultez les urgences pour en savoir plus.</p>';
		
    ?>
    </div>
</div>
</div>
