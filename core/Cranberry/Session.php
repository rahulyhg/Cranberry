<?php

namespace Cranberry;

class Session{
	public static function Start(){
		session_start();

		if(User::GetCurrentUser() != null){
			self::Verify();
		}
	}

	public static function Destroy(){
		unset($_SESSION['username']);
		unset($_SESSION['password']);

		self::Start();
	}

	private static function Verify(){
		if(!User::GetCurrentUser()->Verify($_SESSION['password'])){
			self::Destroy();
		}
	}
}