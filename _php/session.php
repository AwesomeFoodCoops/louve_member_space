<?php $included ? : die('Ohhh nooooo!'); 
/* 
 * En incluant ce fichier au début, on restore la session. Si la session 
 * n'existait pas, l'utilisateur est redirigé sur la page de login.
 */
session_start();
if ($_SESSION['logged'] != TRUE)
    header('Location: ./login.php');
    
/*
 * On inclut les ressources.
 */
include '_php/em-config.php';
include '_php/cl_LouveUser.php';

/* 
 * Restoration de l'objet utilisateur ($em_user), ou création s'il 
 * n'existait pas 
 */
if( isset( $_SESSION['em_user'] ) ) {
    $em_user = unserialize($_SESSION['em_user']);
} else {
    $em_user = new LouveUser();
    $_SESSION['em_user'] = serialize($em_user);
}
?>
