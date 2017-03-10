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
use Louve\Model\Event;
use Louve\Model\Document;
use Louve\Model\Session;
use Louve\Model\User;
use Louve\Model\Shift;


class ManagementController
{
    public function __construct()
    {
        $this->session = new Session();
        //TODO ACL and redirect
    }
    
    // Page principale / par défaut: liste des outils de gestion
    public function index()
    {
        $user = new User();
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();
        //chargement des shift => surement à déplacer dans user
        $myshift = new Shift();
        require APP . 'view/_templates/header.php';
        require APP . 'view/management/index.php';
        require APP . 'view/_templates/footer.php';
    }

    // TODO_NOW
    // Page d'ajout de documents PDF
    public function manageDocument()
    {
        $user = new User();
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();
        //chargement des shift => surement à déplacer dans user
        $myshift = new Shift();
        require APP . 'view/_templates/header.php';
        require APP . 'view/management/document.php';
        require APP . 'view/_templates/footer.php';
    }

    // Page de gestion des urgences
    public function manageEmergencies()
    {
        $user = new User();
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();
        //chargement des shift => surement à déplacer dans user
        $myshift = new Shift();
        require APP . 'view/_templates/header.php';
        require APP . 'view/management/emergencies.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * Endpoints / urls faisant office plus ou moins d'API REST pour la page des urgences
     **/
    public function getEmergencies()
    {
        $emergency = new Emergency();
        $results = $emergency->getAll();
        echo json_encode($results);
    }

    public function postEmergencies()
    {
        $emergency = new Emergency();
        $result = $emergency->save(
            $_REQUEST['info'], $_REQUEST['lien'], $_REQUEST['titre'], $_REQUEST['datefin'], $_REQUEST['date']
        );
        echo json_encode($result);
    }

    public function updateEmergencies()
    {
        $emergency = new Emergency();
        $result = $emergency->update(
            $_REQUEST['id'], $_REQUEST['info'], $_REQUEST['lien'], $_REQUEST['titre'], $_REQUEST['datefin'], $_REQUEST['date']
        );
        echo json_encode($result);
    }

    public function destroyEmergencies()
    {
        $emergency = new Emergency();
        // TODO_LATER: l'id est ou devrait être pasé en argument de la fonction par le routeur d'url de l'application
        $emergency->destroy(intval($_REQUEST['id']));
        echo json_encode(array('success'=>true));
    }

    // Page d'ajout d'assemblée générale
    public function addMeeting()
    {
        $user = new User();
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();
        //chargement des shift => surement à déplacer dans user
        $myshift = new Shift();
        require APP . 'view/_templates/header.php';
        require APP . 'view/_templates/footer.php';
    }

   // Page de gestion des evenement
    public function manageEvents()
    {
        $user = new User();
        // Nécessaire pour la pastille "prochaine AG": accès au modèle d'assemblée générale
        $event = new Event();
        // Nécessaire pour la pastille "Urgences": accès au modèle d'urgence
        $emergency = new Emergency();
        //chargement des shift => surement à déplacer dans user
        $myshift = new Shift();

        require APP . 'view/_templates/header.php';
        require APP . 'view/management/event.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * Endpoints / urls faisant office plus ou moins d'API REST pour la page des evenements
     **/
    public function getEvents()
    {
        $event = new Event();
        $results = $event->getAll();
        echo json_encode($results);
    }

    public function postEvent()
    {
        $event = new Event();
        $result = $event->save(
            $_REQUEST['info'], $_REQUEST['lien'], $_REQUEST['titre'], $_REQUEST['date'], $_REQUEST['type']
        );
        echo json_encode($result);
    }

    public function updateEvent()
    {
        $event = new Event();
        $result = $event->update(
            $_REQUEST['id'], $_REQUEST['info'], $_REQUEST['lien'], $_REQUEST['titre'], $_REQUEST['date'], $_REQUEST['type']
        );
        echo json_encode($result);
    }

    public function destroyEvent()
    {
        $event = new Event();
        // TODO_LATER: l'id est ou devrait être pasé en argument de la fonction par le routeur d'url de l'application
        $event->destroy(intval($_REQUEST['id']));
        echo json_encode(array('success'=>true));
    }

   //documents
    public function getDocuments()
    {
        $Document = new Document();
        $results = $Document->getAll();
        echo json_encode($results);
    }

    public function postDocument()
    {
        $Document = new Document();
        $result = $Document->save(
            $_REQUEST['lien'], $_REQUEST['icone'], $_REQUEST['categorie'], $_REQUEST['titre'],$_REQUEST['acces']
        );
        echo json_encode($result);
    }

    public function updateDocument()
    {
        $Document = new Document();
        $result = $Document->update(
            $_REQUEST['id'],  $_REQUEST['lien'], $_REQUEST['icone'], $_REQUEST['categorie'], $_REQUEST['titre'],$_REQUEST['acces']
        );
        echo json_encode($result);
    }

    public function destroyDocument()
    {
        $Document = new Document();
        // TODO_LATER: l'id est ou devrait être pasé en argument de la fonction par le routeur d'url de l'application
        $Document->destroy(intval($_REQUEST['id']));
        echo json_encode(array('success'=>true));
    }

}
