<?php

class View
{
	static function generate($content_view, $template, $data = null)
	{
		require $_SERVER["DOCUMENT_ROOT"]."/views/$content_view";
		require "$template";
	}
}