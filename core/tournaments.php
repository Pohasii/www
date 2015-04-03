<?php
if(@$action[0]){
	$result = call("SELECT * FROM `tournaments` WHERE `id`='$action[0]'");
	$title = $result[0]['title'];
	$content = index('tournaments.one',$result[0]);
} else {
	$result = call("SELECT * FROM `tournaments` ORDER BY `date` DESC");
	$title = "Турниры всего мира";
	$content = index('tournaments',$result);
}
?>