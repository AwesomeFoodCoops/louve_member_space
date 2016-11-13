<?php

/**
 * Class ManagementController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Louve\Controller;

use Louve\Model\Emergency;


class EmergencyController
{
    // Page principale / par défaut: liste des outils de gestion
    public function index()
    {
        $emergency = new Emergency();
        require APP . 'view/_templates/header.php';
        require APP . 'view/emergencies/index.php';
        require APP . 'view/_templates/footer.php';
        
    }
}
