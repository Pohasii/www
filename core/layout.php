<?php
	if($action[0]=='exit') {
		unset($_SESSION['keys']);
		unset($_SESSION['login']); 
		unset($_SESSION['ip']);
		session_destroy();
		echo '<script>window.location.href = "/"</script>';
	}

?>