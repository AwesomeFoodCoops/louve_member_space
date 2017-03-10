<?php

namespace Louve\Model;

use Louve\Core\OdooProxy;
use Louve\Core\BaseDBModel;
use Louve\Model\Shift;
use Louve\Model\User;
use PDO;


// Un import 'use function Mini\Core\formatShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne


/*
 * Todo: Idealement faire deriver cette classe de User
 */
class Coordinator extends User
{
    public function __construct()
    {
	parent::__construct();
    }
}
