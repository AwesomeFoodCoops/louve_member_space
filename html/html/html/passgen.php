<!DOCTYPE html>
<!-- saved from url=(0077)https://d396qusza40orc.cloudfront.net/phoenixassets/web-frameworks/index.html -->
<html lang="fr">

    <head>
    
    <meta charset="iso-8859-15">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head 
         content must come *after* these tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
    <title>Membres - La Louve</title>
        <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/members_styles.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	

    
    </head>
    
    <body style="background-color: #FFF0EB;">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
                <a class="navbar-brand" href="#">La Louve</a> 
            </div>
    </nav>

    <header class="jumbotron" style="background-color: #ff4200">

        <!-- Main component for a primary marketing message or call to action -->

        <div class="container">
            <div class="row row-header">
                <div class="col-xs-12 col-sm-8" >
                    <h2>Bienvenue dans l'Espace Membre de La Louve</h2>
                    <p style="padding:10px;"></p>
                    <p>Nous n'étions pas satisfaits de l'offre alimentaire qui nous était proposée, 
					alors nous avons décidé de créer notre propre supermarché.</p>
                </div>
                <div class="col-xs-12 col-sm-4" >
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">

      <form class="form-signin" method="post" action="passgen.php">
        <h3 class="form-signin-heading">Generateur de mot de passe sécurisé</h3>
		<p><?php
		if (isset($_POST['mdpsafe']))
		{
			$basemdp = strip_tags($_POST['mdpsafe']);
			$basemdp = sha1('qsdrt54' . $basemdp . 'coopirish42k');
			echo $basemdp;
		}
		
		?>
		</p>
        <label for="inputID" class="sr-only">Identifiant Membre</label>
        <input type="text" id="inputID" name="mdpsafe" class="form-control" placeholder="Entrez votre mot de passe" required autofocus>
        <p></p>
             <button class="btn btn-danger btn-block " type="submit">Générer</button>
        <p style="padding:10px;"></p>
        <p>Retrouvez la Louve sur <a href="#">www.lalouve.net</a></p>
      </form>

    </div> <!-- /container -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body></html>