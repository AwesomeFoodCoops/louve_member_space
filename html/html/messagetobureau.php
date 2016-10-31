
 
<?php 

	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	session_start();
	$_SESSION['posted'] = 0;

     $headers ="From: 'LA LOUVE ESPACE MEMBRES'<support@cooplalouve.fr>"."\n"; 
     $headers .='Reply-To: support@cooplalouve.fr'."\n"; 
     $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n"; 
     $headers .='Content-Transfer-Encoding: 8bit'; 

	 if(isset($_POST['message']) AND isset($_POST['sujet']))
	 {

     $message = strip_tags($_POST['message']); 
	 $sujet = strip_tags($_POST['sujet']); 
	 
	 $to      = 'mic.roche@gmail.com';
 $subject = $sujet;
 $message = $message ;
 //$headers = 'From: support@cooplalouve.fr' . "\r\n" .
 //'Reply-To: support@cooplalouve.fr' . "\r\n" .
 //'X-Mailer: PHP/' . phpversion();
	mail($to, $subject, $message, $headers);

		if(mail($to, $subject, $message, $headers)) //faudra changer le mail sinon je vais tout reçevoir
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
