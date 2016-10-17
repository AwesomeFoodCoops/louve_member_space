<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$odoo_table = "shift.shift";   //"shift.registration";

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

if ($c_response->errno != 0){
    echo  '<p>error : ' . $c_response->faultString() . '</p>';
}
else{
    
    $uid = $c_response->value()->scalarval();

    $domain_filter = array ( 
        new xmlrpcval(
            array(new xmlrpcval('user_id' , "string"), 
                  new xmlrpcval('!=',"string"), 
                  new xmlrpcval('',"string")
                  ),"array"             
            ),
        ); 
    
    $client = new xmlrpc_client($server_url . "/xmlrpc/object");
    $client->setSSLVerifyPeer(0);

    $msg = new xmlrpcmsg('execute'); 
    $msg->addParam(new xmlrpcval($dbname, "string")); 
    $msg->addParam(new xmlrpcval($uid, "int")); 
    $msg->addParam(new xmlrpcval($password, "string")); 
    $msg->addParam(new xmlrpcval($odoo_table, "string")); //shift.registration  res.partner
    $msg->addParam(new xmlrpcval("search", "string")); 	
    $msg->addParam(new xmlrpcval($domain_filter, "array")); 
    $response = $client->send($msg);

	if(false){
	 echo "<PRE>";
	 var_dump($response); 
	 echo "</PRE>";
	 die("<HR>");
	 }
	
    $result = $response->value();
	//var_dump($result);
	//exit;
	
    $ids = $result->scalarval();
   
    $id_list = array();
    
	echo "<HR><pre>";
	//var_dump($ids);
	echo "</pre><HR>";
	//die("</pre><HR>");
	
    for($i = 0; $i < count($ids); $i++){
        $id_list[]= new xmlrpcval($ids[$i]->me['int'], 'int');
    }

    $field_list = array(
        new xmlrpcval("id", "string"),
        new xmlrpcval("name", "string"),
		new xmlrpcval("seats_max", "string"),
        new xmlrpcval("seats_reserved", "string"),
		new xmlrpcval("date_begin", "string"),
        new xmlrpcval("shift_ticket_id", "string"),
        new xmlrpcval("shift_type_id", "string"),
    ); 
     
    $msg = new xmlrpcmsg('execute');
    $msg->addParam(new xmlrpcval($dbname, "string"));
    $msg->addParam(new xmlrpcval($uid, "int"));
    $msg->addParam(new xmlrpcval($password, "string"));
    $msg->addParam(new xmlrpcval($odoo_table, "string"));
    $msg->addParam(new xmlrpcval("read", "string")); 
    $msg->addParam(new xmlrpcval($id_list, "array")); 
    $msg->addParam(new xmlrpcval($field_list, "array")); 

    $resp = $client->send($msg);

    if ($resp->faultCode()){
        echo $resp->faultString();
    }

    $result = $resp->value()->scalarval();    
    
    echo '<h2>Resultat brut de la requete avec print_r($result) :</h2>';
    print_r($result);
    echo '<hr />';
    echo '<h2>Liste des SHIFTS :</h2>';
   
    for($i = 0; $i < count($result); $i++){
        echo '<h1>' .utf8_encode( $result[$i]->me['struct']['name']->me['string']) . '</h1>'
           . '<ol>'
           . '<li><strong>id</strong> : ' . $result[$i]->me['struct']['id']->me['int'] . '</li>'
           . '<li><strong>Type</strong> : ' . $result[$i]->me['struct']['shift_type_id'][0]->me['int'] . '</li>'
           . '<li><strong>Type</strong> : ' . $result[$i]->me['struct']['shift_type_id'][1]->me['string'] . '</li>'
           . '<li><strong>Ticket id</strong> : ' . $result[$i]->me['struct']['shift_ticket_id'][0]->me['int'] . '</li>'
           . '<li><strong>date_begin</strong> : ' . $result[$i]->me['struct']['date_begin']->me['string'] . '</li>'
           .'<li><strong>seats_max</strong> : ' . $result[$i]->me['struct']['seats_max']->me['int'] . '</li>'
           . '<li><strong>seats_reserved</strong> : ' . $result[$i]->me['struct']['seats_reserved']->me['int'] . '</li>'
           . '<li><strong>name</strong> : ' . $result[$i]->me['struct']['name']->me['string'] . '</li>'
            . '</ol>'     
           . '<hr />';
    }

}

echo "<HR>TOTO";


?>