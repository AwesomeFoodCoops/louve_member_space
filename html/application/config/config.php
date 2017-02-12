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

date_default_timezone_set('Europe/Paris');

define('ENVIRONMENT', 'dev');
error_reporting(E_ALL);
ini_set('display_errors', '1');
 
// En développement reporter toutes les erreurs
if (php_sapi_name() === 'cli-server') {
    //define('ENVIRONMENT', 'dev');
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
} else {
//    define('ENVIRONMENT', 'prod');
    error_reporting(E_ALL);
    ini_set('display_errors', -1);
    ini_set("log_errors", 1);
}

// Charge la config "secrète": mots de passe, logins
$credentials = APP . 'config/secret.php';
if (file_exists($credentials)) {
    require $credentials;
} else {
    define('DB_USER', 'root');
    define('DB_PASS', 'mWse74a10/');

    define('ODOO_DB_USER', '');
    define('ODOO_DB_PASSWORD', '');
    define('ODOO_DB_NAME', '');
    define('ODOO_SERVER_URL', '');

    define('LDAP_SERVER', '');
    define('LDAP_BASE_DN', '');
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
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER );

/**
 * Configuration for: Database
 * This is the place where you define your database credentials, database type etc.
 */
define('DB_NAME', 'louve');
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
// login, MDP => dans le fichier de conf secret

/**
 * Configuration for: Odoo
 */
// Tout est dans le fichier de conf secret

/**
 * Configuration for: LDAP
 */
// Tout est dans le fichier de conf secret

// Grab this from Google Calendar's settings.
define('GOOGLE_CALENDAR_ID', 'r3d4f9vip901c4ovao8ibvfats@group.calendar.google.com');
