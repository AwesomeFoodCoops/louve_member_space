<?php
$_SESSION['mail'] = 'zied.kheriji@gmail.com'; // ATTENTION a supprimer quand ldap est effectif !!!!!
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$odoo_table = "shift.registration";
$odoo_table2 = "shift.template";

error_reporting(E_ALL);
ini_set('display_errors', '1');

include_once("xmlrpc/lib/xmlrpc.inc");
include_once("xmlrpc/lib/xmlrpcs.inc");
$GLOBALS['xmlrpc_internalencoding']='UTF-8';

$user = 'ESPACE_MEMBRES';
$password = 'cooplalouv3';
$dbname = 'lalouve-dev_20161023_b';  //cooplalouve

$server_url = 'http://lalouve-dev.code-and-design.fr';  // TEST: http://erp-test.cooplalouve.fr:8069    Attention : http://lalouve-dev.code-and-design.fr
$connexion = new xmlrpc_client($server_url . "/xmlrpc/common");
$connexion->setSSLVerifyPeer(0);

$c_msg = new xmlrpcmsg('login');
$c_msg->addParam(new xmlrpcval($dbname, "string"));
$c_msg->addParam(new xmlrpcval($user, "string"));
$c_msg->addParam(new xmlrpcval($password, "string"));
$c_response = $connexion->send($c_msg);

if ($c_response->errno != 0){
    //echo  '<p>error : ' . $c_response->faultString() . '</p>';
}
else{
    
    $uid = $c_response->value()->scalarval();


    $domain_filter = array ( 
        new xmlrpcval(
            array(new xmlrpcval('email' , "string"), 
                  new xmlrpcval('=',"string"), 
                  new xmlrpcval($_SESSION['mail'],"string")
                  ),"array"             
            ),
        ); 

    
    $client = new xmlrpc_client($server_url . "/xmlrpc/object");
    $client->setSSLVerifyPeer(0);

    $msg = new xmlrpcmsg('execute'); 
    $msg->addParam(new xmlrpcval($dbname, "string")); 
    $msg->addParam(new xmlrpcval($uid, "int")); 
    $msg->addParam(new xmlrpcval($password, "string")); 
    $msg->addParam(new xmlrpcval($odoo_table, "string")); 
    $msg->addParam(new xmlrpcval("search", "string")); 	
    $msg->addParam(new xmlrpcval($domain_filter, "array")); 
    $response = $client->send($msg);

	if(false){
	 echo "<PRE>";
	 echo "</PRE>";
	 die("<HR>");
	 }
	
    $result = $response->value();

	
    $ids = $result->scalarval();
   
    $id_list = array();
	
    for($i = 0; $i < count($ids); $i++){
        $id_list[]= new xmlrpcval($ids[$i]->me['int'], 'int');
    }

    $field_list = array(
    new xmlrpcval("shift_template_id", "string"),		
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
	print_r("$result");
	if(FALSE){

	}
	

}

?>