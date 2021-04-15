<?php
	
class chats_Ctrl extends Controller {

	static function get(){		
		View::generate('chats.php', 'template.php', @$data);
	}
	static function post(){
		if(@$_POST['act']=='loadMsgs'){
			echo json_encode(['msg' => Chats_Mod::getMsgs()]);
		}else{
			echo json_encode(['msg' => Chats_Mod::getChats()]);
		}
	}
}