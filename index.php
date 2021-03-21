<?php
	error_reporting(E_ALL);
	ini_set('display_errors','0');
	try{
		//require __DIR__.$_SERVER['REQUEST_URI'];
		require "core/autoload.php";
		Session::go();
		switch ($_SERVER['REQUEST_URI']) {
			case "/script.js":
				require __DIR__.'/script.js';
				break;
			case "/style/style.css":
				require __DIR__.'/style/style.css';
				header("Content-Type: text/css");
				break;
			default:
				Route::go();
		}
	}catch(Error $e){
		$msg = sprintf("|%s| Error(%d): %s in %s at %d\n",strftime('%c'), $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
		error_log($msg, 3, $_SERVER['DOCUMENT_ROOT'].'/log');
		echo json_encode(['msg'=>'Произошла ошибка']);
	}
?>
