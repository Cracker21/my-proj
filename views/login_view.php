<?php
	$title = "Login";
	$reg = "<a href='reg'>Регистрация</a>";
	$out = "";
	if(isset($_SESSION["usid"])){
		$reg = "";
		$out = "<br><input type='button' value='Выйти' onclick=logout()>";
	}
	$html = <<<EOD
	<form id="a" action="login">
		<label>Логин:</label>
		<input type="text" name="name">
		<label>Пароль:</label>
		<input type="password" name="pass">
		<input type="submit" value="Войти">
		$out
	</form>
	<label id="b"></label><br>
	$reg
EOD;
?>
