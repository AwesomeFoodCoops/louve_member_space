<?php

/**
 * Class Error
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Louve\Controller;

class ErrorController
{
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function index()
    {
        // load views
        require APP . 'view/_templates/header.php';
        // TODO_NOW: personnaliser le message d'erreur (mettre mailing liste de devs ?)
        require APP . 'view/error/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
