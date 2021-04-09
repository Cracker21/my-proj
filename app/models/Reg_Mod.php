<?php

class Reg_Mod extends Model{
	private static $err = "";
	private static $email;
	private static $name;
	private static $pass;

	static function getError(){
		return [false, self::$err];
	}

	static function register(){
		$db = DB::get();
		self::$pass = password_hash(self::$pass, PASSWORD_DEFAULT);
		$db->insPr("insert into users(name, pass, email) values(:name, :pass, :email)", [':name'=>self::$name, ':pass'=>self::$pass, ':email'=>self::$email]);
		unset($_SESSION['codeField'], $_SESSION['codeSentAddr'], $_SESSION['confirmedEmail'], $_SESSION['name'], $_SESSION['email']);
		$_SESSION['justReg'] = 'Регистрация прошла успешно! Теперь можно зайти в аккаунт<br>';
		return [true];
	}

	static function emailIsCorrect($checkVerified = true){
		self::$email = $_POST['email'];
        if(filter_var(self::$email, FILTER_VALIDATE_EMAIL)){
		    if(iconv_strlen(self::$email)<40){
		    	$pdo = DB::get();
				$mailExists = $pdo->fetchPr("select email from users where email =:email", ['email'=> self::$email])['email'] ?? false;
				if(self::$email == $mailExists){
				    self::$err = "Аккаунт с такой почтой уже существует!";
				    return;
				}
		    }else{
		        self::$err = 'Длина почты - до 40 символов!';
		        return;
		    }
		}else{
		    self::$err = "Некорректная почта!";
		    return;
		}

		$_SESSION['confirmedEmail'] = $_SESSION['confirmedEmail'] ?? "";
		if(($_SESSION['confirmedEmail'] != self::$email)&&$checkVerified){
	    	self::$err = 'Подтвердите почту!';
	    	return;
	    }
	    $_SESSION['email'] = self::$email;
		return true;
    }
    static function nameIsCorrect(){
    	self::$name = $_POST['name'];
    	if(!(iconv_strlen(self::$name)<3||iconv_strlen(self::$name)>20)){		//кол-во символов от 3 до 20
			if(preg_match('/^[a-zA-Z]{1,}[a-zA-Z0-9]*$/', self::$name)){		//буквы лат.алфавита и цифры не сначала
				$pdo = DB::get();
				$userExists = $pdo->fetchPr("select name from users where name =:name", ['name'=> self::$name])['name'] ?? false;
				if(self::$name == $userExists){
					self::$err = "Такой логин уже существует!";
					return;
				}
			}else{
				self::$err = "Логин может содержать только буквы латинского алфавита!";
				return;
			}
		}else{
			self::$err = "Длина логина - от 3 до 20 символов!";
			return;
		}
		$_SESSION['name'] = self::$name;
    	return true;
    }

    static function passIsCorrect(){
    	if(!(iconv_strlen($_POST['pass'])<8)){
			if(!($_POST['pass'] == $_POST['pass2'])){
				self::$err = "Пароли не совпадают!";
				return;
			}
		}else{
			self::$err = "Пароль слишком короткий!";
			return;
		}
		self::$pass = $_POST['pass'];
    	return true;
    }

    static function dataIsCorrect(){
    	if(isset($_POST['name'], $_POST['pass'], $_POST['pass2'], $_POST['email'])){
	    	
	    	foreach ($_POST as $key => $value) {
	    		if(empty($_POST[$key])){
	    			self::$err = "Заполните все поля";
	    			return;
	    		}
	    	}    		
			if(self::nameIsCorrect()&&self::passIsCorrect()&&self::emailIsCorrect())
				return true;
    	}else{
    		self::$err = "refresh the page";
    	}
    }

	static function sendCode(){
        $_SESSION['timeWithDelay'] = $_SESSION['timeWithDelay'] ?? time()-10;    //если не было задержки ставится
        if($_SERVER['REQUEST_TIME'] > $_SESSION['timeWithDelay']){
            $_SESSION['timeWithDelay'] = time()+30;             //ставится задержка перед отправкой кода
            //отправка кода
            require_once ROOT.'/app/mail.php';
            $mail->addAddress(self::$email, 'gost'); // to email and name
            $mail->Subject = 'Подтверждение почты';
            $_SESSION['mailCode'] = mt_rand(100000,999999);
            $_SESSION['mailCode'] = 1111;
            $mail->msgHTML("Код: ". $_SESSION['mailCode']);
            if($mail->send()){
            	$_SESSION['codeSentAddr'] = self::$email;
            	$_SESSION['codeField'] = "<input id='mailCode'><input type='button' value='Подтвердить почту' onclick='confEmail()'>";
            	return [true, $_SESSION['codeField']];
            }else{
            	return $mail->ErrorInfo;
            }
        }else{
            return [false];
        }
	}

	static function confirmEmail(){
		if(isset($_SESSION['codeSentAddr'])){
			if($_POST['mailCode'] == $_SESSION['mailCode']){
				$_SESSION['confirmedEmail'] = $_SESSION['codeSentAddr'];
				unset($_SESSION['codeField']);
				return [true, 'Почта подтверждена!'];
			}else{
				return [false, 'Неверный код!'];
			}
		}
	}

}
	