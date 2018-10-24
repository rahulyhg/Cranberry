<?php

namespace Cranberry;

class Database{
	public static function FilterFieldName($fieldName){
		return preg_replace("/[^a-zA-Z0-9]+/", "", $fieldName);
	}

	public static function ExecReturn($statement, $vars){
		$sql = Settings::$dbCon->prepare($statement);

		try{
			$sql->execute($vars);

			return $sql->fetch();
		}
		catch(\PDOException $e){
			if(Settings::$devMode){
				die($e);
			}
		}

		return null;
	}

	public static function ExecReturnAll($statement, $vars){
		$sql = Settings::$dbCon->prepare($statement);

		try{
			$sql->execute($vars);

			return $sql->fetchAll();
		}
		catch(\PDOException $e){
			if(Settings::$devMode){
				die($e);
			}
		}

		return null;
	}

	public static function ExecOnly($statement, $vars){
		$sql = Settings::$dbCon->prepare($statement);

		try{
			$sql->execute($vars);

			return true;
		}
		catch(\PDOException $e){
			if(Settings::$devMode){
				die($e);
			}
		}

		return false;
	}

	public static function MatchingRowCount($table, $column, $compValue){
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