<?php
	error_reporting(E_ALL);
	ini_set('display_errors','1');
	define('ROOT', $_SERVER['DOCUMENT_ROOT']);

	try{
		//require __DIR__.$_SERVER['REQUEST_URI'];
		require "../vendor/autoload.php";
		require "../app/core/autoload.php";
		Session::go();
		$rou = new Route();
		if(Route::isNotMediaOrJS()){
			Route::handle();
		}
	}catch(Throwable $e){
		$msg = sprintf("|%s| Error(%d): %s in %s at %d\n",strftime('%c'), $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
		error_log($msg, 3, ROOT.'/log');
		if($_SERVER['REQUEST_METHOD'] == 'GET')
			echo 'Произошла ошибка';
		else
			echo json_encode(['msg'=>'Произошла ошибка']);
	}
?>
