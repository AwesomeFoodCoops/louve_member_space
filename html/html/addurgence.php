<?php
require("_php/session.php");
require("_php/base.php");
require("_php/testsalarie.php");
$_SESSION['posted'] = 0;
$req = $bdd->prepare('INSERT INTO urgences(titre, info, lien, date) VALUES(:titre, :info, :lien, :date)');
$tab = "3084d9f7f1aebb522a3ce3624ea29132eeeb5b00";
if (isset($_POST['verif']) AND sha1($_POST['verif']) == $tab)
{
	if (isset($_POST['info']) AND isset($_POST['date']))
	{
		$req->execute(array(
			'titre' => strip_tags($_POST['title']),
			'info' => strip_tags($_POST['info']),
			'lien' => strip_tags($_POST['lien']),
			'date' => strip_tags($_POST['date']),
			));
			echo('<p> le titre est ' . $_POST['title'] . ' et l info est '. $_POST['info'] . ' </p>');
		$_SESSION['posted'] = 117;
	}
}
else
{
	$_SESSION['posted'] = 217;
}
//header('location: salariesurgences.php');
?>	