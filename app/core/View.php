<?php
namespace Core;

class View
{

	static function generate($content, $template, $data = null)
	{
		$menu="";

		if(isset($_SESSION['usid'])){
			$menu = "<div id='menu'><a class='tab' href='profile'>Профиль</a><a class='tab' href='chats'>Чаты</a><a class='tab' href='logout'>Выйти</a></div>";
		}else{
			$menu = "<div id='menu'><a class='tab' href='login'>Войти</a><a class='tab' href='reg'>Регистрация</a></div>";
		}
		require_once ROOT."/app/views/$content";
		$html = "$menu<br>$data<br>";
		require_once ROOT."/app/views/$template";
	}
}