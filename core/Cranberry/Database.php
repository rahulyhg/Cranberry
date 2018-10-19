<?php

namespace Cranberry;

class Database{
	public static function Execute($statement, $vars){
		$sql = Settings::$dbCon->prepare($statement);
		$sql->execute($vars);

		return $sql->fetch();
	}
}

?>