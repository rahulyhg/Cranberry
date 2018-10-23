<?php

spl_autoload_register(function($class){
	$class = str_replace('\\', '/', $class);
	require_once('core/' . $class . '.php');
});

require_once('config.php');

use Cranberry\Settings;
use Cranberry\Session;

//dev mode
if(Settings::$devMode){
	ini_set('display_errors', '1');
	error_reporting(E_ERROR);
}
else{
	error_reporting(0);
}

//maintenance mode
if(!Settings::$maintenanceMode){
	Settings::Connect();
}
else{
	die("m mode");
}

//start session
Session::Start();

?>