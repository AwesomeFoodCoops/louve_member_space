<?php

namespace Mini\Model;

use Mini\Core\OdooProxy;
// Un import 'use function Mini\Core\formatShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne
require APP . 'helpers/odoo_formatting.php';

/*
 * Infos sur l'utilisateur courant récupérées directement sur le serveur Odoo
 * via un appel XMLRPC qui tape dans la base Odoo
 */
class User
{

    public $mail = null;
    public $nextShifts = null;
    public $name = null;
    public $street = null;
    public $mobile = null;
    public $shift_type = null;
    public $cooperative_state = null;
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
            $this->nextShifts = formatShifts($proxy->getNextShifts());
            $infos = formatUserInfo($proxy->getUserInfo());
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

    public function getStatusDisplay()
    {
        $display = [
            'class' => '',
            'alert_msg' => '',
            'full_msg' => '',
        ];
        // En dev on envoie des données bidons
        // TODO: ces infos doivent être pirses dans l'objet lui-meme
        // et donc faire les mocks çà l'initialisation du modèle si besoin
        if (ENVIRONMENT === 'dev') {
            $display['class'] = 'alert-warning';
            $display['alert_msg'] = "T'es dingue mec";
            $display['full_msg'] = "Prends des vacances";
        }
        else {
            if (!isset($_SESSION['louvestatus'])) {
                $display['class'] = 'alert-warning';
                $display['alert_msg'] = 'Erreur';
                $display['full_msg'] = 'Un problème technique nous empêche actuellement de connaitre votre status. Réessayez plus tard ou contactez le bureau des membres.';
            }
            // TODO: faire plus élégant
            else if ($_SESSION['louvestatus'] === 'up_to_date') {
                $display['class'] = 'alert-success';
                $display['alert_msg'] = 'Vous êtes à jour';
                $display['full_msg'] = '';
            }
            else if ($_SESSION['louvestatus'] === 'alert') {
                $display['class'] = 'alert-warning';
                $display['alert_msg'] = 'Attention';
                $display['full_msg'] = 'Vous avez des services en retard';
            }
            else if ($_SESSION['louvestatus'] === 'suspended') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez été suspendu, merci de contacter le bureau des membres';
            }
            else if ($_SESSION['louvestatus'] === 'delay') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Votre participation est temportairement gelée';
            }
            else if ($_SESSION['louvestatus'] === 'unpayed') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez un paiement en retard, vous êtes momentanément suspendu, merci de contacter le bureau des membres.';
            }
            else if ($_SESSION['louvestatus'] === 'unpayed') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez été bloqué, merci de contacter le bureau des membres.';
            }
            else if ($_SESSION['louvestatus'] === 'unsuscribed') {
                $display['class'] = 'alert-danger';
                $display['alert_msg'] = 'Alerte';
                $display['full_msg'] = 'Vous avez été désinscrit, merci de contacter le bureau des membres.';
            }
        }
        return $display;
    }
}
