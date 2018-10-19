<?php

namespace Cranberry;

class User {
	public $username;
	public $password;
	public $email;
	public $groupid;

	public function __construct ($username, $password, $groupid, $hashPassword = true) {
		$this->username = $username;
		if($hashPassword) {
			$this->password = password_hash($password, PASSWORD_DEFAULT);
		}
		else{
			$this->password = $password;
		}
		$this->groupid = intval($groupid);
	}

	public function Verify($password){
		return password_verify($password, $this->password);
	}

	public static function CreateUser($user){
		Database::Execute('INSERT INTO users (username, password, groupid, joined) VALUES (?, ?, ?, CURDATE());', [$user->username, $user->password, $user->groupid]);
	}

	public static function UserExists($username){
		return !empty(Database::Execute('SELECT groupid FROM users WHERE username = ?', [$username]));
	}

	public static function GetUser($username){
		if(self::UserExists($username)){
			$dbUser = Database::Execute('SELECT username, password, email, groupid FROM users WHERE username = ?', [$username]);

			return new User($dbUser['username'], $dbUser['password'], $dbUser['groupid'], false);
		}
		else{
			return null;
		}
	}

	public static function GetCurrentUser(){
		return self::GetUser($_SESSION['username']);
	}
}

?>