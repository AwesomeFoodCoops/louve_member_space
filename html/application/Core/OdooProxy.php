<?php

namespace Louve\Core;

use PhpXmlRpc\Value;
use PhpXmlRpc\Request;
use PhpXmlRpc\Client;
use PhpXmlRpc\Helper\Date;

use Louve\Model\Shift;
// En développement on ne va pas chercher les infos sur Odoo, on retourne des valeurs bidons
use Louve\Testing\FakeOdoo;


class OdooProxy
{
    private $connectionUid = null;

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
            // TODO_NOW: mettre ce type de report d'erreur avec traceback partout
            error_log('Erreur Odoo #1: ' . print_r($response, TRUE));
            return false;
        } else {
            $this->connectionUid = $response->value()->scalarval();
            return true;
        }
    }

    // Récupération des prochains créneaux de l'utilsateur (basé sur son email)
    public function getUserNextShifts($mail)
    {
        
        // En dév local on renvoie des valeurs bidons
        if (ENVIRONMENT === 'dev') {
            return (new FakeOdoo())->nextShifts();
        }

        $odoo_table = "shift.registration";
        $client = new Client(ODOO_SERVER_URL . "/xmlrpc/object");
        $client->request_charset_encoding = 'UTF-8';
        $client->setSSLVerifyPeer(0);

        //$t = time()+4*7*24*60*60;
        $t = time();
        $date = Date::iso8601Encode($t);
        // On récupère les références des lignes qui nous intéressent dans la table "shift.registration"
        $user_entries = self::getLinesByUserMailLaterThan($client, $odoo_table, $mail, $date);
     
        // Définition des champs qu'on va vouloir récupérer dans ces lignes
        $field_list = array(
            new Value("name", "string"),
            new Value("state", "string"),
            new Value("date_begin", "string"),
            new Value("user_id","string"),
            new Value("email", "string"),
        );

        // Requête des champs
        $raw_values = self::getEntriesValues($client, $odoo_table, $user_entries, $field_list);

        $result = $raw_values->value()->scalarval();
        $returnedShifts = array();
        //echo(count($result)); 
        for($i = 0; $i < count($result) AND $i < 3; $i++)
        {
        
        $nextTime = $result[$i]->me['struct']['date_begin']->me['string'];
        list($dd, $day, $month, $year, $hour, $minutes) = formatDate($nextTime);
        
        //todo a virer des qu on sait comment virer les faux shifts d odoo
        if ($hour!="22")
        {
        $shift = new Shift();
        $shift->date =  $dd . ' ' . $day . ' ' . $month . ' ' . $year . ' : ' . $hour . 'H' . $minutes;
        //todo boucler sur les coordinateurs prevoir qu il va y en avoir plusieurs
        //die(count($result[$i]->me['struct']['user_id']));
        //for($i = 0; $i < count($result[$i]->me['struct']['user_id']); $i++)
        //{
        $shift->addCoordinator($result[$i]->me['struct']['user_id'][0]->me['int']);
        //}
        //$shift->coordinator_id = $shifts[$i]->me['struct']['user_id'][0]->me['int'];
        //echo(var_dump($shifts[$i]));
        //$returnedShifts[count( $result)] = $shift;
        array_push($returnedShifts ,$shift);
        }
        }
        //die(print_r(json_encode($returnedShifts ),true));
        //die(var_dump(self::getCoordinatorInfo("7284")));
        //        
        return  $returnedShifts;
    }

    // Récupération des infos personnelles de l'utilisateur
    public function getUserInfo($mail)
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
        $user_entries = self::getUserEntriesInTable($client, $odoo_table, $mail);

        // Définition des champs qu'on va vouloir récupérer dans ces lignes
        $field_list = array(
            new Value("street", "string"),
            new Value("mobile", "string"),
            new Value("email", "string"),
            new Value("shift_type", "string"),
            new Value("cooperative_state", "string"),
        );

        // Requête de ces champs sur les lignes sélectionnées
        $raw_values = self::getEntriesValues($client, $odoo_table, $user_entries, $field_list);

        $result = $raw_values->value()->scalarval();

        // On a une liste mais logiquement on est juste censé avoir une et une seule ligne
        // pour l'utilisateur
        return $result[0];
    }

    // Récupération des infos personnelles de l'utilisateur
    public function getCoordinatorInfo($id)
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
        $user_entries = self::getLinesByUserId($client, $odoo_table, $id);
        // Définition des champs qu'on va vouloir récupérer dans ces lignes
        $field_list = array(
            new Value("street", "string"),
            new Value("mobile", "string"),
            new Value("email", "string"),
            new Value("shift_type", "string"),
            new Value("cooperative_state", "string"),
            new Value("name", "string"),
        );

        // Requête de ces champs sur les lignes sélectionnées
        $raw_values = self::getEntriesValues($client, $odoo_table, $user_entries, $field_list);
        

        $result = $raw_values->value()->scalarval();

        // On a une liste mais logiquement on est juste censé avoir une et une seule ligne
        // pour l'utilisateur
        return $result[0];
    }

    // Récupération des shifts volants
    public function getFtopShifts()
    {
        // TODO_NOW En dév local renvoyer des infos bidons
        if (ENVIRONMENT === 'dev') {
            return;
        }
        $odoo_table = "shift.ticket";
        $client = new Client(ODOO_SERVER_URL . "/xmlrpc/object");
        $client->request_charset_encoding = 'UTF-8';
        $client->setSSLVerifyPeer(0);
        $t = time();
        $date = Date::iso8601Encode($t);
        $domain_filter = array (
            new Value(
                array(new Value('name' , "string"),
                      new Value('=',"string"),
                      new Value('Volant',"string")
                ),"array"
            ),
            
            new Value(
                array(new Value('date_begin' , "string"),
                      new Value('>=',"string"),
                      new Value($date,"string")
                ),"array"
            ),
            
        );

        $msg = new Request(
            'execute', array(
                new Value(ODOO_DB_NAME, 'string'),
                new Value($this->connectionUid, 'int'),
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
    private function getLinesByUserId($client, $odoo_table, $id)
    {
        $domain_filter = array (
            new Value(
                array(new Value('id' , "string"),
                      new Value('=',"string"),
                      new Value($id,"string")
                ),"array"
            ),
        );

        $msg = new Request(
            'execute', array(
                new Value(ODOO_DB_NAME, 'string'),
                new Value($this->connectionUid, 'int'),
                new Value(ODOO_DB_PASSWORD, 'string'),
                new Value($odoo_table, 'string'),
                new Value('search', 'string'),
                new Value($domain_filter, 'array')
            )
        );

        $response = $client->send($msg);

        $uids = $response->value()->scalarval();
        //die(print_r($uids,true));
        $uids_list = array();
        
        for($i = 0; $i < count($uids); $i++){
            $uids_list[]= new Value($uids[$i]->me['int'], 'int');
        }
        // Liste des IDs de ligne pour lesquelles le mail de l'utilisateur courant
        // matche celui de la ligne
        return $uids_list;
    }
    // Permet de trouver les lignes correspondant à un utilisateur dans une table Odoo via son email
    // TODO_LATER: On doit surement pouvoir faire une requête directe (et pas lecture ids puis requête de champs)
    private function getLinesByUserMailLaterThan($client, $odoo_table, $mail, $date)
    {
        $domain_filter = array (
            new Value(
                array(new Value('email' , "string"),
                      new Value('=',"string"),
                      new Value($mail,"string")
                ),"array"
            ),
            new Value(
                array(new Value('date_begin' , "string"),
                      new Value('>=',"string"),
                      new Value($date,"string")
                ),"array"
            ),
        );

        $msg = new Request(
            'execute', array(
                new Value(ODOO_DB_NAME, 'string'),
                new Value($this->connectionUid, 'int'),
                new Value(ODOO_DB_PASSWORD, 'string'),
                new Value($odoo_table, 'string'),
                new Value('search', 'string'),
                new Value($domain_filter, 'array')
            )
        );

        $response = $client->send($msg);
	
        error_log('Erreur Odoo #3: Date('. $date . ')'. print_r($response, TRUE));
        $uids_list = array();
        try{
        $uids = $response->value()->scalarval();
       

        for($i = 0; $i < count($uids); $i++){
            $uids_list[]= new Value($uids[$i]->me['int'], 'int');
        }
        }
        catch(Exception $e){}
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
                new Value($this->connectionUid, "int"),
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


    // Permet de trouver les lignes correspondant à un utilisateur dans une table Odoo via son email
    // TODO_LATER: On doit surement pouvoir faire une requête directe (et pas lecture ids puis requête de champs)
    private function getUserEntriesInTable($client, $odoo_table, $mail)
    {
        $domain_filter = array (
            new Value(
                array(new Value('email' , "string"),
                      new Value('=',"string"),
                      new Value($mail,"string")
                ),"array"
            ),
        );
        $msg = new Request(
            'execute', array(
                new Value(ODOO_DB_NAME, 'string'),
                new Value($this->connectionUid, 'int'),
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
}
