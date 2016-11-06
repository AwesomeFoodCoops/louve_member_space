<?php
$_SESSION['mail'] = 'zied.kheriji@gmail.com'; // ATTENTION a supprimer quand ldap est effectif !!!!!
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$odoo_table = "shift.registration";   //"shift.registration";

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
//'mathilde.virard@gmail.com'
	/*
    $domain_filter = array ( 
        new xmlrpcval(
            array(new xmlrpcval('user_id' , "string"), 
                  new xmlrpcval('!=',"string"), 
                  new xmlrpcval('',"string")
                  ),"array"             
            ),
        ); 
		*/
    
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
	 //var_dump($response); 
	 echo "</PRE>";
	 die("<HR>");
	 }
	
    $result = $response->value();
	//var_dump($result);
	//exit;
	
    $ids = $result->scalarval();
   
    $id_list = array();
    
	//echo "<HR><pre>";
	//var_dump($ids);
//	echo "</pre><HR>";
	//die("</pre><HR>");
	
    for($i = 0; $i < count($ids); $i++){
        $id_list[]= new xmlrpcval($ids[$i]->me['int'], 'int');
    }

    $field_list = array(
        new xmlrpcval("name", "string"),
		new xmlrpcval("state", "string"),
		new xmlrpcval("date_begin", "string"),	
		new xmlrpcval("email", "string"),			
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
	
	if(FALSE){
		//echo '<h2>Resultat brut de la requete avec print_r($result) :</h2><PRE>';
		//var_dump($result);
		//echo "</PRE>";
	}
	
  //  echo '<hr />';
//    echo '<h2>Liste des SHIFTS :</h2>';
   /*
    for($i = 0; $i < count($result) AND $i < 3; $i++){
			//echo '<h1>' .utf8_encode( $result[$i]->me['struct']['name']->me['string']) . '</h1>'
			echo ""
           . '<ol>'
           . '<li><strong>name</strong> : ' . utf8_encode($result[$i]->me['struct']['name']->me['string']) . '</li>'		   
           . '<li><strong>date_begin</strong> : ' . $result[$i]->me['struct']['date_begin']->me['string'] . '</li>'
           . '<li><strong>state</strong> : ' . $result[$i]->me['struct']['state']->me['string'] . '</li>'
           . '<li><strong>email</strong> : ' . utf8_encode($result[$i]->me['struct']['email']->me['string']) . '</li>'
            . '</ol>'     
           . '<hr />';
    }*/
}

?>