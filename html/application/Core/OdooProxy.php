<?php

namespace Mini\Core;

use PhpXmlRpc\Value;
use PhpXmlRpc\Request;
use PhpXmlRpc\Client;

// En développement on ne va pas chercher les infos sur Odoo, on retourne des valeurs bidons
use Mini\Testing\FakeOdoo;


class OdooProxy
{
    private $mail = null;
    private $userUid = null;
    private $client = null;
     
    public function __construct($mail)
    {
        // Mail is used as login in Odoo
        $this->mail = $mail;
    }

    // Connexion à la base Odoo
    // return true si la connexion réussit, false sinon
    public function connect()
    {
        // Si on est en dév local, on n'utilise pas odoo et on considère qu'on arrive à se connecter
        if (ENVIRONMENT === 'dev'){
            return true;
        }

        $client = new Client(ODOO_SERVER_URL . "/xmlrpc/common");
        $client->request_charset_encoding = 'UTF-8';
        $client->setSSLVerifyPeer(0);

        $msg = new Request(
            'login', array(
                new Value(ODOO_DB_NAME, 'string'),
                new Value(ODOO_DB_USER, 'string'),
                new Value(ODOO_DB_PASSWORD, 'string')
            )
        );
        $response = $client->send($msg);

        if( $response->faultCode() ) {
            error_log("Erreur Odoo #1: " . var_dump($response));
            return false;
        } else {
            $this->userUid = $response->value()->scalarval();
            return true;
        }
    }

    // Récupération des prochains créneaux de l'utilsateur (basé sur son email)
    public function getUserNextShifts()
    {
        // En dév local on renvoie des valeurs bidons
        if (ENVIRONMENT === 'dev') {
            return (new FakeOdoo())->nextShifts();
        }

        $odoo_table = "shift.registration";
        $client = new Client(ODOO_SERVER_URL . "/xmlrpc/object");
        $client->request_charset_encoding = 'UTF-8';
        $client->setSSLVerifyPeer(0);

        // On récupère les références des lignes qui nous intéressent dans la table "shift.registration"
        $user_entries = self::getUserEntriesInTable($client, $odoo_table);

        // Définition des champs qu'on va vouloir récupérer dans ces lignes
        $field_list = array(
            new Value("name", "string"),
            new Value("state", "string"),
            new Value("date_begin", "string"),
            new Value("email", "string"),
        );

        // Requête des champs
        $raw_values = self::getEntriesValues($client, $odoo_table, $user_entries, $field_list);

        $result = $raw_values->value()->scalarval();
        return $result;
    }

    // Récupération des infos personnelles de l'utilisateur
    public function getUserInfo()
    {
        // En dév local on renvoie des infos bidons
        if (ENVIRONMENT === 'dev') {
            return (new FakeOdoo())->userInfo()[0];
        }

        $odoo_table = "res.partner";
        $client = new Client(ODOO_SERVER_URL . "/xmlrpc/object");
        $client->request_charset_encoding = 'UTF-8';
        $client->setSSLVerifyPeer(0);

        // On récupère les références des lignes qui nous intéressent dans la table "res.partner"
        $user_entries = self::getUserEntriesInTable($client, $odoo_table);

        // Définition des champs qu'on va vouloir récupérer dans ces lignes
        $field_list = array(
            new Value("name", "string"),
            new Value("street", "string"),
            new Value("mobile", "string"),
            new Value("email", "string"),
            new Value("shift_type", "string"),
            new Value("cooperative_state", "string"),
            new Value("final_standard_point", "string"),
            new Value("final_ftop_point", "string"),
        );

        // Requête de ces champs sur les lignes sélectionnées
        $raw_values = self::getEntriesValues($client, $odoo_table, $user_entries, $field_list);

        $result = $raw_values->value()->scalarval();

        // On a une liste mais logiquement on est juste censé avoir une et une seule ligne
        // pour l'utilisateur
        return $result[0];
    }

    // Récupération des shifts volants
    public function ftopShifts()
    {
        // TODO_NOW En dév local renvoyer des infos bidons
        if (ENVIRONMENT === 'dev') {
            return;
        }
        $odoo_table = "shift.ticket";
        $client = new Client(ODOO_SERVER_URL . "/xmlrpc/object");
        $client->request_charset_encoding = 'UTF-8';
        $client->setSSLVerifyPeer(0);

        $domain_filter = array (
            new Value(
                array(new Value('name' , "string"),
                      new Value('=',"string"),
                      new Value('Volant',"string")
                ),"array"
            ),
        );

        $msg = new Request(
            'execute', array(
                new Value(ODOO_DB_NAME, 'string'),
                new Value($this->userUid, 'int'),
                new Value(ODOO_DB_PASSWORD, 'string'),
                new Value($odoo_table, 'string'),
                new Value('search', 'string'),
                new Value($domain_filter, 'array')
            )
        );

        $response = $client->send($msg);

        $uids = $response->value()->scalarval();
        $uids_list = array();

        // Liste des IDs de shift volant
        for($i = 0; $i < count($uids); $i++){
            $uids_list[]= new Value($uids[$i]->me['int'], 'int');
        }

        // Définition des champs qu'on va vouloir récupérer dans ces lignes
        $field_list = array(
            new Value("id", "string"),
            new Value("name", "string"),
            new Value("seats_available", "string"),
            new Value("date_begin", "string"),
            new Value("shift_type", "string"),
        );

        // Requête des champs
        $raw_values = self::getEntriesValues($client, $odoo_table, $uids_list, $field_list);

        $result = $raw_values->value()->scalarval();
        return $result;
    }

    // Permet de trouver les lignes correspondant à un utilisateur dans une table Odoo via son email
    // TODO_LATER: On doit surement pouvoir faire une requête directe (et pas lecture ids puis requête de champs)
    private function getUserEntriesInTable($client, $odoo_table)
    {
        $domain_filter = array (
            new Value(
                array(new Value('email' , "string"),
                      new Value('=',"string"),
                      new Value($this->mail,"string")
                ),"array"
            ),
        );

        $msg = new Request(
            'execute', array(
                new Value(ODOO_DB_NAME, 'string'),
                new Value($this->userUid, 'int'),
                new Value(ODOO_DB_PASSWORD, 'string'),
                new Value($odoo_table, 'string'),
                new Value('search', 'string'),
                new Value($domain_filter, 'array')
            )
        );

        $response = $client->send($msg);

        $uids = $response->value()->scalarval();
        $uids_list = array();

        for($i = 0; $i < count($uids); $i++){
            $uids_list[]= new Value($uids[$i]->me['int'], 'int');
        }
        // Liste des IDs de ligne pour lesquelles le mail de l'utilisateur courant
        // matche celui de la ligne
        return $uids_list;
    }

    // Retourne les valeurs pour une liste de colonnes et une liste de lignes
    private function getEntriesValues($client, $odoo_table, $entry_uids, $field_list)
    {
        $msg = new Request(
            'execute', array(
                new Value(ODOO_DB_NAME, "string"),
                new Value($this->userUid, "int"),
                new Value(ODOO_DB_PASSWORD, "string"),
                new Value($odoo_table, "string"),
                new Value("read", "string"),
                new Value($entry_uids, "array"),
                new Value($field_list, "array"),            
            )
        );

        $resp = $client->send($msg);

        if ($resp->faultCode()){
            // TODO_LATER: gérer erreur => return ? lever une exception ?
            error_log("Erreur Odoo #2: " . var_dump($resp));
        }
        return $resp;
    }
}

// TODO_LATER: à intégrer ? fonctions développées par JZ pour tester une connexion Odoo
// Attention copiées en "brut", à adapter

//    function getVersion()
//    {
//        $GLOBALS['xmlrpc_internalencoding'] = 'UTF-8';
//
//        $cnx = new Client($this->cfg->host . $this->cfg->api . 'common');
//        //~ $cnx->return_type = 'phpvals';
//        $cnx->request_charset_encoding = 'UTF-8';
//        $cnx->setSSLVerifyPeer(0);
//
//        $msg = new Request('version');
//        $rsp = $cnx->send($msg);
//
//        if( $rsp->faultCode() )
//            $r = NULL;
//        else
//            $r = xmlrpc_decode($rsp->serialize());
//
//        return $r;
//    }

//    /*
//     * Check access
//     *
//     * Returns: true if access is granted, false otherwise
//     */
//    function checkAccess()
//    {
//        $cnx = new Client($this->cfg->host . $this->cfg->api . 'object');
//        //~ $cnx->return_type = 'phpvals';
//        $cnx->request_charset_encoding = 'UTF-8';
//        $cnx->setSSLVerifyPeer(0);
//
//        if( !$this->uid ) $this->authenticate();
//
//        $prm_list = array( new Value('read', 'string') );
//        $prm_mapp = array( 'raise_exception' => new Value('false', 'boolean') );
//
//        $msg = new Request(
//            'execute_kw', array(
//                new Value($this->cfg->base, 'string'),
//                new Value($this->uid, 'int'),
//                new Value($this->cfg->pass, 'string'),
//                new Value($this->table, 'string'),
//                new Value('check_access_rights', 'string'),
//                new Value($prm_list, 'array'),
//                new Value($prm_mapp, 'struct')
//            )
//        );
//        $rsp = $cnx->send($msg);
//
//        if( $rsp->faultCode() ) {
//            die( '<p>Error '. $rsp->errno . ' :' . $rsp->faultString() . '</p>');
//        } else {
//            $r = $rsp->value()->scalarval();
//        }
//
//        return $r;
//    }
