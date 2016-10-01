<?php 
session_start();
require("_php/ldap.php");


 
/**
 *   LDAP PHP Change Password Webpage
 *   @author:   Matt Rude <http://mattrude.com>
 *   @website:  http://technology.mattrude.com/2010/11/ldap-php-change-password-webpage/
 *
 *
 *              GNU GENERAL PUBLIC LICENSE
 *                 Version 2, June 1991
 *
 * Copyright (C) 1989, 1991 Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA
 * Everyone is permitted to copy and distribute verbatim copies
 * of this license document, but changing it is not allowed.
 */
 
 
 
$message = array();
$message_css = "";
 
function changePassword($user,$oldPassword,$newPassword,$newPasswordCnf){
  global $message;
  global $message_css;
 

    
  error_reporting(0);
  ldap_connect($ldapServer);
  $con = ldap_connect($ldapServer);
  ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);
   
  // bind anon and find user by uid
  $user_search = ldap_search($con,$dn,"(|(uid=$user)(mail=$user))");
  $user_get = ldap_get_entries($con, $user_search);
  $user_entry = ldap_first_entry($con, $user_search);
  $user_dn = ldap_get_dn($con, $user_entry);
  $user_id = $user_get[0]["uid"][0];
  $user_givenName = $user_get[0]["givenName"][0];
  $user_search_arry = array( "*", "ou", "uid", "mail", "passwordRetryCount", "passwordhistory" );
  $user_search_filter = "(|(uid=$user_id)(mail=$user))";
  $user_search_opt = ldap_search($con,$user_dn,$user_search_filter,$user_search_arry);
  $user_get_opt = ldap_get_entries($con, $user_search_opt);
  $passwordRetryCount = $user_get_opt[0]["passwordRetryCount"][0];
  $passwordhistory = $user_get_opt[0]["passwordhistory"][0];
   
  //$message[] = "Username: " . $user_id;
  //$message[] = "DN: " . $user_dn;
  //$message[] = "Current Pass: " . $oldPassword;
  //$message[] = "New Pass: " . $newPassword;
   
  /* Start the testing */
  /*
  if ( $passwordRetryCount == 3 ) {
    $message[] = "Error E101 - Your Account is Locked Out!!!";
    return false;
  }
  if (ldap_bind($con, $user_dn, $oldPassword) === false) {
    $message[] = "Error E101 - Current Username or Password is wrong.";
    return false;
  }
  if ($newPassword != $newPasswordCnf ) {
    $message[] = "Error E102 - Your New passwords do not match!";
    return false;
  }
  $encoded_newPassword = "{SHA}" . base64_encode( pack( "H*", sha1( $newPassword ) ) );
  $history_arr = ldap_get_values($con,$user_dn,"passwordhistory");
  if ( $history_arr ) {
    $message[] = "Error E102 - Your new password matches one of the last 10 passwords that you used, you MUST come up with a new password.";
    return false;
  }
  if (strlen($newPassword) < 8 ) {
    $message[] = "Error E103 - Your new password is too short.<br/>Your password must be at least 8 characters long.";
    return false;
  }
  if (!preg_match("/[0-9]/",$newPassword)) {
    $message[] = "Error E104 - Your new password must contain at least one number.";
    return false;
  }
  if (!preg_match("/[a-zA-Z]/",$newPassword)) {
    $message[] = "Error E105 - Your new password must contain at least one letter.";
    return false;
  }
  if (!preg_match("/[A-Z]/",$newPassword)) {
    $message[] = "Error E106 - Your new password must contain at least one uppercase letter.";
    return false;
  }
  if (!preg_match("/[a-z]/",$newPassword)) {
    $message[] = "Error E107 - Your new password must contain at least one lowercase letter.";
    return false;
  }
  if (!$user_get) {
    $message[] = "Error E200 - Unable to connect to server, you may not change your password at this time, sorry.";
    return false;
  }
  */
  $auth_entry = ldap_first_entry($con, $user_search);
  $mail_addresses = ldap_get_values($con, $auth_entry, "mail");
  $given_names = ldap_get_values($con, $auth_entry, "givenName");
  $password_history = ldap_get_values($con, $auth_entry, "passwordhistory");
  $mail_address = $mail_addresses[0];
  $first_name = $given_names[0];
   
  /* And Finally, Change the password */
  $entry = array();
  $entry["userPassword"] = "$encoded_newPassword";
   
  if (ldap_modify($con,$user_dn,$entry) === false){
    $error = ldap_error($con);
    $errno = ldap_errno($con);
    $message[] = "E201 - Your password cannot be change, please contact the administrator.";
    $message[] = "$errno - $error";
  } else {
    $message_css = "yes";
    mail($mail_address,"Password change notice","Dear $first_name,
Your password on http://support.example.com for account $user_id was just changed. If you did not make this change, please contact support@example.com.
If you were the one who changed your password, you may disregard this message.
 
Thanks
-Matt");
    $message[] = "The password for $user_id has been changed.<br/>An informational email as been sent to $mail_address.<br/>Your new password is now fully Active.";
  }
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