<?php
/* *
 *  Cette page est le point d'entrée de l'espace membre de la Louve.
 * */
require '_php/head.php';
require 'menu.php';
require '_php/base.php';
?>

<div class="container">
<?php 
    $base = $bdd->query('SELECT status FROM members WHERE login =\'' . $_SESSION['login'] . '\'');
    $req = $base->fetch();
    include("_php/alertestatus.php");
    $basu = $bdd->query('SELECT * FROM urgences WHERE date <= CURDATE() AND datefin >= CURDATE() ORDER BY niveau DESC LIMIT 0, 5');
    
    $urgence=false;
    while($ruq = $basu->fetch())
    {
          if (isset($ruq['info']))
            {
             if (isset($ruq['lien']))
            {
            echo ('
            <div class="alert alert-info fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> '.$ruq['titre'] .' : </strong> <a href="'. $ruq['lien'].'"> '. $ruq['info'].' </a>
            </div>
            ');
            }
          else
          {
            echo ('
            <div class="alert alert-info fade in">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>'.$ruq[titre].' : </strong> '. $ruq['info'].'
            </div>
            ');
         }
        $urgence=true;
        }
    }
?>
<?php 
    include 'includes/prochaineag.php';
    include 'includes/basedocuments.php'; 
?>
</div>

<?php 
require '_php/footer.php'; 
?>
