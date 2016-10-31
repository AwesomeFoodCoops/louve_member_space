<?php
session_start();
header('location: produits.php');
$log = $_SESSION['mail'];
$prod = strip_tags($_POST['produit']);
require("_php/base.php");

$base = $bdd->query('SELECT mail FROM moderation WHERE mail=$log');
$req = $base->fetch();
if (!(isset($req['mail']))
{
	$base = $bdd->prepare('INSERT INTO `products` (`id`, `content`, `login`, `type`, `positive`, `negative`, `time`) VALUES (NULL, "salami sans nitrites", "jeandenis", "1", "1", NULL, CURRENT_TIMESTAMP)');
	$base->execute;
}
	
?>