<div class="col-xs-12 col-sm-6">
            <h3  class="entete ui horizontal divider"><strong>Mon prochain créneau</strong></h3>
            <div class="louve-creneau">
			<?php 
	
				require ("forms/recuperation.php");
	//			$based = $bdd->query('SELECT * FROM creneaux WHERE (login =\'' . $_SESSION['login'] . '\' AND date >= CURDATE()) ORDER BY date ASC LIMIT 0, 1 ');
	
	//	$rcq = $based->fetch();
	
	//		$basik = $bdd->query('SELECT * FROM infocreneau WHERE nom =\'' . $rcq['type'] . '\'');
	//		$bqq = $basik->fetch();
			if (isset($result[0]))
			{
				$nexttime = $result[0]->me['struct']['date_begin']->me['string'];

				$nexttime_Paris = new DateTime($nexttime.' +00');
            	$nexttime_Paris->setTimezone(new DateTimeZone('Europe/Paris')); 
            	$nexttime_string = $nexttime_Paris->format('Y-m-d H:i:s');

				list ($date, $time) = explode (" ", $nexttime_string);
				list($year, $month, $day) = explode("-", $date);
				list ($heure, $minutes, $secondes) = explode(":", $time);
				$timestamp = mktime(0, 0, 0, $month, $day, $year);
				$dd = date('D', $timestamp);
				if ($dd == 'Mon')
					$dd = 'Lundi';
				elseif ($dd == 'Tue')
					$dd = 'Mardi';
				elseif ($dd == 'Wed')
					$dd = 'Mercredi';
				elseif ($dd == 'Thu')
					$dd = 'Jeudi';
				elseif ($dd == 'Fri')
					$dd = 'Vendredi';
				elseif ($dd == 'Sat')
					$dd = 'Samedi';
				elseif ($dd == 'Sun')
					$dd = 'Dimanche';
				$months = array("janvier", "février", "mars", "avril", "mai", "juin",
				"juillet", "août", "septembre", "octobre", "novembre", "décembre");
				   echo ('<h3> '.$dd.' ' .$day . ' '.$months[$month-1].' '. $year . ' : ' . $heure . 'H'.$minutes.'</h3>');
			}
			else
				echo ("<h3>Vous n'êtes inscrit a aucun créneau futur.</h3>");

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
			if (!(isset($result)))
				echo ('<strong>Erreur : </strong> Prochains crénaux indisponibles actuellement. Veuillez réessayer plus tard ou contacter le bureau des membres.');
			else
			{
				 for($i = 0; $i < count($result) AND $i < 3; $i++)
				{
					$nexttime = $result[$i]->me['struct']['date_begin']->me['string'];
					
					$nexttime_Paris = new DateTime($nexttime.' +00');
            		$nexttime_Paris->setTimezone(new DateTimeZone('Europe/Paris')); 
            		$nexttime_string = $nexttime_Paris->format('Y-m-d H:i:s');

					list ($date, $time) = explode (" ", $nexttime_string);
					list($year, $month, $day) = explode("-", $date);
					list ($heure, $minutes, $secondes) = explode(":", $time);
					$timestamp = mktime(0, 0, 0, $month, $day, $year);
					$dd = date('D', $timestamp);
					if ($dd == 'Mon')
						$dd = 'Lundi';
					elseif ($dd == 'Tue')
						$dd = 'Mardi';
					elseif ($dd == 'Wed')
						$dd = 'Mercredi';
					elseif ($dd == 'Thu')
						$dd = 'Jeudi';
					elseif ($dd == 'Fri')
						$dd = 'Vendredi';
					elseif ($dd == 'Sat')
						$dd = 'Samedi';
					elseif ($dd == 'Sun')
						$dd = 'Dimanche';
					$months = array("janvier", "février", "mars", "avril", "mai", "juin",
					"juillet", "août", "septembre", "octobre", "novembre", "décembre");
					   echo ('<h3> '.$dd.' ' .$day . ' '.$months[$month-1].' '. $year . ' : ' . $heure . 'H'.$minutes.'</h3>');
				}
			}
		//$raq->closecursor();
//	$req->closecursor(); 
	?>    
            </div>

        </div>