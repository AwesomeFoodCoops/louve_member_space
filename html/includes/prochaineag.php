    <div class="row">
	<?php require("creneaux.php");
		  require("_php/base.php");?>
   
        <div class="col-lg-12">
            <h3  class="entete ui horizontal divider"><strong>Prochaine AG</strong></h3>
            <div class="louve-box">

            <?php 
			$based = $bdd->query('SELECT * FROM assemblees WHERE date >= CURDATE() ORDER BY date ASC LIMIT 0, 1 ');
			$rcq = $based->fetch();
if($based->rowCount() == 1 )
{
if (!(is_null( $rcq['titre'] )))
	{
			echo ('<h3>' . $rcq['titre'] . '</h3>');
	}
if (!(is_null( $rcq['infos'] )))
	{
			echo ('<p>' . $rcq['infos'] . ' <br/>');
	}
	if (!(is_null( $rcq['lien'] )))
	{
			echo ('<a href="');
			echo ( $rcq['lien']);
			echo('"> <button class="btn btn-default" type="submit">Inscription / Ordre du Jour / Questions</button></a>');
	}
	echo ('</p>');
}
else{
	echo ('<h3>Aucune AG n&acute;est pr&eacute;vue</h3>');
}
			?>
        </div>

    </div>
    </div>