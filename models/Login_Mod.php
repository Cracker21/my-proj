<?php

class Login_Mod extends Model{
	
	static function enter(){
		if(self::nameIsGood()&&self::passIsGood()){
			$_SESSION['auth'] = true;
			return "good";
		}else{
			return "bad";
		}
	}
	static function nameIsGood(){
		if($_POST['name'] == "admin")
			return true;
	}
	static function passIsGood(){
		if($_POST['pass'] == '123')
			return true;
	}

}