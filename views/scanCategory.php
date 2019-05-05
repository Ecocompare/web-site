<div class="iphonelist">	
	
	<H1>Résultats pour : " <?=$this->category;?> " présentés comme écologiques</H1>
<H2>Nombre de produits référencés  : <b><?=($this->ScanTotal)?></b> dont <?=$this->EcoScanCount;?> notés ecocompare, soit <b><?=$this->ScanMoy;?> %</b></h2>
<H2>Nombre d'eco-acteurs participants : <?= $this->UserScanCount ?> </H2>
</p>
	<link rel="image_src" href="http://www.ecocompare.com/images/comparateur-produit-bio-ecoacteur.png" />
	Cette page permet de lister toutes les lessives écologiques recensées par ecocompare et de les afficher par ordre décroissant de scan.
	Les fiches déjà référencées sur ecocompare sont signalées par un fond vert. Les produits les plus demandés (scannés) font l'objet d'une demande d'information auprès des marques<br/>
	
	<br/>
	<h2>Classement des produits les plus scannés, référencés ecocompare ou non </h2>
			  
		<? $pageURL = $_SERVER['REQUEST_URI']?>
			<? $pageURL = substr($pageURL,1)?>
			<? foreach ($this->socialNetworks as $row){ ?>
				<a href="<?=$row['url'].$GLOBALS['base'].$pageURL ?>" title="<?=$row['alt']?>" class="socialnetwork"><img src="<?=$row['logo']?>" alt="<?=$row['alt']?>"/></a>
			<? } ?>
	
<br/>
	<table border="1">
		<tr class="header"><td >Ean</td><td>Nom</td><td>Marque</td></tr>
<? $i=1;foreach ($this->cats as $key=>$cat) { ?>
<tr <?php if($cat['ecocompare']!=0) echo "class=\"trselect\"";?>>
	

	<td><?= $cat['ean'];?></td><td >
		<?php if($cat['ecocompare']!=0) echo "<a href='index.php?ctrl=Product&action=show&id=".$cat['ecocompare']."'>";?>
		<?= $cat['description'];?>
		<?php if($cat['ecocompare']!=0) echo "</a>";?>
		</td><td>
		
			<?= $cat['marque'];?>
			
			</td>
	

	</tr>
<?}?>
</table>

</div>

