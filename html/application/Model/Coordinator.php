<?php

namespace Louve\Model;

use Louve\Core\OdooProxy;
use Louve\Core\BaseDBModel;
use Louve\Model\Shift;
use PDO;


// Un import 'use function Mini\Core\formatShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne


/*
 * Todo: Idealement faire deriver cette classe de User
 */
class Coordinator
{
    //private $login = null;
    public $mail = null;
    //private $nextShifts = null;              // Prochains créneaux
    public $firstname = null;
    public $lastname = null;
    //private $admin = false;
    //private $id = 0;
    //private $street = null;
    public $phone = null;
    //private $shift_type = null;
    //private $cooperative_state = null;       // Statut coopérateur: à jour ? retard, etc...

    // Est-ce que les données depuis Odoo / BDD locale ont été récupérées ?
    // TODO_LATER: remplacer par un timestamp et rafraichir les données si timestamp trop vieux
    //private $hasData = false;

    public function __construct() {

    }


}
