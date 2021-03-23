<?php

class Route{
	private static $authRoutes = ['profile', 'login', 'chat'];
	private static $noAuthRoutes = ['reg', 'login'];

	static function handle(){
		$route = explode("/", $_SERVER['REQUEST_URI'])[1];			//разбор УРИ
		if($_SERVER['REQUEST_METHOD']=="POST"){						//POST
				if((isset($_SESSION["usid"])&&in_array($route, self::$authRoutes)) xor (!isset($_SESSION["usid"])&&in_array($route, self::$noAuthRoutes))){
					self::go($route, 'post');
				}
		}else{														//GET
			if(isset($_SESSION["usid"])){							//если авторизован
				if(in_array($route, self::$authRoutes)){			//если файл из массива
					self::go($route, 'get');										//открыть нужную стр
				}else{
					header('Location: profile');
				}
			}else{													//если не авторизован
				if(in_array($route, self::$noAuthRoutes)){			
					self::go($route, 'get');
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