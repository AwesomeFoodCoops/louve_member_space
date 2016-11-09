<?php
require("_php/head.php");
require("menu.php");
require("_php/base.php");
?>



<div class="container">

    <div class="row">
        <?php require("creneaux.php"); ?>
             <div class="col-xs-12 col-sm-6">
            <h3  class="entete ui horizontal divider"><strong>Mes coordinateurs</strong></h3>
			<?php require("includes/showcoordinateurs.php"); ?>
        </div>
           <div class="col-xs-12 col-sm-6">
            <h3  class="entete ui horizontal divider"><strong>Bureau des membres</strong></h3>
            <div class="louve-creneau">
                <h3>116 rue des poissonniers</h3>
				<p>Du Mardi au Samedi</p>
                <p>de 13h00 à 20h00</p>
                <p>et prochainement aussi par téléphone.</p>
              </div>
        </div>
        <div class="col-xs-12">

            <h3  class="entete ui horizontal divider"><strong>Horaires</strong></h3>
            <div class="louve-creneau">
             <div class="row">
                  <div class="col-md-4 col-xs-12">
                      <h3>Lundi (magasin fermé)</h3>
                      <p>  <button type="button" class="btn btn-default active">9h00-12h00</button></p>
                  </div>
                  <div class="col-md-4 col-xs-12">
                      <h3>Mardi au samedi</h3>
                      <p>  <button type="button" class="btn btn-default active">6h00-8h15*</button></p>
                      <p>  <button type="button" class="btn btn-default active">8h00-11h00</button></p>
                      <p>  <button type="button" class="btn btn-default active">10h45-13h45</button></p>
                      <p>  <button type="button" class="btn btn-default active">13h30-16h30</button></p>
                      <p>  <button type="button" class="btn btn-default active">16h15-19h15</button></p>
                      <p>  <button type="button" class="btn btn-default active">19h00-22h00</button></p>
                  </div>
                  <div class="col-md-4 col-xs-12">
                      <h3>Dimanche</h3>
                      <p>  <button type="button" class="btn btn-default active">7h15-10h15</button></p>
                      <p>  <button type="button" class="btn btn-default active">10h00-13h00</button></p>
          
                  </div>
             </div>
             
            </div>

        </div>
    </div>
</div>
<?php require("_php/footer.php"); ?>
