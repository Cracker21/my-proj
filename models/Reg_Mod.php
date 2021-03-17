<?php

class Reg_Mod extends Model{
	static function mailIsCorrect($email){
        /*if($mark === 0){
            $con = 'con3558';
    		require_once "connect.php";
			$mailCh = $link->prepare("select * from users where email =:email");
			$mailCh->execute(['email'=> $email]);
			$resMail= $mailCh->fetch(PDO::FETCH_ASSOC);
        }*/
        $err = "";
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
		    if(iconv_strlen($email)<40){
				/*if($email == $resMail['email']){
				    $err = "Аккаунт с такой почтой уже существует!";
				}*/
		    }else{
		        $err = 'Длина почты - до 40 символов!';
		    }
		}else{
		    $err = "Некорректная почта!";
		}
		if(empty($email))
			$err = 'emp';
		/*if($err == ""){
		    if(!isset($_SESSION['verified_email'])||($_SESSION['verified_email'] != $email))
		    	$err = 'Подтвердите почту!';
		}*/
		if($err=='')
			return ['good'=>1];
		else
			return ['good'=>0,'err'=>$err];
    }

	static function sendCode(){
		$email = trim(htmlentities($_POST['email']));
    	//проверка почты
    	$mailCheck = self::mailIsCorrect($email);
	    if($mailCheck['good']){
            $_SESSION['timeWithDelay']= $_SESSION['timeWithDelay'] ?? time()-10;    //если не было задержки ставится
            if($_SERVER['REQUEST_TIME']>$_SESSION['timeWithDelay']){
                $_SESSION['timeWithDelay'] = time()+10;             //ставится задержка перед отправкой кода
                //отправка кода
                require_once '/var/www/mail.php';
                /*$mail->Host = "smtp.gmail.com";
                $mail->Username = 'vovik2113@gmail.com';
                $mail->Password = 'qwaszxxzsawq';
                $mail->setFrom('vovik2113@gmail.com', 'Pentagram'); // From email and name
                $mail->addAddress($email, "Гость"); // to email and name
                $mail->Subject = 'Подтверждение почты';
                $_SESSION['mailCode'] = mt_rand(100001,999999);
                $mail->msgHTML("Код: ". $_SESSION['mailCode']);*/
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
	