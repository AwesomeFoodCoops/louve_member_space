<?php

$id = intval($_REQUEST['id']);

include 'conn.php';

$sql = "delete from urgences where id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$id = $_REQUEST['id'];
$stmt->execute();
echo json_encode(array('success'=>true));
?>