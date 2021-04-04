<?php

class Reg_Mod extends Model{
	private static $err = "";

	static function getError(){
		return self::$err;
	}

	static function register(){
		unset($_SESSION['verified_email']);
		return 'Регистрация прошла успешно!';
	}

	static function emailIsCorrect($checkVerified = true){
		$email = trim($_POST['email']);

        $pdo = DB::get();
		$mailExists = $pdo->fetchPr("select * from users where email =:email", ['email'=> $email])['email'] ?? false;
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		    if(iconv_strlen($email)<40){
				if($email == $mailExists){
				    self::$err = "Аккаунт с такой почтой уже существует!";
				}
		    }else{
		        self::$err = 'Длина почты - до 40 символов!';
		        return;
		    }
		}else{
		    self::$err = "Некорректная почта!";
		    return;
		}

		$_SESSION['verified_email'] = $_SESSION['verified_email'] ?? "";
		if(($_SESSION['verified_email'] != $email)&&$checkVerified){
	    	self::$err = 'Подтвердите почту!';
	    	return;
	    }

		return true;
    }
    static function nameIsCorrect(){
    	return true;
    }

    static function passIsCorrect(){
    	return true;
    }

    static function dataIsCorrect(){
    	if(isset($_POST['name'], $_POST['pass'], $_POST['pass2'], $_POST['email'])){
	    	
	    	trim($_POST['name']);
	    	trim($_POST['email']);

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
    	//проверка почты
	    if(self::emailIsCorrect(false)){
            $_SESSION['timeWithDelay'] = $_SESSION['timeWithDelay'] ?? time()-10;    //если не было задержки ставится
            if($_SERVER['REQUEST_TIME'] > $_SESSION['timeWithDelay']){
                $_SESSION['timeWithDelay'] = time()+10;             //ставится задержка перед отправкой кода
                //отправка кода
                require_once ROOT.'/app/mail.php';
                $mail->Host = "smtp.gmail.com";
                $mail->setFrom('vovik2113@gmail.com', 'Pentagram'); // From email and name
                $mail->addAddress($email, "Гость"); // to email and name
                $mail->Subject = 'Подтверждение почты';
                $_SESSION['mailCode'] = mt_rand(100001,999999);
                $mail->msgHTML("Код: ". $_SESSION['mailCode']);
                //$_SESSION['mailCode'] = 1111;
                if($mail->send()){
                    return 'sent';
                }else{
                	return $mail->ErrorInfo;
                }
            }else{
                return 'time';
            }
		}else{
		    return $mailCheck['err'];
		}
	}

}
	