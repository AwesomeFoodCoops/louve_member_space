<?php

$user = $GLOBALS['User'];
$display = $user->getStatusDisplay();

?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="entete"><strong>Mes infos</strong></h3>
            <div class="louve-box">
            <?php
            if( !isset($user) ){
                echo ('<p>Données temporairement indisponible</p>');
            } else {
                echo ('<h4> Bonjour '. $user->getFirstname() . ' ' . $user->getLastname() .'.</h4>');
                echo ('<p><strong>Votre numéro de téléphone :</strong> '. $user->getPhone() .' . <p>');
                echo ('<p> <strong>Votre e-mail de contact :</strong> '. $user->getEmail() .'. <p>');
                echo ('<p> <strong>Votre numéro de membre : </strong> '. $user->getId() .'. <p>');
                echo ('<p><strong>'.$display['alert_msg'].'</strong> '.$display['full_msg'].'</p>');
                echo ('<p> <br/><strong>Pour modifier ces informations contactez le bureau des membres. </strong><p>');
		echo ('<a href="' . URL . '/selfservice">
                       <button class="btn btn-default type="submit">modifier mon mot de passe</button>
                       </a>');
            }
            ?>
            </div>
        </div>
    </div>
</div>
