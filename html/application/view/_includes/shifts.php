<div class="container">
<div class="row">
   

<div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Services suivants</strong></h3>
    <div class="louve-creneau">
    <?php
    $shifts = $GLOBALS['User']->getNextShifts();
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

 <div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Une absence prévue?</strong></h3>
    <div class="louve-creneau">
    <p>Echanger mon service   </p>
    <button class="btn btn-default" href="https://membres.cooplalouve.fr/forum/category/4/comments-feedback"><span class="glyphicon glyphicon-earphone"></span> Consultez le forum</button>
    </div>
</div>


</div>
</div>
