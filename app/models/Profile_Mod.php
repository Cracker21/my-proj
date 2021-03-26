<?php

class Profile_Mod extends Model{

	static function getUserData(){
		require ROOT.'/config.php';
		$db = new DB('my', $DB_USER, $DB_PASS);
		if($res = $db->fetch("select * from users where user_id = ".$_SESSION['usid'])){
			return $res['user_id']." ".$res['name'];
		}
	}
}