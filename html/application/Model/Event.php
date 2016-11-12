<?php

namespace Louve\Model;

use Louve\Core\BaseDBModel;
use PDO;

/**
 * Modèle d'assemblée générale. Permet de grouper les infos sur les AGs passées et à venir
 **/
class Event extends BaseDBModel
{

    public function getNext()
    {
        if (!$this->fake) {
            $sql = "SELECT * FROM event WHERE date >= CURDATE() ORDER BY date ASC LIMIT 0, 1 ";
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            return $result;
        }
        // valeur bidon en local
        return (object) [
            "info" => "Pas d'AG le 20/10! On se fait une grosse bouffe!",
            "lien" => 'https://facebook.com',
            "type" => "ag",
            "titre" => "info AG",
            "date" => "2016-11-18"
        ];
    }

    public function getNextMeeting()
    {
        if (!$this->fake) {
            $sql = "SELECT * FROM event WHERE date >= CURDATE() and type='ag' ORDER BY date ASC LIMIT 0, 1 ";
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            return $result;
        }
        // valeur bidon en local
        return (object) [
            "info" => "Pas d'AG le 20/10! On se fait une grosse bouffe!",
            "lien" => 'https://facebook.com',
            "type" => "ag",
            "titre" => "info AG",
            "date" => "2016-11-18"
        ];
    }
    // supprime un evenement de la base
    public function destroy($id)
    {
        if (!$this->fake) {
            $sql = "delete from event where id=:id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            return;
        }
        // En dev local, ne rien faire
        return;
    }

    // Retourne toutes les evenements existants
    public function getAll()
    {
        if (!$this->fake) {
            $sql = 'SELECT * FROM event order by id desc';
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        // Valeur bidon en local
        return [
            [
                "id" => "1",
                "info" => "Y'a le feu de partout",
                "date" => "2016-11-05",
                "lien" => "https://facebook.com",
                "type" => "ag",
                "titre" => "AG",
                "date" => "2016-11-18"
            ],
        ];
    }

    // Ajout d'un nouvel event
    public function save($info, $lien, $titre, $date, $type)
    {
        if (!$this->fake) {
            $sql = "INSERT INTO event(info, lien, titre, date, type) VALUES (:info, :lien, :titre, :date, :type)";
            $query = $this->db->prepare($sql);
            $query->bindParam(':info', $info);
            $query->bindParam(':lien', $lien);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':date', $date);
            $query->bindParam(':type', $type);
            $query->execute();
            return array(
                'id' => $this->db->lastInsertId(),
                'info' => $info,
                'lien' => $lien,
                'titre' => $titre,
                'date' => $date,
                'type' => $type
            );
        }
        // valeur bidon en local
        return [
            "id" => "1",
            "info" => "Y'a le feu de partout",
            "date" => "2016-11-05",
            "insertion" => "2016-11-06 12:58:03",
            "lien" => "https://facebook.com",
            "titre" => "AAAaarrg!",
            "datefin" => "2016-11-11",
            "niveau" => "3"
        ];
    }
// Modification d'un  evenement existant
    public function update($id, $info, $lien, $titre, $date, $type)
    {
        if (!$this->fake) {
            $sql = "update event set info=:info,lien=:lien,titre=:titre,date=:date,type=:type where id=:id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':info', $info);
            $query->bindParam(':lien', $lien);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':type', $type);
            $query->bindParam(':date', $date);
            $query->execute();
            return array(
                'id' => $id,
                'info' => $info,
                'lien' => $lien,
                'titre' => $titre,
                'type' => $type,
                'date' => $date
            );
        }
        // valeur bidon en local
        return [
            "id" => "1",
            "info" => "Y'a le feu de partout",
            "date" => "2016-11-05",
            "insertion" => "2016-11-06 12:58:03",
            "lien" => "https://facebook.com",
            "titre" => "AAAaarrg!",
            "datefin" => "2016-11-11",
            "niveau" => "3"
        ];
    }


    
}
