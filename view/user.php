<div class="wrap">
	<!--<?php if ($result['img']==NULL){$scr='avatar.png';} else $scr=$result; ?>
	<div><img src="/img/<?=$scr;?>"></img></div>-->
	<div class="avatar"><img src="/img/ava.jpg"></img></div>
	<div class="user-lines">
		<label class="user-label">ник</label>
		<div class="user-divider"><?php echo $result['nicname']; ?></div>
	</div>
	<div class="user-lines">
		<label class="user-label">имя</label>
		<div class="user-divider"><?php echo $result['name'];?></div>
	</div>
	<div class="user-lines">
		<label class="user-label">дата регистрации</label>
		<div class="user-divider"><?php echo $result['dreg'];?></div>
	</div>
	<div class="user-lines">
		<label class="user-label">Игра</label>
		<div class="user-divider"><?php
		$game = json_decode($result['game'], true);
		foreach($game as $value) {
		echo $value."<br />";
		}
		?>
		</div>
	</div>
</div>