<div class="wrap">
	<?php if ($result['ava']==NULL){$scr='ava.jpg';} else $scr=$result['ava']; ?>

	<div class="personal-full">
		<div class="imgholder">
			<div class="outer1 circle"></div>
			<div class="outer2 circle"></div>
			<figure>
				<img src="/img/user/<?=$scr;?>" />
				<figcaption class="caption" align=center><?php echo $result['name'];?></figcaption>
			</figure>
		</div>
		
		
		<!--div class="avatar"><img src="/img/ava.jpg"></img></div-->
		<div class="personal-info-block">
			<div class="user-lines">
				<label class="user-label">Ник</label>
				<div class="user-divider"><?php echo $result['nicgame']; ?></div>
			</div>
			
			<div class="user-lines">
			<label class="user-label">Индификатор</label>
	
			<div class="user-divider"><?=$result['id'];?></div>
			</div>
	
			<div class="user-lines">
				<label class="user-label">Дата регистрации</label>
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
	</div>
</div>