<?php

session_start();

// Eléments d'authentification LDAP
/*
$ldaprdn  = $_POST['login'];     // DN ou RDN LDAP
$ldappass = $_POST['password'];  // Mot de passe associé NON salé et haché
*/

$_SESSION['falseid'] = FALSE;

//pour les tests : admin/admin user1/pwd1 user2/pwd2
if ((isset($_POST['login'])) AND (isset($_POST['password']))) // vérifier que les données sont bien présentes
{
	$postlogin  = strip_tags($_POST['login']);     // DN ou RDN LDAP
	$postpwd = strip_tags($_POST['password']);  // empecher les failles d'injonction sql
	$postpwd = 'qsdrt54' . $postpwd . 'coopirish42k' ; //mot de passe désormais salé
	$postpwd = sha1($postpwd); //motdepasse désormais haché
	try
{
	$bdd = new PDO('mysql:host=localhost;dbname=louve;charset=utf8', 'louve', 'TESTcoop1');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
if ($bdd) 
{
$base = $bdd->query('SELECT * FROM users WHERE login =\'' . $postlogin . '\'');

$req = $base->fetch();

	if ($req['password'] == $postpwd)
	{
		$_SESSION['login'] = $postlogin ;
		$_SESSION['logged'] = TRUE;
		$_SESSION['falseid'] = FALSE;
		header('Location: index.php');
	}
	else 
	{
		$_SESSION['falseid'] = TRUE;
	}
}

}
/*else 
{
	$_SESSION['falseid'] = TRUE;
	//header('Location: login.php');
}
/*


/*
// Connexion au serveur LDAP
$ldapconn = ldap_connect("vps314661.ovh.net") // integrer la bonne adresse de serveur LDAP ici
    or die("Impossible de se connecter au serveur LDAP.");

if ($ldapconn) {

    // Connexion au serveur LDAP
    $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

    // Vérification de l'authentification
    if (! $ldapbind) {
        echo "Connexion LDAP échouée...";
    } 
	else {
		echo "ok";
	}

	/*
        try
		{
			$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
		}
		catch(Exception $e)
		{
			die('Erreur : '.$e->getMessage());
		}
    }
	// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO members (last_connection) VALUES(?)');
$req->execute(DATE);

// Redirection du visiteur vers la page du minichat
header('Location: minichat.php');


*/
//}
?>