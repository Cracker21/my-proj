<?php

class Login_Mod extends Model{
	private static $name;
	private static $pass;
	private static $error;

	static function enter(){
		if(self::credAreValid()){
			if(self::passIsCorrect()){
				$_SESSION['auth'] = true;
				return "1";
			}else{
				return self::$error;
			}
		}else{
			return self::$error;
		}
	}

	private static function credAreValid(){
		self::$name = trim($_POST['name']);
		self::$pass = trim($_POST['pass']);
		if(empty(self::$name)||empty(self::$pass)){
			self::$error = 'Заполните все поля';
			return false;
		}else{
			return true;
		}
	}

	private static function passIsCorrect(){
		require 'config.php';
		$db = new DB('my', $DB_USER, $DB_PASS);
		if($res = $db->fetch("select * from users where name = :name", [':name'=>self::$name])){
			if($res['name']==self::$name&&$res['pass']==self::$pass)
				return true;
			else{
				self::$error = 'Неверный логин или пароль';
				return false;
			}
		}else{
			self::$error = 'Неверный логин или пароль';
			return false;
		}
	}
}