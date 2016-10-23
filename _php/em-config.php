<?php
/* Class contenant les constantes pour le site web de l'espace membre 
 * de la Louve.
 */
class EmConfig
{
	/* Racine du site web de l'espace membre:
	 * Exemple, pour http://public.cooplalouve.fr/espace-membre/
	 * il faudrait mettre "/espace-membres/"
	 * -
	 * Cette constante est à utiliser pour les chemins vers des resources, 
	 * CSS par exemple,  dans les fichiers qui seront inclus depuis différents
	 * chemins.
	 * Il n'y a pas de '/' final pour qu'elle se comporte comme __DIR__
	 */
	const ROOT = ''; //	actuellement à la racine de: http://vps314661.ovh.net
	const LdapBaseDn = 'dc=ovh,dc=net';
	const LdapServer = 'ldap://vps247219.ovh.net';
	const LdapServerPort = 389; // not used in _php/login.php
}
?>
