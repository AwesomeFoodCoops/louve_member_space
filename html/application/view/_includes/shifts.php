<div class="container">
    <div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Mon prochain service</strong></h3>
    <div class="louve-creneau">
    <?php

    $shifts = $GLOBALS['User']->getNextShifts();
    if ( isset($shifts[0]) && null !== $shifts[0])
    {
        $nexttime = $shifts[0];
        echo ('<h3> '. $nexttime .'</h3>');
    }
    else {
        echo ("<h3>Vous n'êtes inscrit a aucun service futur.</h3>");
    }
    ?>

    <p> Une absence prévue? </p>
    <button class="btn btn-default"><span class="glyphicon glyphicon-earphone"></span> Contactez vos coordinateurs</button>
    </div>
</div>

<div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Services suivants</strong></h3>
    <div class="louve-creneau">
    <?php
    if (null == $shifts)
        echo ('<strong>Erreur : </strong> Prochain service indisponible actuellement. Veuillez réessayer plus tard ou contacter le bureau des membres.');
    else
    {
        for($i = 0; $i < count($shifts) AND $i < 3; $i++)
        {
            $shift = $shifts[$i];
            echo ('<h3> '. $shift . '</h3>');
        }
    }
    ?>
    </div>
</div>
</div>
