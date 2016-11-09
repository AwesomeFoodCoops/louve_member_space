<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '../../_php/base.php';
//$rs = mysql_query('select * from users');
 
$statement=$bdd->prepare('SELECT * FROM assemblees order by id desc');
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($results);

?>