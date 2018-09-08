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
use Louve\Model\User;
use Louve\Model\Emergency;
use Louve\Model\Shift;
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
        $user = new User();
        $emergency = new Emergency();
        // Récupération des shifts volants
        $ftopShiftDisplays = null;
        // TODO_LATER: proxy odoo qui appelle est lié à l'utilisateur = moche
        $proxy = new OdooProxy();
        $connectionStatus = $proxy->connect();
        if ($connectionStatus === true)
        {
            // Si la connexion réussit, on récupère les prochains shifts volants
            $ftopShiftDisplays = formatFtopShifts($proxy->getFtopShifts(),$user->getShiftType());
        }
        else
        {
            // TODO_LATER: gérer les erreurs !
        }

        require APP . 'view/_templates/header.php';
        require APP . 'view/shift/ftop.php';
        require APP . 'view/_templates/footer.php';
        require APP . 'view/shift/scriptftop.php';
        
    }
    public function subscribeFtopShift()
    {
        $shift = new Shift();
        $proxy = new OdooProxy();
        $connectionStatus = $proxy->connect();
        $result = $shift->subscribe(
            $_REQUEST['date_begin'], $_REQUEST['shift_id'], $_REQUEST['shift_ticket_id']
        );
        echo json_encode($result);
    }

    public function getdraftftopshift()
    {
        $shift = new Shift();
        
        $user = new User();
      
         $shifts = null;

        $proxy = new OdooProxy();
        $connectionStatus = $proxy->connect();
        if ($connectionStatus === true)
        {
            // Si la connexion réussit, on récupère les prochains shifts volants
            //$shifts = $proxy->getDraftFtopShiftRegistration($user->getIdOdoo());
            $shifts = $proxy->getFtopShiftsRegistred($user->getEmail());
        }


    //die(var_dump($shifts));
    $tabShift= array();
    for($i = 0; $i < count($shifts) ; $i++)
    {
        

        $nextTime = $shifts[$i]->me['struct']['date_begin']->me['string'];
        $state = $shifts[$i]->me['struct']['state']->me['string'];
        list($dd, $day, $month, $year, $hour, $minutes) = formatDate($nextTime);
        
        //todo a virer des qu on sait comment virer les faux shifts d odoo
        if (($hour!="22"||$hour!="23")&&($state!="open"))
        {
        $shift = new Shift();
        $shift->date =  $dd . ' ' . $day . ' ' . $month . ' ' . $year . ' : ' . $hour . 'H' . $minutes;
        $shift->id = null;
        $shift->shift_id = null;
        $shift->shift_ticket_id = null;
        //$shift->coordinator_id = $shifts[$i]->me['struct']['user_id'][0]->me['int'];
        //echo(var_dump($shifts[$i]));
        $tabShift[$i] = $shift;
        }
    }
          echo json_encode($tabShift);
    }
}
