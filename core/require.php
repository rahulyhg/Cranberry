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
	error_reporting(E_ALL);
}
else{
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
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