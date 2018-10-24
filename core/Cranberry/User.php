<?php

namespace Cranberry;

class User {
	public $username;
	public $password;
	public $email;
	public $groupid;
	public $extra;

	public function __construct ($username, $password, $groupid, $email, $hashPassword = true, $extra = null) {
		$this->username = $username;

		if($hashPassword) {
			$this->password = password_hash($password, PASSWORD_DEFAULT);
		}
		else{
			$this->password = $password;
		}

		$this->groupid = intval($groupid);

		$this->email = $email;

		$this->extra = $extra;
	}

	public function Verify($password){
		return password_verify($password, $this->password);
	}

	public function GetGroup(){
		if($this !== null){
			$dbGroup = Database::Execute('SELECT name FROM groups WHERE id = ?', [$this->groupid]);

			return $dbGroup['name'];
		}
		else{
			return null;
		}
	}

	public static function CreateUser($user){
		if(!self::UserExists($user->username)){
			Database::Execute('INSERT INTO users (username, password, groupid, joined) VALUES (?, ?, ?, CURDATE())', [$user->username, $user->password, $user->groupid]);

			return true;
		}
		else{
			return false;
		}
	}

	public static function UserExists($username){
		return !empty(Database::Execute('SELECT groupid FROM users WHERE username = ?', [$username]));
	}

	public static function GetUser($username){
		if(self::UserExists($username)){
			$dbUser = Database::Execute('SELECT username, password, email, groupid FROM users WHERE username = ?', [$username]);
			$dbUserExtra = Database::Execute('SELECT bio, joined FROM users WHERE username = ?', [$username]);

			return new User($dbUser['username'], $dbUser['password'], $dbUser['groupid'], $dbUser['email'], false, $dbUserExtra);
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