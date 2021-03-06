<?php

namespace Ctrls;
use Models\Reg_Mod;

class Reg_Ctrl extends \Core\Controller {

	static function get(){		
		\Core\View::generate('reg.php', 'template.php', @$data);
	}
	static function post(){
		if(@$_POST['act']=='sendCode'){
			if(Reg_Mod::emailIsCorrect(false)){
				echo json_encode(['msg' => Reg_Mod::sendCode()]);
			}else{
				echo json_encode(['msg' => Reg_Mod::getError()]);
			}
		}else if(@$_POST['act']=='confirmEmail'){
			echo json_encode(['msg' => Reg_Mod::confirmEmail()]);
		}else{
			if(Reg_Mod::dataIsCorrect()){
				echo json_encode(['msg' => Reg_Mod::register()]);
			}else{
				echo json_encode(['msg' => Reg_Mod::getError()]);
			}
		}
	}
}

?>