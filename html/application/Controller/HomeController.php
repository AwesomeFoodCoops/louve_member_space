<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Louve\Controller;

use Louve\Model\Event;
use Louve\Model\Emergency;


class HomeController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    // Page principale
    public function index()
    {
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();

        // Require des différents templates nécessaires à l'affichage de la page d'accueil
        require APP . 'view/_templates/header.php';
        // Pour éviter les 'require' de templates imbriqués, la classe container est ajoutée directement
        echo "<div class=container>";
        require APP . 'view/home/_includes/emergencies.php';
        require APP . 'view/home/_includes/status.php';
        require APP . 'view/_includes/shifts.php';
        require APP . 'view/home/_includes/next_meeting.php';
        require APP . 'view/_includes/documents.php';
        // fermeture du container initial
        echo "</div>";
        require APP . 'view/_templates/footer.php';
    }

    // Page "Mes informations" qui liste les infos personnelles de l'utilisateur
    public function myInfo()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/my_info.php';
        require APP . 'view/_templates/footer.php';
    }

    // Page de listing des "services" offert par l'espace membre: créneaux, contacts, co-voiturage, etc...
    public function services()
    {
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/services.php';
        require APP . 'view/_templates/footer.php';
    }

    // Page de détail sur la situation du membre vis-à-vis de la Louve: statut, retard c'éneauc, etc...
    public function participation()
    {
        require APP . 'view/_templates/header.php';
        // Pour éviter les 'require' de templates imbriqués, la classe container est ajoutée directement
        echo "<div class=container>";
        require APP . 'view/_includes/shifts.php';
        require APP . 'view/home/_includes/my_coordinator.php';
        require APP . 'view/home/_includes/members_office.php';
        echo "</div>";
        require APP . 'view/_templates/footer.php';
    }
}
