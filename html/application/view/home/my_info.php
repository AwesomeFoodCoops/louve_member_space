<?php

$user = $GLOBALS['User'];

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="entete"><strong>Mes infos</strong></h3>
            <div class="louve-box">
            <?php
            if( !isset($user) ){
                echo ('<p>Données temporairement indisponible (0x1) </p>');
            } else {
                echo ('<p> Bonjour '. $user->getFirstname() . ' ' . $user->getName() .'.<p>');
                echo ('<p> Votre numéro de téléphone est '. $user->getPhone() .' . <p>');
                echo ('<p> Votre e-mail est '. $user->getEmail() .'. <p>');
                echo ('<p> Votre LouveID est '. $user->getId() .'. <p>');
                //~ if ($user->isLeader())
                    //~ echo ('<p> <strong>Vous êtes coordinateur.</strong> <p>');

                echo ('<p>'.$user->getStatusDisplay()['full_msg'].'</p>');

                if( !$user->connected )
                    echo('<p>NOT CONNECTED TO ODOO</p>');
                else
                    echo('<p>CONNECTED TO ODOO</p>');
                //~ if ($user->status == 1)
                    //~ echo ('<p> <br/><strong>Vous êtes à jour !</strong> <p>');
                //~ else if ($user->status == 2)
                    //~ echo ('<p> <br/><strong>Attention, vous avez des services en retard !</strong> <p>');
                //~ else if ($user->status == 3)
                    //~ echo ('<p> <br/><strong>Vous êtes désinscrit. Contactez le bureau des membres et ratrrapez vos créneaux manqués pour continuer à faire vos courses à la louve.</strong> <p>');
                echo ('<p> <br/><strong>Pour modifier ces informations contactez le bureau des membres. </strong><p>');
                echo ('<a href="changepwd.php">
                       <button class="btn btn-default type="submit">modifier mon mot de passe</button>
                       </a>');
            }
            ?>
            </div>
        </div>
    </div>
</div>
