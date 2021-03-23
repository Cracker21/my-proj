<?php
	
class Profile_Ctrl extends Controller {

	static function get(){		
		View::generate('profile_view.php', 'template.php', @$data);
	}
	static function post(){
		//echo json_encode(['msg' => Profile_Mod::getUserData()]);
	}
}