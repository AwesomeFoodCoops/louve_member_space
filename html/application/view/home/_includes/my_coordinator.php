<div class="col-xs-12 col-sm-6">
    <h3  class="entete ui horizontal divider"><strong>Mes coordinateurs</strong></h3>
    <div class="louve-creneau">
	<?php
	$base = $bdd->query('SELECT creneau FROM members WHERE login =\'' . $_SESSION['login'] . '\'');
	$req = $base->fetch();
	if (isset($req['creneau']) AND $req['creneau'] == 'volant')
		echo ('<h3> Vous êtes en équipe volante. vous n\'avez donc pas de coordinateur. Contactez le bureau des membres pour toute question.</h3>');
	else
	{
		$base2 = $bdd->query('SELECT * FROM members WHERE creneau = \'' . $req['creneau'] . '\' AND coordinateur =  1');
		while($raq = $base2->fetch())
		{
			if (isset($raq['nom']) AND isset($raq['prenom']) AND isset($raq['telephone']))
			{
			   echo ('<h3>' . $raq['prenom'] . ' ' . $raq['nom'] . '</h3>
				<p>' . $raq['telephone'] . '</p>');
			}
		}
	}
	?>
</div>
