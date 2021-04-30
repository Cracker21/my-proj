<?php

namespace Ctrls;

class profile_Ctrl extends \Core\Controller {

	static function get(){		
		\Core\View::generate('profile.php', 'template.php', @$data);
	}
	static function post(){
		//echo json_encode(['msg' => Profile_Mod::getUserData()]);
	}
}