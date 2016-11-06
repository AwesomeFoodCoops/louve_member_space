<?php
include '../../_php/base.php';

$sql = "update urgences set info=:info,lien=:lien,titre=:titre,datefin=:datefin,date=:date where id=:id";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':info', $info);
$stmt->bindParam(':lien', $lien);
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':datefin', $datefin);
$stmt->bindParam(':date', $date);
$id = $_REQUEST['id'];
$info = $_REQUEST['info'];
$lien = $_REQUEST['lien'];
$titre = $_REQUEST['titre'];
$datefin = $_REQUEST['datefin'];
$date = $_REQUEST['date'];
$stmt->execute();

echo json_encode(array(
	'id' => $id,
	'info' => $info,
	'lien' => $lien,
	'titre' => $titre,
	'datefin' => $datefin,
	'date' => $date
));
?>