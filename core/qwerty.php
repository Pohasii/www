<?php 
$login = $_SESSION["login"];
$result = call("SELECT `special` FROM `user` WHERE `email`='$login'");
if ($result[0]['special']!=1) {
	echo '<script>window.location.href = "/" </script>';
} else {
	if($result[0]['special']==1) {
	$title = "qwerty";
	$content = index('qwerty');
	}
}
?>