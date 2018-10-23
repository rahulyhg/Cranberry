<?php

namespace Cranberry;

class Database{
	public static function FilterFieldName($fieldName){
		return preg_replace("/[^a-zA-Z0-9]+/", "", $fieldName);
	}

	public static function Execute($statement, $vars){
		$sql = Settings::$dbCon->prepare($statement);

		try{
			$sql->execute($vars);
		}
		catch(\PDOException $e){
			if(Settings::$devMode){
				die($e);
			}
		}

		return $sql->fetch();
	}

	public static function MatchingRows($table, $column, $compValue){
		$table = self::FilterFieldName($table);
		$column = self::FilterFieldName($column);

		$sql = Settings::$dbCon->prepare("SELECT $column FROM $table WHERE $column = ?");

		try{
			$sql->execute([$compValue]);
		}
		catch(\PDOException $e){
			if(Settings::$devMode){
				die($e);
			}
		}

		return count($sql->fetchAll());
	}
}

?>