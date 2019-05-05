<h1>Actualités</h1>
<? foreach ($this->news as $key=>$new) { ?>
	<div class="article">
	
		<div class="articledescription">
			<h2>
				<a href="<?=$GLOBALS['base']?><?=toURL($new['title'])?>_n<?=$new['id']?>.html"><?=$new['title']?></a>
			</h2>
			<div class="articleinfo">
				Ajouté <?=$this->formatTime($new['created'])?>
			</div>
			<div class="articlesummary" style="width:760px;">
				<?=trimText($new['text'], 500)?>
			</div>
		</div>
	</div>
<? } ?>

