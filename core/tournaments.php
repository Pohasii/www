<?php
if(@$action[0]){
	$result = call("SELECT * FROM `tournaments` WHERE `id`='$action[0]'");
	$result2 = call("SELECT * FROM `participants` WHERE `idtur`='$action[0]'");
	$title = $result[0]['title'];
	

	if(isset($_SESSION["keys"]) and isset($_SESSION["login"]) and $result[0]['status']=='Регистрация'){
		if($result2==false){
			$result3='noparty';
		} else {
			foreach($result2 as $value){
				if($value['iduser'] == $_SESSION['id']){
					$result3='party';
				} elseif($result[0]['status']=='Регистрация'){ $result3='noparty';}
			}
		}
	}
	
	/*if($result[0]['date']<=$result[0]['start']<=$result[0]['end']){
		
	}*/
	
	if($_POST['run'] == 'Участвовать'){
		if($result3 == 'noparty') {

			$idus=$_POST['idus'];
			$idtur=$_POST['idtur'];
			$nicgame=$_POST['nic'];
		
			$res = put("INSERT INTO `participants`(`iduser`, `idtur`, `nicgame`) VALUES ('$idus','$idtur','$nicgame')");
			
			if($res){
				$counts = checkCounts("SELECT * FROM `participants` WHERE `idtur`='$action[0]'");
				put("UPDATE `tournaments` SET `count`='$counts' WHERE `id`='$action[0]'");
				
				$messegError['codeError'] = 13; $messegError['relode'] = true;
			} else {$messegError['codeError'] = 14; $messegError['relode'] = false;}
		
		} else {$messegError['codeError'] = 15; $messegError['relode'] = false;}
	} elseif($_POST['run'] == 'Отписаться') {
		if($result3) {
		
			$idus=$_POST['idus'];
			$idtur=$_POST['idtur'];
		
			$res = put("DELETE FROM `participants` WHERE `iduser`='$idus' and `idtur`='$idtur'");
			if($res == true){
				
				$counts = checkCounts("SELECT * FROM `participants` WHERE `idtur`='$action[0]'");
				put("UPDATE `tournaments` SET `count`='$counts' WHERE `id`='$action[0]'");
				
				$messegError['codeError'] = 16; $messegError['relode'] = true;
			} else {$messegError['codeError'] = 17; $messegError['relode'] = false;}
		}
	}
	
	$content = index('tournaments.one',$result[0],$result2,$result3,$messegError);
} else {
	$result = call("SELECT * FROM `tournaments` ORDER BY `date` DESC");
	$title = "Турниры всего мира";
	$content = index('tournaments',$result);
}
?>