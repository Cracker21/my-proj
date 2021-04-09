<?php

class Chats_Mod extends Model{

	static function getChats(){
		$chats = "";
		$db = DB::get();

		if($res = $db->pdo->query("select chat_id from party where usid = ".$_SESSION['usid'])){
			while($row = $res->fetch(PDO::FETCH_ASSOC)) {
				$withUser = $db->pdo->query("select name from party p, users u where p.usid = u.usid and u.usid !=".$_SESSION['usid'])->fetch(PDO::FETCH_ASSOC);

				$chats.= "<a href='chat/".$withUser['name']."'>".$withUser['name']."</a><br>";
			}
			return $chats;
		}else{
			return "no chats";
		}
	}
}
			/*for($i=0;$i<count($rsp);$i++){
				$msgs .= $rsp[$i]['sender_id'].": ".$rsp[$i]['msg']."<br>";
			}*/
/*$sender = $db->fetch("select name from users where usid=".$row['sender_id']);
				$row['sender_id'] = $sender['name'];
				$rsp[] = $row;*/