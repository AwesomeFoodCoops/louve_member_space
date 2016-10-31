<?php
$ldapconn = ldap_connect("vps314661.ovh.net") // integrer la bonne adresse de serveur LDAP ici
    or die("Impossible de se connecter au serveur LDAP."); 
?>