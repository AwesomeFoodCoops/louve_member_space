<?php

// Transforme un résultat de l'api Odoo dans un format moins dégueu :)
function formatUserInfo($userInfo)
{
    return [
        "name" => $userInfo->me['struct']['name']->me['string'],
        "street" => $userInfo->me['struct']['street']->me['string'],
        "mobile" => $userInfo->me['struct']['mobile']->me['string'],
        "shift_type" => $userInfo->me['struct']['shift_type']->me['string'],
        "cooperative_state" => $userInfo->me['struct']['cooperative_state']->me['string'],
        "final_standard_point" => $userInfo->me['struct']['final_standard_point']->me['string'],
        "final_ftop_point" => $userInfo->me['struct']['final_ftop_point']->me['string'],
    ];
}

// Transforme un résultat de l'api Odoo dans un format moins dégueu :)
// TODO_LATER: beaucoup de choses à améliorer ici
function formatShifts($shifts)
{
    $result = array();
    for($i = 0; $i < count($shifts) AND $i < 3; $i++)
    {
        $nextTime = $shifts[$i]->me['struct']['date_begin']->me['string'];
        // Mise dans la bonne timezone
        $localizedNextTime = new DateTime($nextTime.' +00');
        $localizedNextTime->setTimezone(new DateTimeZone('Europe/Paris'));
        $localizedNextTime = $localizedNextTime->format('Y-m-d H:i:s');
        list ($date, $time) = explode (" ", $localizedNextTime);
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
        $result[$i] = $dd.' ' .$day . ' '.$months[$month-1].' '. $year . ' : ' . $heure . 'H' . $minutes;
    }
    return $result;
}
