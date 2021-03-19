<?php
	
	class Profile_Ctrl extends Controller {

	static function get(){		
		View::generate('profile_view.php', 'template.php', @$data);
	}
	static function post(){
		
	}
}