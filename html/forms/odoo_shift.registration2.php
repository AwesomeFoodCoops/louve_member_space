<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$odoo_table = "shift.registration";   //"shift.registration";

error_reporting(E_ALL);
ini_set('display_errors', '1');
echo '<h2>XML-RPC AVEC OPENERP/ODOO ET PHP eéèï</h2>';

include("xmlrpc/lib/xmlrpc.inc");
include("xmlrpc/lib/xmlrpcs.inc");
$GLOBALS['xmlrpc_internalencoding']='UTF-8';

$user = 'ESPACE_MEMBRES';
$password = 'cooplalouv3';
$dbname = 'lalouve-dev_bdd1';  //cooplalouve

$server_url = 'http://lalouve-dev.code-and-design.fr';  // TEST: http://erp-test.cooplalouve.fr:8069    Attention : ttp://lalouve-dev.code-and-design.fr
$connexion = new xmlrpc_client($server_url . "/xmlrpc/common");
$connexion->setSSLVerifyPeer(0);

$c_msg = new xmlrpcmsg('login');
$c_msg->addParam(new xmlrpcval($dbname, "string"));
$c_msg->addParam(new xmlrpcval($user, "string"));
$c_msg->addParam(new xmlrpcval($password, "string"));
$c_response = $connexion->send($c_msg);


echo '<hr />';
echo "<HR>RESERVATION SHIFT DANS ODOO";

print_r($c_response);


    $val = array ( 
        "name"    => new xmlrpcval("VIRARD, Mathilde", "string"),
        "state"   => new xmlrpcval("open", "string"),
        "date_begin" => new xmlrpcval("2016-12-27 07:00:00", "string"),  
        "email"   => new xmlrpcval("mathilde.virard@gmail.com", "string"),
        ); 
    
    $client = new xmlrpc_client($server_url . "/xmlrpc/object");
    $client->setSSLVerifyPeer(0);
echo '<hr />';
print_r($client);
    $msg = new xmlrpcmsg('execute'); 
    $msg->addParam(new xmlrpcval($dbname, "string")); 
    $msg->addParam(new xmlrpcval($user, "int")); 
    $msg->addParam(new xmlrpcval($password, "string")); 
    $msg->addParam(new xmlrpcval("shift.registration", "string")); 
    $msg->addParam(new xmlrpcval("create", "string")); 
    $msg->addParam(new xmlrpcval($val, "struct")); 
    $response = $client->send($msg);

    echo 'Inscription created = ' . $response->value()->scalarval();

echo "<HR>THE END";

?>