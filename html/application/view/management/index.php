<!-- TODO_NOW: comme sur la page 'services' mettre en évidence les pages non encore accessibles -->
<div class="container">
<div class="row">
    <div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Ajouter un document</strong></h3>
            <p> Les documents ajoutés ici sont insérés dans l'espace membre. </p>
            <a href="<?php echo URL . 'management/adddocument'; ?>">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
            </a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Ajouter une urgence</strong></h3>
            <p> Permet d'ajouter une notification "urgent :" en haut des pages de l'espace membre pendant une journée prédéfinie. </br></p>
            <a href="<?php echo URL . 'management/manageemergencies'; ?>">
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
            <a href="<?php echo URL . 'management/addmeeting'; ?>">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
			</a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-6">
        <div class="louve-creneau">
            <h3><strong>Ajouter un évènement </strong></h3>
            <p> Ajoutez des évènements à venir dans l'agenda </p>
            <a href="<?php echo URL . 'management/manageevents'; ?>">
                <button class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Ajouter </button>
			</a>
        </div>
    </div>
</div>
