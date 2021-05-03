<?php
	define('ROOT', "/var/www/main");

	use Workerman\Worker;
	use Core\DB;

	require ROOT."/vendor/autoload.php";

	$worker = new Worker('websocket://0.0.0.0:2346');
	$worker->count = 2;
	$db = DB::get();

	$worker->onConnect = function($conn) use ($db){
		echo "new conn $conn->id\r\n";
	};
	$worker->onClose = function($conn){
		echo "conn closed\r\n";
	};
	$worker->onError = function($err){
		echo "error: $err\r\n";
	};
	$worker->onMessage = function($conn, $data) use ($worker, $db){
		Core\WSHandler::message($conn, $data, $worker, $db);
	};

	Worker::runAll();
