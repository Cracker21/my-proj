<?php

class Login_Ctrl extends Controller {

	static function get(){	
		View::generate('login.php', 'template.php', @$data);
	}
	static function post(){
		if(@$_POST['act']!= 'logout'){
			echo json_encode(['msg' => Login_Mod::enter()]);
		}else{
			echo json_encode(['msg' => Login_Mod::logout()]);
		}
	}
}