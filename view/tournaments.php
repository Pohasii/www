<div class="wrap">
	<div class="tournaments">
			<div class="theader link">
				<span>Игра</span>
				<span>Название</span>
				<span>Формат</span>
				<span>Описание</span>
				<span>Дата/Время</span>
				<span>Игроки</span>
				<span>Статус</span>
			</div>
			<?php foreach($result as $value) { ?>
				<div class="link active" style="background-image:url(<?php echo $value['img']; ?>);">
					<a href="/tournaments/<?php echo $value['id']; ?>">
						<span ><img src="/img/game/<?=$value['game'];?>"></span>
						<span ><?php echo $value['title'];?></span>
						<span ><?php echo $value['format'];?></span>
						<span ><?php echo $value['demotitle'];?></span>
						<span ><?php echo date_format(date_create($value['date']), 'd.m.y').'/'.$value['time'];?></span>
						<span><?php echo $value['count'].'/'.$value['countFerst'];?></span>
						<span><?php echo $value['status'];?></span>
					</a>
				</div>
			<?php } ?>
	</div>
</div>