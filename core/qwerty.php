<?php 
$login = $_SESSION["login"];
$result = call("SELECT `special` FROM `user` WHERE `email`='$login'");
if ($result[0]['special']!=1) {
	echo '<script>window.location.href = "/" </script>';
} else {
	if($result[0]['special']==1) {
		
		if($_POST['sub'] == 'edit'){	
			$id=$_POST['id'];
			$title=$_POST['title'];
			$result = call("SELECT * FROM `tournaments` WHERE `id`='$id' and `title`='$title'");
			$result3='edit';
		} else {$result = call("SELECT * FROM `tournaments`");}
		
		if($_POST['sub'] == 'delete'){
			$id=$_POST['id'];
			$title=$_POST['title'];
			$res = put("DELETE FROM `tournaments` WHERE `id`='$id' and `title`='$title'");
			if ($res){
			$messegError['codeError'] = 22; $messegError['relode'] = true;
			put("DELETE FROM `participants` WHERE `idtur`='$id'");
			} else {$messegError['codeError'] = 23; $messegError['relode'] = false;}
		}
		
		if($_POST['sub'] == 'Обновить'){
			
			$id=$_POST['id'];
			$title=$_POST['title'];
			$demotitle=$_POST['demotitle'];
			$format=$_POST['format'];
			$fulltext=$_POST['fulltext'];
			
			$time=$_POST['time'];
			$game=$_POST['game'];
			
			$specification=$_POST['specification'];
			$date=$_POST['date'];
			$status=$_POST['status'];
			
			$res = put("UPDATE `tournaments` SET `title`='$title',`demotitle`='$demotitle',`format`='$format',`fulltext`='$fulltext',`specification`='$specification',`date`='$date', `time`='$time', `game`='$game',`status`='$status' WHERE `id`='$id'");
			if ($res){$messegError['codeError'] = 24; $messegError['relode'] = true; 
			} else {$messegError['codeError'] = 25; $messegError['relode'] = false;}
		}
		
		if($_POST['sub'] == 'Создать турнир'){
			
			$title=$_POST['title'];
			$demotitle=$_POST['demotitle'];
			$format=$_POST['format'];
			$fulltext=$_POST['fulltext'];
			
			$time=$_POST['time'];
			$game=$_POST['game'];
			
			$specification=$_POST['specification'];
			$date=$_POST['date'];
			$status=$_POST['status'];
			
			$res = put("INSERT INTO `tournaments`(`title`, `demotitle`, `format`, `fulltext`, `specification`,`date`, `time`, `game`, `status`) VALUES ('$title', '$demotitle', '$format', '$fulltext', '$specification', '$date', '$time', '$game', '$status')");
			if ($res){$messegError['codeError'] = 20; $messegError['relode'] = false; 
			} else {$messegError['codeError'] = 21; $messegError['relode'] = false;}
		}

	$result2=$messegError;
	
	$title = "qwerty";
	$content = index('qwerty',$result,$result2,$result3);
	}
}
?>