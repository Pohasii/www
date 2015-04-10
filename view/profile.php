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
/*
$array = array("name"=>"kommands", "user" => array ("user1","user2","user3","user4","user5","user6","user7"), "active" => array("active","active","inactive","inactive","active","inactive","active"));
$array2=json_encode ($array);
print_r($array);
print_r($array2);
$array2=json_decode($array2, true);
print_r($array2);*/

?>
                <h1>Личный кабинет :Ваш индификатор <?=$result['id'];?></h1>
		<?php if ($result['ava']==NULL){$scr='ava.jpg';} else $scr=$result['ava']; ?>
			
			<div class="imgholder">
			<div class="outer1 circle"></div>
			<div class="outer2 circle"></div>
			<figure>
				<img src="/img/user/<?php echo $scr;?>" />
				<figcaption class="caption" align=center><?php echo $result['name'];?></figcaption>
			</figure>
		</div>
			
			
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
	
	<div class="second-form">
	<form method='post' enctype="multipart/form-data">
		<div class="field">
			<label>Аватар</label>
			<input type="file" name="ava" accept="image/*"> 
			<input class="button" name="avabut" type="submit" value="load">
		</div>
	</form>
	</div>
	
	<? if($result['commands'] == 0) { ?>
	<div class="second-form">
	<form method='post'>
	<label>Название команды</label>
	<input type="text" name="comname" required>
	
	<div class="second-column-block-element">
		<select name="iduser[]" data-placeholder="Line" class="chosen-select" multiple style="width:300px;" tabindex="1" required>
					<?php 
					$result = call("SELECT `id` FROM `user`");
					foreach($result as $value) { 
					echo "<option value='".$value['id']."'>".$value['id']."</option>";
					}
					?>
		</select>
	</div>

	<input class="button" name="createcom" type="submit" value="создать">
	</form>
	</div>
	<? } ?>
<? //личный кабинет ?>

<? //админ панель ?>
<?php if($result['special'] == 1){?>
    <div class="admin-button">       
     <a href="/qwerty">Админ панель </a>
	</div>
<?php } ?>
<? //админ панель ?>


	<? } ?>
</div>