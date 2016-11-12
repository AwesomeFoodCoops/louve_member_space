<?php

namespace Mini\Model;

use Mini\Core\OdooProxy;
use Mini\Core\BaseDBModel;
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
    // TODO_NOW: définition et valeurs possibles pour les champs en dessou à vérifier
    public $login = null;
    public $mail = null;
    public $nextShifts = null;              // Prochains créneaux
    public $firstname = 'John';
    public $name = 'Doe';
    public $admin = false;
    public $id = 0;
    public $leader = true;
    public $street = null;
    public $phone = '+33(0)1 00 00 00 00';
    public $shift_type = null;
    public $cooperative_state = null;       // Statut coopérateur: à jour ? retard, etc...
    public $final_standard_point = null;
    public $final_ftop_point = null;

    public $connected = false;

    // Quand on instancie l'objet, on récupère les infos d'Odoo
    public function __construct($login)
    {
        $this->login = $login;
    }

    public function getFirstName()
    {
        return $this->firstname;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->mail;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function isLeader()
    {
        return $this->leader;
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function getAdminStatus()
    {
        $db = new BaseDBModel();
        $r = false;

        if (!$db->fake && isset($this->mail) )
        {
            $sql = "SELECT COUNT(mail) AS FoundAsAdmin FROM admins WHERE mail=\"$this->mail\"";
            $query = $db->db->query($sql);
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $r = boolval($query->fetch()['FoundAsAdmin']);
        }

        return $r;
    }

    /**
     *  Get user info from Odoo
     * */
    public function getOdooInfo()
    {
        if(!isset($this->mail))
            return null;

        // TODO: remove email from OdooProxy constructor
        $proxy = new OdooProxy($this->mail);
        $this->connected = $proxy->connect();
        if ($this->connected === true)
        {
            // Si la connexion réussit, on récupère les prochains shifts de l'utilisateur
            $this->nextShifts = formatShifts($proxy->getUserNextShifts());
            // TODO_LATER: gérer les erreurs qui peuvent survenir
            $infos = formatUserInfo($proxy->getUserInfo());
            // On recopie simplement les infos récupérées dans les attributs de User
            //~ $this->name = $infos['name']; -- now from ldap
            $this->street = $infos['street'];
            $this->phone = isset($infos['mobile']) ? $infos['mobile'] : '-undefined-';
            $this->shift_type = $infos['shift_type'];
            $this->cooperative_state = isset($infos['cooperative_state']) ? $infos['cooperative_state'] : '';
            //~ $this->final_standard_point = $infos['final_standard_point'];
            //~ $this->final_ftop_point = $infos['final_ftop_point'];
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
            $cooperative_state = $this->cooperative_state;
            if (!isset($cooperative_state)) {
                $display['class'] = 'alert-warning';
                $display['alert_msg'] = 'Erreur';
                $display['full_msg'] = 'Un problème technique nous empêche actuellement de connaitre votre status. Réessayez plus tard ou contactez le bureau des membres.';
            }
            // TODO_LATER: faire plus élégant que cette suite de conditions moches ?
            else if ($cooperative_state === 'up_to_date') {
                $display['class'] = 'alert-success';
                $display['alert_msg'] = 'Vous êtes à jour';
                $display['full_msg'] = 'Bravo!';
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


    public function checkPass($pass)
    {
        $pass = strip_tags($pass);
        $ldap = ldap_connect(LDAP_SERVER);

        if( $ldap )
        {
            // On dit qu'on utilise LDAP V3, sinon la V2 par défaut est utilisé
            // et le bind ne passe pas.
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

            $ldapbind = ldap_bind($ldap, "uid=".$this->login.",ou=users,".LDAP_BASE_DN, $pass);

            if( $ldapbind )
            {
                //~ echo '<p>Ldap bind OK</p>';

                $filter="uid=$this->login";
                $justthese = array("employeeNumber", "sn", "givenName", "mail", "userPassword");

                $sr = ldap_search($ldap, LDAP_BASE_DN, $filter, $justthese);

                $info = ldap_get_entries($ldap, $sr);
                $nb_results = $info['count'];

                if( $nb_results != 1 )
                {
                    //~ echo '<p>Info KO, user not found ('. $nb_results . ')</p>';
                    $r = false;
                }
                else
                {
                    //~ if( !isset($info[0]['employeenumber'][0]) )
                    if( !isset($info[0]['mail'][0]) )
                    {
                        // pas de n° louve!
                        $r = false;
                    }
                    else
                    {
                        $this->firstname = isset( $info[0]['givenname'][0] ) ? $info[0]['givenname'][0] : 'unknown';
                        $this->name = isset( $info[0]['sn'][0] ) ? $info[0]['sn'][0] : 'unkonwn';
                        $this->id = isset( $info[0]['employeenumber'][0] ) ? $info[0]['employeenumber'][0] : 0;
                        $this->mail = isset( $info[0]['mail'][0] ) ? $info[0]['mail'][0] : 'nomail';
                        //~ $pass = $info[0]['userpassword'][0];

                        $this->getOdooInfo();
                        $this->admin = $this->getAdminStatus();

                        // l'utilisateur est authentifié et ses infos sont enregistrées.
                        $r = true;
                    }
                }

                ldap_close($ldap);
            }
            else
            {
                //~ echo '<p>Ldap bind KO</p>';
                $r = false;
            }
        }
        else
        {
            //~ echo '<p>Ldap connection KO</p>';
            $r = false;
        }

        return $r;
    }

}
