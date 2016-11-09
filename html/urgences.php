<?php
require("_php/head.php");
?>
<body>

<?php
require("menu.php");
require("_php/base.php");
?>
<div class="container">

<div class="col-xs-12 col-sm-12">
                   <div class="louve-creneau">
                 <h3><strong>Les urgences du moment</strong></h3>
                <p> La louve a besoin de vous ! Nous avons actuellement les urgences suivantes en cours. Toute aide est la bienvenue. </p>
				<?php 
    $basu = $bdd->query('SELECT * FROM urgences WHERE date <= CURDATE() AND datefin >= CURDATE() ORDER BY niveau DESC LIMIT 0, 15');
    
    $urgence=false;
    while($ruq = $basu->fetch())
    {
          if (isset($ruq['info']))
            {
             if (isset($ruq['lien']))
            {	
            echo ('
            <div class="well well-lg done">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong> '.$ruq['titre'] .' : </strong> <a href="'. $ruq['lien'].'"> '. $ruq['info'].' </a>
            </div>
            ');
            }
          else
          {
            echo ('
            <div class="well well-lg done">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>'.$ruq[titre].' : </strong> '. $ruq['info'].'
            </div>
            ');
         }
        $urgence=true;
        }
    }?>
        </div>
        </div>
</div>
<?php require("_php/footer.php"); ?>
</body>
</html>