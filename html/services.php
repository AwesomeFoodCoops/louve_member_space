<?php
require("_php/head.php");
?>
<body>

<?php
require("menu.php");
require("_php/base.php");
?>
<div class="container">
<div class="row">

<div class="col-xs-12 col-sm-6">
                   <div class="louve-creneau">
                 <h3><strong>Consulter les crénaux volants</strong></h3>
                <p> Vous êtes en équipe volante et souhaitez savoir quels sont les crénaux disponibles pour vous inscrire ? Consultez les ici avant de contacter le bureau des membres.</p>
                <a href="shifts_volants_ticket.php">
				<button class="btn btn-default"style="border-color : green; color : green;" ><span class="glyphicon glyphicon-ok"></span>Je regarde les crénaux.</button>
				</a>
		</div>
        </div>

		<div class="col-xs-12 col-sm-6">
                   <div class="louve-creneau" style="backgr-color : #FED8CF;">
                 <h3><strong>Echanger son créneau</strong></h3>
                <p> Vous serez indisponible pour effectuer votre prochain créneau ? Vous pouvez tenter de l'échanger ici avec un autre membre de la louve. </br></p>
                <button class="btn btn-default" style="border-color : red; color : red;"><span class="glyphicon glyphicon-ok"></span> Prochainement ici.</button>
            </div>
        </div>
</div>
<div class="row">
		

		<div class="col-xs-12 col-sm-6">
                   <div class="louve-creneau" >
                 <h3><strong>Suggérer un produit</strong></h3>
                <p> Lors de vos dernières courses un produit vous a manqué ? Suggérez le ici et votez pour les articles que vous souhaitez voir apparaître en rayons.</p>
               <a href="produits.php">
			   <button class="btn btn-default" style="border-color : green; color : green;"><span class="glyphicon glyphicon-apple"></span> Proposer un produit</button>
			   </a>
            </div>
        </div>

		<div class="col-xs-12 col-sm-6">
                   <div class="louve-creneau">
                 <h3><strong>Contacter le bureau des membres</strong></h3>
                <p> Un problème ? Une remarque ? Une question ou suggestion ? Le bureau des membres est là pour vous aider ! </p>
				<a href="formbureau.php">
           <button class="btn btn-default" style="border-color : green; color : green;" ><span class="glyphicon glyphicon-pencil"></span> Ecrire un message </button>
			</a>
            </div>
        </div>
		</div>
<div class="row">
		<div class="col-xs-12 col-sm-6">
                   <div class="louve-creneau" style="backgr-color : #FED8CF;">
                 <h3><strong>Organiser un covoiturage</strong></h3>
                <p> Trouvez des personnes qui habitent près de chez vous et organisez-vous pour vos déplacements vers et depuis la louve ! </p>
                <button class="btn btn-default" style="border-color : red; color : red;"><span class="glyphicon glyphicon-ok"></span> Prochainement ici.</button>
            </div>
        </div>

</div>
</div>
<?php require("_php/footer.php"); ?>
</body>
</html>