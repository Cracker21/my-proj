<?php
	spl_autoload_register(function($class){
		if(substr($class, -4)=="Ctrl"){
			require ROOT."/app/ctrls/$class".".php";
		}else if(substr($class, -3)=="Mod"){
			require ROOT."/app/models/$class".".php";
		}else{
			require ROOT."/app/core/$class".".php";
		}
	});
?>