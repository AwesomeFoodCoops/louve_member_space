<?php
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
 
 
$baseDN = "dc=ovh,dc=net";
$ldapServer = "ldap://vps247219.ovh.net";
$ldapServerPort = 389;
$rdn="admin";
$mdp="secret";
//$dn = 'cn=manager,dc=foo,dc=org';
$dn = 'dc=ovh,dc=net';
echo "Connexion au serveur <br />";
$conn=ldap_connect($ldapServer);

// on teste : le serveur LDAP est-il trouvé ?
if ($conn)
 echo "Le résultat de connexion est ".$conn ."<br />";
else
 die("connexion impossible au serveur LDAP");

if ($conn) {

    ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3);
    // Connexion au serveur LDAP
    $ldapbind = ldap_bind($conn, "uid=zk00001,ou=users,dc=ovh,dc=net", "louv3");

    // Vérification de l'authentification
    if ($ldapbind) {
        echo "Connexion LDAP réussie...pour zied<br>";
    } else {
        echo "Connexion LDAP échouée...";
    }

$ldapbind = ldap_bind($conn, "uid=zk00001,ou=users,dc=ovh,dc=net", "louv31212");
    if ($ldapbind) {
        echo "Connexion LDAP réussie...pour zied";
    } else {
        echo "Connexion LDAP échouée... pour zied<br>";
    }

}

/* 2ème étape : on effectue une liaison au serveur, ici de type "anonyme"
 * pour une recherche permise par un accès en lecture seule
 */

// On dit qu'on utilise LDAP V3, sinon la V2 par défaut est utilisé
// et le bind ne passe pas. 
/*
if (ldap_set_option($conn, LDAP_OPT_PROTOCOL_VERSION, 3)) {
    echo "Utilisation de LDAPv3 \n";
 } else {
    echo "Impossible d'utiliser LDAP V3\n";
    exit;
 }
*/

// Instruction de liaison. 
// Décommenter la ligne pour une connexion authentifiée
// ou pour une connexion anonyme.
// Connexion authentifiée
// print ("Connexion authentifiée ...<br />");
// $bindServerLDAP=ldap_bind($conn,$dn,$mdp);
// print ("Connexion anonyme...<br />");
// $bindServerLDAP=ldap_bind($conn);
/*
print ("Liaison au serveur : ". ldap_error($conn)."\n");
// en cas de succès de la liaison, renvoie Vrai
if ($bindServerLDAP)
  echo "Le résultat de connexion est $bindServerLDAP <br />";
else
  die("Liaison impossible au serveur ldap ...");
*/
/* 3ème étape : on effectue une recherche anonyme, avec le dn de base,
 * par exemple, sur tous les noms commençant par B
 */
/*
echo "Recherche suivant le filtre (sn=B*) <br />";
$query = "sn=B*";
$result=ldap_search($conn, $baseDN, $query);
echo "Le résultat de la recherche est $result <br />";

echo "Le nombre d'entrées retournées est ".ldap_count_entries($conn,$result)."<p />";
echo "Lecture de ces entrées ....<p />";
$info = ldap_get_entries($conn, $result);
echo "Données pour ".$info["count"]." entrées:<p />";

for ($i=0; $i alt; $info["count"]; $i++) {
        echo "dn est : ". $info[$i]["cn"] ."<br />";
        echo "premiere entree cn : ". $info[$i]["cn"][0] ."<br />";
        echo "premier email : ". $info[$i]["mail"][0] ."<p />";
}
*/
/* 4ème étape : cloture de la session  */
echo "Fermeture de la connexion";
ldap_close($conn);

?>
 