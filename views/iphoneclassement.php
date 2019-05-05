


<div class="iphonelist">	
	<img src="/images/scanparty/scanning-party-kbane.jpg" alt="Scanning Party">
	<H1 style="width:600px;">Classement de la Scanning PARTY chez KBANE </H1>
	<link rel="image_src" href="http://www.ecocompare.com/images/ecoacteur.png" />
	
	
	<br/><a name="ecoacteurs"/>
	<h2>Classement des eco-acteurs ayant scannés les produits à rechercher,  <?=count($this->users); ?> participant(s)</h2>
			  
		<? $pageURL = $_SERVER['REQUEST_URI']?>
			<? $pageURL = substr($pageURL,1)?>
			<? foreach ($this->socialNetworks as $row){ ?>
				<a href="<?=$row['url'].$GLOBALS['base'].$pageURL ?>" title="<?=$row['alt']?>" class="socialnetwork"><img src="<?=$row['logo']?>" alt="<?=$row['alt']?>"/></a>
			<? } ?>
	
<p>Ce tableau récapitule le classement des 15 premiers eco-acteurs ayant le plus scannés de codes barre uniques pour le mois en cours avec leur smartphone </p>
<br/>
	<table id="tabclassement" style="width:100%;">
		<tr class="header"><td align="left">Position</td><td>Nom</td><td align="center">Nb de scan</td><td align="center">Photo</td></tr>
<? $i=1;foreach ($this->users as $key=>$user) { ?>
<tr >
	<td align="center">
		<!-- <img src="<?=$repertoire=$GLOBALS['base'];?>/images/ecoacteurs/ecoacteur_min_<?=$i;?>.png" border="0" alt="Classement ecoacteur, position <?=$i;?>" title="Classement ecoacteur, position <?=$i;?>"/> -->
		
	<?=$i;?>
		</td>
	<td>&nbsp;<?= $user['name'];?></td><td align="center">

		<?= $user['total'];?>

		</td>
	
<td align="center">
	<?php
	// $this->maxgreen;
	
	$i++;
	$repertoire=$GLOBALS['base'];
	$baseweb="http://www.ecocompare.com/iphone/usersImages/";
	$repertoire="/var/www/vhosts/ecocompare.com/httpdocs/iphone/usersImages/";

//echo $baseweb.$fichier;

	 echo '<img border="0" class="photoecoac" src="ecoacteur-photo-'.$user['id'].'" alt="Image ecoacteur'.$user['name'].'"\>'; 
	 ?>

</td>
	</tr>
<?}?>
</table>
<br/><a name="top15produit">
<h2>Classement des codes barre des produits responsables les plus scannés parmi parmi <?=count($this->eans) ?> scans </h2></a>
		
	
<p>Ce tableau récapitule le classement des codes barre de produits plus responsables (*), les plus scannés pour ce jour par (rafraichissement toutes les 10 minutes).</p>
<br/>
	<table style="width:100%;">
		<tr class="header"><td align="center">Position</td><td>Code EAN</td><td>Libellé</td><td align="center">Nb de scan</td></tr>
<? $i=0;foreach ($this->eans as $key=>$ean) { 	$i++;?>
<tr>
	
	<td align="center" ><?=$i?></td><td><?= $ean['ean'];?></td><td><?= $ean['description'];?></td><td align="center"><?= $ean['total'];?></td>


	</tr>
<?}?>
</table>
<br/>



</div>

