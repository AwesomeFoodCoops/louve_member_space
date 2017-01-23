<?php

namespace Louve\Model;

use Louve\Core\BaseDBModel;
use PDO;

/**
 * Modèle d'assemblée générale. Permet de grouper les infos sur les AGs passées et à venir
 **/
class Document extends BaseDBModel
{

    
    // supprime un evenement de la base
    public function destroy($id)
    {
        if (!$this->fake) {
            $sql = "delete from Documents where id=:id";
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
            $sql = 'SELECT * FROM Documents order by id desc';
            $query = $this->db->prepare($sql);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }
        // Valeur bidon en local
        return [
            [
                "id" => "1",
                "lien" => "https://facebook.com",
                "icone" => "general",
                "categorie" => "general",
                "titre" => "AG",
                "acces" => "1"
            ],
        ];
    }

    // Ajout d'un nouvel event
    public function save($lien, $icone, $categorie, $titre, $acces)
    {
        if (!$this->fake) {
            $sql = "INSERT INTO Documents( lien, icone, categorie, titre, acces) VALUES (:lien, :icone, :categorie, :titre, :acces)";
            $query = $this->db->prepare($sql);
            $query->bindParam(':lien', $lien);
            $query->bindParam(':icone', $icone);
            $query->bindParam(':categorie', $categorie);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':acces', $acces);
            $query->execute();
            return array(
                'id' => $this->db->lastInsertId(),
                'lien' => $lien,
                'icone' => $icone,
                'categorie' => $categorie,
                'titre' => $titre,
                'acces' => $acces
            );
        }
        // valeur bidon en local
        return [
                "id" => "1",
                "lien" => "https://facebook.com",
                "icone" => "general",
                "categorie" => "general",
                "titre" => "AG",
                "acces" => "1"
        ];
    }

  
// Modification d'un  evenement existant
    public function update($id, $lien, $icone, $categorie, $titre, $acces)
    {
        if (!$this->fake) {
            $sql = "update Documents set lien=:lien,icone=:icone,categorie=:categorie,titre=:titre,acces=:acces where id=:id";
            $query = $this->db->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':lien', $lien);
            $query->bindParam(':icone', $icone);
            $query->bindParam(':categorie', $categorie);
            $query->bindParam(':titre', $titre);
            $query->bindParam(':acces', $acces);
            $query->execute();
            return array(
                'id' => $id,
                'lien' => $lien,
                'icone' => $icone,
                'categorie' => $categorie,
                'titre' => $titre,
                'acces' => $acces
            );
        }
        // valeur bidon en local
        return [
                "id" => "1",
                "lien" => "https://facebook.com",
                "icone" => "general",
                "categorie" => "general",
                "titre" => "AG",
                "acces" => "1"
        ];
    }


    
}
