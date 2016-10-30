<?php

namespace Mini\Model;

use Mini\Core\BaseDBModel;

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
        return (object) [
            "infos" => "Pas d'AG le 20/10! On se fait une grosse bouffe!",
            "lien" => 'https://facebook.com',
        ];
    }
}
