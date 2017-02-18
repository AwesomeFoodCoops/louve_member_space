<div class="container">
    <div class="col-xs-12 col-sm-5">
    <h3  class="entete ui horizontal divider"><strong>Mon prochain service</strong></h3>
    <div class="louve-creneau">
    <?php

    $shifts = $user->getNextShifts();
	
    if ( isset($shifts[0]) && null !== $shifts[0])
    {
		
		$myshift = $shifts[0];
        $nexttime = $myshift->date;
		 
        echo ('<h3> '. $nexttime .'</h3>');
		echo ('<h3> Coordinateurs</h3>');
            for($j = 0; $j < count($myshift->coordinators) ; $j++)
            {
		    echo ($myshift->coordinators[$j]->firstname . " " . $myshift->coordinators[$j]->lastname  . "<br>");
			echo ('<a href="mailto:' . $myshift->coordinators[$j]->mail . '">' . $myshift->coordinators[$j]->mail );
            echo ("</a><br>");
		    echo ("<a href='tel:" . $myshift->coordinators[$j]->phone  . "'>" . $myshift->coordinators[$j]->phone  . "</a><br>");
            }
    }
    else {
        echo ("<h3>Vous n'êtes inscrit a aucun service.</h3>");
    }
    ?>
  </div>
</div>

<div>
    <div class="col-xs-12 col-sm-2">
        <h3 class="entete ui horizontal divider"><strong>Semaine</strong><div id="subtitle">en cours</h3><div></h3>
        <div class="louve-creneau">
            <div id="current_week">
                <?php echo $user->getCurrentWeek(); ?>
            </div>
            <a href="pdfs/CalendrierABCD.pdf" target="_blank">Calendrier ABCD</a>
        </div>
    </div>
</div>

<div class="col-xs-12 col-sm-5">
    <h3  class="entete ui horizontal divider"><strong>Le magasin</strong></h3>
    <div class="louve-creneau">
    <?php

	$day = date('D');
	$min = date('i');
	$hrs = date('H');
	if ($day == 'Mon')
	{
		echo '<h3 style="color : red">Actuellement fermé</h3>';
		echo '<h4>Le magasin est fermé aujourd\'hui. A demain.</h4>';
	}
	else if ($day == 'Sun')
	{
		$debut = "08:30:00";
		$imminente = "11:30:00";
		$fin = "12:30:00";

		if (time() >= strtotime($debut) && time() <= strtotime($fin)) {
			if (time() >= strtotime($imminente))
			echo '<h3 style="color : orange">Fermeture imminente</h3>';
			else
			echo '<h3 style="color : green">Actuellement ouvert</h3>';
		}
		else{
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		}
		echo '<h4>Le magasin est ouvert le dimanche de 8h30 à 12h30.</h4>';
		/*if ($hrs < 8 OR $hrs > 13)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 8 AND $min < 30)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 12 AND $min > 30)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 12 AND $min < 30)
			echo '<h3 style="color : orange">Fermeture imminente</h3>';
		else 
			echo '<h3 style="color : green">Actuellement ouvert</h3>';
		echo '<h4>Le magasin est ouvert aujourd\'hui de 8h30 à 12h30.</h4>';
		*/
	}
	else
	{
		$debut = "09:00:00";
		$imminente = "20:00:00";
		$fin = "21:00:00";

		if (time() >= strtotime($debut) && time() <= strtotime($fin)) {
			if (time() >= strtotime($imminente))
			echo '<h3 style="color : orange">Fermeture imminente</h3>';
			else
			echo '<h3 style="color : green">Actuellement ouvert</h3>';

		}
		else{
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		}
		/*

		if ($hrs < 9 OR $hrs > 21)
			echo '<h3 style="color : red">Actuellement fermé</h3>';
		else if ($hrs == 20)
			echo '<h3 style="color : orange">Fermeture imminente</h3>';
		else 
			echo '<h3 style="color : green">Actuellement ouvert</h3>';
			*/
		echo '<h4>Le magasin est ouvert aujourd\'hui de 9h à 21h.</h4>';
	}
	//echo '<a href="http://www.openstreetmap.org/node/4437524492#map=16/48.8944/2.3530" ><button class="btn btn-default"><span class="glyphicon glyphicon-map-marker"></span> 116 Rue des Poissonniers, 75018 Paris</button></a>';
	echo '<p> Ces horaires sont susceptibles de varier lors de certains évènements. Consultez les urgences pour en savoir plus.</p>';
		
    ?>
    </div>
</div>
