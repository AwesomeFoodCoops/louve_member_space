<?php

$conn = new PDO('mysql:host=localhost;dbname=louve;charset=utf8', 'louve', 'TESTcoop1');
if (!$conn) {
	die('Could not connect: ' . mysql_error());
}
//mysql_select_db('mydb', $conn);

?>