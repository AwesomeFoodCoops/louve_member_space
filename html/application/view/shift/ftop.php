<div class="container">
    <div class="row">

    <div class="row">
        <div class="col-lg-12">
            <h3 class=" ui horizontal divider"><strong>Mes infos</strong></h3>
            <div class="louve-box">
            <?php
            if( !isset($user) ){
                echo ('<p>Données temporairement indisponible</p>');
            } else {
                echo ('<p><strong>Compteur pour l&acute;équipe volante :</strong> '. $user->getFinal_ftop_point() .'</p>');
            }
            ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12">
        <h3  class="entete ui horizontal divider"><strong>Services volants disponibles</strong></h3>
            <div class="louve-creneau">
                <div class = "table-responsive">
                <table class = "table">
                <thead>
                <tr>
                    
                    <th>Date</th>
                    <th>Heure de début</th>
                    <th>Places disponibles</th>
                    <th>Inscription</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for($i = 0; $i < count($ftopShiftDisplays); $i++)
                {
                    $shiftDisplay = $ftopShiftDisplays[$i];
                    echo ($shiftDisplay);
                }
                ?>
                </tbody>
                </table>
                </div>
            </div>
        </div>
  

    </div>
</div>
