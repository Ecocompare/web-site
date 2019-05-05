<div class="iphonelist">
	<h1 style="width:680px;">Top 20 des produits les plus scannés de la marque <?=$this->brand;?></h1>
</p>
	<link rel="image_src" href="http://www.ecocompare.com/images/comparateur-produit-bio-ecoacteur.png" />
	Cette page permet de lister les produits les plus scannés par les eco-acteurs<br/>
	
	<br/>
	<h2>Classement des produits les plus scannés, référencés ecocompare ou non </h2>
			  
		<? $pageURL = $_SERVER['REQUEST_URI']?>
			<? $pageURL = substr($pageURL,1)?>
			<? foreach ($this->socialNetworks as $row){ ?>
				<a href="<?=$row['url'].$GLOBALS['base'].$pageURL ?>" title="<?=$row['alt']?>" class="socialnetwork"><img src="<?=$row['logo']?>" alt="<?=$row['alt']?>"/></a>
			<? } ?>
	
<br/>
	<table border="1"  >
		<tr class="header"><td>Ean</td><td>Nom</td></tr>
<? $i=1;foreach ($this->products as $key=>$product) { ?>
<tr <?php if($product['ecocompare']!=0) echo "class=\"trselect\"";?>>
	

	<td> &nbsp;<?= $product['ean'];?>&nbsp;</td><td >
		<?php   if($product['ecocompare']!=0) echo "<a href='index.php?ctrl=Product&action=show&id=".$product['ecocompare']."'>";?>
		&nbsp;<?= $product['description'];?>&nbsp;
		<?php if($product['ecocompare']!=0) echo "</a>";?>
		</td>
	
	</tr>
<?}?>
</table>

<p><a href="javascript:history.back()">Retour page précédente</a></p>
<br/>
</div>