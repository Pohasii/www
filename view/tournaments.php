<div class="wrap">
	<div class="tournaments">
			<div class="theader link">
				<span>Название</span>
				<span>Формат</span>
				<span>Дата</span>
				<span>Игроки</span>
			</div>
			<?php foreach($result as $value) { ?>
				<div class="link" style="background-image:url(<?php echo $value['img']; ?>);">
					<a href="/tournaments/<?php echo $value['id']; ?>">
						<span ><?php echo $value['title'];?></span>
						<span ><?php echo $value['demotitle'];?></span>
						<span ><?php echo date_format(date_create($value['date']), 'd.m.y');?></span>
					</a>
				</div>
			<?php } ?>
	</div>
</div>