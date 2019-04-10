<?php
	require_once File::build_path(array("controller","controllerCactus.php"));
	require_once File::build_path(array("controller","controllerCommande.php"));
	require_once File::build_path(array("controller","controllerUtilisateur.php"));
	require_once File::build_path(array("controller","controllerDefault.php"));

	// Controller
	if (isset($_GET['controller'])) {
		$controller = $_GET['controller'];
	}
	else {
		$controller = "Cactus";
	}
	
	// Action
	if (isset($_GET['action'])) {
		$action = $_GET['action']; 
	}
	else {
		$action = "readAll";
	}
	$controller_class = 'controller'.ucfirst($controller);
	$upController = 'Controller'.ucfirst($controller);

	if (in_array("$action", get_class_methods($controller_class))) {
		$upController::$action(); // Appel de la méthode statique $action de ControllerCactus	
	}
	else {
		echo "Cette fonction n'existe pas !";
	}
	
?>

