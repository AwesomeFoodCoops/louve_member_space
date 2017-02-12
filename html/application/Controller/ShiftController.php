<?php

/**
 * Class ShiftController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Louve\Controller;


use Louve\Core\OdooProxy;
use Louve\Model\Session;

// Un import 'use function Mini\Core\formatFtopShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne
include_once(APP . 'helpers/odoo_formatting.php');


class ShiftController
{
    public function __construct()
    {
        $this->session = new Session();
        //TODO ACL and redirect
    }

    // Page d'affichage des shifts volants
    public function ftopShifts()
    {
        // Récupération des shifts volants
        $ftopShiftDisplays = null;
        // TODO_LATER: proxy odoo qui appelle est lié à l'utilisateur = moche
        $proxy = new OdooProxy($GLOBALS['User']->mail);
        $connectionStatus = $proxy->connect();
        if ($connectionStatus === true)
        {
            // Si la connexion réussit, on récupère les prochains shifts volants
            $ftopShiftDisplays = formatFtopShifts($proxy->getFtopShifts());
        }
        else
        {
            // TODO_LATER: gérer les erreurs !
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/shift/ftop.php';
        require APP . 'view/_templates/footer.php';
    }
}
