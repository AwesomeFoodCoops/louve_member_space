<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

// Un import 'use function Mini\Core\checkCredentials;' devrait marcher en théorie mais
// Pas avec Mini3, le projet sur lequel on s'est basé !!
// Donc on met les fonctions dans un fichier à part eton importe avec un require à l'ancienne
require APP . 'helpers/ldap_connection.php';


class LoginController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/login/index (which is the default page btw)
     */
    public function index()
    {
        // Y'a-t-il eu une erreur de saisie de login/mdp ? cette variable est passée dans les templates
        // et permet d'afficher une erreur le cas échéant
        $error_msg = null;
        if (isset($_SESSION['bad_credentials']) AND $_SESSION['bad_credentials'] === true) {
            $error_msg = "ERREUR: Indentifiants invalides.";
            if (ENVIRONMENT === 'dev') {
                $error_msg = "PSSSSTTT: en dev c'est login/password";
            }
        }

        // load views
        require APP . 'view/_templates/public_header.php';
        require APP . 'view/login/index.php';
        require APP . 'view/_templates/public_footer.php';
    }

    // L'utilisateur envoi ses login/mdp
    public function postCredentials($rawLogin, $rawPassword)
    {
        $login = strip_tags($_POST['login']);   // DN ou RDN LDAP
        $password = strip_tags($_POST['password']);  // empecher les failles d'injection sql
        $credentialsValid = false;
        // En dev, on utilise les credentials login='login' / password='password'
        if (ENVIRONMENT === 'dev' AND $login === 'login' AND $password === 'password') {
            $credentialsValid = true;
        }
        else {
            $credentialsValid = checkCredentials($login, $password);
        }
        // Si les credentials sont corrects, on active le flag de session
        if ($credentialsValid) {
            $_SESSION['logged_in'] = true;
            $_SESSION['login'] = $login;
        }
        // Sinon on garde l'info en session pour afficher une erreur
        else {
            $_SESSION['logged_in'] = false;
            $_SESSION['bad_credentials'] = true;
        }
        // Dans tous les cas on redirige vers le point d'entrée de l'app
        header('location: ' . URL);
    }

    public function logout()
    {
        // Quand l'utilisateur se déconnecte, détruire toutes les infos de session
        session_destroy();
        // Renvoyer vers le point d'entrée de l'App (qui lui même chargera la page de login)
        header('location: ' . URL);
    }
}
