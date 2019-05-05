<? ?>
<h1>Entreprises engagées</h1>
<div>
Dans cette section, vous retrouverez les entreprises engagées dans une démarche d'eco-conception de leurs produits pour limiter l'impact environnemental tout au long du cycle de vie. Cet espace est donc dédié a la mise en avant de ces entreprises plus vertueuses... 
</div>
<br/>		
<? foreach ($this->companies as $key=>$company) { ?>

<? if (strlen($company['text'])>5) {?>
	<div class="article">
		<div class="imagecontainer">
		
			<? if ($company['image'] != ''){ ?>
				<a href="<?=$GLOBALS['base']?><?=toURL($company['title'])?>_c<?=$company['id']?>.html">
					<!-- <img src="<?=$GLOBALS['base']?>companies?action=showImage&size=medium&id=<? echo $company['id']; ?>" alt="<?=$company['title']?>" /> -->
						<img  src="comparateur-produit-ecologique-<?=toURL($company['title'])?>-<? echo $company['id']; ?>.jpg" alt="Comparer les produits de <?=toUrl($company['title'])?>"/>
					
				</a>
			<? } else { ?>
				&nbsp;
			<? } ?>
		</div>
		<div class="articledescription">
			<h2>
				<a href="<?=$GLOBALS['base']?><?=toURL($company['title'])?>_c<?=$company['id']?>.html"><?=$company['title']?></a>
			</h2>
			
			<div class="articlesummary">
				<?=trimText($company['text'], 500)?>
			</div>
		</div>
	</div>
<? } }?>
