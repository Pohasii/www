<div class="wrap">
	<div class="block-tidings">
			<?php foreach($result as $value) { ?>
				<div class="link" style="background-image:url(<?php echo $value['img']; ?>);">
					<a href="/tournaments/<?php echo $value['id']; ?>">
						<span class="title"><?php echo $value['title'];?></span>
						<span class="title"><?php echo $value['demotitle'];?></span>
						<span class="anounce"><span class="new-date"><?php echo date_format(date_create($value['date']), 'd.m.y');?></span></span>
					</a>
				</div>
			<?php } ?>
	</div>
</div>