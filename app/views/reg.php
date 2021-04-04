<?php
$title = "Registration";
$mailCode = $_SESSION['codeField'] ?? "";
$name = $_SESSION['name'] ?? "";
$email = $_SESSION['confirmedEmail'] ?? $_SESSION['email'] ?? $_SESSION['codeSentAddr'] ?? "";
$html = <<<EOD
<div id='form'>
	<form action='reg'>
		<label>Имя</label><br>
		<input name='name' value="$name"><br>
		<label>Пароль</label><br>
		<input type='password' name='pass'><br>
		<label>Повторите пароль</label><br>
		<input type='password' name='pass2'><br>
		<label>Почта</label><br>
		<input id='email' name='email' value='$email'><input type='button' value='Отправить код подтверждения' onclick='sendCode()'><br>
		<div id='code' style='display:inline-block;'>$mailCode</div><br>
		<input type='submit' value='Регистрация'>
	</form>
	<label id="b"></label><br>
	<a href='login'>Авторизоваться</a>
</div>
EOD;
?>