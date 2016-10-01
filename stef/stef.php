<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
// ================================================
require_once('ripcord-master/ripcord.php');
require_once('stef.inc.php');
require_once('odoo_cnx.inc.php');
// ================================================

//phpinfo();

// ================================================
$url 		= $odoo_url;
$db  		= $odoo_db;
$username 	= $odoo_username;
$password 	= $odoo_password;
// ================================================

$madate = " ".date('Ymd-H-i-s');
echo "Time(".date('H:i:s')."-".$madate.") <HR>";
echo "url(".$url.")"; 
echo "<HR>";
$common = ripcord::client("$url/xmlrpc/2/common");
echo "<HR>";

// ================
//show_var($common,"COMMON_VERSION","red");
$common->version();
show_var($common,"COMMON_VERSION","blue");
// ================
$uid = $common->authenticate($db, $username, $password, array());
show_var($uid,"UID","green");

// =============================================================
/*
Calling methods
The second endpoint is xmlrpc/2/object, is used to call methods of odoo models via the execute_kw RPC function.
For instance to see if we can read the res.partner model we can call check_access_rights with operation passed by position and raise_exception passed by keyword (in order to get a true/false result rather than true/error):
*/
$models = ripcord::client("$url/xmlrpc/2/object");
$models->execute_kw($db, $uid, $password,
    'res.partner', 'check_access_rights',
    array('read'), array('raise_exception' => false));
show_var($models,"MODEL check_access_rights","red");	

// =============================================================
/*
Search and read
Because it is a very common task, Odoo provides a search_read() shortcut which as its name notes is equivalent to a search() followed by a read(), but avoids having to perform two requests and keep ids around.
Its arguments are similar to search()'s, but it can also take a list of fields (like read(), if that list is not provided it will fetch all fields of matched records):
*/
$models->execute_kw($db, $uid, $password,
    'res.partner', 'search_read',
    array(array(array('customer', '=', true))),
    array('fields'=>array('name', 'email'), 'limit'=>10));

show_var($models,"MODELMIKE ","brown");
var_dump($models);

echo "<HR>";
$result = $models->value();
var_dump($result);
?>
