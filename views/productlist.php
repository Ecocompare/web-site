	<? foreach ($this->products as $key=>$product) { ?>

		<div class="<?=$class?>">
		<div class="productslistitem">
			<?
				$checked = '';
				if (isset($this->selection) && in_array($product['id'], $this->selection)){
					$checked = ' checked';
					foreach ($this->selection as $key=>$value){
						if ($value == $product['id']){
							$this->selection[$key] = '';
						}
					}
					echo "removed";
				}
			?>
			<div class="imagecontainer">
				<? if ($product['image'] != ''){ ?>
					<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html">
					
							<img src="fiche-eco-produit-<?=toUrl($product['name'])?>-<? echo $product['id']; ?>.jpg" alt="Produit ecolo <?=$product['name']?>"/>
					</a>
				<? } else { ?>
					&nbsp;
				<? } ?>
			</div>
			<div class="main">
				<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html">
					<strong><?=stripSlashes($product['name'])?></strong>
				</a>
				<? if ($product['brand'] != ''){ ?>
					<strong><?=stripSlashes($product['brand'])?></strong>
				<? } ?>
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
					<span class="faded">|</span> <a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html#section2"> <?=$product['commentscount']?> commentaire(s)</a>
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
							
							
									<img src="<?=$GLOBALS['base']?>style/<?=$prefix?><?=arrondir_demi($product['score'.$ratingLabel['id']])?>.png" alt="<?=$product['score'.$ratingLabel['id']]?>/5"/>
								
						
						
							</div>
						</div>
			
				<? } ?>
			</div>
		</div>
		</div>
	<? } ?>