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

			return $sql->fetch();
		}
		catch(\PDOException $e){
			/*
			 * Let me explain - the 2nd part of this statement checks to see if the SQL statement still evaluated properly.
			 * This allows you to use Database::Execute() for SQL statements that do not return any data (UPDATE) as well
			 * as data producing statements (SELECT). If you run a data returning statement, 'return $sql->fetch();' will
			 * fail, but because we detect the statement still ran properly, no error is thrown.
			 */
			if(Settings::$devMode && intval($sql->errorCode()) != 0){
				die($e);
			}
		}

		return null;
	}

	public static function MatchingRows($table, $column, $compValue){
		$table = self::FilterFieldName($table);
		$column = self::FilterFieldName($column);

		$sql = Settings::$dbCon->prepare("SELECT $column FROM $table WHERE $column = ?");

		try{
			$sql->execute([$compValue]);

			return count($sql->fetchAll());
		}
		catch(\PDOException $e){
			if(Settings::$devMode){
				die($e);
			}
		}

		return null;
	}
}

?>