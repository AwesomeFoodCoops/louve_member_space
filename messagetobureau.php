
 
<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	session_start();
	$_SESSION['posted'] = 0;
     $headers ='From: "nom"<adresse@fai.fr>'."\n"; 
     $headers .='Reply-To: adresse_de_reponse@fai.fr'."\n"; 
     $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 

	 if(isset($_POST['message']) AND isset($_POST['sujet']))
	 {

     $message = strip_tags($_POST['message']); 
	 $sujet = strip_tags($_POST['sujet']); 

		if(mail('timohr01@gmail.com', $sujet, $message, $headers)) //faudra changer le mail sinon je vais tout reçevoir
		{ 
			$_SESSION['posted'] = 114; 
		} 
		else 
		{ 
          $_SESSION['posted'] = 214; 
	
		} 
	 }
	 else
	 {
		  $_SESSION['posted'] = 214; 
	 }

	 header('location: formbureau.php');
?>
