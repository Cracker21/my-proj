<?php

class Login_Ctrl extends Controller {

	static function get(){	
		View::generate('login_view.php', 'template.php', @$data);
	}
	static function post(){
		echo json_encode(['res' => Login_Mod::enter()]);
	}
}