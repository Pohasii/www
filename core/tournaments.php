<?php
if(@$action[0]){
	$result = call("SELECT * FROM `tournaments` WHERE `id`='$action[0]'");
	$result2 = call("SELECT * FROM `participants` WHERE `id`='$action[0]'");
	$title = $result[0]['title'];
	
	if($_POST['run'] == 'Участвовать'){
		
		print_r($_POST['id']);
		print_r($_POST['nic']);
		
		$idus=$_POST['id'];
		$idtur=$result['id'];
		$nicgame=$_POST['nic'];
		
		$res = put("INSERT INTO `participants`(`iduser`, `idtur`, `nicgame`) VALUES ('$idus','$idtur','$nicgame')");
		if($res){
			echo 'Вы зарегистрировались';
		} else echo 'Ошибка регистрации';
	}
	
	$content = index('tournaments.one',$result[0],$result2);
} else {
	$result = call("SELECT * FROM `tournaments` ORDER BY `date` DESC");
	$title = "Турниры всего мира";
	$content = index('tournaments',$result);
}
?>