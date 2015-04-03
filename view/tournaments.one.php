	<h1><?php echo $result['title'];?></h1>
	<img src="<?php echo $result['img'];?>" alt="<?php echo $result['title'];?>">
	<article>
	<?php echo $result['content'];?>
	</article>
	<?php echo $result['demotitle'];?>
	<?php echo $result['fulltext'];?>
	<?php echo $result['specification'];?>
	<?php echo $result['participants'];?>
	<?php echo date_format(date_create($result['date']), 'd.m.y');?>
