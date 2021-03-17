<?php

class Reg_Ctrl extends Controller {

	static function get(){		
		View::generate('reg_view.php', 'template.php', @$data);
	}
	static function post(){
		if(@$_POST['action']=='sendCode')
			echo json_encode(['res' => Reg_Mod::sendCode()]);
		else
			echo json_encode(['res' => 'suc']);
	}
}

?>