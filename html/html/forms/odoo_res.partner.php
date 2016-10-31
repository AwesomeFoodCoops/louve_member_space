<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo '<h2>XML-RPC AVEC OPENERP/ODOO ET PHP</h2>';

include("xmlrpc/lib/xmlrpc.inc");
include("xmlrpc/lib/xmlrpcs.inc");
$GLOBALS['xmlrpc_internalencoding']='UTF-8';

$user = 'ESPACE_MEMBRES';
$password = 'cooplalouv3';
$dbname = 'cooplalouve';

$server_url = 'http://erp-test.cooplalouve.fr:8069'; 
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
            array(new xmlrpcval('membership_state' , "string"), 
                  new xmlrpcval('=',"string"), 
                  new xmlrpcval('free',"string")
                  ),"array"             
            ),
        ); 
    
    $client = new xmlrpc_client($server_url . "/xmlrpc/object");
    $client->setSSLVerifyPeer(0);

    $msg = new xmlrpcmsg('execute'); 
    $msg->addParam(new xmlrpcval($dbname, "string")); 
    $msg->addParam(new xmlrpcval($uid, "int")); 
    $msg->addParam(new xmlrpcval($password, "string")); 
    $msg->addParam(new xmlrpcval("res.partner", "string")); 
    $msg->addParam(new xmlrpcval("search", "string")); 	
    $msg->addParam(new xmlrpcval($domain_filter, "array")); 
    $response = $client->send($msg);
      
	 echo "<PRE>";
	 var_dump($response); 
	 echo "</PRE>";
	 die("<HR>");
	  
    $result = $response->value();
    $ids = $result->scalarval();
   
    $id_list = array();
    
    for($i = 0; $i < count($ids); $i++){
        $id_list[]= new xmlrpcval($ids[$i]->me['int'], 'int');
    }

    $field_list = array(
        new xmlrpcval("name", "string"),
        new xmlrpcval("email", "string"),
        new xmlrpcval("street", "string"),
        new xmlrpcval("city", "string"),
        new xmlrpcval("zip", "string"),
        new xmlrpcval("function", "string"),
    ); 
     
    $msg = new xmlrpcmsg('execute');
    $msg->addParam(new xmlrpcval($dbname, "string"));
    $msg->addParam(new xmlrpcval($uid, "int"));
    $msg->addParam(new xmlrpcval($password, "string"));
    $msg->addParam(new xmlrpcval("res.partner", "string"));
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
    echo '<h2>Liste des partners qui ne sont pas des societes:</h2>';
   
    for($i = 0; $i < count($result); $i++){
        echo '<h1>' . $result[$i]->me['struct']['name']->me['string'] . '</h1>'
           . '<ol>'
           . '<li><strong>Email</strong> : ' . @$result[$i]->me['struct']['email']->me['string'] . '</li>'
           . '<li><strong>Street</strong> : ' . $result[$i]->me['struct']['street']->me['string'] . '</li>'
           . '<li><strong>City</strong> : ' . $result[$i]->me['struct']['city']->me['string'] . '</li>'
           . '<li><strong>Zip code</strong> : ' . $result[$i]->me['struct']['zip']->me['string'] . '</li>'
           . '<li><strong>Fonction</strong> : ' . $result[$i]->me['struct']['function']->me['string'] . '</li>'
           . '</ol>'     
           . '<hr />';
    }

}



if ($c_response->errno != 0){
    echo  '<p>error : ' . $c_response->faultString() . '</p>';
}
else{
    
    $uid = $c_response->value()->scalarval();
    
    $id_list = array();
    $id_list[]= new xmlrpcval(7, 'int');

    $values = array ( 
        'street'=>new xmlrpcval('75 rue du Faubourg St Martin' , "string"),        
        ); 
    
    $client = new xmlrpc_client($server_url . "/xmlrpc/object");
    $client->setSSLVerifyPeer(0);

    $msg = new xmlrpcmsg('execute'); 
    $msg->addParam(new xmlrpcval($dbname, "string")); 
    $msg->addParam(new xmlrpcval($uid, "int")); 
    $msg->addParam(new xmlrpcval($password, "string")); 
    $msg->addParam(new xmlrpcval("res.partner", "string")); 
    $msg->addParam(new xmlrpcval("write", "string")); 
    $msg->addParam(new xmlrpcval($id_list, "array"));
    $msg->addParam(new xmlrpcval($values, "struct")); 
    $response = $client->send($msg);
    print_r($response);
    if ($response->faultCode()){
        echo $response->faultString();
    }    
    
    echo '<h2>Mise a jour effectuee</h2>';

}

?>