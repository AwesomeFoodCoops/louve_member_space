<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=louve;charset=utf8', 'louve', 'TESTcoop1');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
?>