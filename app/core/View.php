<?php

class View
{
	static function generate($content, $template, $data = null)
	{
		require_once ROOT."/app/views/$content";
		require_once ROOT."/app/views/$template";
	}
}