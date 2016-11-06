<?php

session_start();
require("_php/ldap.php");
// Eléments d'authentification LDAP
/*
$ldaprdn  = $_POST['login'];     // DN ou RDN LDAP
$ldappass = $_POST['password'];  // Mot de passe associé NON salé et haché
*/

$_SESSION['falseid'] = FALSE;

//pour les tests : admin/admin user1/pwd1 user2/pwd2
if ((isset($_POST['login'])) AND (isset($_POST['password']))) // vérifier que les données sont bien présentes
{




// on teste : le serveur LDAP est-il trouvé 
try
{
	$conn=ldap_connect($ldapServer);

if ($conn) {

	$postlogin  = strip_tags($_POST['login']);     // DN ou RDN LDAP
	$postpwd = strip_tags($_POST['password']);  // empecher les failles d'injonction sql
    ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    // Connexion au serveur LDAP
    $ldapbind = ldap_bind($conn, "uid=".$postlogin.",ou=users,dc=ovh,dc=net", $postpwd);

    // Vérification de l'authentification
    if ($ldapbind) {
    //connexion réussie
		$_SESSION['login'] = $postlogin ;
		$_SESSION['logged'] = TRUE;
		$_SESSION['falseid'] = FALSE;
		require_once '_php/baseinfo.php'; 
		header('Location: index.php');
    }
	else {
	//connexion ratée
	$_SESSION['falseid'] = TRUE;
		}
	}


}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}
}

    $base = $bdd->query('SELECT status FROM members WHERE login =\'' . $_SESSION['login'] . '\'');
    $req = $base->fetch();
   
    $basu = $bdd->query('SELECT top 1* FROM urgences WHERE date <= CURDATE() AND datefin >= CURDATE() ORDER BY niveau DESC');
    
    $urgence=false;
    while($ruq = $basu->fetch())
    {
          if (isset($ruq['info']))
            {
       $_SESSION['urgence']="1";
    
        }
    }
?>