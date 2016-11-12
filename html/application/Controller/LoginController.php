<?php

/**
 * Class LoginController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Louve\Controller;

use Louve\Model\User;

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

    // TODO_NOW: On a absolument besoin d'obliger HTTPS pour le post des MDP !!
    // L'utilisateur envoi ses login/mdp
    public function postCredentials($rawLogin, $rawPassword)
    {
        $login = strip_tags($rawLogin);   // DN ou RDN LDAP
        $password = strip_tags($rawPassword);  // empecher les failles d'injection sql
        $logginSuccesful = false;

        $user = new User($login);

        // En dev, on utilise les credentials login='login' / password='password'
        if (ENVIRONMENT === 'dev' AND $login === 'login' AND $password === 'password') {
            $logginSuccesful = true;
        }
        elseif ($user->bindLdap($password)) {
            $logginSuccesful = true;
        }

        // Si les credentials sont corrects, on sérialise l'utilisateur
        // Ce qui est équivalent à dire qu'il est loggué
        if ($logginSuccesful === true) {
            $_SESSION['SerializedUser'] = serialize($user);
        }
        // Sinon on garde l'info en session pour afficher une erreur
        else {
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
