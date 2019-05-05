<div class="iphonelist">
	<h1 style="width:680px;">Témoignages des ecoacteurs ayant utilisés l'application mobile</h1>
</p>
	<link rel="image_src" href="http://www.ecocompare.com/images/comparateur-produit-bio-ecoacteur.png" />

	
		<? $pageURL = $_SERVER['REQUEST_URI']?>
			<? $pageURL = substr($pageURL,1)?>
			<? foreach ($this->socialNetworks as $row){ ?>
				<a href="<?=$row['url'].$GLOBALS['base'].$pageURL ?>" title="<?=$row['alt']?>" class="socialnetwork"><img src="<?=$row['logo']?>" alt="<?=$row['alt']?>"/></a>
			<? } ?>
	
<br/>
	<table border="1"  >
		<tr class="header"><td>Sujet</td><td>Message</td><td align="center">Auteur</td><td align="center">Source</td></tr>
<? $i=1;foreach ($this->userReviews as $key=>$userReview) { ?>
<tr>
	<td> &nbsp;<?= $userReview['subject'];?>&nbsp;</td>
	<td> &nbsp;<?= $userReview['description'];?>&nbsp;</td>
	<td align="center"> &nbsp;<?= $userReview['author'];?>&nbsp;</td>
	<td align="center"> &nbsp;<?= $userReview['source'];?>&nbsp;</td>
	</tr>
<?}?>
</table>

<p><a href="javascript:history.back()">Retour page précédente</a></p>
<br/>
</div>