<?php

namespace Mini\Model;

use Mini\Core\BaseDBModel;
use PDO;


/**
 * Modèle d'"urgences": permet de solliciter les membres en cas de besoin urgent
 **/
class Emergency extends BaseDBModel
{
    public function getCurrent()
    {
        if (!$this->fake) {
            $sql = 'SELECT * FROM urgences WHERE date <= CURDATE() AND datefin >= CURDATE() ORDER BY id DESC LIMIT 0, 1';
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetch();
            return $result;
        }
        // Valeur bidon en local
        // TODO_NOW: harmoniser les mocks => faire comme pour Odoo un fichier à part dans Testing
        return (object) [
            "titre" => "AAAaarrg!",
            "info" => "Y'a le feu de partout",
            "lien" => 'https://facebook.com',
        ];
    }

    // supprime une urgence de la base
    public function destroy($id)
    {
        if (!$this->fake) {
            $sql = "delete from urgences where id=:id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->execute();
            return;
        }
        // En dev local, ne rien faire
        return;
    }

    // Retourne toutes les urgences existantes
    public function getAll()
    {
        if (!$this->fake) {
            $sql = 'SELECT * FROM urgences WHERE date <= CURDATE() AND datefin >= CURDATE() ORDER BY niveau DESC LIMIT 0, 15';
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
                "insertion" => "2016-11-06 12:58:03",
                "lien" => "https://facebook.com",
                "titre" => "AAAaarrg!",
                "datefin" => "2016-11-11",
                "niveau" => "3"
            ],
        ];
    }
    
    // Ajout d'une nouvelle urgence
    public function save($info, $lien, $titre, $datefin, $date)
    {
        if (!$this->fake) {
            $sql = "INSERT INTO urgences(info, lien, titre, datefin,date) VALUES (:info, :lien, :titre, :datefin, :date)";
            $query = $this->db->prepare($sql);
            $query->bindParam(':info', $info);
            $query->bindParam(':lien', $lien);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':datefin', $datefin);
            $query->bindParam(':date', $date);
            $query->execute();
            return array(
                'id' => $this->db->lastInsertId(),
                'info' => $info,
                'lien' => $lien,
                'titre' => $titre,
                'datefin' => $datefin,
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

    // Modification d'une urgence existante
    public function update($id, $info, $lien, $titre, $datefin, $date)
    {
        if (!$this->fake) {
            $sql = "update urgences set info=:info,lien=:lien,titre=:titre,datefin=:datefin,date=:date where id=:id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':info', $info);
            $query->bindParam(':lien', $lien);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':datefin', $datefin);
            $query->bindParam(':date', $date);
            $query->execute();
            return array(
                'id' => $id,
                'info' => $info,
                'lien' => $lien,
                'titre' => $titre,
                'datefin' => $datefin,
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
