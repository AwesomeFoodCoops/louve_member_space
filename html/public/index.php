<?php

/**
 * Heavily based on MINI3 project. Lots of thanks !
 * Uses namespaces + composer's autoloader (PSR-4)
 * For more info about namespaces please @see http://php.net/manual/en/language.namespaces.importing.php
 */

// "Hack" pour le développement seulement: le fichier .htaccess n'est pas utilisé par le builtin
// server de PHP. Il faut donc dupliquer ses fonctionnalités
$filename = __DIR__.preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server') {
    // On sert les fichiers statiques directement
    if (is_file($filename)) {
        return false;
    }
    // Pour construire les controleurs, l'url (/objetX/actionY) est passée
    // en query parameter à index.php par .ht access
    // soit un truc du goût index.php?objet=objetX&action=actionY
    $_GET['url'] = $_SERVER['REQUEST_URI'];
}

// set a constant that holds the project's folder path, like "/var/www/".
// DIRECTORY_SEPARATOR adds a slash to the end of the path
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
// set a constant that holds the project's "application" folder, like "/var/www/application".
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

// This is the auto-loader for Composer-dependencies (to load tools into your project).
require ROOT . 'vendor/autoload.php';

// load application config (error reporting etc.)
require APP . 'config/config.php';

// load application class
use Louve\Core\Application;

// start the application
$app = new Application();
