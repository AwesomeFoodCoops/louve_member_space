<?php

/**
 * Configuration
 *
 * For more info about constants please @see http://php.net/manual/en/function.define.php
 */

/**
 * Configuration for: Error reporting
 * Useful to show every little problem during development, but only show hard errors in production
 */

// En développement reporter toutes les erreurs
if (php_sapi_name() === 'cli-server') {
    define('ENVIRONMENT', 'dev');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
}
else {
    define('ENVIRONMENT', 'prod');
    error_reporting(E_ALL);
    // TODO_PRD: à désactiver à la mise en prod !! (et mettre la bonne valeur à trouver)
    ini_set('display_errors', '1');
 }

/**
 * Configuration for: URL
 * Here we auto-detect your applications URL and the potential sub-folder. Works perfectly on most servers and in local
 * development environments (like WAMP, MAMP, etc.). Don't touch this unless you know what you do.
 *
 * URL_PUBLIC_FOLDER:
 * The folder that is visible to public, users will only have access to that folder so nobody can have a look into
 * "/application" or other folder inside your application or call any other .php file than index.php inside "/public".
 *
 * URL_PROTOCOL:
 * The protocol. Don't change unless you know exactly what you do. This defines the protocol part of the URL, in older
 * versions of MINI it was 'http://' for normal HTTP and 'https://' if you have a HTTPS site for sure. Now the
 * protocol-independent '//' is used, which auto-recognized the protocol.
 *
 * URL_DOMAIN:
 * The domain. Don't change unless you know exactly what you do.
 * If your project runs with http and https, change to '//'
 *
 * URL_SUB_FOLDER:
 * The sub-folder. Leave it like it is, even if you don't use a sub-folder (then this will be just "/").
 *
 * URL:
 * The final, auto-detected URL (build via the segments above). If you don't want to use auto-detection,
 * then replace this line with full URL (and sub-folder) and a trailing slash.
 */

define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', '//');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
// TODO_PRD: (mettre les mots de passe dans un fichier de conf mis dans gitignore)
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'louve');
define('DB_USER', 'louve');
define('DB_PASS', 'TESTcoop1');
define('DB_CHARSET', 'utf8');

/**
 * Configuration for: Odoo
 */
define('ODOO_DB_USER', 'ESPACE_MEMBRES');
define('ODOO_DB_PASSWORD', 'bBuzWHjSr5ZYN1Br');
define('ODOO_DB_NAME', 'louve-erp-test_20161111');
define('ODOO_SERVER_URL', 'http://gestion-test.cooplalouve.fr');

/**
 * Configuration for: LDAP
 */
define('LDAP_SERVER', 'ldap://vps247219.ovh.net');
define('LDAP_BASE_DN', 'dc=ovh,dc=net');
