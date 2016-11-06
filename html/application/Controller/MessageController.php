<?php

// TODO_LATER: tout est à (re) faire ici. Le code brut de l'ancienne version du site a été collée en brut

namespace Mini\Controller;

class MessagesController
{
    public function index()
    {
        require APP . 'view/messages/index.php';
    }

    public function postMessage()
    {
//        $_SESSION['posted'] = 0;
//
//        $headers ="From: 'LA LOUVE ESPACE MEMBRES'<support@cooplalouve.fr>"."\n";
//        $headers .='Reply-To: support@cooplalouve.fr'."\n";
//        $headers .='Content-Type: text/html; charset="iso-8859-1"'."\n";
//        $headers .='Content-Transfer-Encoding: 8bit';
//
//        if(isset($_POST['message']) AND isset($_POST['sujet']))
//        {
//            $message = strip_tags($_POST['message']);
//            $sujet = strip_tags($_POST['sujet']);
//
//            $to      = 'mic.roche@gmail.com';
//            $subject = $sujet;
//            $message = $message ;
//            mail($to, $subject, $message, $headers);
//
//            if(mail($to, $subject, $message, $headers)) //faudra changer le mail sinon je vais tout reçevoir
//            {
//                $_SESSION['posted'] = 114;
//            }
//            else
//            {
//                $_SESSION['posted'] = 214;
//            }
//        }
//        else
//        {
//            $_SESSION['posted'] = 214;
//        }
//        header('location: formbureau.php');

    }
}
