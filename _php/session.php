<?php
	session_start();
	if ($_SESSION['logged'] != TRUE)
		header('Location: ./login.php');
	
	// Fourni des noms par défaut:
	if( !isset($_SESSION['name']) ) {
		$_SESSION['name'] = '[nom indéfini]';
	}			
	if( !isset($_SESSION['mobile']) ) {
		$_SESSION['mobile'] = '[n° de mobile indéfini]';
	}			

?>
