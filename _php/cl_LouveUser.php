<?php

/* La classe LouveUser va aggréger les infos du membre connecté.
 * Durant les dev. ces infos peuvent venir de différents endroits.
 * Il devraient être récupérés de Odoo.
 * 
 * Chaque fois que les infos sont récupérées du serveur distant, un 
 * timestamp est sauvegardé. Si celui-ci est trop ancien quand on accède
 * aux données, celles-ci sont à nouveau récupérées du serveur distant.
 */
class LouveUser
{
    string $name = 'Doe';
    string $firstname = 'John';
    string $phone = '';
    //~ int $timestamp = time();
    int $timestamp;
    
    function LouveUser()
    {
        this->$timestamp = time();
    }
    
    function refresh()
    {
        return 0;
    }
    
    function getName()
    {
        return $this->name;
    }
}

?>
