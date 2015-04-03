<div class="block-tidings">
		<?php foreach($result as $value) { ?>
			<div class="link" style="background-image:url(<?php echo $value['mainimg']; ?>);">
				<a href="/news/<?php echo $value['url']; ?>">
					<span class="title"><?php echo $value['title'];?></span>
					<span class="anounce"><span class="new-date"><?php echo date_format(date_create($value['date']), 'd.m.y');?></span><?php echo $value['intro'];?></span>
				</a>
			</div>
		<?php } ?>
	</div>