<?php $included ? : die('Ohhh nooooo!'); 

/* 
 * En incluant ce fichier au début, on restore la session. Si la session 
 * n'existait pas, l'utilisateur est redirigé sur la page de login.
 */

/*
 * On inclut les ressources.
 */
include_once '_php/em-config.php';
include_once '_php/cl_LouveUser.php';


session_start();
if ($_SESSION['logged'] != TRUE) 
    header('Location: ./login.php');
    
/* 
 * Restoration de l'objet utilisateur ($em_user), ou création s'il 
 * n'existait pas 
 */
if( isset( $_SESSION['em_user'] ) )
    $em_user = unserialize($_SESSION['em_user']);

?>
