<div class="wrap">
	<?php 
	if(isset($result['passErrorSingIn'])) echo $result['passErrorSingIn'];
	if(isset($result['errorlogin'])) echo $result['errorlogin'];
	if(isset($result['errorpass'])) echo $result['errorpass'];
	if(isset($result['erroremail'])) echo $result['erroremail'];
	if(isset($result['notidenticalemail'])) echo $result['notidenticalemail'];
	if(isset($result['ok'])) echo $result['ok'];
	echo 'Main page';
	echo $result['text'];
	?>	 
</div>