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
use Louve\Model\Session;
use Louve\Model\User;
use Louve\Model\Shift;
use Louve\Model\Event;

/**
 *  Class EmergencyController
 *  @package Louve\Controller
 */
class EmergencyController
{
    /**
     * EmergencyController constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
        //TODO ACL and redirect
    }

    // Page principale / par défaut: liste des outils de gestion
    public function index()
    {
        $emergency = new Emergency();
        $user = new User();
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();
        //chargement des shift => surement à déplacer dans user
        $myshift = new Shift();

        require APP . 'view/_templates/header.php';
        require APP . 'view/emergencies/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
