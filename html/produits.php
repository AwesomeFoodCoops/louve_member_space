<?php
require("_php/head.php");
?>
<body>

<?php
require("menu.php");
require("_php/base.php");


$base = $bdd->query('SELECT id, content, login FROM products WHERE type=1 ORDER BY time DESC');
//echo ('<div class="container">');
echo ('
<div class="col-xs-12 col-sm-12">
                   <div style="background-color:white; padding:5px; margin:4px; text-align:center;">
				  <form method="post" action="addvote.php">
				  <p>Nous vous proposons sur cette page de proposer les produits qui vous ont manqué lors de vos dernières courses à la Louve et de voter pour les suggestions des autres. Cela permet à l\'ensemble des membres de la louve de réfléchir ensemble aux futurs produits qui pourraient rejoindre les rayons de notre suppérmarché. <br /><strong>Seules les suggestions de nouveaux produits doivent être proposées ici.</strong> </p>
				  <p><strong>Je propose:</strong></p>
                 <input type=text" style="margin-bottom:10px;" max-length=250 name="produit" /><br />
                <input type="submit" class="btn btn-default" value ="Suggérer ce produit" />
				</form
            </div>
			</div>');

while ($req = $base->fetch())
{
	$reqo = $req['id'];
     $result = $bdd->prepare('SELECT count(*) AS posi FROM products WHERE positive=1 AND content=:content');
                $result->execute(array('content' => $reqo));
	$posvalue = $result->fetch();
	$posval = $posvalue['posi'] + 1;
	//$reqo = $req['id']
	//$neg = $bdd->query('count(*) FROM products WHERE positive=1 AND content="$reqo"');
	//$tot = $pos - $neg;
	echo ('
<div class="col-xs-12 col-sm-12">
                   <div style="background-color:white; padding:5px; margin:4px; text-align:center;">
				  <form method="post" action="vote.php">
                 <h4><strong>'.$req['content'].'</strong></h4>
				 <h5><strong>'.$posval.' personne(s) interessées par ce produit</strong></h5>
                <button class="btn btn-default"><span class="glyphicon glyphicon-ok"></span> Je souhaite aussi pouvoir acheter ce produit</button>
				 <button class="btn btn-default"></span> signaler </button>
				</form>
            </div>
			</div>
');
}
//echo ('</div>');
?>
<?php require("_php/footer.php"); ?>
</body>
</html>