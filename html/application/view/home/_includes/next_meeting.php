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
			<h3><strong> Rendez-vous au magasin <strong/></h3>
            <h4>mardi : 13h30 - 16h</h4>
            <h4>mercredi - vendredi : 13h30 - 20h</h4>
            <h4>samedi : 10 - 16h</h4>
        </div>
    </div>
    </div>
</div>
