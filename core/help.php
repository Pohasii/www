<?php
	$result = call("SELECT * FROM `page` WHERE `namepage`='help'");
	$title = "Help";
	$content = index('hel',$result[0]);
	
?>