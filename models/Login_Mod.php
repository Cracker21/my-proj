<?php

class Login_Mod extends Model{
	private static $name;
	private static $pass;

	static function enter(){
		if(self::credAreValid()){
			if(self::passIsCorrect()){
				$_SESSION['auth'] = true;
				return "good";
			}else{
				return "bad";
			}
		}
	}

	private static function credAreValid(){
		self::$name = $_POST['name'];
		self::$pass = $_POST['pass'];
		return true;
	}

	private static function passIsCorrect(){
		require 'config.php';
		$db = new DB('my', $DB_USER, $DB_PASS);
		if($res = $db->fetch("select * from users where name = :name", [':name'=>self::$name])){
			if($res['name']==self::$name&&$res['pass']==self::$pass)
				return true;
			else
				return false;
		}else
			return false;
	}
}