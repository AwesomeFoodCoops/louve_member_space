<?php

namespace Mini\Model;

use Mini\Core\BaseDBModel;

class Emergency extends BaseDBModel
{

    public function getRecent()
    {
        if (!$this->fake) {
            $sql = 'SELECT * FROM urgences WHERE date <= CURDATE() AND datefin >= CURDATE() ORDER BY id DESC LIMIT 0, 1';
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            return $result;
        }
        return (object) [
            "titre" => "AAAaarrg!",
            "info" => "Y'a le feu de partout",
            "lien" => 'https://facebook.com',
        ];
    }
}
