<?php
require("_php/head.php");
?>
<body>
<?php
require("menu.php");
require("_php/base.php");
?>

<div class="container">

      <form class="form-signin" method="post" action="login.php">
        <h3 class="form-signin-heading">Ajouter une urgence</h3>
        <label for="inputID" class="sr-only">Identifiant Membre</label>
        <input type="text" id="inputID" name="login" class="form-control" placeholder="Entrez votre identifiant Louve" required autofocus>
        <p></p>
        <label for="inputPassword" class="sr-only">Mot de passe</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Mot de passe" required>
        <p style="padding:10px;"><a href="forgetpwd.php">Mot de passe oubli&eacute;?</a></p>
        <button class="btn btn-danger btn-block " type="submit">Se connecter</button>
        <p style="padding:10px;"></p>
        <p>Retrouvez la Louve sur <a href="lalouve.net">www.lalouve.net</a></p>
      </form>

    </div> <!-- /container -->
<?php require("_php/footer.php"); ?>
</body>
</html>