<div class="clearfix"></div>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <h3  class="entete ui horizontal divider"><strong>Prochaine AG</strong></h3>
            <div class="louve-box">
            <?php
                $infos = $event->getNextMeeting();
                if (is_object($infos)) {
			        echo ('<h3>' . $infos->info . ' </a></h3>');
		            echo ('<a href="'. $infos->lien . '"><button class="btn btn-default type="submit">Inscription / Ordre du Jour / Questions</button></a>');
                } else {
                    echo "La date sera bientôt définie.";   
                }
			?>
            </div>
        </div>
           <div class="col-xs-12 col-sm-6">
        <h3  class="entete ui horizontal divider"><strong>Bureau des membres</strong></h3>
        <div class="louve-box">
			<h3><strong>Horaires d’ouverture<strong/></h3>
            <h4>mardi : 13h30 - 16h</h4>
            <h4>du mercredi au vendredi : 13h30 - 20h</h4>
            <h4>samedi : 10 - 16h</h4>			
	    <h4> <button type="button" class="btn btn-default btn-sm">
		    <a href="tel:0186959190"><span class="glyphicon glyphicon-earphone"></span> 01 86 95 91 90</a>
        </button>
		</h4>
		
        </div>
    </div>
    </div>
</div>
