<?php
	spl_autoload_register(function($class){
		if(substr($class, -4)=="Ctrl"){
			require "ctrls/$class.php";
		}else if(substr($class, -3)=="Mod"){
			require "models/$class.php";
		}else{
			require $class.".php";
		}
	});