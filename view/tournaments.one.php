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
	
	<?php 
	echo 'Участники:';
	foreach($result2 as $value) { ?>
		<a href="/user/<?php echo $value['id']; ?>"><?echo $value['nicgame'];?></a>
	<?php } 
	
	if(isset($_SESSION["keys"]) and isset($_SESSION["login"])){ 
	$id=$_SESSION['id'];
	$nicgame=$_SESSION['nicgame'];
	?>
		<form method="post" action="/tournaments">
			<input name="id" type="hidden" value='<?$id?>'>
			<input name="nic" type="hidden" value='<?$nicgame?>'>
			<input class="button" name="run" type="submit" value="Участвовать">
		</form>
	<?}?>