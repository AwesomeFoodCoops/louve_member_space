<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
       <a class="navbar-brand" href="<?php echo URL; ?>"><img alt="La Louve" src="<?php echo URL; ?>img/Louve_logo.png" width="27px"/></a>
       <a class="navbar-brand" href="#">La Louve</a>
    </div>
</nav>

<div class="jumbotron" style="background-color: #ff4200">

    <!-- Main component for a primary marketing message or call to action -->
    <div class="container">
        <div class="row row-header">
            <div class="col-xs-12 col-sm-8" >
                <h2>Bienvenue dans l'Espace Membre de La Louve</h2>
                <p style="padding:10px;"></p>
                <p>Nous n'étions pas satisfaits de l'offre alimentaire qui nous &eacute;tait propos&eacute;e,
                alors nous avons d&eacute;cid&eacute; de cr&eacute;er notre propre supermarch&eacute;.</p>
            </div>
            <div class="col-xs-12 col-sm-4" >
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">

    <form class="form-signin" method="post" action="<?php echo URL; ?>login/sendcredentials">
        <input type="hidden" name="token" value="<?php echo $token ?>" />
        <h3 class="form-signin-heading">Identifiant Louve</h3>
        <label for="inputID" class="sr-only">Identifiant Membre</label>
        <p>
            <?php if (isset($error_msg)) {echo $error_msg;} ?>
        </p>
        <input type="text" id="inputID" name="login" class="form-control" placeholder="Entrez votre identifiant Louve" required autofocus>
        <p></p>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
        <p style="padding:10px;"><a href="<?php echo URL; ?>selfservice/?action=sendtoken">Mot de passe oubli&eacute;?</a></p>
        <button class="btn btn-danger btn-block " type="submit">Se connecter</button>
        <p style="padding:10px;"></p>
        <p>Retrouvez la Louve sur <a href="http://public.cooplalouve.fr">cooplalouve.fr</a></p>
    </form>

</div> <!-- /container -->
