<?php

namespace Louve\Model;

use Louve\Core\OdooProxy;
use Louve\Core\BaseDBModel;
use Louve\Model\Shift;
use Louve\Model\Session;
use Louve\Model\Statecooperative;
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
    /**
     * @var Singleton
     * @access private
     * @static
     */
    private static $_instance = null;

    /**
     *  id
     *  @var integer
     */
    protected $id;


    /**
     *  idOdoo
     *  @var integer
     */
    protected $idOdoo;

    /**
     *  login
     *  @var string
     */
    protected $login;

    /**
     *  mail
     *  @var string
     */
    protected $mail;

    /**
     *  Session
     *  @var \Louve\Model\Session
     */
    protected $session;

    /**
     *  Prochains créneaux
     *  @var string
     */
    protected $nextShifts;

    /**
     *  First name
     *  @var string
     */
    protected $firstname;

    /**
     *  Last name
     *  @var string
     */
    protected $lastname;

    /**
     *  Admin
     *  @var bool
     */
    protected $admin = false;

    /**
     *  Street
     *  @var int
     */
    protected $street;

    /**
     *  Phone
     *  @var null
     */
    protected $phone;

    /**
     *  Shift
     *  @var
     */
    protected $shift_type;


    /**
     *  compteur volant
     *  @var
     */
    protected $final_ftop_point;

    /**
     *  cooperative_state Statut coopérateur: à jour ? retard, etc...
     *  @var string
     */
    protected $cooperative_state;

    // Est-ce que les données depuis Odoo / BDD locale ont été récupérées ?
    // TODO_LATER: remplacer par un timestamp et rafraichir les données si timestamp trop vieux
    /**
     *  @var datetime
     */
    protected $hasData;

    /**
     * User constructor.
     */
    public function __construct()
    {
 	    $this->session = new Session();
        //recharge les infos de la session
        //TODO check hasData timestamp
        if ($this->isLogged()) {
            //on mets en session l'objet user, autant le récupérer

            $that = & $this;
            $that = unserialize($this->session->getSerializedUser());

            //POURQUOI je ne peux pas copier ?! directement this ??!!
            $this->id = $that->id;
            $this->login = $that->login;
            $this->mail = $that->mail;
            $this->nextShifts = $that->nextShifts;
            $this->firstname = $that->firstname;
            $this->lastname = $that->lastname;
            $this->admin = $that->admin;
            $this->street = $that->street;
            $this->phone = $that->phone;
            $this->shift_type = $that->shift_type;
            $this->cooperative_state = $that->cooperative_state;
            $this->hasData = $that->hasData;
            $this->idOdoo = $that->idOdoo;
            $this->final_ftop_point = $that->final_ftop_point;
            
        } else {
            //echo 'NOT LOGGED';
        }
    }

    /**
     *  isLogged
     *  @return bool
     */
    public function isLogged()
    {
	    return $this->session->isLogged();
    }

    /**
     *  renew session
     *  @return bool
     */
    public function renew()
    {
        $this->getData();
        $this->session->setUser($this);
        return $this;
    }

    // Essaie de se connecter au LDAP et de récupérer des infos sur l'utilisateur
    public function bindLdap($password)
    {
        // En dev, on utilise les credentials login='login' / password='password'
        if (ENVIRONMENT === 'dev' AND $this->login === 'login' AND $password === 'password') {
            $this->firstname = 'dev';
            $this->lastname = 'php';
            $this->id = 1;
            $this->mail = 'dev.php@lalouve.fr';
            $this->setAdmin();
	        $this->getData();
            $this->admin = 1;
            return true;
        } else {
            $ldapResult = bindLdapUser($this->login, $password);
            if (isset($ldapResult)) {
                list($this->firstname, $this->lastname, $this->id, $this->mail) = $ldapResult;
                $this->setAdmin();
		        $this->getData();
                return true;
            }
        }

        return false;
    }

    // Récupération des données du membre depuis Odoo et la base locale
    public function getData()
    {
        if (!isset($this->mail)) {
            error_log("Mail not set while trying to connect Odoo!" . $this->login);
            return;
        }
        $proxy = new OdooProxy();

        if ($proxy->connect() === true)  {
            // Si la connexion réussit, on récupère les prochains shifts de l'utilisateur

            $this->nextShifts = $proxy->getUserNextShifts($this->mail);
            // TODO_LATER: gérer les erreurs qui peuvent survenir
            
            
            $infos = formatUserInfo($proxy->getUserInfo($this->mail));
            //die(var_dump($infos['cooperative_state']));
            // On recopie simplement les infos récupérées dans les attributs de User
            $this->setStreet(isset($infos['street']) ? $infos['street'] : null);
            $this->setFinal_ftop_point(isset($infos['final_ftop_point']) ? $infos['final_ftop_point'] : 0);
            $this->idOdoo = isset($infos['id']) ? $infos['id'] : null;
            $this->phone = isset($infos['mobile']) ? $infos['mobile'] : null;
            $this->shift_type = isset($infos['shift_type']) ? $infos['shift_type'] : null;
            $this->cooperative_state = isset($infos['cooperative_state']) ? $infos['cooperative_state'] : null;
            $this->hasData = true;
            
        } else {
            error_log("Odoo connection error for user " . $this->login);
        }
    }

    /**
     *
     */
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
    }

    /**
     *  getAdmin
     *  @return bool
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     *     setAdmin
     */
    public function setAdmin()
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
        return $this;
    }

    /**
     *  setLogin
     *  @param $login
     *  @return $this
     */
    public function setLogin($login)
    {
	    $this->login = $login;
        return $this;
    }

    /**
     * @param $login
     * @return null|string
     */
    public function getLogin($login)
    {
	    return $this->login;
    }

    /**
     *  setStreet
     *  @param $street
     *  @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;
        return $this;
    }

    /**
     *  getStreet
     *  @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     *  setPhone
     *  @param $phone
     *  @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     *  getPhone
     *  @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     *
     *  @return datetime
     */
    public function hasData()
    {
        return $this->hasData;
    }

    /**
     *  isAdmin
     *  @return bool
     */
    public function isAdmin()
    {
        return $this->admin;
    }

    // TODO_NOW: faire un helper commun qui renvoie une chaîne "info non dispo" si élément pas setté
    // HMMM helper a mettre cote tpl pas dans les getter / setter 
    /**
     *  getFirstName
     *  @return string
     */
    public function getFirstName()
    {
        return $this->firstname;
    }

    /**
     *  setFirstname
     *  @param $firstname
     *  @return $thi
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     *  setLastname
     *  @param $lastname
     *  @return $thi
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     *  getLastname
     *  @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     *  setId
     *  @param $id
     *  @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *  getId
     *  @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *  setIdOdoo
     *  @param $id
     *  @return $this
     */
    public function setIdOdoo($id)
    {
        $this->idOdoo = $id;
        return $this;
    }

    /**
     *  getIdOdoo
     *  @return mixed
     */
    public function getIdOdoo()
    {
        return $this->idOdoo;
    }

    /**
     *  getEmail
     *  @return string
     */
    public function getEmail()
    {
        return $this->mail;
    }

    /**
     *  @param $email
     *  @return $this
     */
    public function setEmail($email)
    {
        $this->mail = $email;
        return $this;
    }

    /**
     *  getCooperativeState
     *  @return string
     */
    public function getCooperativeState()
    {
        return $this->cooperative_state;
    }

    /**
     *  setCooperativeState
     *  @param $cooperativeState
     *  @return $this
     */
    public function setCooperativeState($cooperativeState)
    {
        $this->cooperative_state = $cooperativeState;
        return $this;
    }
    
    /**
     *  getNextShifts
     *  @return string
     */
    public function getNextShifts()
    {
        return $this->nextShifts;
    }

    /**
     *  setNextShifts
     *  @param $nextShifts
     *  @return $this
     */
    public function setNextShifts($nextShifts)
    {
        $this->nextShifts = $nextShifts;
        return $this;
    }

        /**
     *  setFinal_ftop_point
     *  @param $final_ftop_point
     *  @return $this
     */
    public function setFinal_ftop_point($final_ftop_point)
    {
        $this->final_ftop_point= $final_ftop_point;
        return $this;
    }

    /**
     *  getFinal_ftop_point
     *  @return string
     */
    public function getFinal_ftop_point()
    {
        return $this->final_ftop_point;
    }

    // Renvoie les paramètres d'affichage du statut dans un object:
    // la class Bootstrap d'alerte, une alerte courte et le message de détail

    /**
     *  getStatusDisplay
     *  @return array
     */
    public function getStatusDisplay()
    {
        
        
        //echo 'Statecooperative';die;
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
        } else { // Sinon on se base sur 'cooperative_state'
            
            $statecooperative = new Statecooperative($this->cooperative_state);

            $display['class'] = $statecooperative->getClass();
            $display['alert_msg'] = $statecooperative->getAlertmsg();
            $display['full_msg'] = $statecooperative->getFullmsg();

            return $display;
        }
    }

    /**
     *  getCurrentWeek
     *  @return mixed
     */
    public function getCurrentWeek() {
        $calendar = array();
        $letters = array("A", "B", "C", "D");
        for ($counter = 1; $counter <= 53; $counter++) {
            if ($counter == 1) {
                $calendar[$counter] = next($letters);
            } else {
                if (current($letters) == "D") {
                    reset($letters);
                    $calendar[$counter] = current($letters);
                } else {
                    $calendar[$counter] = next($letters);
                }
            }
        }

        return $calendar[(int) date("W")];
    }

    /**
     * Méthode qui crée l'unique instance de la classe
     * si elle n'existe pas encore puis la retourne.
     *
     * @param void
     * @return Singleton
     */
    public static function getInstance() 
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new Singleton();
        }
        return self::$_instance;
    }

}
