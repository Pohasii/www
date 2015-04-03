<?php 
	
	$email = $_SESSION['login'];
	$errors = errors();
	foreach($errors as $value) { 
		if($value['numberError'] == $result2['codeError'] and $result2['relode']==true){
			echo $value['textError'];
			echo "<script>window.location.href = '/profile/$email' </script>";
		} elseif($value['numberError'] == $result2['codeError']) {
			echo $value['textError'];
		}
	}
	
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
	} else {
?>
<h1>My page</h1>
		
		<?php if ($result['img']=='') { $scr='avatar.png'; } else $scr=$result['img'];?>
			<img src="/img/<?=$scr?>">
	<form method='post'>
			<p>
			<div>
				<label>Имя</label>
				<input name="name" type="text" value="<?=$result['name'];?>"><br />
			</div>
			</p>
			<p>
			<div>
				<label>Логин в играх</label>
				<input name="nicname" type="text" value="<?=$result['nicgame']; ?>"><br />
			</div>
			</p>

			<label>дата регистрации</label>
			<label><?=$result['dreg'];?></label><br />
				
			<label>Игры</label>
			<label><?php 
			$game = json_decode($result['game'], true);?>
			<select name="game[]" data-placeholder="Line" class="chosen-select" multiple style="width:300px;" tabindex="1">
			<?php 
				$games = call("SELECT * FROM `game`");
				$i=0;
				foreach($games as $value) {
					if($game[$i] == $value['game']){
						echo "<option value='".$value['game']."' selected>".$value['game']."</option>";
					} else echo "<option value='".$value['game']."'>".$value['game']."</option>";
					$i++;
				}?>
			</select>
			</label><br />
			
			<input name="saveinf" type="submit" value="Сохранить">
	</form>
	
	<div>
	<form method='post'>
		<label>Новый пароль</label>
		<input name="pass" type="password"><br />
		<label>Повторите новый пароль</label>
		<input name="pass2" type="password"><br />
		<label>Текущий пароль</label>
		<input name="pass3" type="password"> <br />
		<input name="newpass" type="submit" value="Update">
	</form>
	</div>
	<? } ?>