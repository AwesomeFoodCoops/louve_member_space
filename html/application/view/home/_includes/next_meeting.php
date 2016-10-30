<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3  class="entete ui horizontal divider"><strong>Prochaine AG</strong></h3>
            <div class="louve-box">
            <?php
                $infos = $meeting->getNext();
			    echo ('<h3>' . $infos->infos . ' </a></h3>');
		        echo ('<a href="'. $infos->lien . '">
                    <button class="btn btn-default type="submit">Inscription / Ordre du Jour / Questions</button>
                    </a>');
			        ?>
            </div>
        </div>
    </div>
</div>
