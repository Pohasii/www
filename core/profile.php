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
		
		if($_POST['editcom']) {
			
			$idcaptain = $_SESSION['id'];
			
			$iduser = $_POST['iduser'];
			
			for($i=0;$i<5;$i++){
				if($iduser[$i] != '') {
					$iduser[$i]=$iduser[$i];
				} else $iduser[$i]='-';
			}
			
			$participants = array("participants" => array ("$iduser[0]","$iduser[1]","$iduser[2]","$iduser[3]","$iduser[4]","$iduser[5]"));
			
			$participants = json_encode($participants);                               						
			$res = put("UPDATE `commands` SET `participants`='$participants' WHERE `captain`='$idcaptain'");

			if($res) {
				$messegError = array("codeError" => 35, "relode" => true);
			} else $messegError = array("codeError" => 36, "relode" => false);
		}
		
		if($_POST['deletecom']) {
			
			$idcaptain = $_SESSION['id'];
			
			$deleteComName = $_POST['deleteComName'];
			
			$res = put("DELETE FROM `commands` WHERE `thename`='$deleteComName'");

			if($res) {
				$messegError = array("codeError" => 37, "relode" => true);
			} else $messegError = array("codeError" => 38, "relode" => false);
		}
		
		if($_POST['createcom']) {
			
			$email = $_SESSION['login'];
			
			$name = che($_POST['comname']);
			$iduser = $_POST['iduser'];
			$captain=$_SESSION["id"];
			
			$checkCommnadsName = call("SELECT * FROM `commands` WHERE `thename`='$name'");
			$checkCommnadsExistence = call("SELECT * FROM `commands` WHERE `captain`='$captain'");
			if($checkCommnadsName == false and $checkCommnadsExistence == false){
				for($i=0;$i<5;$i++){
					if($iduser[$i] != '') {
						$iduser[$i]=$iduser[$i];
					} else $iduser[$i]='-';
				}
				
				$participants = array("participants" => array ("$iduser[0]","$iduser[1]","$iduser[2]","$iduser[3]","$iduser[4]","$iduser[5]"));
				$active = array("active" => array("inactive","inactive","inactive","inactive","inactive","inactive"));
				
				$participants = json_encode($participants);
				$active = json_encode($active);
				
				$res = put("INSERT INTO `commands`(`thename`, `captain`, `participants`, `status`) VALUES ('$name','$captain','$participants','$active')");
				
				if($res) {
					$reloadcommnads = call("SELECT `id` FROM `commands` WHERE `thename`='$name'");
					$idCommnads = $reloadcommnads[0]['id'];
					$res = put("UPDATE `user` SET `commands`='$idCommnads' WHERE `email`='$email'");
					if($res) {
						//$messegError['codeError'] = 32; $messegError['relode'] = true;
						$messegError = array("codeError" => 32, "relode" => true);
					} else {
						$res = put("DELETE FROM `commands` WHERE `thename`='$name'");
						//$messegError['codeError'] = 33; $messegError['relode'] = false;
						$messegError = array("codeError" => 33, "relode" => false);
						}	
				} else {//$messegError = array("codeError" => 33, "relode" => false);
					$messegError['codeError'] = 33; $messegError['relode'] = false;
					}
			} else {//$messegError['codeError'] = 34; $messegError['relode'] = false;
			$messegError = array("codeError" => 34, "relode" => false);
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