<?php
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors','1');
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
?>
