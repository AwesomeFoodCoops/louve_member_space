<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$odoo_table = "res.partner";   //"shift.registration";

error_reporting(E_ALL);
ini_set('display_errors', '1');
echo '<h2>XML-RPC AVEC OPENERP/ODOO ET PHP</h2>';

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
            array(new xmlrpcval('email' , "string"), 
                  new xmlrpcval('=',"string"), 
                  new xmlrpcval('celine@hh.com',"string")
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
        new xmlrpcval("name", "string"),
		new xmlrpcval("street", "string"),
        new xmlrpcval("mobile", "string"),
        new xmlrpcval("email", "string"),
        new xmlrpcval("shift_type", "string"),
        new xmlrpcval("cooperative_state", "string"),
        new xmlrpcval("final_standard_point", "string"),
        new xmlrpcval("final_ftop_point", "string"),

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
   
    for($i = 0; $i < count($result); $i++){
        echo '<h1>' .( $result[$i]->me['struct']['name']->me['string']) . '</h1>'
           . '<ol>'
           . '<li><strong>name</strong> : ' . $result[$i]->me['struct']['name']->me['string'] . '</li>'
           . '<li><strong>street</strong> : ' . $result[$i]->me['struct']['street']->me['string'] . '</li>'
           . '<li><strong>mobile</strong> : ' . $result[$i]->me['struct']['mobile']->me['string'] . '</li>'
           . '<li><strong>Email</strong> : ' . $result[$i]->me['struct']['email']->me['string'] . '</li>'
           . '<li><strong>Shift type</strong> : ' . $result[$i]->me['struct']['shift_type']->me['string'] . '</li>'
           . '<li><strong>Cooperative State</strong> : ' . $result[$i]->me['struct']['cooperative_state']->me['string'] . '</li>'
           .'<li><strong>final standard point</strong> : ' . $result[$i]->me['struct']['final_standard_point']->me['int'] . '</li>'
           . '<li><strong>final ftop point</strong> : ' . $result[$i]->me['struct']['final_ftop_point']->me['int'] . '</li>'
           . '</ol>'     
           . '<hr />';
    }

}

echo "<HR>TOTO";


?>