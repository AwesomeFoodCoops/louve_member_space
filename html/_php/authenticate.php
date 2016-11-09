<?php $included ? : die('Ohhh nooooo!');

$_SESSION['falseid'] = FALSE;

if ((isset($_POST['login'])) AND (isset($_POST['password']))) // vérifier que les données sont bien présentes
{
    $postlogin = strip_tags($_POST['login']);   // DN ou RDN LDAP
    $postpwd = strip_tags($_POST['password']);  // empecher les failles d'injonction sql

    $em_user = new louve_user($postlogin);
    if( $em_user->checkPass($postpwd) )
    {
        $_SESSION['login'] = $postlogin ;
        $_SESSION['logged'] = TRUE;
        $_SESSION['falseid'] = FALSE;
        $_SESSION['em_user'] = serialize($em_user);
        header('Location: index.php');
 	$_SESSION['urgence']=TRUE;
    }
    else {
        //connexion ratée
        $_SESSION['falseid'] = TRUE;
    }
}

?>
