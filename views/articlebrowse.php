<? ?>
<h1 class="titrerss ">Articles et Dossiers conseil</h1>
<div class="lienrss">	<a href="<?=$GLOBALS['base']?>articles_rss_ecocompare.html" title="Suivez notre flux RSS !">Suivre le flux RSS</a>
</div>
<? foreach ($this->articles as $key=>$article) { ?>
	<div class="article">
		<div class="imagecontainer">
			<? if ($article['image'] != ''){ ?>
				<a href="<?=$GLOBALS['base']?><?=toURL($article['title'])?>_d<?=$article['id']?>.html">
					<img src="<?=$GLOBALS['base']?>articles?action=showImage&size=medium&id=<? echo $article['id']; ?>" alt="<?=$article['title']?>" />
				</a>
			<? } else { ?>
				&nbsp;
			<? } ?>
		</div>
		<div class="articledescription">
			<h2>
				<a href="<?=$GLOBALS['base']?><?=toURL($article['title'])?>_d<?=$article['id']?>.html"><?=$article['title']?></a>
			</h2>
			<div class="articleinfo">
				Ajouté <?=$this->formatTime($article['created'])?>
			</div>
			<div class="articlesummary">
				<?=trimText($article['text'], 500)?>
			</div>
		</div>
	</div>
<? } ?>
<br/>
<div id="icone_paperblog">
	<a href="http://www.paperblog.fr/" rel="paperblog pmontier" title="Paperblog : Les meilleurs actualités issues des blogs" >
	  <img src="http://media.paperblog.fr/assets/images/logos/minilogo.png" border="0" alt="Paperblog : Les meilleurs actualités issues des blogs" />
	 </a>
</div>