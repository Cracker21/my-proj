<?php
namespace Core;

class Session{
	static function go(){
		session_name('sid');
		session_start([
	    	'cookie_lifetime' => 86400,
	    	'save_path' => ROOT.'/tmp',
		]);
	}
	static function logout($db){
		$sid = $db->pdo->query('select sid from users where usid = '.$_SESSION['usid'])->fetch(\PDO::FETCH_ASSOC);
		if(!empty($sid['sid'])&&$sid['sid'] != session_id()){
			unlink(ROOT.'/tmp/sess_'.$sid['sid']);
		}
	}
}
