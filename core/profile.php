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
						$to  = $_SESSION["login"]; 
						$subject = "Активация аккаунта"; 
						$message = "код активации - $key"; 
						$from = 'admin@prze.ru';
						mail($to, $subject, $message, 'From:'.$from); 
		}
		
		if($_POST['saveinf']) {
			
			$email = $_SESSION['login'];
			
			$name = che($_POST['name']);
			$nicname = che($_POST['nicname']);
			$game = $_POST['game'];
			$game = json_encode($game);
			
			$res = put("UPDATE `user` SET `name`='$name', `nicgame`='$nicname', `game`='$game' WHERE `email`='$email'");
			
			if($res) {$messegError['codeError'] = 3; $messegError['relode'] = true; }
			
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