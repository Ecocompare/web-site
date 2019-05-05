<? ?>
<h1>Administration fiches produits<? // $this->productsCount ?></h1>

<div id="toolbar">
	
	<div id="toolbarview">
	<select id="users" name="users"  onchange="changeDisplay()">
		<option value="0">Tous les utilisateurs</option>
	<? foreach ($this->users as $key=>$user) { ?>
		<option value="<?=$user['userid']?>" <? if (reqOrDefault("userId", "true") == $user['userid']) { echo "selected"; } ?>><?=$user['title']?></option>
	<?}
	?>
	</select>
	
		<select id="published" name="published" onchange="changeDisplay()">
			<option value="saved" <? if (reqOrDefault("published", "true") == "saved") { echo "selected"; } ?> >Fiches sauvegardées</option>
			<option value="submission" <? if (reqOrDefault("published", "true") == "submission") { echo "selected"; } ?> >Fiches en attente</option>
			<option value="deactivated" <? if (reqOrDefault("published", "true") == "deactivated") { echo "selected"; } ?>>Fiches désactivées</option>
			<option value="false" <? if (reqOrDefault("published", "true") == "false") { echo "selected"; } ?>>Fiches non publiées</option>
			<option value="true" <? if (reqOrDefault("published", "true") == "true") { echo "selected"; } ?>>Fiches publiées</option>
		</select>

		<select id="category" name="category" onchange="changeDisplay()">
			<option value="">Toutes catégories</option>
			<? $this->categoryCtrl->showOptions(reqOrDefault('category', 'all'), 0, admin()); ?>
		</select>
		<? $this->showSelect('orderby', $this->orders, reqOrDefault('orderby', 'majdate DESC'), 'changeDisplay()'); ?>
		


	</div>
	<input type="button" onclick="window.location='products?action=add'" value="Ajouter un produit" />

</div>

<table class="adminlist">
	<tr>

		<th></th>
		<th>Nom</th>
		<th>Marque</th>
		<th>Ajoutée</th>
		<th>
<!--<? if (reqOrDefault("published", "true") == "submission") { echo "Mise à jour"; } else { echo "Publiée"; } ?>-->
Mise à jour
		</th>
		
		<th class="actions"></th>
	</tr>
	<? $even = false; ?>	
	<? foreach ($this->products as $key=>$product) { ?>
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
			<tr class="<? echo $class; ?>">

			<td class="image">
				<? if ($product['image'] != ''){ ?>
					<img src="<?=$GLOBALS['base']?>products?action=showImage&size=thumb&id=<? echo $product['id']; ?>" />
				<? } ?>
			</td>
			<?
				if ($product['referer'] != null){
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
			
			<td class="<?=$class?>">
				 <? //if ($product['pubdate'] != 0 && reqOrDefault("published", "true") != "submission") { echo $this->formatTime($product['pubdate']);} 
				//if ($product['majdate'] != 0 && reqOrDefault("published", "true") == "submission") { 
				if ($product['majdate'] != 0 ) { 
					
				if ($product['majuserid']!=$_SESSION['user']['id']) {echo "<b>".$this->formatTime($product['majdate'])."</b>";} else {echo $this->formatTime($product['majdate']);}
			}
				
				?>
				
				
			</td>

			<td class="actions">
					<? if ($class!="faded") { ?>
			
					<a href="<?=$GLOBALS['base']?>products?action=show&id=<? echo $product['id'] ?>" alt="Afficher"><img src="<?=$GLOBALS['base']?>style/display.gif" alt="Afficher"/></a>&nbsp;&nbsp; 
					<a href="<?=$GLOBALS['base']?>products?action=edit&id=<? echo $product['id'] ?>&returnurl=<?=urlencode($_SERVER["REQUEST_URI"])?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; 
					<a href="javascript: duplicateProduct(<? echo $product['id'] ?>,'<? echo reqOrDefault("published", "true"); ?>','<? echo reqOrDefault("page", "0"); ?>')" alt="Dupliquer"><img src="<?=$GLOBALS['base']?>style/duplicate.png" alt="Dupliquer"/></a>&nbsp;&nbsp; 
	
					<? if (admin()){ ?>
						<a href="javascript: deleteProduct(<? echo $product['id'] ?>,'<? echo reqOrDefault("published", "true"); ?>','<? echo reqOrDefault("page", "0"); ?>')" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Modifier"/></a>
					<? } ?>
					<? } ?>
			</td>
		</tr>
	<? } ?>
</table>

<div id="pageselector">
	<?
	$totalPages = ($this->productsCount + 49) / 50;
	for($i = 1; $i < $totalPages; $i++) {
		if ($i == reqOrDefault("page", 1)){
			echo '&nbsp;&nbsp;<strong>'.$i.'</strong>';
		}else{
			echo '&nbsp;&nbsp;'.'<a href="'.$GLOBALS['base'].'products?action=admin&category='.reqOrDefault('category', '').'&orderby='.reqOrDefault('orderby', 'created DESC').'&published='.reqOrDefault('published', 'true').'&page='.$i.'">'.$i.'</a>';
		}
	}?>
</div>