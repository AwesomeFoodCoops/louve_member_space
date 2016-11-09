<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../../_php/base.php';

$sql = "update urgences set infos=:infos,lien=:lien,titre=:titre,date=:date where id=:id";
$stmt = $bdd->prepare($sql);

$stmt->bindParam(':infos', $infos);
$stmt->bindParam(':lien', $lien);
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':date', $date);
$stmt->bindParam(':id', $id);

$infos = $_REQUEST['infos'];
$lien = $_REQUEST['lien'];
$titre = $_REQUEST['titre'];
$date = $_REQUEST['date'];
$id = $_REQUEST['id'];

$stmt->execute();

echo json_encode(array(
	'id' => $id,
	'infos' => $infos,
	'lien' => $lien,
	'titre' => $titre,
	'date' => $date
));
?>