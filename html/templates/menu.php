<?php 
    require("_php/base.php");
    include("_php/baseinfo.php");

?>     

<div class="container">


<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
    <div class="container">
        <div class="navbar-header">
        <a class="navbar-brand" href="index.php"><img alt="La Louve" src="img/Louve_logo.png" width="27px"/></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#louvenav" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
			
          <!--  <a href="index.php" class="navbar-brand"><span class="glyphicon glyphicon-heart" style="color:grey"></span></a>-->
        
			
        </div>

        <div class="nav navbar-nav collapse navbar-collapse" id="louvenav">
		
            <li><a href="participation.php"><span class="glyphicon glyphicon-time" style="color:grey"></span> MA PARTICIPATION</a></li>
            <?php  
                // <li><a href="#"><span class="glyphicon glyphicon-calendar" style="color:grey"></span> VIE DE LA LOUVE</a></li> 
                //  <li><a href="documents.php"><span class="glyphicon glyphicon-duplicate" style="color:grey"></span> DOCUMENTS</a></li> 
            ?>
		<!-- -->	<li><a href="services.php"><span class="glyphicon glyphicon-ok" style="color:grey"></span> SERVICES</a></li>
            <li><a href="http://vps247219.ovh.net:4567/"><span class="glyphicon glyphicon-earphone" style="color:grey"></span> FORUM</a></li>
            <?php	
				if (!(isset($_SESSION['admin'])))
				{
					$basez = $bdd->query('SELECT * FROM admins WHERE mail =\'' . $_SESSION['mail'] . '\' LIMIT 0, 1');
					$test = $basez->fetch();
					$_SESSION['admin'] = (isset($test['mail']))? 1 : 0;
				}
				if($_SESSION['admin'] == 1)
					echo('<li><a href="gestion.php"><span class="glyphicon glyphicon-plus" style="color:grey"></span> GESTION </a></li>');
            ?>			
            <?php if(isset( $_SESSION['urgence'])){?>  
                <li><a href="urgences.php"  style="color:lightcoral;"><span class="glyphicon glyphicon-alert urgences"></span> URGENCES</a></li>
            <?php } ?>           
        </div>
		<?php //-earphone ?>
        <ul class="nav navbar-inverse navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bonjour, 
                      <?php 
                    if (!(isset($_SESSION['prenom'])))
				    {
                      echo $_SESSION['prenom'] ; 
                    }
                      ?>
                       
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="mesinfos.php">Mes informations</a></li>
                    <li><a href="#">Messages</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="logout.php">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
  
</nav>
</div>
	
