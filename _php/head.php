<?php
/* C'est l'entête de toutes les pages protégées du site (il faut être 
 * loggé pour y accéder).
 * 
 * A part login.php et logout.php, toutes les pages doivent donc commencer 
 * par la ligne qui suit sans rien avant:
 * 
 * require_once '_php/head.php' 
 * 
 * */
$included = TRUE;
require_once '_php/session.php'; // gestion de la session
?>

<!DOCTYPE html>
<html>
    <head>
        <title>La louve - mon espace</title>
        <link rel="stylesheet" type="text/css" href="<?=EmConfig::ROOT?>/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?=EmConfig::ROOT?>/css/bootgrid.css">
        <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,900,300' rel='stylesheet' type='text/css'>
        <meta charset="UTF-8">
        <style type="text/css">
            @font-face {
                font-family: 'Glyphicons Halflings';
                src: url('fonts/glyphicons-halflings-regular.eot');
            }
            
        </style>
    </head>
<body> 
