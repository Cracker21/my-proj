<?php
	$title = "Login";
	$data = <<<EOD
	<form id="a" action="login">
		<label>Логин:</label>
		<input type="text" name="name">
		<label>Пароль:</label>
		<input type="password" name="pass">
		<input type="submit" value="Отправить">
	</form>
	<label id="b"></label><br>
	<a href='reg'>Регистрация</a>
	EOD;
?>
