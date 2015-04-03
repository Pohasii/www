<?php
	$result = call("SELECT * FROM `page` WHERE `namepage`='help'");
	$title = "Главная страница";
	$content = index('help',$result);
	
?>