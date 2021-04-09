<?php
	
class chats_Ctrl extends Controller {

	static function get(){		
		View::generate('chats.php', 'template.php', @$data);
	}
	static function post(){
		echo json_encode(['msg' => Profile_Mod::getChats()]);
	}
}