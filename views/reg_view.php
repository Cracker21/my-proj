<?php
$title = "Registration";
$html = <<<EOD
<div id='form'>
	<form action='reg'>
		<label>Имя</label><br>
		<input name='nick'><br>
		<label>Пароль</label><br>
		<input name='pass'><br>
		<label>Повторите пароль</label><br>
		<input name='pass2'><br>
		<label>Почта</label><br>
		<input id='email' name='email'><input type='button' value='Отправить код подтверждения' onclick='sendCode()'><br>
		<input type='submit' value='Регистрация'>
	</form>
	<label id="b"></label><br>
	<a href='login'>Авторизоваться</a>
</div>
EOD;

?>