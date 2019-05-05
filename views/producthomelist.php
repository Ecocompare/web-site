	<? foreach ($this->products as $key=>$product) { ?>


<div class="carrousel-item">

			<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html">
			<img border="0" src="fiche-eco-produit-<?=toUrl($product['name'])?>-<? echo $product['id']; ?>.jpg" alt="Produit responsable <?=$product['name']?>" class="carrousel-image"/>
			</a>
			<img src="<?=$GLOBALS['base']?>style/gauge<?=arrondir_demi($product['score4'])?>.png" alt="<?=$product['score4']?>/5"/>
			<a href="<?=$GLOBALS['base']?><?=toURL($product['name'])?>_p<?=$product['id']?>.html"><?=stripSlashes($product['name'])?> - <?=stripSlashes($product['brand'])?></a>

				
			</div>
			
<?	} ?>
			
