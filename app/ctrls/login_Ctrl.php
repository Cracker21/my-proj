<?php
namespace Ctrls;
use Models\Login_Mod;

class Login_Ctrl extends \Core\Controller {

	static function get(){	
		\Core\View::generate('login.php', 'template.php', @$data);
	}
	static function post(){
		if(@$_POST['act']!= 'logout'){
			echo json_encode(['msg' => Login_Mod::enter()]);
		}else{
			echo json_encode(['msg' => Login_Mod::logout()]);
		}
	}
}