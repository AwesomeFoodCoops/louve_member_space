<?php

namespace Louve\Model;


use Louve\Core\OdooProxy;
use Louve\Core\BaseDBModel;
use Louve\Model\Coordinator;


// Un import 'use function Mini\Core\formatShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne
//include_once(APP . 'helpers/odoo_formatting.php');


/*
 * Infos sur l'utilisateur courant récupérées directement sur le serveur Odoo.
 * AUCUNE DONNEE UTILISATEUR N'EST STOCKEE DANS LA BDD LOCALE MYSQL
 * Utilisation de XMLRPC via la classe OdooProxy
 */
class Shift
{
  
    public $date = null;
    public $coordinators = null;

    /*
    private $coordinator_name = null;             
    private $coordinator_phone = null;
    private $coordinator_email = null;
  
    */
    public function __construct() {
       
    }

    public function addCoordinator($coordinator_id){

        $proxy = new OdooProxy();
        if ($proxy->connect() === true)
        {
            $values = $proxy->getCoordinatorInfo($coordinator_id);
            
            $coordinateur = new Coordinator();
            $coordinateur->mail = $values->me['struct']['email']->me['string'];
            $coordinateur->lastname = explode(", ",$values->me['struct']['name']->me['string'])[0];
            $coordinateur->firstname = explode(", ",$values->me['struct']['name']->me['string'])[1];
            
            $coordinateur->phone= isset($values->me['struct']['mobile']->me['string']) ? $values->me['struct']['mobile']->me['string'] : null;

            // Si la connexion réussit, on récupère le coordinateur du shift
            $this->coordinators[count($this->coordinators)] = $coordinateur;
        }


}
}
