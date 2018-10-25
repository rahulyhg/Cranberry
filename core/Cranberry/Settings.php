<?php

namespace Cranberry;

class Settings {
	//Supersettings - must be configured manually in config.php
	public static $maintenanceMode = false;
	public static $devMode = false;
	public static $dbUser;
	public static $dbPass;
	public static $dbHost;
	public static $dbName;
	public static $mediaPath;

	//database stuff
	public static $dbCon;

	public static function Connect(){
		try{
			self::$dbCon = new \PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
			self::$dbCon->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		catch(\PDOException $e){
			die("Error connecting to database: " . $e);
		}
	}
}

?>