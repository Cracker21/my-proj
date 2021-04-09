<?php
$title = "Registration";
$page = 'reg';

$mailCode = $_SESSION['codeField'] ?? "";
$name = $_SESSION['name'] ?? "";
$email = $_SESSION['confirmedEmail'] ?? $_SESSION['codeSentAddr'] ?? $_SESSION['email'] ?? "";
if($_SERVER['REQUEST_TIME']>@$_SESSION['timeWithDelay']){
	$t_cont = "<input id='sC' type='button' value='Отправить код подтверждения' onclick='sendCode()'>";
}else{
	$t_cont = "<script>mTimer(". ($_SESSION['timeWithDelay']-$_SERVER['REQUEST_TIME']) .")</script>";
}
$data = <<<EOD
<div id='form'>
	<form action='reg'>
		<label id='rsp'></label><br>
		<label>Имя</label><br>
		<input name='name' value="$name"><br>
		<label>Пароль</label><br>
		<input type='password' name='pass'><img onclick='shP(this)' src='cls.png' alt='Показать пароль'><br>
		<label>Повторите пароль</label><br>
		<input type='password' name='pass2'><br>
		<label>Почта</label><br>
		<input id='email' name='email' value='$email'><div id='t' class='i'>$t_cont</div>
		<div id='code' class='i'>$mailCode</div><br>
		<input type='submit' value='Регистрация'>
	</form>
</div>
EOD;
?>