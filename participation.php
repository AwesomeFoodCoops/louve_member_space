<?php
require("_php/session.php");

?>

<!DOCTYPE html>
<html>
<head>
    <title>La louve - mon espace</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/bootgrid.css">
    <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,900,300' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
    <style type="text/css">
        @font-face {
            font-family: 'Glyphicons Halflings';
            src: url('fonts/glyphicons-halflings-regular.eot');
        }
        
    </style>
</head>
<body>

<?php
require("menu.php");
?>



<div class="container">

    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <h3><strong>Mon prochain créneau</strong></h3>
            <div class="louve-creneau">
                <h3>Mardi 8 Mars : 16h00 - 19h00</h3>
                <p> Une absence prévue? </p>
                <button class="btn btn-default"><span class="glyphicon glyphicon-earphone"></span> Contactez votre coordinateur</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">

            <h3><strong>Créneaux suivants</strong></h3>
            <div class="louve-creneau">
                <h4>Mardi 8 Mars : 16h00 - 19h00</h4>
                <h4>Mardi 4 Avril : 16h00 - 19h00</h4>
                <h4>Mardi 6 Mai : 16h00 - 19h00</h4>

            </div>

        </div>
             <div class="col-xs-12 col-sm-6">
            <h3><strong>Mon coordinateur</strong></h3>
            <div class="louve-creneau">
                <h3>Jean Bon</h3>
                <p>06 00 00 00 00</p>
                <p>01 00 00 00</p>
              </div>
        </div>
           <div class="col-xs-12 col-sm-6">
            <h3><strong>Bureau des membres</strong></h3>
            <div class="louve-creneau">
                <h3>116 rue des poissonniers</h3>
                <p>de 14h00 à 18h00</p>
                <p>01 00 00 00</p>
              </div>
        </div>
        <div class="col-xs-12">

            <h3><strong>Horaires</strong></h3>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>

</body>
</html>