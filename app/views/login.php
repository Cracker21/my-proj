<?php
	$title = "Login";
	$reg = "<a href='reg'>Регистрация</a>";
	$out = "";
	if(isset($_SESSION["usid"])){
		$reg = "";
		$out = "<br><input type='button' value='Выйти' onclick=logout()>";
	}
	$justReg = $_SESSION['justReg'] ?? "";
	unset($_SESSION['justReg']);
	$html = <<<EOD
	$justReg
	<form id="a" action="login">
		<label id='rsp'></label><br>
		<label>Логин:</label>
		<input type="text" name="name">
		<label>Пароль:</label>
		<input type="password" name="pass">
		<input type="submit" value="Войти">
		$out
	</form>
	$reg
EOD;
?>