<?php

use Louve\Model\Shift;
//use Louve\Model\Session;

// Transforme un résultat de l'api Odoo dans un format moins dégueu :)
function formatUserInfo($userInfo)
{
    return [
        "street" => $userInfo->me['struct']['street']->me['string'],
        "mobile" => $userInfo->me['struct']['mobile']->me['string'],
        "shift_type" => $userInfo->me['struct']['shift_type']->me['string'],
        "cooperative_state" => $userInfo->me['struct']['cooperative_state']->me['string'],
        "id" => $userInfo->me['struct']['id']->me['int'],
        "final_ftop_point" => $userInfo->me['struct']['final_ftop_point']->me['double'],
    ];

    //~ TODO replace by return xml_decode($userInfo);
}

function formatDate($date)
{
    // Mise dans la bonne timezone
    $localizedDate = new DateTime($date.' +00', new DateTimeZone('Europe/Paris'));
    $localizedDate->setTimezone(new DateTimeZone('Europe/Paris'));
    //$localizedDate->setTimezone(new DateTimeZone('Europe/Berlin'));
    $localizedDate = $localizedDate->format('Y-m-d H:i:s');
    list ($date, $time) = explode (" ", $localizedDate);
    list($year, $month, $day) = explode("-", $date);
    list ($hour, $minutes, $secondes) = explode(":", $time);
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
    $month = $months[$month - 1];
    return array($dd, $day, $month, $year, $hour, $minutes);
}


// Transforme un résultat de l'api Odoo dans un format moins dégueu :)
// TODO_LATER: beaucoup de choses à améliorer ici
function formatShifts($shifts)
{

    //die(var_dump($shifts));
    $result = array();
    for($i = 0; $i < count($shifts) AND $i < 3; $i++)
    {
        

        $nextTime = $shifts[$i]->me['struct']['date_begin']->me['string'];
        list($dd, $day, $month, $year, $hour, $minutes) = formatDate($nextTime);
        
        //todo a virer des qu on sait comment virer les faux shifts d odoo
        if ($hour!="22"||$hour!="23")
        {
        $shift = new Shift();
        $shift->date =  $dd . ' ' . $day . ' ' . $month . ' ' . $year . ' : ' . $hour . 'H' . $minutes;
        //$shift->coordinator_id = $shifts[$i]->me['struct']['user_id'][0]->me['int'];
        //echo(var_dump($shifts[$i]));
        $result[count( $result)] = $shift;
        }
    }
    return $result;
    


}

// Formattage des shifts volants
// TODO: à refactoriser avec la fonction au dessus
function formatFtopShifts($shifts,$shift_type_user)
{
    

    $result = array();
    $ftopIndex = 0;

    
    usort($shifts, "cmpDate");
    //die(var_dump($shifts));
    for($i = 0; $i < count($shifts); $i++) {
       //die(var_dump($shifts[$i]->me['struct']['shift_id']->me['array'][0][0]));
       //die(var_dump($shifts[$i]));
       //die(var_dump($shifts[2]->me['struct']['shift_id']->me['array'][0]->me['int']));
       //die(var_dump($shifts[$i]->me['struct']['id']->me['int']));
        $shift_type = $shifts[$i]->me['struct']['shift_type']->me['string'];
        $available_seats = $shifts[$i]->me['struct']['seats_available']->me['int'];
        $name = $shifts[$i]->me['struct']['name']->me['string'];
        $shift_id = $shifts[$i]->me['struct']['shift_id']->me['array'][0]->me['int'];
        $shift_ticket_id = $shifts[$i]->me['struct']['id']->me['int'];
        // List only shifts which are kind 'volant' (id=2) and for which there are more than 1 available seats
        // TODO_NOW: !!! Clarify with ERP team which value should be used : "name" or "shift_type"!!!
        //if ($available_seats <= 0 OR $name != "Volant") {
        //    continue;
        //}
        if ($available_seats <= 0 ) {
            continue;
        }
        $time = $shifts[$i]->me['struct']['date_begin']->me['string'];
        list($dd, $day, $month, $year, $hour, $minutes) = formatDate($time);
        //08 aoùt 2018
        $weekdiff = datediffInWeeks('2018-08-02 00:00:00',$time) % 4;
        /*        
        echo("time:");
        echo($time);
        echo("weekdiff:");
        echo($weekdiff);
        echo("/shift:");
        echo($shift_type_user);
        echo("<br>");
        */

        if($weekdiff!=0 or $shift_type_user!='standard')
        {
        $result[$ftopIndex] = (
            '<tr><td>' . $dd . ' ' . $day . ' ' . $month . ' ' . $year . '</td><td>' .
            $hour . 'H' . $minutes . '</td><td>' . $available_seats . '</td><td>'.
            '<input type="button" class="subscribeftop" name="inscription" value="inscription" data-date_begin="' . $time .'" data-date_begin_formated="' . $dd . ' ' . $day . ' ' . $month . ' ' . $year . ' à ' . $hour . 'H' . $minutes . '" data-shift_id="' . $shift_id . '" data-shift_ticket_id="' . $shift_ticket_id . '"></td></tr>'
        );
        }
        else{
            $result[$ftopIndex] = '';
        }
        
        

        $ftopIndex++;
    }
    return $result;
}
function cmpDate($a, $b)
{
    return strcmp($a->me['struct']['date_begin']->me['string'], $b->me['struct']['date_begin']->me['string']);
}

function datediffInWeeks($date1, $date2)
{
    if($date1 > $date2) return datediffInWeeks($date2, $date1);
    $first = DateTime::createFromFormat('Y-m-d H:i:s', $date1);
    $second = DateTime::createFromFormat('Y-m-d H:i:s', $date2);
    return floor($first->diff($second)->days/7);
}
