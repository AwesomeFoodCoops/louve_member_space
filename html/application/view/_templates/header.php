<!DOCTYPE html>
<html>
    <head>
        <title>La louve - mon espace</title>
        <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet" type='text/css'>
        <link href="<?php echo URL; ?>css/bootgrid.css" rel="stylesheet" type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,900,300' rel='stylesheet' type='text/css'>
        <!-- TODO_NOW: pour les deux feuilles de style suivantes, elles ne servent que pour les pages d'ajout d'urgence
         +> faire un import uniquement pour ces pages -->
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/easyui.css">
        <link rel="stylesheet" type="text/css" href="<?php echo URL; ?>css/icon.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <meta charset="UTF-8">
        <style type="text/css">
            @font-face {
                font-family: 'Glyphicons Halflings';
                src: url('fonts/glyphicons-halflings-regular.eot');
            }
        </style>
    </head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo URL; ?>"><img alt="La Louve" src="<?php echo URL; ?>img/Louve_logo.png" width="27px"/></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#louvenav" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="nav navbar-nav collapse navbar-collapse" id="louvenav">
            <li><a href="<?php echo URL . 'home/participation/'; ?>"><span class="glyphicon glyphicon-time" style="color:grey"></span> MA PARTICIPATION</a></li>
			<li><a href="<?php echo URL . 'home/services/'; ?>"><span class="glyphicon glyphicon-ok" style="color:grey"></span> SERVICES</a></li>
            <li><a href=""><span class="glyphicon glyphicon-earphone" style="color:grey"></span> FORUM</a></li>
            <li><a href="<?php echo URL . 'management/'; ?>"><span class="glyphicon glyphicon-plus" style="color:grey"></span> GESTION </a></li>
        <?php
            if ($GLOBALS['hasEmergency']) {
                $emergencyStyle = "color:lightcoral";
            }
            else {
                $emergencyStyle = "color:grey";
            }
            echo '<li><a href="' . URL . 'urgences/" style="' . $emergencyStyle . ';"><span class="glyphicon glyphicon-alert urgences"></span> URGENCES</a></li>';
        ?>
        </div>
        <ul class="nav navbar-inverse navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Bonjour,
                    <?php echo $GLOBALS['User']->name ?>
                <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?php echo URL . 'home/myinfo/'; ?>">Mes informations</a></li>
                    <li><a href="#">Messages</a></li>
                    <li role="separator" class="divider"></li>
                    <li><a href="<?php echo URL . 'login/logout/'; ?>">Déconnexion</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

