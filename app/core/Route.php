<?php

class Route{
	private static $authRoutes = ['profile', 'login', 'chat'];
	private static $noAuthRoutes = ['reg', 'login'];
	private	static $route;

	function __construct(){
		self::$route = explode("/", $_SERVER['REQUEST_URI'])[1];
	}

	static function isNotMediaOrJS(){
		if(self::$route == 'script.js'){
			require_once ROOT.'/public/script.js';			//put server req uri if more than 2 elements
			header("Content-Type: text/javascript");
		}else if(self::$route == 'style.css'){
			require_once ROOT.'/public/style/'.self::$route;
			header("Content-Type: text/css");
		}else if(preg_match('/\.png$/', self::$route)){
			require_once ROOT.'/public/style/'.self::$route;
			header("Content-Type: image/png");
		}else{
			return true;
		}
	}

	static function handle(){
		if($_SERVER['REQUEST_METHOD']=="POST"){						//POST
				if((isset($_SESSION["usid"])&&in_array(self::$route, self::$authRoutes)) xor (!isset($_SESSION["usid"])&&in_array(self::$route, self::$noAuthRoutes))){
					self::go(self::$route, 'post');
				}
		}else{														//GET
			if(isset($_SESSION["usid"])){							//если авторизован
				if(in_array(self::$route, self::$authRoutes)){			//если файл из массива
					self::go(self::$route, 'get');										//открыть нужную стр
				}else{
					header('Location: profile');
				}
			}else{													//если не авторизован
				if(in_array(self::$route, self::$noAuthRoutes)){			
					self::go(self::$route, 'get');
				}else{
					header('Location: login');
				}
			}
		}
	}

	private static function go($route, $method){
		$cls = $route."_Ctrl";
		$cls::$method();
	}
}