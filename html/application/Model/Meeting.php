<?php

namespace Louve\Model;

use Louve\Core\BaseDBModel;


/**
 * Modèle d'assemblée générale. Permet de grouper les infos sur les AGs passées et à venir
 **/
class Meeting extends BaseDBModel
{

    public function getNext()
    {
        if (!$this->fake) {
            $sql = "SELECT * FROM assemblees WHERE date >= CURDATE() ORDER BY date ASC LIMIT 0, 1 ";
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            return $result;
        }
        // valeur bidon en local
        return (object) [
            "infos" => "Pas d'AG le 20/10! On se fait une grosse bouffe!",
            "lien" => 'https://cooplalouve.fr',
        ];
    }
}
