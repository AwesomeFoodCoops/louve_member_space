<?php

namespace Louve\Model;

use Louve\Core\OdooProxy;
use Louve\Core\BaseDBModel;
use PDO;


// Un import 'use function Mini\Core\formatShifts;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne
include_once(APP . 'helpers/odoo_formatting.php');


/*
 * Infos sur l'utilisateur courant récupérées directement sur le serveur Odoo.
 * AUCUNE DONNEE UTILISATEUR N'EST STOCKEE DANS LA BDD LOCALE MYSQL
 * Utilisation de XMLRPC via la classe OdooProxy
 */
class User
{
    private $login = null;
    private $mail = null;
    private $nextShifts = null;              // Prochains créneaux
    private $firstname = null;
    private $lastname = null;
    private $admin = false;
    private $id = 0;
    private $street = null;
    private $phone = null;
    private $shift_type = null;
    private $cooperative_state = null;       // Statut coopérateur: à jour ? retard, etc...

    // Est-ce que les données depuis Odoo / BDD locale ont été récupérées ?
    // TODO_LATER: remplacer par un timestamp et rafraichir les données si timestamp trop vieux
    private $hasData = false;

    public function __construct($login) {
        $this->login = $login;
        //~ parent::__construct();
        self::getAdminStatus();
    }

    // Essaie de se connecter au LDAP et de récupérer des infos sur l'utilisateur
    public function bindLdap($password)
    {
        $ldapResult = bindLdapUser($this->login, $password);
        if (isset($ldapResult)) {
            list($this->firstname, $this->lastname, $this->id, $this->mail) = $ldapResult;
            return true;
        }
        return false;
    }

    // Récupération des données du membre depuis Odoo et la base locale
    public function getData()
    {
        if(!isset($this->mail)){
            error_log("Mail not set while trying to connect Odoo!" . $this->login);
            return;
        }
        $proxy = new OdooProxy();
        if ($proxy->connect() === true)
        {
            // Si la connexion réussit, on récupère les prochains shifts de l'utilisateur
            $this->nextShifts = formatShifts($proxy->getUserNextShifts($this->mail));
            // TODO_LATER: gérer les erreurs qui peuvent survenir
            $infos = formatUserInfo($proxy->getUserInfo($this->mail));
            // On recopie simplement les infos récupérées dans les attributs de User
            $this->street = isset($infos['street']) ? $infos['street'] : null;
            $this->phone = isset($infos['mobile']) ? $infos['mobile'] : null;
            $this->shift_type = isset($infos['shift_type']) ? $infos['shift_type'] : null;
            $this->cooperative_state = isset($infos['cooperative_state']) ? $infos['cooperative_state'] : null;
            $hasData = true;
        }
        else {
            error_log("Odoo connection error for user " . $this->login);
        }
    }

    public function getAdminStatus()
    {
        // TODO_NOW: lire le statut admin dans LDAP ?
        $db = new BaseDBModel;

        //test si l user est Admin
        if (!$db->fake) {
            $sql = "SELECT mail FROM admins where mail='$this->login'";
            $query = $db->db->prepare($sql);
            $query->bindParam(':mail', $this->mail);
            $query->execute();
            if ($query->rowCount() > 0)
               $this->admin=true;
        }
        error_log('COUNT:'.$query->rowCount());
    }

    public function hasData() { return $this->hasData; }
    public function isAdmin() { return $this->admin; }

    // TODO_NOW: faire un helper commun qui renvoie une chaîne "info non dispo" si élément pas setté
    public function getFirstName() { return $this->firstname; }
    public function getLastname() { return $this->lastname; }
    public function getId() { return $this->id; }
    public function getEmail() { return $this->mail; }
    public function getPhone() { return $this->phone; }
    public function getNextShifts() { return $this->nextShifts; }

    // Renvoie les paramètres d'affichage du statut dans un object:
    // la class Bootstrap d'alerte, une alerte courte et le message de détail
    public function getStatusDisplay() {
        // Objet d'affichage à renvoyé qui va être rempli en fontion du statut
        $display = [
            'class' => '',
            'alert_msg' => '',
            'full_msg' => '',
        ];
        // En dev on envoie des données bidons
        // TODO_NOW: en fait on en a pas besoin parce qu'on a un mock de cooperative state en dev, à virer donc
        if (ENVIRONMENT === 'dev') {
            $display['class'] = 'alert-warning';
            $display['alert_msg'] = "T'es dingue mec";
            $display['full_msg'] = "Prends des vacances";
        }
        // Sinon on se base sur 'cooperative_state'
        else {
            $cooperative_state = $this->cooperative_state;
            if (!isset($cooperative_state)) {
                $display['class'] = 'alert-warning';
                $display['alert_msg'] = 'Erreur';
                $display['full_msg'] = 'Un problème technique nous empêche actuellement de connaitre votre status. Réessayez plus tard ou contactez le bureau des membres.';
            }
            // TODO_LATER: faire plus élégant que cette suite de conditions moches ?
            else if ($cooperative_state === 'up_to_date') {
                $display['class'] = 'alert-success';
                $display['alert_msg'] = 'Bravo!';
                $display['full_msg'] = "Vous êtes à jour";
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
            else if ($cooperative_state === 'blocked') {
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
