<?php
if(@$action[0]){
	$result = call("SELECT * FROM `tournaments` WHERE `id`='$action[0]'");
	$result2 = call("SELECT * FROM `participants` WHERE `idtur`='$action[0]'");
	$title = $result[0]['title'];
	
	if(isset($_SESSION["keys"]) and isset($_SESSION["login"])){
		if($result2==false){
			$result3='noparty';
		} else {
			foreach($result2 as $value){
				if($value['iduser'] == $_SESSION['id']){
					$result3='party';
				} else $result3='noparty';
			}
		}
	}
	
	if($_POST['run'] == 'Участвовать'){
		if($result3 == 'noparty') {
			//print_r($_POST['id']);
			//print_r($_POST['nic']);
		
			$idus=$_POST['idus'];
			$idtur=$_POST['idtur'];
			$nicgame=$_POST['nic'];
		
			$res = put("INSERT INTO `participants`(`iduser`, `idtur`, `nicgame`) VALUES ('$idus','$idtur','$nicgame')");
			if($res){
				echo 'Вы зарегистрировались';
			} else echo 'Ошибка регистрации';
		} else echo 'вы зарегистрированны';
	} elseif($_POST['run'] == 'Отписаться') {
		if($result3 == 'party') {
			//print_r($_POST['id']);
			//print_r($_POST['nic']);
		
			$idus=$_POST['idus'];
			$idtur=$_POST['idtur'];
		
			$res = put("DELETE FROM `participants` WHERE `iduser`='$idus' and `idtur`='$idtur'");
			if($res){
				echo 'Вы отписались от участия';
			} else echo 'Ошибка';
		}
	}
	
	$content = index('tournaments.one',$result[0],$result2,$result3);
} else {
	$result = call("SELECT * FROM `tournaments` ORDER BY `date` DESC");
	$title = "Турниры всего мира";
	$content = index('tournaments',$result);
}
?>