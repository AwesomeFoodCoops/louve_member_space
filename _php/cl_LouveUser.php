<?php $included ? : die('Ohhh nooooo!'); 
/* 
 * La classe LouveUser va aggréger les infos du membre connecté.
 * Durant les dev. ces infos peuvent venir de différents endroits.
 * Elles devraient être récupérées d'Odoo.
 * 
 * Chaque fois que les infos sont récupérées du serveur distant, un 
 * timestamp est sauvegardé. Si celui-ci est trop ancien quand on accède
 * aux données, celles-ci sont à nouveau récupérées du serveur distant.
 */

require '_php/base.php';
 
class LouveUser
{
    var $id = 'bad_id';
    var $login = 'undefined';
    var $name = 'Doe';
    var $firstname = 'John';
    var $phone = '+33 6 12 23 34 56';
    var $email = 'john.doe@lalouve.fr';
    var $shift = 'no';
    var $status = 0;
    var $isLeader = FALSE;
    
    //~ int $timestamp = time();
    var $timestamp;
    
    function __construct()
    {
        $this->timestamp = time();
    }

    //~ function __construct($login)
    //~ {
        //~ $this->login = $login;
        //~ $this->timestamp = time();
        //~ $this->getInfo();
    //~ }
    
    function refresh()
    {
        return 0;
    }
    
    function getName()
    {
        return $this->name;
    }

    function getFirstname()
    {
        return $this->firstname;
    }

    function getEmail()
    {
        return $this->email;
    }
    
    function getPhone()
    {
        return $this->phone;
    }
    
    function getInfo()
    {
        /* @Todo: à compléter avec la base de donnée de l'espace membre ou odoo */
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=louve;charset=utf8', 'louve', 'TESTcoop1');
            $base = $bdd->query('SELECT * FROM members WHERE login =\'' . $this->login . '\'');
            $req = $base->fetch();
            
            $this->name =  $req['nom'];
            $this->firstname =  $req['prenom'];
            $this->phone =  $req['telephone'];
            $this->email =  $req['mail'];
            $this->shift = $req['creneau'];
            $this->status = $req['status'];
            $this->isLeader = ($req['coordinateur'] == 1);
        }
        catch (Exception $e)
        {
            //~ die('Erreur : ' . $e->getMessage());
            die('Erreur : Ohhhh no');
        }
    }
}

?>
