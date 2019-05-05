<h1>Tableau de bord <?=$_SESSION['user']['username'] ?></h1>

<h2 class="dashboard">Votre page "entreprise engagée"<? if ($this->company != null){ ?> <input type="button" onclick="window.location='<?=$GLOBALS['base']?>companies?action=edit&id=<?=$this->company['id']?>'" value="Modifier" /><? } ?></h2>

<? if ($this->company == null){ ?>

Aucune page "entreprise engagée" n'est rattachée à votre compte.<br/><br/>

<? } else { ?>


		<div class="productheader">
				
			<img class="productimage" src="<?=$GLOBALS['base']?>companies?action=showImage&size=medium&id=<? echo $this->company['id']; ?>" />
			<div class="productfeatures">
				<strong><?=$this->company['title']?></strong><br/>
				Ajoutée <? echo $this->formatTime($this->company['created']) ?><br/>
				<? echo trimText($this->company['text'], 300); ?><br/>
			</div>

		</div>
	<? ?>


<? } ?>

<h2 class="dashboard">Attestations et justificatifs des fiches <font color="#E46C0A">publiées</font> : 
	<? if ($this->nb_justif_1==0 && $this->nb_attestation_1==0) { ?> Aucune <?} else { 
		if ($this->nb_attestation_1 > 0) { ?>
			<input type="button" onclick="window.open('products?action=showproof&mode=2&published=1&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_attestation_1?> Attestation(s)"/>
		<? }
		if ($this->nb_justif_1>0) { ?>
	
	<input type="button" onclick="window.open('products?action=showproof&mode=1&published=1&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_justif_1?> Justificatif(s)" /></h2>
	
<?} }?>
<h2 class="dashboard">Attestations et justificatifs des fiches <font color="#E46C0A">sauvegardées</font> ou <font color="#E46C0A">en attente</font> : 
	<? if ($this->nb_justif_2==0 && $this->nb_attestation_2==0) { ?> Aucune <?} else { 
		if ($this->nb_attestation_2 > 0) { ?>
			<input type="button" onclick="window.open('products?action=showproof&mode=2&published=2&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_attestation_2?> Attestation(s)" />
		<? }
		if ($this->nb_justif_2>0) { ?>
	
	<input type="button" onclick="window.open('products?action=showproof&mode=1&published=2&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_justif_2?> Justificatif(s)" /></h2>
	
<?} }?>

<h2 class="dashboard">Vos fiches produit<? // $this->productsCount ?><input type="button" onclick="window.location='products?action=add'" value="Ajouter un produit" /></h2>


<table class="adminlist">
	<tr>

		<th colspan="2">Produit</th>
		<th>Marque</th>
		<th>Ajoutée</th>
		<th>Statut</th>
		<th class="actions"></th>
	</tr>
	<? $even = false; ?>	
	<? foreach ($this->products as $key=>$product) { ?>
		<? if ($product['referer'] == null){ ?>
			<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">

				<td class="image">
					<? if ($product['image'] != ''){ ?>
						<img src="<?=$GLOBALS['base']?>products?action=showImage&size=thumb&id=<? echo $product['id']; ?>" />
					<? } ?>
				</td>
				<?
					if ($product['referer'] != null || $product['published'] == "deactivated"){
						$class="faded";
					}else{
						$class="";
					}
				?>
				<td class="<?=$class?>">
					<? echo stripSlashes($product['name']) ?> 
				</td>
				<td class="<?=$class?>">
					<? echo stripSlashes($product['brand']) ?>
				</td>
				<td class="<?=$class?>">
					<? echo $this->formatTime($product['created']); ?>
				</td>
				<td class="faded">
					<? if ($product['referer'] == null) { ?>
					<? if ($product['refid'] != 0 && $product['published'] == 'submission'  ){ ?>
						En attente
					<? } else if ($product['published'] == 'submission'){ ?>
						En attente
					<? } else if ($product['published'] == 'saved'){ ?>
						Sauvegardée
					<? } else if ($product['published'] == 'true'){ ?>
						Publiée
					<? } else if ($product['published'] == 'deactivated'){ ?>
						Désactivée
					<? }} ?>
				</td>
				<td class="actions">
						<a href="<?=$GLOBALS['base']?>products?action=show&id=<? echo $product['id'] ?>" title="Afficher"><img src="<?=$GLOBALS['base']?>style/display.gif" alt="Afficher"/></a>&nbsp;&nbsp;
						
						<? if ($product['published'] != 'deactivated') { ?>
							<a href="<?=$GLOBALS['base']?>products?action=edit&id=<? echo $product['id'] ?>&returnurl=<?=urlencode($_SERVER["REQUEST_URI"])?>" title="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; 
						<? } else { ?>
							<img src="<?=$GLOBALS['base']?>style/edit.gif" class="inactive" alt="Modifier"/>&nbsp;&nbsp;
						<? } ?>
							
							<a href="javascript: duplicateProduct(<? echo $product['id'] ?>)" alt="Dupliquer" title="Dupliquer"><img src="<?=$GLOBALS['base']?>style/duplicate.png" alt="Dupliquer"/></a>&nbsp;&nbsp; 

							<a href="javascript: deleteProduct(<? echo $product['id'] ?>)" alt="Supprimer" title="Supprimer"<img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Modifier"/></a>
					
							<? if ($product['published'] == 'true'){ ?>
								<a href="products?action=deactivate&id=<? echo $product['id'] ?>" title="Désactiver"><img src="<?=$GLOBALS['base']?>style/deactivate.png" alt="Désactiver"/></a>
							<? } else if ($product['published'] == 'deactivated'){ ?>
								<a href="products?action=reactivate&id=<? echo $product['id'] ?>" title="Réactiver"><img src="<?=$GLOBALS['base']?>style/reactivate.png" alt="Réactiver"/></a>
							<? } else { ?>
								<img src="<?=$GLOBALS['base']?>style/deactivate.png" class="inactive" alt="Désactiver"/></a>
							<? } ?>
					
				</td>
			</tr>
		<? }?>
	<? } ?>
</table>

