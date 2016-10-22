<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include 'conn.php';
//$rs = mysql_query('select * from users');
 
$statement=$conn->prepare('SELECT * FROM urgences order by id desc');
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($results);

?>