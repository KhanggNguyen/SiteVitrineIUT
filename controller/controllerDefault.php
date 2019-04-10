<?php
require_once File::build_path(array('config', 'Conf.php'));

class ControllerDefault {
	protected static $object = 'default';

	public static function index() {
		$view = 'index';
		$pagetitle = 'MyGuestHouse';
		$powerNeeded = true;
		require File::build_path(array('view', 'main_view.php'));
	}

	public static function active($currentController, $currentAction){
		$queryString = $_SERVER['QUERY_STRING'];
		if(!empty($currentAction)){
			if(strpos($queryString, 'controller='.$currentController.'&action='.$currentAction) !== false) {
				echo 'class="active"';
			}
		}else{
			if(strpos($queryString, 'controller='.$currentController !== false)) {
				echo 'class="active"';
			}
			if ($currentController == 'index' && empty($queryString)) {
				echo 'class="active"';
			}
		
		}
	}

	public static function error($error) {
		$displayError = $error;
		$view = 'error';
		$pagetitle= 'MyGuestHouse - Erreur';
		$powerNeeded = true;
		require File::build_path(array('view', 'main_view.php'));
	}
}
?>