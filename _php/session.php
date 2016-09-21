<?php
	session_start();
	if ($_SESSION['logged'] != TRUE)
		header('Location: ./login.php');
?>