    <div class="row">
	<?php require("creneaux.php");
		  require("_php/base.php");?>
   
        <div class="col-lg-12">
            <h3  class="entete ui horizontal divider"><strong>Prochaine AG</strong></h3>
            <div class="louve-box">

            <?php 
			$based = $bdd->query('SELECT * FROM assemblees WHERE date >= CURDATE() ORDER BY date ASC LIMIT 0, 1 ');
			$rcq = $based->fetch();
	//		if(isset...)
			echo ('<h3>' . $rcq['infos'] . ' </a></h3>');
		
		//$raq->closecursor();
//	$req->closecursor(); 
	
		echo ('<a href="'. $rcq['lien'] . '">
           <button class="btn btn-default type="submit">Inscription / Ordre du Jour / Questions</button>
			</a>');
			?>
        </div>

    </div>
    </div>