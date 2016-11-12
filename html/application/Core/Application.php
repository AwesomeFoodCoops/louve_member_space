<?php
/** For more info about namespaces plase @see http://php.net/manual/en/language.namespaces.importing.php */
namespace Mini\Core;

use Mini\Model\User;
use Mini\Model\Meeting;


class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var array URL parameters */
    private $url_params = array();

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        // Parsing de l'url pour récupérer l'objet et sa méthode
        $this->splitUrl();

        // Démarre ou redémarre une session
        session_start();

        // L'utilisateur est-il loggué ? (loggué = on a sérialisé son user dans la session)
        if (!isset($_SESSION['SerializedUser']))
        {
            $page = new \Mini\Controller\LoginController();

            // Est-ce qu'il s'agit d'un POST pour essayer de se connecter ?
            if ((isset($_POST['login'])) AND (isset($_POST['password']))) {
                $page->postCredentials($_POST['login'], $_POST['password']);
            }
            else {
                // Page de login
                $page->index();
            }
        }
        else {
            // On sérialize l'user pour ne pas avoir à récupérer les infos d'Odoo à chaque changement de page
            $user = unserialize($_SESSION['SerializedUser']);
            // Si les données d'Odoo / de la BDD n'ont pas été récupérées, le faire
            // TODO_LATER: remplacer 'hasData' par 'hasRecentData' (par ex rafraichir toutes les 5min)
            if (!$user.hasData()) {
                $user.getData();
            }
            // L'utilisateur est accessible depuis le scope global car on en a besoin dans toute l'app
            $GLOBALS['User'] = $user;

            // TODO_NOW: à mettre ailleurs et pas en dur ! => et calculer au début ici
            $GLOBALS['hasEmergency'] = true;

            // check for controller: no controller given ? then load start-page
            if (!$this->url_controller) {

                $page = new \Mini\Controller\HomeController();
                $page->index();

            } elseif (file_exists(APP . 'Controller/' . ucfirst($this->url_controller) . 'Controller.php')) {
                // here we did check for controller: does such a controller exist ?

                // if so, then load this file and create this controller
                // like \Mini\Controller\CarController
				$shortcontroller = ucfirst($this->url_controller);
				$controller = "\\Mini\\Controller\\" . $shortcontroller . 'Controller';
                $this->url_controller = new $controller();

				// Cas particulier: les pages de Gestion ne sont accessibles que par les admin
				if ($shortcontroller == 'Management' AND !$user->isAdmin())
				{
				    // TODO_LATER: fournir un message d'erreur
					header('location: ' . URL . 'error');
				}

                // check for method: does such a method exist in the controller ?
                if (method_exists($this->url_controller, $this->url_action)) {

                    if (!empty($this->url_params)) {
                        // Call the method and pass arguments to it
                        call_user_func_array(array($this->url_controller, $this->url_action), $this->url_params);
                    } else {
                        // If no parameters are given, just call the method without parameters, like $this->home->method();
                        $this->url_controller->{$this->url_action}();
                    }

                } else {
                    if (strlen($this->url_action) == 0) {
                        // no action defined: call the default index() method of a selected controller
                        $this->url_controller->index();
                    } else {
                        header('location: ' . URL . 'error');
                    }
                }
            } else {
                header('location: ' . URL . 'error');
            }
        }
    }

    /**
     * Get and split the URL
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            // split URL
            $url = trim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            // Put URL parts into according properties
            // By the way, the syntax here is just a short form of if/else, called "Ternary Operators"
            // @see http://davidwalsh.name/php-shorthand-if-else-ternary-operators
            $this->url_controller = isset($url[0]) ? $url[0] : null;
            $this->url_action = isset($url[1]) ? $url[1] : null;

            // Remove controller and action from the split URL
            unset($url[0], $url[1]);

            // Rebase array keys and store the URL params
            $this->url_params = array_values($url);

            // for debugging. uncomment this if you have problems with the URL
            //echo 'Controller: ' . $this->url_controller . '<br>';
            //echo 'Action: ' . $this->url_action . '<br>';
            //echo 'Parameters: ' . print_r($this->url_params, true) . '<br>';
        }
    }
}
