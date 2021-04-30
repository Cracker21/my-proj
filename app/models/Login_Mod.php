<?php
namespace Models;

class Login_Mod extends \Core\Model{
	private static $name;
	private static $pass;
	private static $err;
	private static $usid;

	static function enter(){
		if(self::credAreValid()){
			if(self::passIsCorrect()){
				$_SESSION['usid'] = self::$usid;
				$_SESSION['name'] = self::$name;
				$db = \Core\DB::get();
				\Core\Session::logout($db);
				if(!$db->pdo->query("update users set `sid` = '".session_id()."' where usid = ".$_SESSION['usid']))
					throw new \Exception($db->pdo->errorInfo()[2]);
				return "1";
			}else{
				return self::$err;
			}
		}else{
			return self::$err;
		}
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
		$db = \Core\DB::get();
		if($res = $db->fetchPr("select * from users where name = :name", [':name'=>self::$name])){
			if($res['name']==self::$name&&password_verify(self::$pass, $res['pass'])){
				self::$usid = $res['usid'];
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