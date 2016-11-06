<?php

$id = intval($_REQUEST['id']);
include '../../_php/base.php';
$sql = "delete from urgences where id=:id";
$stmt = $bdd->prepare($sql);
$stmt->bindParam(':id', $id);
$id = $_REQUEST['id'];
$stmt->execute();
echo json_encode(array('success'=>true));
?>