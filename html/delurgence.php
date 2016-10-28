<?php
require("_php/base.php");
?>

	<?php
	$basu = $bdd->query('SELECT id FROM urgences WHERE date = CURDATE() ORDER BY insertion DESC LIMIT 0, 1');
	while($ruq = $basu->fetch())
	{	
		if (isset($ruq['id']))
		{
			echo ($ruq['id']);
			$now = $ruq['id'];
			$req = "DELETE FROM urgences WHERE id='$now' ";
			$bdd = exec($req);
		}
	}
	?>