<?php

class Route{
	static function go(){
		$RT = $_SERVER["DOCUMENT_ROOT"];			//сокращение
		$route = explode("/", $_SERVER['REQUEST_URI']);		//разбор УРИ
		if($_SERVER['REQUEST_METHOD']=="POST"){				//если POST
			if(file_exists($RT."/ctrls/".$route[1]."_Ctrl.php")){
				$cls = "$route[1]_Ctrl";
				$cls::post();
			}
		}else{											//GET
			if(isset($_SESSION["auth"])){				//если авторизован
				if($_SERVER['REQUEST_URI']=="/"){			//если запрос без УРЛ
					header('Location: profile');			//редирект на профиль
				}else if(file_exists($RT."/ctrls/".$route[1]."_Ctrl.php")){	//если файл существует
					$cls = "$route[1]_Ctrl";
					$cls::get();										//открыть нужную стр
				}else{
					require "errors/e404.php";							//если нет - выдать 404
					http_response_code(404);
				}
			}else{													//если не авторизован
				if(($route[1]!="login")&&($route[1]!="reg")){						//если урл не логин
					header('Location: login');						//направить на логин
				}else{												//иначе
					$cls = "$route[1]_Ctrl";
					$cls::get();
				}
			}
		}
	}
}