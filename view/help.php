
<main class="article" >
<div class="wrap">
	<h1><?php echo $result['title'] ?></h1>
	<div class="breadcrumbs">
	<a href="/"><?=t('main');?></a>

	<span>\<span>
	<span><?php echo $result['title'] ?></span>

	</div>
	<article class="news-text"><?php echo $result['content'] ?></article>
</div>
</main>
