<div class="wrap">
	<img src="<?php echo $result['img'];?>" alt="<?php echo $result['title'];?>">
	<h1><?php echo $result['title'];?></h1>
	<?php echo $result['demotitle'];?>
	
	<? 
	$idus=$_SESSION['id'];
	$nicgame=$_SESSION['nicgame'];
	if($result3 == 'noparty') { ?>
	<form method='post' action='/tournaments/<?php echo $result['id'];?>'>
			<input name='idus' type='hidden' value='<?php echo $idus;?>'>
			<input name='idtur' type='hidden' value='<?php echo $result['id'];?>'>
			<input name='nic' type='hidden' value='<?php echo $nicgame;?>'>
			<input name='run' type='submit' value='Участвовать'>
	</form>
	<? } elseif($result3 == 'party') { ?>
	<form method='post' action='/tournaments/<?php echo $result['id'];?>' onclick="">
		<input name='idus' type='hidden' value='<?php echo $idus;?>'>
		<input name='idtur' type='hidden' value='<?php echo $result['id'];?>'>
		<input name='run' type='submit' value='Отписаться'>
	</form>
	<? } else echo 'Что-бы стать участником нужно авторизоваться/зарегистрироваться'; ?>
	
	<?php echo $result['participants'];?>

	<div id="demoTab" style="font-size: 16px; color:#F00;">
            <ul class="resp-tabs-list">
                <li> Участники </li>
                <li> Правила </li>
                <li> Описание </li>
				</ul> 
				
            <div class="resp-tabs-container">
                <div>
				<?php 
				foreach($result2 as $value) { ?>
				<a href="/user/<?php echo $value['iduser']; ?>"><?php echo $value['nicgame'];?></a>
				<?php } ?>
				</div>
                <div> <?php echo $result['specification'];?> </div>
                <div> 
				<article>
				<?php echo $result['fulltext'];?>
				</article>  
				</div>
            </div>
        </div>
		
		<?php echo date_format(date_create($result['date']), 'd.m.y');?>
<div>		
		<script type="text/javascript">
		$("#demoTab").easyResponsiveTabs({
			type: 'accordion', //Типы: default, vertical, accordion      
			width: 'auto', //auto или любое значение ширины
			fit: true,   // 100% пространства занимает в контейнере
			activate: function() {} // Функция обратного вызова, используется, когда происходит переключение вкладок
			});
		</script>