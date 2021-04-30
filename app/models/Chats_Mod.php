<?php
namespace Models;

use Core\DB;

class Chats_Mod extends \Core\Model{

	static function getChats(){
		$chats = "";
		$db = DB::get();

		if($res = $db->pdo->query("select chat_id, name from party p, users u where chat_id in (select chat_id from party where usid = ".$_SESSION['usid'].") and p.usid != ".$_SESSION['usid']." and p.usid = u.usid;")){
			while($row = $res->fetch(\PDO::FETCH_ASSOC)) {
				$chats.= "<button id='".$row['chat_id']."' class='chat' onclick='load(this)'>".$row['name']."</button><br>";
			}
			if($chats == "")return 'no chats';

			return $chats;
		}else{
			throw new Exception($res->errorInfo()[2]);
		}
	}
	static function getMsgs(){
		$msgs = "";		
		$db = DB::get();

		$res = $db->pdo->prepare("select u.name, m.msg from msgs m, party p, users u where sender_id = u.usid and p.chat_id = :chid and p.chat_id = m.chat_id and p.usid = u.usid");
		if($res->execute([":chid"=>$_POST['chid']])){
			while($row = $res->fetch(\PDO::FETCH_ASSOC)){
				$msgs.= $row['name'].": ".$row['msg']."<br>";
			}
			if($msgs=="")return [true, 'no messages'];

			return [true, $msgs];
		}else{
			throw new Exception($res->errorInfo()[2]);
		}
	}
}