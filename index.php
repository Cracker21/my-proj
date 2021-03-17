<?php
	ini_set('error_reporting', E_ALL);
	require "core/autoload.php";
	Session::go();
	switch ($_SERVER['REQUEST_URI']) {
		case "/script.js":
			require '/var/www/script.js';
			break;
		case "/style/style.css":
			require '/var/www/style/style.css';
			header("Content-Type: text/css");
			break;
		case "/test.php":
			require '/var/www/test.php';
			break;
		default:
			Route::go();
	}
?>
