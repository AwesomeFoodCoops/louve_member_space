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

class louve_user
{
    var $id = 'bad_id';
    var $login = 'undefined';
    var $name = 'Doe';
    var $firstname = 'John';
    var $phone = '+33 6 12 23 34 56';
    var $email = 'john.doe@lalouve.fr';
    var $shift = 'no';
    var $status = 0;
    var $leader = FALSE;
    var $employe = FALSE;
    var $timestamp;

    function __construct($login)
    {
        $this->login = strip_tags($login);
        $this->timestamp = time();
    }

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

    function isLeader()
    {
        return $this->leader;
    }

    function isEmploye()
    {
        return $this->employe;
    }

    function checkPass($pass)
    {
        $pass = strip_tags($pass);
        $ldap = ldap_connect(EmConfig::LdapServer);

        if( $ldap )
        {
            //~ echo '<p>Ldap connexion OK</p>';
            // On dit qu'on utilise LDAP V3, sinon la V2 par défaut est utilisé
            // et le bind ne passe pas.
            ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);

            $ldapbind = ldap_bind($ldap, "uid=".$this->login.",ou=users,".EmConfig::LdapBaseDn, $pass);
            //~ $ldapbind = ldap_bind($ldap, "mail=".$login.",ou=users,".$ldap_basedn, $ldap_pass);

            if( $ldapbind )
            {
                //~ echo '<p>Ldap bind OK</p>';

                $filter="uid=$this->login";
                $justthese = array("employeeNumber", "sn", "givenName", "mail", "userPassword");

                $sr = ldap_search($ldap, EmConfig::LdapBaseDn, $filter, $justthese);

                $info = ldap_get_entries($ldap, $sr);
                $nb_results = $info['count'];

                //~ echo '<pre>';
                //~ var_dump($info[0]);
                //~ echo '</pre>';

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
                        $this->email = isset( $info[0]['mail'][0] ) ? $info[0]['mail'][0] : 'nomail';
                        $pass = $info[0]['userpassword'][0];

                        //~ echo '<p>First name: '.$firstname.'</p>';
                        //~ echo '<p>Name: '.$name.'</p>';
                        //~ echo '<p>Employee Number: '.$uid.'</p>';
                        //~ echo '<p>Mail: '.$mail.'</p>';
                        //~ echo '<p>Password: '.$pass.'</p>';

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

?>
