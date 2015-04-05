<div class="wrap">
	<div class="block-tidings">
			<div class="theader">
				<span></span>
				<span></span>
				<span></span>
			</div>
			<?php foreach($result as $value) { ?>
				<div class="link" style="background-image:url(<?php echo $value['img']; ?>);">
					<a href="/tournaments/<?php echo $value['id']; ?>">
						<span class="title"><?php echo $value['title'];?></span>
						<span class="title"><?php echo $value['demotitle'];?></span>
						<span class="new-date"><?php echo date_format(date_create($value['date']), 'd.m.y');?></span>
					</a>
				</div>
			<?php } ?>
	</div>
</div>