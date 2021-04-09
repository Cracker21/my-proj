<?php
$title = "Login";
$page = 'login';

$justReg = $_SESSION['justReg'] ?? "";
unset($_SESSION['justReg']);
$data = <<<EOD
$justReg
<form id="a" action="login">
	<label id='rsp'></label><br>
	<label>Логин:</label>
	<input type="text" name="name">
	<label>Пароль:</label>
	<input type="password" name="pass">
	<input type="submit" value="Войти">
</form>
EOD;
?>
