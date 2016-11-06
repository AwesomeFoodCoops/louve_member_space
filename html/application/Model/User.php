<?php

namespace Mini\Model;

use Mini\Core\OdooProxy;

// Un import 'use function Mini\Core\formatShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne
require APP . 'helpers/odoo_formatting.php';


/*
 * Infos sur l'utilisateur courant récupérées directement sur le serveur Odoo.
 * AUCUNE DONNEE UTILISATEUR N'EST STOCKEE DANS LA BDD LOCALE MYSQL
 * Utilisation de XMLRPC via la classe OdooProxy
 */
class User
{
    // TODO_NOW: définition et valeurs possibles pour les champs en dessou à vérifier
    public $mail = null;
    public $nextShifts = null;              // Prochains créneaux  
    public $name = null;
    public $street = null;
    public $mobile = null;
    public $shift_type = null;
    public $cooperative_state = null;       // Statut coopérateur: à jour ? retard, etc...
    public $final_standard_point = null;    
    public $final_ftop_point = null;

    // Quand on instancie l'objet, on récupère les infos d'Odoo
    public function __construct($mail)
    {
        $this->mail = $mail;
        $proxy = new OdooProxy($this->mail);
        $connectionStatus = $proxy->connect();
        if ($connectionStatus === true)
        {
            // Si la connexion réussit, on récupère les prochains shifts de l'utilisateur 
            $this->nextShifts = formatShifts($proxy->getNextShifts());
            // TODO_LATER: gérer les erreurs qui peuvent survenir 
            $infos = formatUserInfo($proxy->getUserInfo());
            // On recopie simplement les infos récupérées dans les attributs de User
            $this->name = $infos['name'];
            $this->street = $infos['street'];
            $this->mobile = $infos['mobile'];
            $this->shift_type = $infos['shift_type'];
            $this->cooperative_state = $infos['cooperative_state'];
            $this->final_standard_point = $infos['final_standard_point'];
            $this->final_ftop_point = $infos['final_ftop_point'];            
        }
        else
        {
            // TODO_LATER: gérer les erreurs !
        }
    }

    // Renvoie les paramètres d'affichage du statut dans un object:
    // la class Bootstrap d'alerte, une alerte courte et le message de détail
    public function getStatusDisplay()
    {
        // Objet d'affichage à renvoyé qui va être rempli en fontion du statut
        $display = [
            'class' => '',
            'alert_msg' => '',
            'full_msg' => '',
        ];
        // En dev on envoie des données bidons
        if (ENVIRONMENT === 'dev') {
            $display['class'] = 'alert-warning';
            $display['alert_msg'] = "T'es dingue mec";
            $display['full_msg'] = "Prends des vacances";
        }
        // Sinon on se base sur 'cooperative_state'
        else {
            if (!isset($cooperative_state)) {
                $display['class'] = 'alert-warning';
                $display['alert_msg'] = 'Erreur';
                $display['full_msg'] = 'Un problème technique nous empêche actuellement de connaitre votre status. Réessayez plus tard ou contactez le bureau des membres.';
            }
            // TODO_LATER: faire plus élégant que cette suite de conditions moches ?
            else if ($cooperative_state === 'up_to_date') {
                $display['class'] = 'alert-success';
                $display['alert_msg'] = 'Vous êtes à jour';
                $display['full_msg'] = '';
            }
            else if ($cooperative_state === 'alert') {
                $display['class'] = 'alert-warning';
                $display['alert_msg'] = 'Attention';
                $display['full_msg'] = 'Vous avez des services en retard';
            }
            else if ($cooperative_state === 'suspended') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez été suspendu, merci de contacter le bureau des membres';
            }
            else if ($cooperative_state === 'delay') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Votre participation est temportairement gelée';
            }
            else if ($cooperative_state === 'unpayed') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez un paiement en retard, vous êtes momentanément suspendu, merci de contacter le bureau des membres.';
            }
            else if ($cooperative_state === 'unpayed') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez été bloqué, merci de contacter le bureau des membres.';
            }
            else if ($cooperative_state === 'unsuscribed') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez été désinscrit, merci de contacter le bureau des membres.';
            }
        }
        return $display;
    }
}
