<?php



include 'conn.php';

$sql = "update urgences set info=:info,lien=:lien,titre=:titre,datefin=:datefin where id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->bindParam(':info', $info);
$stmt->bindParam(':lien', $lien);
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':datefin', $datefin);
$id = $_REQUEST['id'];
$info = $_REQUEST['info'];
$lien = $_REQUEST['lien'];
$titre = $_REQUEST['titre'];
$datefin = $_REQUEST['datefin'];
$stmt->execute();

echo json_encode(array(
	'id' => $id,
	'info' => $info,
	'lien' => $lien,
	'titre' => $titre,
	'datefin' => $datefin
));
?>