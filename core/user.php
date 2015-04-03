<?php 
//user controller

if (@$action[0]=='') {
	echo '<script>window.location.href = "/" </script>';
} else {
	if(@$action[0]) {
	$result = call("SELECT `id`, `nic_name`, `email`, `name`, `fname`, `skype`, `aga`, `title`, `rating`, `img`, `time`, `regdate`, `needtime`, `needtimetwo`, `strana`, `lang`, `elo`, `server`, `role`, `lan`, `goal`, `I_was_looking_for`, `team`, `fc`, `vk` FROM `users` WHERE `nic_name`='$action[0]'");

		$title = $result[0]['title'];
		$content = getTpl('user',$result[0]/*,$result2*/);
	}
}
 ?>