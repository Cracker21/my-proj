<?php
	ini_set('error_reporting', E_ALL);
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
		case "/test.php":
			require __DIR__.'/test.php';
			break;
		default:
			Route::go();
	}
?>
