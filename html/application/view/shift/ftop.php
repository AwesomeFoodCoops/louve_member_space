<div class="container">
    <div class="row">
        <h3  class="entete ui horizontal divider"><strong>Créneaux volants disponibles</strong></h3>
            <div class="louve-creneau">
                <div class = "table-responsive">
                <table class = "table">
                <thead>
                <tr>
                    <th>Créneau</th>
                    <th>Date</th>
                    <th>Heure de début</th>
                    <th>Places disponibles</th>
                </tr>
                </thead>
                <tbody>
                <?php
                for($i = 0; $i < count($ftopShiftDisplays) AND $i < 3; $i++)
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
