<? 
	$countHtml = "";

	if ($this->productsCount > 0){
		$countHtml = "(Produits ".($this->offset + 1)." à ".min(($this->offset + $this->limit), $this->productsCount)." sur ".$this->productsCount.')';
	}

	if (reqOrDefault('keywords', '') != ''){ 
		?>
			<h1>Résultats de votre recherche "<?=stripslashes(reqOrDefault('keywords', ''))?>"</h1>
		<?
	}else if (reqOrDefault('category', "new") == "new"){
		?>
			<h1>Nouveautés</h1>
		<?
		
		}else if (reqOrDefault('category', "new") == "personnal"){
		?>
			<h1>Recherche personnalisée</h1>
		<?
		
	}else if (reqOrDefault('category', "new") == "selection"){
		?>
			<h1>Produits  responsables : notre sélection</h1>
		<?
	}else if (reqOrDefault('category', "new") == "bad"){
		?>
			<h1>Nous n’avons pas aimé</h1>
		<?
	}else{
		?>
			<h1 style="display: inline"><?=$this->category['name']?></h1> <?=$countHtml?><br/><br/>
		<?
		if ($this->category['text'] != ''){
			?>
				<div class="categorytext">
					<?=nl2br(stripslashes($this->category['text']))?>
				</div>
			<?
		 }
		if (count($this->category['subcategories']) > 0){
			?>
				<div class="categorytext">

					Sous-catégories :
					<? for ($i = 0; $i < count($this->category['subcategories']); $i++){ ?>
						<? $subcategory = $this->category['subcategories'][$i]; ?>
						<h2 style="display: inline"><a href="<?=$GLOBALS['base']?>/products/browse/<?=$subcategory['id']?>"><?=$subcategory['name']?></a></h2><? if ($i < count($this->category['subcategories']) - 1){ echo ', '; } ?>
					<? } ?>

				</div>
			<?
		 }
	}

	



	if (reqOrDefault('category', 'new') != "new" && reqOrDefault('category', 'new') != "selection" && reqOrDefault('category', 'new') != "personnal" && reqOrDefault('category', 'new') != "bad" && reqOrDefault('keywords', '') == ''){
		$tempStyle = "display: block";
 	} else {
 		$tempStyle = "display: none";
 	}

?>

	<div id="browsetoolbar" style="<?=$tempStyle?>">

		
	<!--		<div class="comparebutton"><a id="comparebuttontop" href="#" onclick="compare('<?=$GLOBALS['base']?>products/compare/')"/>Comparer</a><img src="<?=$GLOBALS['base']?>style/resetcompare.gif" id="cancelselection" onClick="deselectAll();"/></div> -->

		
		<div id="browsefilters">
			<input type="hidden" id="category" name="category" value="<?=reqOrDefault('category', '0')?>"/>
			<input type="hidden" id="personnal" name="personnal" value="<?=reqOrDefault('personnal', '')?>"/>
			<input type="hidden" id="previouskeywords" name="previouskeywords" value="<?=reqOrDefault('keywords', '')?>"/>
			<input type="hidden" id="page" name="page" value="<?=reqOrDefault('page', '1')?>"/>
			<? 
				for ($i = 1; reqOrDefault('selection'.$i, '') != ''; $i++){
					?>
						<input type="hidden" id="selection<?=$i?>" name="selection<?=$i?>" value="<?=reqOrDefault('selection'.$i, '')?>"/>
					<?
				}
			?>
			

			<span>Classer par : </span>
			<label style="display: none" for="orderby">Classement</label><? $this->showSelect('orderby', $this->orders, reqOrDefault('orderby', 'pubdate DESC'), 'browseFilter(\''.$GLOBALS['base'].toURL($this->category["name"]).'_r'.$this->category["id"].'.html\')'); ?>
			<span>Label : </span>
			<label style="display: none" for="label">Label</label><? $this->showSelect('label', $this->labels, reqOrDefault('label', ''), 'browseFilter(\''.$GLOBALS['base'].toURL($this->category["name"]).'_r'.$this->category["id"].'.html\')'); ?>

		</div>
	</div>

	<? if ($this->productsCount == 0){ ?>
		<div class="notfound">
			Aucun produit trouvé
		</div>
	<? } ?>

<div id="productslist">

	<? $even = false; ?>	
	<? foreach ($this->products as $key=>$product) { ?>
		<?
			if ($even == false){
				$class = "odd";
				$even = true;
			}else{
				$class = "even";
				$even = false;
			}
		?>
		<div class="<?=$class?>">
		<div class="productslistitem">
			<?
				$checked = '';
				if (in_array($product['id'], $this->selection)){
					$checked = ' checked';
					foreach ($this->selection as $key=>$value){
						if ($value == $product['id']){
							$this->selection[$key] = '';
						}
					}
					echo "removed";
				}
			?>
			<label for="<?=$product['id']?>" style="display: none;">Selectionner</label>
			
			<!-- <input type="checkbox" onkeypress="updateCompareButton()" onclick="updateCompareButton()" onchange="updateCompareButton()" id="<?=$product['id']?>" name="<?=$product['id']?>" <?=$checked?>/> --> 
			<div class="imagecontainer">
				<? if ($product['image'] != ''){ ?>
					<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html">
						<img src="<?=$GLOBALS['base']?>fiche-eco-produit-<?=toUrl($product['name'])?>-<? echo $product['id']; ?>.jpg" alt="comparatif <?=$product['name']?>"/>
					</a>
				<? } else { ?>
					&nbsp;
				<? } ?>
			</div>
			<div class="main">
				<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html">
					<h2 style="display: inline"><?=stripSlashes($product['name'])?></h2>
				</a>
				<strong><?=stripSlashes($product['brand'])?></strong>
				<? if (count($product['labels']) > 0){ ?>
					<? foreach ($product['labels'] as $key=>$label) { ?>
						<span class="label">
							<img alt="<?=$label['name']?>" src="<?=$GLOBALS['base']?>images/labels_16/<?=$label['image']?>">
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
		</div>
	<? } ?>
	<? 
		foreach ($this->selection as $key=>$value){
			if ($value != ''){
				?>
					<input type="checkbox" style="display: none;" id="<?=$value?>" name="<?=$value?>" checked/>
				<?
			}
		}
	?>
</div>

<div id="productslistfooter">
	<!-- <div class="comparebutton"><a id="comparebuttonbottom" href="#" onclick="compare('<?=$GLOBALS['base']?>products/compare/')"/>Comparer</a><img src="<?=$GLOBALS['base']?>style/resetcompare.gif" id="cancelselection" onClick="deselectAll();"/></div> -->

</div>

<div id="pageselector">
	<? 
		$pageUrls = array();
		for ($i = 1; $i <= $this->pages; $i++){

			if (reqOrDefault('orderby', 'created DESC') != 'created DESC' || reqOrDefault('label', '') != '' || reqOrDefault('keywords', '') != '' || reqOrDefault('personnal', '') != '' ){
			
				$url = $GLOBALS['base'].'products/browse/';
				$url .= '?keywords='.reqOrDefault('keywords', '0');
				$url .= '&category='.reqOrDefault('category', '0');
				$url .= '&personnal='.reqOrDefault('personnal', '0');
				$url .= '&orderby='.reqOrDefault('orderby', 'created DESC');
				$url .= '&label='.reqOrDefault('label', '');
				$url .= '&page='.$i;
			}else{
				
				$url = $GLOBALS['base'].'products/browse/';
				$url .= reqOrDefault('category', '0').'/';
				$url .= $i.'/';
			}
			$pageUrls[$i] = "#0"; 
			$onClicks[$i] = "changePage('".$GLOBALS['base']."products/browse/'".", $i)";
		}			
	?>
	
	<? 
		if ($this->pages >= 2){ 
			if (reqOrDefault('page', 1) > 1){ 
				?>
					<a onclick="<?=$onClicks[reqOrDefault('page', 1) - 1]?>" href="<?=$pageUrls[reqOrDefault('page', 1) - 1]?>">« Précédente</a>
				<?
			}
			for ($i = 1; $i <= $this->pages; $i++){
				if (reqOrDefault('page', '1') == $i){
					?>
						<strong><?=$i?></strong>
					<?
				}else{ 
					
					 ?>
						 <a onclick="<?=$onClicks[$i]?>" href="<?=$pageUrls[$i]?>"><?=$i?></a>
					<?
				}
			}
			if (reqOrDefault('page', 1) < $this->pages){ 
				?>
					<a onclick="<?=$onClicks[reqOrDefault('page', 1) + 1]?>" href="<?=$pageUrls[reqOrDefault('page', 1) + 1]?>">Suivante »</a>
				<?
			}		
		}
	?>
</div>