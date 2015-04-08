
<div class="wrap">
	<div class="about-tournament">
		<?php messegErrors($messegError);//сообщение об ошибке?>
		<div class="about-tournament-heading">
			<h1><?php echo $result['title'];//титле (название)?></h1>
			<div class="heading-span">
				<span>Регистрация<?php echo $value['status'];// статус (регистрация/завершон)?></span>
			</div>
		</div>
		<div class="full-description">
			<div class="decription-element">
				<label>Формат</label>
				<span>1x1<?php echo $value['format'];?></span>
			</div>
			<div class="decription-element">
				<label>Приз</label>
				<span>20М</span>
			</div>
			<div class="decription-element">
				<label>Зарегистрировано</label>
				<span>15</span>
			</div>
			<div class="decription-element">
				<label>Начало</label>
				<span ><?php echo date_format(date_create($value['date']), 'd.m.y');?></span>
			</div>
		</div>
		<div class="">
			<img src="<?php echo $result['img'];//изображение?>" alt="<?php echo $result['title'];//титле?>">
		</div>
		<?php echo $result['demotitle'];//краткое описание?>
		
		<span><?php echo $value['count'];//количество участвующих?></span>
		<span><?php echo $value['status'];// статус (регистрация/завершон)?></span>
	</div>
	<?
	$idus=$_SESSION['id'];// не трож
	$nicgame=$_SESSION['nicgame'];// не трож

	if($result3 == 'noparty' and $nicgame != '') {// форма участия ?>
	<form method='post' action='/tournaments/<?php echo $result['id'];?>'>
			<input name='idus' type='hidden' value='<?php echo $idus;?>'>
			<input name='idtur' type='hidden' value='<?php echo $result['id'];?>'>
			<input name='nic' type='hidden' value='<?php echo $nicgame;?>'>
			<input class="register-button" name='run' type='submit' value='Участвовать'> <!-- кнопка участия -->
	</form>
	<? } elseif($result3 == 'party') { // не трож?>
	<form method='post' action='/tournaments/<?php echo $result['id'];?>' onclick="">
		<input name='idus' type='hidden' value='<?php echo $idus;?>'>
		<input name='idtur' type='hidden' value='<?php echo $result['id'];?>'>
		<input class="register-button" name='run' type='submit' value='Отписаться'> <!-- кнопка отписаться от участия -->
	</form>
	<? } else echo 'для участия Авторизуйтесь, либо вы не ввели логин(в играх) в личном кабинете'; // сообщение (нужно перефразировать правильно) если не зарегистрирован/либо логин не введ в личном кабинете (заместо кнопки выводится) ?>
	
	<?php echo $result['participants'];// я еще не придумал?>

	<div id="demoTab" style="font-size: 16px; color:#F00;">
            <ul class="resp-tabs-list">
                <li> Участники </li>
                <li> Правила </li>
                <li> Описание </li>
				</ul> 
				
            <div class="resp-tabs-container">
                <div>
				<?php 
				foreach($result2 as $value) { // участники?>
				<a href="/user/<?php echo $value['iduser']; ?>"><?php echo $value['nicgame'];// ссылка?></a>
				<?php } ?>
				</div>
                <div> <?php echo $result['specification'];// паравила?> </div>
                <div> 
				<article>
				<?php echo $result['fulltext']; // полное онписание?>
				</article>  
				</div>
            </div>
        </div>
		
	<!--<?php echo date_format(date_create($result['date']), 'd.m.y');?>-->
</div>		
		<script type="text/javascript">/*
		$("#demoTab").easyResponsiveTabs({
			type: 'accordion', //Типы: default, vertical, accordion      
			width: 'auto', //auto или любое значение ширины
			fit: true,   // 100% пространства занимает в контейнере
			activate: function() {} // Функция обратного вызова, используется, когда происходит переключение вкладок
			});*/
		</script>