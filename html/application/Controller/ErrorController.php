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

use Louve\Model\Emergency;
use Louve\Model\Event;
use Louve\Model\Shift;
use Louve\Model\User;

class ErrorController
{
    /**
     * PAGE: index
     * This method handles the error page that will be shown when a page is not found
     */
    public function index()
    {
        $user = new User();
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();
        //chargement des shift => surement à déplacer dans user
        $myshift = new Shift();


        // load views
        require APP . 'view/_templates/header.php';
        // TODO_NOW: personnaliser le message d'erreur (mettre mailing liste de devs ?)
        require APP . 'view/error/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
