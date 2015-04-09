<div class="wrap">
	<?$messegError=$result2;
	messegErrors($messegError);?>
	<div class="admin-form">
	
	<?php if($result3=='edit') { ?>
	
		<form name=turreg method=post>
			<div class="admin-block">
				<label>Название</label>
				<input type="text" name="title" value='<? echo $result[0]['title'];?>'> 
			</div>
			<div class="admin-block">
				<label>Краткое описание</label>
				<input type="text" name="demotitle" value='<? echo $result[0]['demotitle'];?>'> 
			</div>
			
			<div class="admin-block">
				<label>Игра</label>
				
				<div class="second-column-block-element">
				<select name="game" data-placeholder="Line" class="chosen-select" style="width:300px;" tabindex="1">
				<?
				$format = call("SELECT * FROM `game`");
				$i=0;
				foreach($format as $value) {
				if($result[0]['game'] == $value['game']){
				echo "<option value='".$value['img']."' ".$value['status'].">".$value['game']."</option>";
				} else echo "<option value='".$value['img']."' ".$value['status'].">".$value['game']."</option>";
				$i++;
				}?>
				</select>
				</div>
				
			</div>
			
			<div class="admin-block">
				<label>Время</label>
				<input type="time" name="time" value='<? echo $result[0]['time'];?>'> 
			</div>
			
			<div class="admin-block">
				<label>Формат</label>
		<div class="second-column-block-element">
		<select name="format" data-placeholder="Line" class="chosen-select" style="width:300px;" tabindex="1">
			<?
			$format = call("SELECT * FROM `utilities_tournaments` WHERE `determination`='format'");
			$i=0;
			foreach($format as $value) {
			if($result[0]['format'] == $value['value']){
			echo "<option value='".$value['value']."' selected>".$value['text']."</option>";
			} else echo "<option value='".$value['value']."'>".$value['text']."</option>";
			$i++;
			}?>
		</select>
		</div>	
			</div>
			
			<div class="admin-block">
				<label>Необходимое количество</label>
				<input type="number" max="100" name="countFerst" value='<? echo $result[0]['countFerst'];?>'>
			</div>
			
			<div class="admin-block">
				<label>полное описание</label>
				<textarea name='fulltext'><? echo $result[0]['fulltext'];?></textarea>
			</div>
			<div class="admin-block">
				<label>Правила</label>
				<textarea name=specification><? echo $result[0]['specification'];?></textarea>
			</div>
			<div class="admin-block">
				<label>Дата проведения</label>
				<input type="date" name="date" value='<? echo $result[0]['date'];?>'> 
			</div>
			<div class="admin-block">
				<label>статус</label>
					<div class="second-column-block-element">
					<select name="status" data-placeholder="Line" class="chosen-select" style="width:300px;" tabindex="1">
					<?
					$format = call("SELECT * FROM `utilities_tournaments` WHERE `determination`='status'");
					$i=0;
					foreach($format as $value) {
					if($result[0]['status'] == $value['value']){
					echo "<option value='".$value['value']."' selected>".$value['text']."</option>";
					} else echo "<option value='".$value['value']."'>".$value['text']."</option>";
					$i++;
					}?>
					</select>
					</div>
			</div>
			<input type="hidden" name="id" value='<? echo $result[0]['id'];?>'> 
			
			<input name="sub" type="submit" value="Обновить">
		</form>
		
	<? } else { ?>
		<form name=turreg method=post>
			<div class="admin-block">
				<label>Название</label>
				<input type="text" name="title"> 
			</div>
			<div class="admin-block">
				<label>Краткое описание</label>
				<input type="text" name="demotitle"> 
			</div>
			
			
			<div class="admin-block">
				<label>Игра</label>
				
				<div class="second-column-block-element">
				<select name="game" data-placeholder="Line" class="chosen-select" style="width:300px;" tabindex="1">
				<?
				$format = call("SELECT * FROM `game`");
				$i=0;
				foreach($format as $value) {
				echo "<option value='".$value['img']."' ".$value['status'].">".$value['game']."</option>";
				$i++;
				}?>
				</select>
				</div>
				
			</div>
			
			<div class="admin-block">
				<label>Время</label>
				<input type="time" name="time"> 
			</div>
			
			<? $format = call("SELECT * FROM `utilities_tournaments`"); ?>
			
			<div class="admin-block">
				<label>Формат</label>
		<div class="second-column-block-element">
		<select name="format" data-placeholder="Line" class="chosen-select" style="width:300px;" tabindex="1">
		<? foreach($format as $value) {
		if($value['determination']=='format'){
		echo "<option value='".$value['value']."'>".$value['text']."</option>";
		}
		}?>
		</select>
		</div>	
			</div>
			
			<div class="admin-block">
				<label>Необходимое количество</label>
				<input type="number" max="100" name="countFerst">
			</div>
			
			<div class="admin-block">
				<label>полное описание</label>
				<textarea name=fulltext></textarea>
			</div>
			<div class="admin-block">
				<label>Правила</label>
				<textarea name=specification></textarea>
			</div>
			<div class="admin-block">
				<label>Дата проведения</label>
				<input type="date" name="date"> 
			</div>
			<div class="admin-block">
				<label>статус</label>
					<div class="second-column-block-element">
					<select name="status" data-placeholder="Line" class="chosen-select" style="width:300px;" tabindex="1">
					<? foreach($format as $value) {
					if($value['determination']=='status'){
					echo "<option value='".$value['value']."'>".$value['text']."</option>";
					}
					}?>
					</select>
			</div>
			<input name="sub" type="submit" value="Создать турнир">
		</form>
		<? } ?>
		
		<? foreach($result as $value) { ?>
			<form name=turreg method=post>
			<input type="text" name="title" value='<? echo $value['title']?>' readonly>
			<input type="text" name="id" value='<? echo $value['id']?>' readonly>
			<input name="sub" type="submit" value="edit">
			<input name="sub" type="submit" value="delete">
			</form>
		<?}?>
		
		</div>
	</div>
</div>