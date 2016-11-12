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
                echo ('<p> Bonjour '. $user->getFirstname() . ' ' . $user->getLastname() .'.<p>');
                echo ('<p> Votre numéro de téléphone est '. $user->getPhone() .' . <p>');
                echo ('<p> Votre e-mail est '. $user->getEmail() .'. <p>');
                echo ('<p> Votre LouveID est '. $user->getId() .'. <p>');
                echo ('<p><strong>'.$display['alert_msg'].'</strong> '.$display['full_msg'].'</p>');
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
