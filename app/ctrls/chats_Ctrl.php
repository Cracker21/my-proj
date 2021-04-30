<?php

namespace Ctrls;
use Models\Chats_Mod;

class chats_Ctrl extends \Core\Controller {

	static function get(){		
		\Core\View::generate('chats.php', 'template.php', @$data);
	}
	static function post(){
		if(@$_POST['act']=='loadMsgs'){
			echo json_encode(['msg' => Chats_Mod::getMsgs()]);
		}else{
			echo json_encode(['msg' => Chats_Mod::getChats()]);
		}
	}
}