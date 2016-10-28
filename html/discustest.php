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
		
		<div class="col-xs-12 col-sm-12">
               <div id="disqus_thread"></div>
<script>

/**
 *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
 *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables */
/*
var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = '//lalouve.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>   
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

</div>
</div>
<?php require("_php/footer.php"); ?>
</body>
</html>