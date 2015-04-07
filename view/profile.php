<div class="wrap">
<?php
	$messegError=$result2;
	messegErrors($messegError);

	if($result['status'] == 0){
	echo "
		<form method='post'>
		<div>
		<label>Введите код потверждения</label>
		<input name='status' type='text'><br />
		</div>
		<input name='Activate' type='submit' value='Activate'>
		</form>
	";
	
	echo "
		<form method='post'>
		<label>Выслать еще раз код</label>
		<input name='Activate' type='submit' value='Выслать'>
		</form>
	";
	} else {
?>

<?
$messegError=$result2;
messegErrors($messegError);
?>
                <h1>Личный кабинет</h1>
		<?php if ($result['img']=='') { $scr='avatar.png'; } else $scr=$result['img'];?>
			<img src="/img/<?=$scr?>">
	<div class="first-form">
		<form method='post'>
				<div class="field">
					<label>Имя</label>
					<input name="name" type="text" value="<?=$result['name'];?>">
				</div>
				<div class="field">
					<label>Логин в играх</label>
					<input name="nicgame" type="text" value="<?=$result['nicgame']; ?>">
				</div>
				<div class="field">
					<label>дата регистрации</label>
					<label><?=$result['dreg'];?></label>
				</div>
				<div class="field">
					<label>Игры</label>
					<div class="selection-game">
						<?php 
						$game = json_decode($result['game'], true);?>
						<select name="game[]" data-placeholder="Line" class="chosen-select" multiple style="width:300px;" tabindex="1">
						<?php 
							$games = call("SELECT * FROM `game`");
							$i=0;
							foreach($games as $value) {
								if($game[$i] == $value['game']){
									echo "<option value='".$value['game']."' selected>".$value['game']."</option>";
								} else echo "<option value='".$value['game']."' ".$value['status'].">".$value['game']."</option>";
								$i++;
							}?>
						</select>
					</div>
				</div>
				<div >
						<input class="button" name="saveinf" type="submit" value="Сохранить">
				</div>
		</form>
	</div>
	<div class="second-form">
	<form method='post'>
		<div class="field">
			<label>Новый пароль</label>
			<input name="pass" type="password">
		</div>
		<div class="field">
			<label>Повторите новый пароль</label>
			<input name="pass2" type="password">
		</div>
		<div class="field">
			<label>Текущий пароль</label>
			<input name="pass3" type="password"> 
		</div>
		<input class="button" name="newpass" type="submit" value="Update">
	</form>
	</div>
<? //личный кабинет ?>

<? //админ панель ?>
<?php if($result['special'] == 1){?>
    <div>       
     <li> <a href="/qwerty">Админ панель </a></li>
	</div>
<?php } ?>
<? //админ панель ?>


	<? } ?>
</div>