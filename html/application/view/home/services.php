<?php

$display = $user->getStatusDisplay();

?>
<div class="container">
    <div class="row">
    <?php
                //echo ($user->getShiftType());
                if( $user->getShiftType()=='standard' ){
                    //echo ('Programmer un service');
              
                ?>
        <div class="col-xs-12 col-sm-6">
                        <div class="louve-creneau">
                <h3><strong>
                Programmer un service anticipé

                </strong></h3>
                <p>Si vous êtes membre d’une équipe ABCD, vous pouvez programmer des services anticipés en passant par ici. <br>
                Accumuler des services anticipés est le seul moyen pour les membres des équipes ABCD de faire des “services en avance” pour demander ensuite un congé anticipé --période de 8 semaines minimum pendant laquelle vous n’avez pas besoin de faire vos services tout en gardant le doit de faire vos courses. <br>
                Merci de consulter les manuel de membres pour les détails.</p>

                <a href="<?php echo URL . 'shift/ftopshifts/'; ?>">
                <button class="btn btn-default" style="border-color : green; color: green;" ><span class="glyphicon glyphicon-ok"></span>Je regarde les services.</button>  
                </a>
            </div>
        </div>
        <?php
          }
                else{
                    //echo ('Programmer un service volant');
                
                ?>
        <div class="col-xs-12 col-sm-6">
                        <div class="louve-creneau">
                <h3><strong>Programmer un service volant</strong></h3>
                <p>Si vous êtes membre de l’équipe volante, passez par ici pour voir les services disponibles et programmer le vôtre. L’annulation d’un service se fait uniquement par contact direct avec le bureau des membres.</p>

                <a href="<?php echo URL . 'shift/ftopshifts/'; ?>">
                <button class="btn btn-default" style="border-color : green; color: green;" ><span class="glyphicon glyphicon-ok"></span>Je regarde les services.</button>  
                </a>
            </div>
        </div>
        <?php
          }
          ?>
        <div class="col-xs-12 col-sm-6">
            <div class="louve-creneau">
                <h3><strong>Echanger son service</strong></h3>
                <p> Vous serez indisponible pour effectuer votre prochain service ? Vous pouvez tenter de l'échanger ici avec un autre membre de la louve. </br></p>
              <a href="https://membres.cooplalouve.fr/forum/category/5/échanges">  
        <button class="btn btn-default" style="border-color : green; color : green;"><span class="glyphicon glyphicon-retweet"></span> Echanger mon service.</button>
        </a>        
    </div>
        </div>
    </div>
    <!--
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <div class="louve-creneau">
                <h3><strong>Suggérer un produit</strong></h3>
                <p> Lors de vos dernières courses un produit vous a manqué ? Découvrez ici comment suggérer les produits que vous souhaitez voir apparaître en rayons.</p>
                <button class="btn btn-default disabled" style="border-color: red; color: red;"><span class="glyphicon glyphicon-apple"></span> Prochainement ici.</button>
            </div>
        </div> -->
        <?php /*
        <div class="col-xs-12 col-sm-6">
            <div class="louve-creneau">
                <h3><strong>Contacter le bureau des membres</strong></h3>
                <p> Un problème ? Une remarque ? Une question ou suggestion ? Le bureau des membres est là pour vous aider ! </p>
                <button class="btn btn-default disabled" style="border-color: red; color: red;"><span class="glyphicon glyphicon-pencil"></span> Prochainement ici.</button>
            </div>
        </div>
    </div>

    <div class="row"> */ ?>
        <div class="col-xs-12 col-sm-6">
            <div class="louve-creneau">
                <h3><strong>Organiser un covoiturage</strong></h3>
                <p> Trouvez des personnes qui habitent près de chez vous et organisez-vous pour vos déplacements vers et depuis la louve ! </p>
                <a href="https://membres.cooplalouve.fr/forum/category/6/covoiturages">
                 <button class="btn btn-default" style="border-color: green; color: green;"><span class="glyphicon glyphicon-move"></span> Organiser mon covoiturage.</button>
                </a>
                    </div>
            </div>
        </div>
    </div>
</div>
