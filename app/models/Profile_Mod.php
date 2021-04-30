<?php
namespace Models;
use Core\DB;


class Profile_Mod extends \Core\Model{

	static function getUserData(){
		$db = DB::get();
		if($res = $db->fetch("select * from users where usid = ".$_SESSION['usid'])){
			return 'Логин: '.$res['name']."<br>Почта: ".$res['email'];
		}
	}
}