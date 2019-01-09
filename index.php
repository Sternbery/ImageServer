<?php
	//require_once '.env';
	require_once 'database.php';
	require_once 'autoload.php';
	
	//var_dump($_SERVER);
	
	$controller = new Controller();
	$view = $controller->getView(Request::getCurrentRequest());
	$view->render();
?>
