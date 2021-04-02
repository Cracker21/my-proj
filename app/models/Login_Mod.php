<?php

class Login_Mod extends Model{
	private static $name;
	private static $pass;
	private static $err;
	private static $usid;

	static function enter(){
		if(self::credAreValid()){
			if(self::passIsCorrect()){
				$_SESSION['usid'] = self::$usid;
				return "1";
			}else{
				return self::$err;
			}
		}else{
			return self::$err;
		}
	}
	static function logout(){
		unset($_SESSION['usid']);
		return '1';
	}

	private static function credAreValid(){
		self::$name = trim($_POST['name']);
		self::$pass = trim($_POST['pass']);
		if(empty(self::$name)||empty(self::$pass)){
			self::$err = 'Заполните все поля';
			return false;
		}else{
			return true;
		}
	}

	private static function passIsCorrect(){
		$db = DB::get();
		if($res = $db->fetchPr("select * from users where name = :name", [':name'=>self::$name])){
			if($res['name']==self::$name&&$res['pass']==self::$pass){
				self::$usid = $res['user_id'];
				return true;
			}else{
				self::$err = 'Неверный логин или пароль';
				return false;
			}
		}else{
			self::$err = 'Неверный логин или пароль';
			return false;
		}
	}
}