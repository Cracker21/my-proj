<?php

class Session{
	static function go(){
		ini_set("session.gc_maxlifetime",'86400');
		session_start();
	}
}