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
			
			
						$to  = $_SESSION["login"];//$_SESSION["login"];  'admin@prze.ru'
						$subject = "Активация аккаунта"; 
						$message = "код активации - ".$result[0]['key']; 
						$headers = 'admin@prze.ru';
						$er=mail($to, $subject, $message, 'From:'.$headers);
						if($er){
							$messegError['codeError'] = 18; $messegError['relode'] = false;
						} else {$messegError['codeError'] = 19; $messegError['relode'] = false;}
			
		}
		
		if($_POST['avabut']) {

			$email = $_SESSION['login'];
			$id = $_SESSION['id'];
				
			if($_FILES['ava']['size']>10){
				if($_FILES['ava']['size']<=2097152) {
					$rename = explode(".",$_FILES['ava']['name']);
					unset($rename[0]);
					$file=$id.'.'.$rename[1];
					$uploaddir = $_SERVER["DOCUMENT_ROOT"].'/img/user/'.$file;
					
					if(move_uploaded_file($_FILES['ava']['tmp_name'], $uploaddir)){
						$res = put("UPDATE `user` SET `ava`='$file' WHERE `email`='$email'");
						if($res) {$messegError['codeError'] = 26; $messegError['relode'] = true; 
						} else $messegError['codeError'] = 27; $messegError['relode'] = false; 
					} else $messegError['codeError'] = 28; $messegError['relode'] = false; 
				} else $messegError['codeError'] = 29; $messegError['relode'] = false; 	
			} else $messegError['codeError'] = 30; $messegError['relode'] = false; 
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