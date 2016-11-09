<?php
require("_php/head.php");
?>
<body>

<?php
require("menu.php");
require("_php/base.php");
require("_php/testsalarie.php");
?>
<div class="container">
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Ajouter un document</strong></h3>
            <p> Les documents ajoutés ici sont insérés dans l'espace membre. </p>
            <a href="gestiondocs.php">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
            </a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Ajouter une urgence</strong></h3>
            <p> Permet d'ajouter une notification "urgent :" en haut des pages de l'espace membre pendant une journée prédéfinie. </br></p>
            <a href="salariesurgences.php">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
            </a>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Ajouter une assemblée générale</strong></h3>
            <p> Permet d'informer les membres de la prochaine AG</p>
            <a href="gestionag.php">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
			</a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Ajouter un évènement </strong></h3>
            <p> Ajoutez des évènements à venir dans l'agenda </p>
            <a href="gestionevents.php">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
			</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Générer un mot de passe</strong></h3>
            <p> Convertissez un mot de passe classique en un code crypté sécurisé à insérer dans la base de données. </p>
            <a href="passgen.php">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
            </a>
            </div>
        </div>
		
		<div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Gérer les administrateurs</strong></h3>
            <p> Comme son nom l'indique, cette page permet de gérer les administrateurs. </p>
            <a href="gestion_de_gestion.php">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> gérer </button>
            </a>
            </div>
        </div>
		
		
    </div> 
</div>

<?php require("_php/footer.php"); ?>
</body>
</html>
