<?php



include 'conn.php';
$stmt = $conn->prepare("INSERT INTO urgences(info, lien, titre, datefin) VALUES (:info, :lien, :titre, :datefin)");
$stmt->bindParam(':info', $info);
$stmt->bindParam(':lien', $lien);
$stmt->bindParam(':titre', $titre);
$stmt->bindParam(':datefin', $datefin);

$info = $_REQUEST['info'];
$lien = $_REQUEST['lien'];
$titre = $_REQUEST['titre'];
$datefin = $_REQUEST['datefin'];

$stmt->execute();



echo json_encode(array(
	'id' => $conn->lastInsertId(),
	'info' => $info,

	'lien' => $lien,
	'titre' => $titre,
	'datefin' => $datefin
));

?>