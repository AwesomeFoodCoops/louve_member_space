<?php
require("_php/head.php");
?>

<body>

<?php
require("menu.php");
require("_php/base.php");
?>

<?php

$odoo_table = "shift.ticket";   //"shift.registration";

error_reporting(E_ALL);
ini_set('display_errors', '1');

$GLOBALS['xmlrpc_internalencoding']='UTF-8';

$user = 'ESPACE_MEMBRES';
$password = 'cooplalouv3';
$dbname = 'lalouve-dev_20161023_b';  //cooplalouve

$server_url = 'http://lalouve-dev.code-and-design.fr';
$connexion = new xmlrpc_client($server_url . "/xmlrpc/common");
$connexion->setSSLVerifyPeer(0);

$c_msg = new xmlrpcmsg('login');
$c_msg->addParam(new xmlrpcval($dbname, "string"));
$c_msg->addParam(new xmlrpcval($user, "string"));
$c_msg->addParam(new xmlrpcval($password, "string"));
$c_response = $connexion->send($c_msg);

if ($c_response->errno != 0){
    echo  '<p>Connection error : ' . $c_response->faultString() . '</p>';
}
else{

    $uid = $c_response->value()->scalarval();

    $domain_filter = array (
        new xmlrpcval(
            array(new xmlrpcval('name' , "string"),
                  new xmlrpcval('=',"string"),
                  new xmlrpcval('Volant',"string")
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


    for($i = 0; $i < count($ids); $i++){
        $id_list[]= new xmlrpcval($ids[$i]->me['int'], 'int');
    }

    $field_list = array(
        new xmlrpcval("id", "string"),
        new xmlrpcval("name", "string"),
        // new xmlrpcval("seats_max", "string"),
        // new xmlrpcval("seats_reserved", "string"),
        new xmlrpcval("seats_available", "string"),
        new xmlrpcval("date_begin", "string"),
        new xmlrpcval("shift_type", "string"),
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

}
?>



<div class="container">
<div class="row">
    <h3  class="entete ui horizontal divider"><strong>Créneaux volants disponibles</strong></h3>
    <div class="louve-creneau">
    <div class = "table-responsive">
    <table class = "table">
      <thead>
         <tr>
            <th>Créneau</th>
            <th>Date</th>
            <th>Heure de début</th>
            <th>Places disponibles</th>
         </tr>
      </thead>
      <tbody>
    <?php
        for($i = 0; $i < count($result); $i++) {
            $shift_type = $result[$i]->me['struct']['shift_type']->me['string'];

           // $available_seats = $result[$i]->me['struct']['seats_max']->me['int'] - $result[$i]->me['struct']['seats_reserved']->me['int'];
            $available_seats = $result[$i]->me['struct']['seats_available']->me['int'];
            $name = $result[$i]->me['struct']['name']->me['string'];
             // List only shifts which are kind 'volant' (id=2) and for which there are more than 1 available seats
             if ($available_seats <= 0) {
                 continue;
              }
            // !!! Clarify with ERP team which value should be used : "name" or "shift_type"!!!
              // if ($shift_type != "ftop" && $available_seats < 0) {
              //     continue;
              //  }

            if ($name != "Volant") {
                 continue;
              }
            $datetime = $result[$i]->me['struct']['date_begin']->me['string'];
            
           
            $datetime_Paris = new DateTime($datetime.' +00');
            $datetime_Paris->setTimezone(new DateTimeZone('Europe/Paris')); 
            $date_string = $datetime_Paris->format('Y-m-d H:i:s');
            
            list ($date, $time) = explode (" ", $date_string);
            list($year, $month, $day) = explode("-", $date);
            list ($heure, $minutes, $secondes) = explode(":", $time);
            $timestamp = mktime(0, 0, 0, $month, $day, $year);
            
            $dd = date('D', $timestamp);
            if ($dd == 'Mon')
                $dd = 'Lundi';
            elseif ($dd == 'Tue')
                $dd = 'Mardi';
            elseif ($dd == 'Wed')
                $dd = 'Mercredi';
            elseif ($dd == 'Thu')
                $dd = 'Jeudi';
            elseif ($dd == 'Fri')
                $dd = 'Vendredi';
            elseif ($dd == 'Sat')
                $dd = 'Samedi';
            elseif ($dd == 'Sun')
                $dd = 'Dimanche';
            $months = array("janvier", "février", "mars", "avril", "mai", "juin",
            "juillet", "août", "septembre", "octobre", "novembre", "décembre");
            echo ('<tr> <td>'.$name.'</td> <td>'.$dd.' ' .$day . ' '.$months[$month-1].' '. $year . '</td> <td>' . $heure . 'H'.$minutes.'</td> <td>'.$available_seats.'</td> </tr>');
#            echo ('<h3>'.$name.' ('.$available_seats.' places): '.$dd.' ' .$day . ' '.$months[$month-1].' '. $year . ' : ' . $heure . 'H'.$minutes);
        };
    ?>
    </tbody>
    </table>
    </div>


    </div>


</div>
</div>
</div>

<?php require("_php/footer.php"); ?>
</body>
</html>
