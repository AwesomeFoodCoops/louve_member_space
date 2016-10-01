<?php 
session_start();
require("_php/ldap.php");

error_reporting(E_ALL);
ini_set('display_errors', '1');
 
 
 
$message = array();
$message_css = "";
 
function changePassword($user,$oldPassword,$newPassword,$newPasswordCnf){
  
   
  error_reporting(0);
  ldap_connect($ldapServer);
 
  $con = ldap_connect($ldapServer);
  ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);
   
  $dn = "uid=".$user.",ou=users,dc=ovh,dc=net";
   
  $newEntry['userpassword'] =  $newPassword;

if(ldap_mod_replace( $con, $dn, $newEntry))
     echo( "<p>succeded</p>");
else
      echo( "<p>failed</p>");
    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Password Change Page</title>
<style type="text/css">
body { font-family: Verdana,Arial,Courier New; font-size: 0.7em; }
th { text-align: right; padding: 0.8em; }
#container { text-align: center; width: 500px; margin: 5% auto; }
.msg_yes { margin: 0 auto; text-align: center; color: green; background: #D4EAD4; border: 1px solid green; border-radius: 10px; margin: 2px; }
.msg_no { margin: 0 auto; text-align: center; color: red; background: #FFF0F0; border: 1px solid red; border-radius: 10px; margin: 2px; }
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<div id="container">
<h2>Password Change Page</h2>
<p>Your new password must be 8 characters long or longer and have at least:<br/>
one capital letter, one lowercase letter, &amp; one number.<br/>
You must use a new password, your current password<br/>can not be the same as your new password.</p>
<?php
      if (isset($_POST["submitted"])) {
        changePassword($_SESSION['login'],$_POST['oldPassword'],$_POST['newPassword1'],$_POST['newPassword2']);
        global $message_css;
        if ($message_css == "yes") {
          ?><div class="msg_yes"><?php
         } else {
          ?><div class="msg_no"><?php
          $message[] = "Your password was not changed.";
        }
        foreach ( $message as $one ) { echo "<p>$one</p>"; }
      ?></div><?php
      } ?>
<form action="<?php print $_SERVER['PHP_SELF']; ?>" name="passwordChange" method="post">
<table style="width: 400px; margin: 0 auto;">

<tr><th>Current password:</th><td><input name="oldPassword" size="20px" type="password" /></td></tr>
<tr><th>New password:</th><td><input name="newPassword1" size="20px" type="password" /></td></tr>
<tr><th>New password (again):</th><td><input name="newPassword2" size="20px" type="password" /></td></tr>
<tr><td colspan="2" style="text-align: center;" >
<input name="submitted" type="submit" value="Change Password"/>
<button onclick="$('frm').action='changepwd.php';$('frm').submit();">Cancel</button>
</td></tr>
</table>
</form>
</div>
</body>
</html>