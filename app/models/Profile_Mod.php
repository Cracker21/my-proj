<?php

class Profile_Mod extends Model{

	static function getUserData(){
		$db = DB::get();
		if($res = $db->fetch("select * from users where usid = ".$_SESSION['usid'])){
			return $res['usid']." ".$res['name'];
		}
	}
}