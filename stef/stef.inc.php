<?php

// ======================================================================
// https://www.odoo.com/documentation/8.0/api_integration.html#connection
// http://thierry-godin.developpez.com/openerp/openerp-xmlrpc-php-fr/
// ======================================================================
function show_var($variable,$mess="", $color="black"){
	echo "<BR><font color='$color'><b>===========[DEBUT $mess]============</b>";
	echo "<pre>";
	var_dump($variable);
	echo "</pre>";
	echo "<b>===========[FIN $mess]============</b></font><BR>";
}
?>