<?php

function checkCredentials($login, $password)
{
    try
    {
        // Connexion au serveur LDAP
        $conn=ldap_connect(LDAP_SERVER);

        if ($conn) {
            // On dit qu'on utilise LDAP V3, sinon la V2 par défaut est utilisé
            // et le bind ne passe pas.
            ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);

            // Authentification sur le serveur LDAP
            $ldapbind = ldap_bind($conn, "uid=" . $login . ",ou=users," . LDAP_BASE_DN, $password);

            // Vérification de l'authentification
            if ($ldapbind) {
                //connexion réussie
                return true;
            }
            else {
                return false;
            }
            ldap_close($conn);
       }
    }
    catch (Exception $e)
    {
        // TODO_LATER: manager l'exception ! (envoi de logs d'erreurs)
        // die('Erreur : ' . $e->getMessage());
        return false;
    }
}
