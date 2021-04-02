<?php

class Profile_Mod extends Model{

	static function getUserData(){
		$db = DB::get();
		if($res = $db->fetch("select * from users where user_id = ".$_SESSION['usid'])){
			return $res['user_id']." ".$res['name'];
		}
	}
}