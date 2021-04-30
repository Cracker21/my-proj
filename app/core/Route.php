<?php
namespace Core;

class Route{
	private static $authRoutes = ['profile', 'login', 'chats'];
	private static $noAuthRoutes = ['reg', 'login'];
	public static $route;


	static function isNotMediaOrJS(){
		if($_SERVER['REQUEST_METHOD']=="GET"){
			if(in_array(self::$route,['script.js', 'manifest.json', 'sw.js', 'ws.js'])){
				header("Content-Type: text/javascript");				
				require_once ROOT.'/public/'.self::$route;
			}else if(self::$route == 'style.css'){
				header("Content-Type: text/css");				
				require_once ROOT.'/public/style/'.self::$route;
			}else if(preg_match('/\.png$/', self::$route)){
				header("Content-Type: image/png");				
				require_once ROOT.'/public/style/'.self::$route;
			}else if(self::$route == 'ws'){
				require ROOT.'/app/core/WS.php';
			}else{
				return true;
			}
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
			if(self::$route == 'logout'){
				self::logout();
			}else if(isset($_SESSION["usid"])){							//если авторизован
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
		$cls = "\\Ctrls\\".$route."_Ctrl";
		$cls::$method();
	}

	static function logout(){
		$db = \Core\DB::get();
		if(!$db->pdo->query("update users set `sid` = null where sid = '".session_id()."'"))
			throw new \Exception($db->pdo->errorInfo()[2]);
		unset($_SESSION['usid'], $_SESSION['name']);
		header('Location: login');
	}
}