<?php 
//user controller

if (@$action[0]=='') {
	echo '<script>window.location.href = "/" </script>';
} else {
	if(@$action[0]) {
	$result = call("SELECT `id`, `email`, `name`, `dreg`, `game`, `nicgame`, `ava` FROM `user` WHERE `id`='$action[0]'");

		$title = $result[0]['nicgame'];
		$content = index('user',$result[0]/*,$result2*/);
	}
}
 ?>