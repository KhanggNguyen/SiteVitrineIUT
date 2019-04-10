<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pagetitle; ?></title>

        <link rel="stylesheet" href="assets/css/style.css" />
        <link rel="stylesheet" href="assets/css/style-new.css" />

        <!-- BOOTSTRAP-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
	    <nav class="navbar navbar-inverse navbar-fixed-top menuHaut">
	    	<div class="container">
				<div class="navbar-header">
		        	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			            <span class="sr-only">Navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
					</button>
					<a href="index.php"><img src="assets/img/cactus2.png" class="visible-xs" width="60" heigth="60" style="margin:5px;"></a>	
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					<ul class="nav navbar-nav">

					 	<li <?php ControllerDefault::active("index", ""); ?> ><a class="navA" href="index.php?action=readAll&controller=cactus">Nos cactus</a></li>
					  	<li <?php ControllerDefault::active("cactus", "monPanier"); ?> ><a class="navA" href="index.php?action=monPanier&controller=cactus">Mon panier</a></li>

					 	<?php
					  		if (isset($_SESSION["id"])) {
						        $isAdmin = ModelUtilisateur::isAdmin($_SESSION["id"]);
						        if ($isAdmin==1) {
						?>
								   		 <li <?php ControllerDefault::active("utilisateurs", ""); ?>><a class="navA" href="index.php?action=readAll&controller=utilisateur">Utilisateurs</a></li>
								  		 <li <?php ControllerDefault::active("cactus", "readAll"); ?> ><a class="navA" href="index.php?action=create&controller=cactus">Créer un cactus</a></li>
								  		 <li <?php ControllerDefault::active("utilisateur", "create"); ?> ><a class="navA" href="index.php?action=create&controller=utilisateur">Créer un utilisateur</a></li>
					  	<?php
					  			}
					  			else {
						?>
					  					<li <?php ControllerDefault::active("cactus", "read"); ?> ><a class="navA" href="index.php?action=read&controller=utilisateur&login=<?php echo $_SESSION["id"] ?>" >Mon profil</a></li>
					  	<?php
					  			}
					  		}					  	
					  		if(empty($_SESSION['id'])){

					  	?>
					  					<li <?php ControllerDefault::active("index", "create"); ?> ><a class="navA" href="index.php?action=create&controller=utilisateur">S'inscrire</a></li>
					  				 	<li <?php ControllerDefault::active("index", "connect"); ?> ><a class="navA" href='index.php?action=connect&controller=utilisateur'>Se connecter</a></li>
					  	<?php
					  		}
					  		else{
					  	?>
					  					<li <?php ControllerDefault::active("index", "deconnect"); ?> ><a class="navA" href='index.php?action=deconnect&controller=utilisateur'>Déconnexion</a></li>
						<?php	
							}
						?>

					</ul>
				</div>
	    	</div>
		</nav>

  		
		<div id="mainContainer" class="container" >
			<br>
			<br>
			<div class='col-lg-2 col-md-2 col-sm-2 col-xs-1'></div>
			<div class="container col-lg-8 col-md-8 col-sm-8 col-xs-10 " >
			<?php
			// Si $controleur='voiture' et $view='list',
			// alors $filepath="/chemin_du_site/view/voiture/list.php"
			$filepath = File::build_path(array("view", self::$object, "$view.php"));
			require_once $filepath;
			?>
			</div>
		</div>


    <footer class="footer text-center">	
		<br>
		<p> Site de vente de cactus &copy </p>
	</footer>	
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
