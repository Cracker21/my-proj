<?php
	namespace Core;

	class WSHandler
	{
		static function message($conn, $data, $worker, $db){
			$data = json_decode($data);
			if(isset($data->srvc)){
				if(!$db->pdo->query('update users set ws_id = '.$conn->id.' where sid = "$data->sid"')){
					echo $db->pdo->errorInfo()[2];
				}
			}else{
				$msg = trim($data->msg, '"');
				$msg = trim($msg);	
				if(!empty($msg)){
					if(!($user = $db->fetchPr('select usid, ws_id, name from users where sid = ?', [$data->sid])))
						echo $db->pdo->errorInfo()[2];
					$res = $user['name'].": $msg<br>";
					$isChid = $db->pdo->query('select chat_id from party where usid ='.$user['usid']);
						echo $db->pdo->errorInfo()[2];
					$pa=false;		
					while($row = $isChid->fetch(\PDO::FETCH_ASSOC)){
						if($row['chat_id']==$data->chid){
							$pa=true;
							break;
						}
					}
					if($pa){
						$db->fetchPr('insert into msgs(msg, sender_id, chat_id) values(?, ?, ?)',[$data->msg, $user['usid'], $data->chid]);
					}
					foreach($worker->connections as $con){

						$con->send(json_encode($res));
					}
				}
			}
		}
	}
?>