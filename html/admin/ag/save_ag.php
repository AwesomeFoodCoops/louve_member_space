<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

include '../../_php/base.php';
$stmt = $bdd->prepare("INSERT INTO assemblees(infos, lien, titre,date) VALUES (:infos, :lien, :titre, :date)");
$stmt->bindParam(':infos', $infos);
$stmt->bindParam(':lien', $lien);
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':date', $date);


$infos = $_REQUEST['infos'];
$lien = $_REQUEST['lien'];
$titre = $_REQUEST['titre'];
$date = $_REQUEST['date'];
$stmt->execute();



echo json_encode(array(
	'id' => $bdd->lastInsertId(),
	'infos' => $infos,
	'lien' => $lien,
	'titre' => $titre,
	'date' => $date 
));

?>