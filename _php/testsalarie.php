<?php 

error_reporting(E_ALL);
ini_set('display_errors', '1');
	
			$based = $bdd->prepare('SELECT salarie FROM members WHERE login = :login ');
		
			$based->bindParam(':login',$login);
	
			$login =  strip_tags($_SESSION['login']);
			$based->execute();
			$rcq = $based->fetch();
			if (!(isset($rcq['salarie'])) OR $rcq['salarie'] != '1')
				header('Location: ./index.php');
			
			 
?>