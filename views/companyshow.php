<div class="productheader">

	<? if ($this->company['image'] != ''){ ?>
 
		<img class="productimage" src="comparateur-produit-ecologique-<?=toURL($this->company['title'])?>-<? echo $this->company['id']; ?>.jpg" alt="comparateur-produit-bio-eco-<?=$this->company['title']?>"/>
	<? } ?>

	<div class="productfeatures">
		<h1><?=$this->company['title']?></h1>
		<?php $findit = stripslashes(nl2br($this->company['site'])); ?>
		<?=autolink($findit,0)?>
	</div>
	
	<div class="socialnetworks">
			<? $pageURL = $_SERVER['REQUEST_URI']?>
			<? $pageURL = substr($pageURL,1)?>
			<? foreach ($this->socialNetworks as $row){ ?>
				<a href="<?=$row['url'].$GLOBALS['base'].$pageURL ?>" title="<?=$row['alt']?>" class="socialnetwork"><img src="<?=$row['logo']?>" alt="<?=$row['alt']?>"/></a>
			<? } ?>
	
		<div id="likeFB" style="margin: 10px 0px; height: 15px;">
    <!-- <iframe src="http://www.facebook.com/plugins/like.php?href=<?=$GLOBALS['base'].$pageURL ?>&amp;layout=standard&amp;show_faces=false&amp;width=450&amp;action=recommend&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:450px; height:px;"></iframe>-->
	</div>

		</div>
		
</div> 


<div class="articlehtml">
	<?
		$html = $this->company['text'];
		$html = str_replace('companyimages/', $GLOBALS['base'].'/companyimages/', $html);
	?>
	<br/>
	<?=$html?><br/>	
</div>

<? if (count($this->products) > 0){ ?>

<h2><?=count($this->products)?> produit(s) <?=$this->company['title']?> sur Ecocompare...</h2>

<div class="highlights">

	<? foreach ($this->products as $key=>$product) { ?>

		<div class="productslistitem">

			<div class="imagecontainer">
				<? if ($product['image'] != ''){ ?>
					<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html">
					<!--	<img src="<?=$GLOBALS['base']?>cache/medium<? echo $product['id']; ?>.jpg" alt="<?=$product['name']?>"/> -->
							<img src="fiche-eco-produit-<?=toUrl($product['name'])?>_<?=toUrl($this->company['title'])?>-<? echo $product['id']; ?>.jpg" alt="comparatif <?=$product['name']?>"/>
					</a>
				<? } else { ?>
					&nbsp;
				<? } ?>
			</div>
			<div class="main">
				<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html">
					<strong><?=stripSlashes($product['name'])?></strong>
				</a>
				<strong><?=stripSlashes($product['brand'])?></strong>
				<? if (count($product['labels']) > 0){ ?>
					<? foreach ($product['labels'] as $key=>$label) { ?>
						<span class="label">
							<img alt="<?=$label['name']?>" src="<?=$GLOBALS['base']?>/images/labels_16/<?=$label['image']?>">
							<div class="bubble">
								<div class="bubbletop"><?=$label['name']?></div>
								<div class="bubblebottom">&nbsp;</div>
							</div>
						</span>
					<? } ?>
				<? } ?>
				<br/>
				<div class="faded">
					Ajouté <?=$this->formatTime($product['pubdate'])?>
					<span class="faded">|</span> <a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html#section2"><?=$product['commentscount']?> commentaire(s)</a>
				</div>
				<?=stripslashes(trimText(stripslashes($product['description']), 175))?>
			</div>
			<div class="ratings">
				<?
				$ratingLabels = array();
					$ratingLabels[] = array("id" => "1", "name" => "Environnement");
					$ratingLabels[] = array("id" => "2", "name" => "Sociétal");				
					$ratingLabels[] = array("id" => "3", "name" => "Santé");
					$ratingLabels[] = array("id" => "4", "name" => "Note globale");
				?>
			<? foreach ($ratingLabels as $key => $ratingLabel){ ?>
				
						<? 
							if ($ratingLabel['id'] == 4){
								$class = "global";
								$prefix = "leaves";
							}else{
								$class = "normal";
								$prefix = "gauge";
							}
						?>
						<div class="<?=$class?>">
							<div class="rating">

								<span><?=$ratingLabel['name']?> :</span>
							<!--	<img src="<?=$GLOBALS['base']?>style/<?=$prefix?><?=$product['rating'.$ratingLabel['id']]?>.png" alt="<?=$product['rating'.$ratingLabel['id']]?>/5"/> -->
							
							<? if ($ratingLabel['id']!=4) { ?>
									<img src="<?=$GLOBALS['base']?>style/<?=$prefix?><?=arrondir($product['score'.$ratingLabel['id']])?>.png" alt="<?=$product['score'.$ratingLabel['id']]?>/5"/>
									
									<? } else {?>
									<img src="<?=$GLOBALS['base']?>style/<?=$prefix?><?=round($product['score'.$ratingLabel['id']]*2)/2?>.png" alt="<?=$product['score'.$ratingLabel['id']]?>/5"/>
								
						
							<?}?>
							</div>
						</div>
			
				<? } ?>
			</div>
		</div>
	<? } ?>
	
	
</div>

<div>
<?php

foreach ($this->partners as $key=>$partner)
{
	echo "Retrouvez les <a href='".$partner['url']."' target='blank'> produits de ".$this->company['title']." sur ".$partner['partner'].".</a><br/>";
}

?>	
</div>

<div style="clear:both"><br/></div>
<? } ?>