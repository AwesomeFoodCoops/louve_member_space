<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

$_SESSION['needinfo'] = 1; // ATTENTION A ENLEVER EN PROD
if (!(isset($_SESSION['needinfo'])) OR $_SESSION['needinfo'] !==42)
{
    $_SESSION['mail'] = "celine@hh.com"; //PENSER A ENLEVER CETTE LIGNE AU PLUS VITE
    $odoo_table = "res.partner";   //"shift.registration";

    include("forms/xmlrpc/lib/xmlrpc.inc");
    include("forms/xmlrpc/lib/xmlrpcs.inc");
    $GLOBALS['xmlrpc_internalencoding']='UTF-8';

    $user = 'ESPACE_MEMBRES';
    $password = 'cooplalouv3';
    $dbname = 'lalouve-dev_20161023_b';  //cooplalouve

    $server_url = 'http://lalouve-dev.code-and-design.fr';  // TEST: http://erp-test.cooplalouve.fr:8069    Attention : ttp://lalouve-dev.code-and-design.fr
    $connexion = new xmlrpc_client($server_url . "/xmlrpc/common");
    $connexion->setSSLVerifyPeer(0);

    $c_msg = new xmlrpcmsg('login');
    $c_msg->addParam(new xmlrpcval($dbname, "string"));
    $c_msg->addParam(new xmlrpcval($user, "string"));
    $c_msg->addParam(new xmlrpcval($password, "string"));
    $c_response = $connexion->send($c_msg);

    if ($c_response->errno != 0){
        // echo  '<p>error : ' . $c_response->faultString() . '</p>';
    }
    else {
    
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
       
        $i = 0; 
        $_SESSION['needinfo'] = 42;
        $_SESSION['name'] = $result[$i]->me['struct']['name']->me['string'];
        $_SESSION['street'] = $result[$i]->me['struct']['street']->me['string'];
    //	echo 'ici'.$result[$i]->me['struct']['mobile']->me['string'];
    //	echo $_SESSION['needinfo'];
        $_SESSION['mobile'] = $result[$i]->me['struct']['mobile']->me['string'];
        $_SESSION['shift type'] = $result[$i]->me['struct']['shift_type']->me['string'];
        $_SESSION['mail'] = $result[$i]->me['struct']['email']->me['string'];
        $_SESSION['street'] = $result[$i]->me['struct']['street']->me['string'];
        //$_SESSION['louvestatus'] = $result[$i]->me['struct']['cooperative_state']->me['string'];
        $_SESSION['standard point'] =  $result[$i]->me['struct']['final_standard_point']->me['int'];
        $_SESSION['volant point'] = $result[$i]->me['struct']['final_ftop_point']->me['int'];
        $_SESSION['prenom'] = $result[$i]->me['struct']['name']->me['string'];
    //	echo 'la'.$_SESSION['mobile'];
    }

}



?>
