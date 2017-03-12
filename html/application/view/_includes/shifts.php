<div class="container">
<div class="row">
   

<div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Services suivants</strong></h3>
    <div class="louve-creneau">
    <?php
    $shifts = $user->getNextShifts();
    if (null == $shifts)
        echo ("<h3>Vous n'êtes inscrit a aucun service suivant.</h3>");              
    else
    {
        $countShifts = count($shifts);
	for($i = 0; $i < $countShifts AND $i < 3; $i++)
        {
		$myshift = $shifts[$i];
        $nexttime = $myshift->date;
		 
        echo ('<h3> '. $nexttime .'</h3>');
		echo ('<h3> Coordinateurs</h3>');
	    $countcoordinators = count($myshift->coordinators);
            for($j = 0; $j < $countcoordinators ; $j++)
            {

		    echo ($myshift->coordinators[$j]->getFirstname() . " " . $myshift->coordinators[$j]->getLastname()  . "<br>");
		    echo ('<a href="mailto:' . $myshift->coordinators[$j]->getEmail() . '">' . $myshift->coordinators[$j]->getEmail() );
            echo ("</a><br>");
		    echo ("<a href='tel:" . $myshift->coordinators[$j]->getPhone()  . "'>" . $myshift->coordinators[$j]->getPhone()  . "</a><br>");
            }
        }
    }
    ?>
    </div>
</div>

 <div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Une absence prévue?</strong></h3>
    <div class="louve-creneau">
    <p>Echanger mon service   </p>
    <a href="<?php echo URL . 'forum/category/5'?>">
    <button class="btn btn-default"><span class="glyphicon glyphicon-comment"></span> Consultez le forum</button>
    </a>
    </div>
</div>



</div>
</div>
