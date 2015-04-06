<?php 
//user controller
if (@$action[0]=='') {
	echo '<script>window.location.href = "/" </script>';
} else {
	if(@$action[0]) {
		$result = call("SELECT * FROM `user` WHERE `email`='$action[0]'");
		if((isset($_SESSION["keys"]) and $_SESSION["keys"]==$result[0]['keys']) and $_SESSION["ip"]==$ip and (isset($_SESSION["login"]) and $_SESSION["login"]==$result[0]['email'])){
			
		$title = $result[0]['title'];
		
		if($_POST['Activate'] == 'Activate'){
			$code = $_POST['status'];
			$code = che($code);
			$email = $_SESSION['login'];
			$result = call("SELECT * FROM `user` WHERE `email`='$email'");
				if($result[0]['key']==$code){
					$res = put("UPDATE `user` SET `status`='1' WHERE `email`='$email'");
					
					$messegError['codeError'] = 1; $messegError['relode'] = true;
					
				} else {$messegError['codeError'] = 2; $messegError['relode'] = true; }
		} elseif($_POST['Activate'] == 'Выслать') {
			
			
						$mail_to  = $_SESSION["login"];//$_SESSION["login"];  'admin@prze.ru'
						$subject = "Активация аккаунта"; 
						$message = "код активации - ".$result[0]['key']; 
						$headers = 'From:admin@prze.ru';/*
						$er=mail($to, $subject, $message, 'From:'.$from);
						if($er){
							$messegError['codeError'] = 18; $messegError['relode'] = false;
						} else {$messegError['codeError'] = 19; $messegError['relode'] = false;}
						
						*/
						
						
						
	$config['smtp_username'] = 'admin@prze.ru';  //Смените на имя своего почтового ящика.
	$config['smtp_port']	 = '25'; // Порт работы. Не меняйте, если не уверены.
	$config['smtp_host']	 = 'smtp.ht-systems.ru ';  //сервер для отправки почты
	$config['smtp_password'] = 'admin1234';  //Измените пароль
	$config['smtp_debug']	= true;  //Если Вы хотите видеть сообщения ошибок, укажите true вместо false
	$config['smtp_charset']  = 'windows-1251';	//кодировка сообщений. (или UTF-8, итд)
	$config['smtp_from']	 = 'prze.ru'; //Ваше имя - или имя Вашего сайта. Будет показывать при прочтении в поле "От кого"
function smtpmail($mail_to, $subject, $message, $headers='') {
	global $config;
	$SEND =	"Date: ".date("D, d M Y H:i:s") . " UT\r\n";
	$SEND .=	'Subject: =?'.$config['smtp_charset'].'?B?'.base64_encode($subject)."=?=\r\n";
	if ($headers) $SEND .= $headers."\r\n\r\n";
	else
	{
			$SEND .= "Reply-To: ".$config['smtp_username']."\r\n";
			$SEND .= "MIME-Version: 1.0\r\n";
			$SEND .= "Content-Type: text/plain; charset=\"".$config['smtp_charset']."\"\r\n";
			$SEND .= "Content-Transfer-Encoding: 8bit\r\n";
			$SEND .= "From: \"".$config['smtp_from']."\" <".$config['smtp_username'].">\r\n";
			$SEND .= "To: $mail_to <$mail_to>\r\n";
			$SEND .= "X-Priority: 3\r\n\r\n";
	}
	$SEND .=  $message."\r\n";
	 if( !$socket = fsockopen($config['smtp_host'], $config['smtp_port'], $errno, $errstr, 30) ) {
		if ($config['smtp_debug']) echo $errno."<br>".$errstr;
		return false;
	 }
 
	if (!server_parse($socket, "220", __LINE__)) return false;
 
	fputs($socket, "HELO " . $config['smtp_host'] . "\r\n");
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить HELO!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "AUTH LOGIN\r\n");
	if (!server_parse($socket, "334", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу найти ответ на запрос авторизаци.</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, base64_encode($config['smtp_username']) . "\r\n");
	if (!server_parse($socket, "334", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Логин авторизации не был принят сервером!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, base64_encode($config['smtp_password']) . "\r\n");
	if (!server_parse($socket, "235", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Пароль не был принят сервером как верный! Ошибка авторизации!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "MAIL FROM: <".$config['smtp_username'].">\r\n");
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить комманду MAIL FROM: </p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "RCPT TO: <" . $mail_to . ">\r\n");
 
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить комманду RCPT TO: </p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "DATA\r\n");
 
	if (!server_parse($socket, "354", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не могу отправить комманду DATA</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, $SEND."\r\n.\r\n");
 
	if (!server_parse($socket, "250", __LINE__)) {
		if ($config['smtp_debug']) echo '<p>Не смог отправить тело письма. Письмо не было отправленно!</p>';
		fclose($socket);
		return false;
	}
	fputs($socket, "QUIT\r\n");
	fclose($socket);
	return TRUE;
}
 
function server_parse($socket, $response, $line = __LINE__) {
	global $config;
	while (@substr($server_response, 3, 1) != ' ') {
		if (!($server_response = fgets($socket, 256))) {
			if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
 			return false;
 		}
	}
	if (!(substr($server_response, 0, 3) == $response)) {
		if ($config['smtp_debug']) echo "<p>Проблемы с отправкой почты!</p>$response<br>$line<br>";
		return false;
	}
	return true;
}
						
						
						
						
						
						
						
		}
		
		if($_POST['saveinf']) {
			
			$email = $_SESSION['login'];
			
			$name = che($_POST['name']);
			$nicgame = che($_POST['nicgame']);
			$game = $_POST['game'];
			$game = json_encode($game);
			
			
			$res = put("UPDATE `user` SET `name`='$name', `nicgame`='$nicgame', `game`='$game' WHERE `email`='$email'");
			
			if($res) {
				$_SESSION['nicgame']=$nicgame;
				$messegError['codeError'] = 3; $messegError['relode'] = true; 
				}
			
		}
		
		if($_POST['newpass']) {
			
			$email = $_SESSION['login'];
			
			$pass = che($_POST['pass']);
			$pass2 = che($_POST['pass2']);
			$pass3 = che($_POST['pass3']);
			
			if($pass == $pass2){
				$security='zagadka';
				$password = md5("$pass3$security");
				if($password == $result[0]['pass']){
					$pass = md5("$pass$security");
					$res = put("UPDATE `user` SET `pass`='$pass' WHERE `email`='$email'");
					
					if($res) {$messegError['codeError'] = 4; $messegError['relode'] = true; }
					
				} else {$messegError['codeError'] = 5; $messegError['relode'] = false; }
			} else {$messegError['codeError'] = 6; $messegError['relode'] = false; }
		}
		
		$result2=$messegError;
		$content = index('profile',$result[0],$result2);
		} else echo '<script>window.location.href = "/" </script>';
	}
}
 ?>