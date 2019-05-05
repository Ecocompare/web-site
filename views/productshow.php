<div itemscope itemtype="http://data-vocabulary.org/Product">

<div class="productheader">

	<? if ($this->product['image'] != ''){ ?>
		<img class="productimage" src="comparateur-produit-eco-<?=toUrl($this->product['name'])?>-<? echo $this->product['id']; ?>.jpg" alt="Evaluation environnementale <?=stripslashes($this->product['name'])?>"/>
	<? } ?>

<div class="badge">
<img width="150" alt="<?=stripslashes($this->product['name'])?>" src="bilan-produit-eco-<?=toUrl($this->product['name'])?>-<?=$this->product['id']?>.png"/>

</div>

<span itemprop="brand"><?=$this->product['brand']?></span>
<span itemprop="name"><?=$this->product['name']?></span>


<div class="productfeatures">
		<h1>
			<?=stripslashes($this->product['name'])?><br/>
			<? if ($this->product['brand'] != ''){ ?>
				<span class="faded"><?=$this->product['brand']?></span>
			<? } ?>
		</h1>
		<? if ($this->company != null){ ?>
			<strong><a href="<?=$GLOBALS['base']?><?=toURL($this->company['title'])?>_c<?=$this->company['id']?>.html">Voir la page de <?=$this->company['title']?></a></strong><br/>
		<? } ?>
		<div class="socialnetworks">
			<? $pageURL = $_SERVER['REQUEST_URI']?>
			<? $pageURL = substr($pageURL,1)?>
			<? foreach ($this->socialNetworks as $row){ ?>
				<a href="<?=$row['url'].$GLOBALS['base'].$pageURL ?>" title="<?=$row['alt']?>" class="socialnetwork"><img src="<?=$row['logo']?>" alt="<?=$row['alt']?>"/></a>
			<? } ?>
	
		<div id="likeFB" style="margin: 0px 0px; height: 15px;">
  
<iframe src="http://www.facebook.com/plugins/like.php?href=<?=$GLOBALS['base'].$pageURL ?>&amp;layout=standard&amp;show_faces=false&amp;width=400&amp;action=recommend&amp;font=arial&amp;colorscheme=light&amp;height=45" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:400px; height:35px;" allowTransparency="true"></iframe>


	</div>

		</div>
		
	

	</div>
</div> 




<div class="productdescription tooltip2">
	<span itemprop="description"><?=stripslashes(checkLink($this->product['description'],0))?></span>
	<div>
		<? if ($this->product['price'] != ''){ ?>
		 <span itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
		<meta itemprop="currency" content="EUR" />
		<br/><strong>Prix conseillé : 	<span itemprop="price"><?=mb_ucfirst($this->product['price'])?></span></strong>
		 <span itemprop="availability" content="in_stock"/>
</span>
		<? } ?>
	</div>
	
	
	<div class="faded">
	
		Catégorie(s) : 
		
		<? foreach ($this->product['categories'] as $key=>$category){ ?>
				<a href="<?=$GLOBALS['base']?><?=toURL($category['name'])?>_r<?=$category['id']?>.html"><?=stripslashes($category['name'])?></a><? if ($key < count($this->product['categories']) - 1){ echo ', ';} ?>
			<? } ?>
	
		<span itemprop="category" content="<? foreach ($this->product['categories'] as $key=>$category){ echo $category['name']; } ?>"/></span>
		
		<? if ($this->product['tags'] != "") { ?>
			<br/>
			Tags : 
			<? 
				$tags = explode (',', $this->product['tags']);
				foreach ($tags as $key=>$tag){
					?>
					<a href="<?=$GLOBALS['base']?>search?keywords=<?=trim($tag)?>"><?=trim(stripslashes($tag))?></a><? if ($key < count($tags) -1){ echo ', ';} ?>
					<?
				}
			?>
		<? } ?>
		<? if (count($this->product['labels']) > 0){ ?>
				<br/>
				Label(s) : 
				<? foreach ($this->product['labels'] as $key=>$label) { ?>
				<a href="#" class="tooltip">
					<img alt="<?=$label['name']?>" src="<?=$GLOBALS['base']?>/images/labels_16/<?=$label['image']?>">&nbsp;<?=$label['name']?>&nbsp;<?=$label['referentiel']?>&nbsp;&nbsp;
					
				<span><?=nl2br($label['description']);?></span></a>
					
				<? } ?>

		<? } ?>
		
		
		<? if (count($this->product['indicators']) > 0){ ?>
				<br/>
				Impact(s) minimisé(s) : 
				<? foreach ($this->product['indicators'] as $key=>$indicator) { ?>
					<!-- <img alt="<?=$indicator['name']?>" src="<?=$GLOBALS['base']?>/images/labels_16/<?=$indicator['image']?>">&nbsp;-->
					<?=$indicator['name']?><? if ($key < count($this->product['indicators']) -1){ echo ', ';} ?>
				<? } ?>

		<? } ?>
		<? if ($this->product['pubdate'] != 0){ ?>
		<br/>Ajouté <? echo $this->formatTime($this->product['pubdate'])?><br/>
		<? } ?>
	</div>
	
</div>


<? if ($this->product['facts'] != ""){ ?> 
	<div class="facts tooltip2">
		<?=stripslashes(checkLink($this->product['facts'],9))?>
	</div>
<? } ?>

<div id="productpanes">



	<div class="hometabs">
		<a id="tab1" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/rating.png" alt="Notre avis"/>&nbsp;&nbsp;Notre avis</a>
	</div>

	<div class="ratings" id="section1">
	
	
	<!--	
				<?
					if ($ratingId == 4){
						$class = "ratingglobal";
						$prefix = "leaves";
					}else{
						$class = "ratingdetail";
						$prefix = "gauge";
					}	
				?>
				-->
				<!-- environnement -->
				<div class="ratingdetail">

					<div class="ratinglabel">
					Environnement
					</div>
					<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/gauge<?=arrondir_demi($this->product['score1'])?>.png" alt="<?=$this->product['score1']?>/5"/>
					&nbsp;&nbsp;<strong><?=arrondir2($this->product['score1']);?> / 5 </strong> 
					(<a href="<?=$GLOBALS['base']?>Methodologie.html#<?=$this->product['typeid']?>">voir la note idéale pour cette catégorie</a>)
					<?php $this->displayLifeCycleCompact($this->product['id']); ?>
				</div>
			</div>
			
				<div class="ratingdetail">
					<div class="ratinglabel">
					Sociétal
					</div>
					<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/gauge<?=arrondir_demi($this->product['score2'])?>.png" alt="<?=$this->product['score2']?>/5"/>
					&nbsp;&nbsp;<strong><?=arrondir2($this->product['score2']);?> / 5 </strong>
					(<a href="<?=$GLOBALS['base']?>Methodologie.html#<?=$this->product['typeid']?>">voir la note idéale pour cette catégorie</a>)
					<?php $this->displayThemescore($this->product['id'],'3,4,5,6,7'); ?>
				</div>
				
				</div>

				<div class="ratingdetail">
					<div class="ratinglabel"> 
					Santé
					</div>
					<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/gauge<?=arrondir_demi($this->product['score3'])?>.png" alt="<?=$this->product['score3'];?>/5"/>
					&nbsp;&nbsp;<strong><?=arrondir2($this->product['score3']);?> / 5 </strong> 
					(<a href="<?=$GLOBALS['base']?>Methodologie.html#<?=$this->product['typeid']?>">voir la note idéale pour cette catégorie</a>)
							
						
					<?php $this->displayRatingDetail($this->product['id'],'2',0); ?>
				
				
				</div>
				
				</div>
				
					<div class="ratingglobal">
					<div class="ratinglabel">
					Total
					</div>
					<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/leaves<?=round($this->product['score4']*2)/2?>.png" alt="<?=$this->product['score4']?>/5"/>
									&nbsp;&nbsp;<strong><?=$this->product['score4']?> / 5 </strong>
							
						
				
					<? if ($this->product['globalcomment'] != ""){ ?>
							<div class="ratingcomment">
								 <?=stripslashes($this->product['globalcomment'])?>
							</div> 
						<? } ?>	
					
					
				
				
				</div>
				
				</div>
</div>				

<? if ($this->product['AE']!='') { ?>
<div class="moitie marginright">

<?}?>
	<? if ($this->product['findit'] != '' || count($this->partners)>0 ){ ?>
	<div class="hometabs">
		<a id="tab1" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/ou-trouver.png" alt="achat <?=$this->product['name'] ?>"/>&nbsp;&nbsp;Où le trouver ?</a>
	</div>


<? if ($this->product['AE']!='')  $class="where2"; else $class="where";?>
	<div class="<?=$class?>" id="section1">
		
	<? $findit = stripslashes(nl2br($this->product['findit'])); ?>
	<? if (strpos($findit, 'href') === false){ $findit = autolink($findit,$this->product['id']);}?>
	<?=$findit?>
<table border="0">
	
<?php

foreach ($this->partners as $key=>$partner)
{
	echo "<tr><td><br/><a href='".$partner['url']."' target='blank' title='".stripslashes($this->product['name'])." sur eco-sapiens.com'>".stripslashes($this->product['name'])."</a> sur eco-sapiens.com. au prix de ".$partner['price']." €<br/></td>";
	echo "<td><img src='http://www.eco-sapiens.com/xml/imgskill.php?id=".$partner['partnerid']."' alt='plus values eco-sapiens' /></td></tr>";
}

?>	
</table>
	</div>
	<? } ?>
	


<? if ($this->product['AE']!='') { ?>
</div><div class="moitie">

	<div class="hometabs">
		<a id="tab1" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/affichageenvironnemental.png" alt="Affichage environnemental ?"/>&nbsp;&nbsp;Affichage Environnemental</a>
	</div>
	<div class="where2" >
		
		<img src="<?=$GLOBALS['base']?>images/<?=$this->product['AE']?>" alt="affichage environnemental"/>
		
		
	</div>
	

</div>

<?}?>
	
	<? if (count($this->relatedProducts) != 0){ ?>
		<div class="hometabs">
			<a id="tab3" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/folder.png" alt="Produits associés"/>&nbsp;&nbsp;Produits de la même catégorie </a>
		</div>

		<div class="related" id="section3">
			<? foreach ($this->relatedProducts as $row){ ?>
				<div class="relatedproduct">
					<a href="<?=$GLOBALS['base']?><?=toURL($row['name'])?>_p<?=$row['id']?>.html" title="<?php echo $row['name']?>"><img src="fiche-eco-produit-<?php echo toUrl($row['name'])?>-<?php echo $row['id']?>.jpg" alt="Achat responsable <?php echo $row['name']?>"/></a><br/><a href="<?=$GLOBALS['base']?><?=toURL($row['name'])?>_p<?=$row['id']?>.html" title="<?php echo $row['name']?>"><?php echo $row['name'] ?></a>
				</div>
			<? } ?>
		</div>
	<? } ?>	
	
	<div class="hometabs">
		<a id="tab2" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/avis-produit-ecologique.png" alt="Avis produit écologique <?=$this->product['name']?>"/>&nbsp;&nbsp;Vos réactions (<?=count($this->comments)?>)</a>
	</div>

	<div class="comments" id="section2">
		<input type="hidden" id="returnurl" value="<?=urlencode($_SERVER['REQUEST_URI'])?>" />
		<? $this->commentCtrl->renderList($this->comments, $this->product['id']); ?>

		<strong>Donnez votre opinion sur ce produit</strong>
		<form id="form" action="<?=$GLOBALS['base']?>comments/add" method="post">
			<? $captcha = rand(1, 4); ?>
			<input type="hidden" name="key" value="<?=$captcha?>" />
			<input type="hidden" name="type" value="product" />
			<input type="hidden" name="productid" value="<?=$this->product['id']?>" />
			<label for="name" style="display:none">Pseudo</label><input name="name" id="name"/> Votre nom ou pseudo (requis)<br/>
			<label for="email" style="display:none">Email</label><input name="email" id="useremail"/> Votre email (requis, invisible pour les autres visiteurs)<br/>
			<label for="captcha" style="display:none">Tapez ce code (Vérification anti-spam)</label>
			<input name="TzUio23bc" id="captcha"/> Tapez ce code (Vérification anti-spam) : <br/>
		<img src="<?=$GLOBALS['base']?>/captcha/captcha.php" alt="code captcha"/><br/>
			<label for="text" style="display:none">Commentaire</label><textarea name="text" id="text"></textarea><br/>
			<input type="button" onclick="checkCommentAndSubmitForm()" value="Envoyer"/>
		</form>
	</div>

	<? /*if ($this->product['related'] != ''){ 
		<div class="comments" id="section3">
			<?=stripslashes(nl2br($this->product['related']))?>
		</div>
	*/ ?>

</div>
</div>