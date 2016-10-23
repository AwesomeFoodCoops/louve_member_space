<?php
session_start();
$included = TRUE;
require(__DIR__.'/em-config.php');

$_SESSION['falseid'] = FALSE;

//pour les tests : admin/admin user1/pwd1 user2/pwd2
if ((isset($_POST['login'])) AND (isset($_POST['password']))) // vérifier que les données sont bien présentes
{
	$postlogin = strip_tags($_POST['login']);   // DN ou RDN LDAP
	$postpwd = strip_tags($_POST['password']);  // empecher les failles d'injonction sql

	// on teste : le serveur LDAP est-il trouvé
	try
	{
		// Connexion au serveur LDAP
		$conn=ldap_connect(EmConfig::LdapServer);

        if ($conn) {
            // On dit qu'on utilise LDAP V3, sinon la V2 par défaut est utilisé
			// et le bind ne passe pas.
            ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);

            // Authentification sur le serveur LDAP
            $ldapbind = ldap_bind($conn, "uid=".$postlogin.",ou=users,".EmConfig::LdapBaseDn, $postpwd);

            // Vérification de l'authentification
            if ($ldapbind) {
                //connexion réussie
                $_SESSION['login'] = $postlogin ;
                $_SESSION['logged'] = TRUE;
                $_SESSION['falseid'] = FALSE;
                header('Location: index.php');
            }
            else {
                //connexion ratée
                $_SESSION['falseid'] = TRUE;
            }
            ldap_close($conn);
       }
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
}

?>
