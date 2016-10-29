<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../../_php/base.php';
$stmt = $bdd->prepare("INSERT INTO urgences(info, lien, titre, datefin,date) VALUES (:info, :lien, :titre, :datefin, :date)");
$stmt->bindParam(':info', $info);
$stmt->bindParam(':lien', $lien);
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':datefin', $datefin);
$stmt->bindParam(':date', $date);


$info = $_REQUEST['info'];
$lien = $_REQUEST['lien'];
$titre = $_REQUEST['titre'];
$datefin = $_REQUEST['datefin'];
$date = $_REQUEST['date'];
$stmt->execute();



echo json_encode(array(
	'id' => $bdd->lastInsertId(),
	'info' => $info,

	'lien' => $lien,
	'titre' => $titre,
	'datefin' => $datefin,
	'date' => $date 
));

?>