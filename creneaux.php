<div class="col-xs-12 col-sm-6">
            <h3  class="entete ui horizontal divider"><strong>Mon prochain créneau</strong></h3>
            <div class="louve-creneau">
			<?php 
				
				$based = $bdd->query('SELECT * FROM creneaux WHERE (login =\'' . $_SESSION['login'] . '\' AND date >= CURDATE()) ORDER BY date ASC LIMIT 0, 1 ');
	
		$rcq = $based->fetch();
	
			$basik = $bdd->query('SELECT * FROM infocreneau WHERE nom =\'' . $rcq['type'] . '\'');
			$bqq = $basik->fetch();
			list($year, $month, $day) = explode("-", $rcq['date']);
			$months = array("janvier", "février", "mars", "avril", "mai", "juin",
			"juillet", "août", "septembre", "octobre", "novembre", "décembre");
			   echo ('<h3>' . $bqq['jour'] . ' ' .$day . ' '.$months[$month-1].' '. $year . ' : ' . $bqq['heure'] . '</h3>');
		
		//$raq->closecursor();
//	$req->closecursor(); 
	?>
                
                <p> Une absence prévue? </p>
                <button class="btn btn-default"><span class="glyphicon glyphicon-earphone"></span> Contactez vos coordinateurs</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">

            <h3  class="entete ui horizontal divider"><strong>Créneaux suivants</strong></h3>
            <div class="louve-creneau">
			<?php 
				$based = $bdd->query('SELECT * FROM creneaux WHERE (login =\'' . $_SESSION['login'] . '\' AND date >= CURDATE())ORDER BY date ASC LIMIT 0, 5 ');
		while($rcq = $based->fetch())
		{
			$basik = $bdd->query('SELECT * FROM infocreneau WHERE nom =\'' . $rcq['type'] . '\'');
			$bqq = $basik->fetch();
			list($year, $month, $day) = explode("-", $rcq['date']);
			   echo ('<h4>' . $bqq['jour'] . ' ' .$day . ' '.$months[$month-1].' '. $year . ' : ' . $bqq['heure'] . '</h4>');
		}
		//$raq->closecursor();
//	$req->closecursor(); 
	?>    
            </div>

        </div>