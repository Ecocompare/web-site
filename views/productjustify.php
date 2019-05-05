<? ?>
<h1>Justificatifs fiches produits<? // $this->productsCount ?></h1>


<div id="toolbar">
	
	<div id="toolbarview">
	<select id="users" name="users"  onchange="changeUser()">
		<option value="-1">Tous les utilisateurs</option>
	<? foreach ($this->users as $key=>$user) { ?>
		<option value="<?=$user['userid']?>" <? if (reqOrDefault("userId", "true") == $user['userid']) { echo "selected"; } ?>><?=$user['title']?> (<?=$user['nombre']?>)</option>
	<?}
	?>
	</select>
	
		<select id="products" name="products" onchange="changeProduct()">
				<option value="0">Sélectionner un produit</option>
		<? foreach ($this->products as $key=>$product) { ?>
		<option value="<?=$product['id']?>" <? if (reqOrDefault("productId", "true") == $product['id']) { echo "selected"; } ?>><?=$product['name']?>  (<?=$product['published']?>/<?=$product['nbjustify']?>)</option>
	<?}
	?>
		</select>

		</div>
</div>
<div style="float:left;	margin-bottom: 20px;">
	<? if (count($this->products) >0) { ?>
	<table border="0">
	<tr><td>
Status published : </td><td>
		<input type="button" onclick="window.open('products?action=showproof&mode=2&published=1&userId=<? echo reqOrDefault("userId", "true");?>');" value="Attestation(s) sur l'honneur" />
		<input type="button" onclick="window.open('products?action=showproof&mode=1&published=1&userId=<? echo reqOrDefault("userId", "true");?>');" value="Justificatif(s)" />
	</td></tr>
	<tr><td>
Status saved or submission : </td><td>
		<input type="button" onclick="window.open('products?action=showproof&mode=2&published=2&userId=<? echo reqOrDefault("userId", "true");?>');" value="Attestation(s) sur l'honneur" />
		<input type="button" onclick="window.open('products?action=showproof&mode=1&published=2&userId=<? echo reqOrDefault("userId", "true");?>');" value="Justificatif(s)" />
	</td></tr>
</table>
		
	<?}?>
</div>
<? if (isset($this->product)) { ?>



<h2><?=$this->product['name'] ?></h2>
<img src="<?=$GLOBALS['base']?>products?action=showImage&size=thumb&id=<? echo $this->product['id']; ?>" />
	
<form name="update" method="post" action="<?=$GLOBALS['base']?>products?action=updateJustify" >
<input type="hidden" name="productId" value="<?=$this->product['id'];?>" />
<input type="hidden" name="userId" value="<?=reqOrDefault("userId", "true");?>" />

<table class="adminlist">
	<tr>
		<th style="width:200px;">Justificatif</th>
		<th style="width:200px;">Preuve</th>
  	<th style="width:70px;">Date</th>
  	<th style="width:30px;">Recu</th>
  	<th style="width:100px;">Commentaire</th>
	</tr>
	<? $even = false; $i=0;?>	
	<? foreach ($this->justifs as $key=>$justif) { ?>
	<input type="hidden" name="justif_id[]" value="<?=$justif['subratingid']?>" />

		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
			<tr class="<? echo $class; ?>">

			
			
			<td class="">
				<?=$justif['subratingid'];?> - <? echo stripSlashes($justif['name']) ?> 
			</td>
			<td class="<?=$class?>">
				<? echo stripSlashes($justif['proof_exist']) ?>
			</td>
				<td class="<?=$class?>">
			<input type="text" name="justif_date[]" size="10" style="width:70px;" value="<? echo stripSlashes($justif['bo_date']) ?>"/>
			</td>
				<td class="<?=$class?>">
					<input type="checkbox" name="justif_sent<?=$i;?>" <?if ($justif['bo_received']==1) echo "checked" ?> >
			</td>
	
				<td class="<?=$class?>">
				<textarea style="width:80px;height:20px;" name="justif_comment[]" cols="4" rows="1"><?=$justif['bo_comment']?></textarea>
			</td>
		</tr>
	<? $i++; } ?>
</table>
<br/>
<table class="adminlist">
	<tr>
		<th style="width:200px;">Attestations</th>
		<th style="width:200px;">Preuve</th>
  	<th style="width:70px;">Date</th>
  	<th style="width:30px;">Recu</th>
  	<th style="width:100px;">Commentaire</th>
	</tr>
	<? $even = false; $i=0;?>	
	<? foreach ($this->attestations as $key=>$justif) { ?>
		<input type="hidden" name="attest_id[]" value="<?=$justif['subratingid']?>" />
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
			<tr class="<? echo $class; ?>">

			
			
			<td class="">
				<?=$justif['subratingid'];?> - <? echo stripSlashes($justif['name']) ?> 
			</td>
			<td class="<?=$class?>">
				<? echo stripSlashes($justif['proof_exist']) ?>
			</td>
				<td class="<?=$class?>">
			<input type="text" name="attest_date[]" size="10" style="width:70px;" value="<? echo stripSlashes($justif['bo_date']) ?>"/>
			</td>
				<td class="<?=$class?>">
					<input type="checkbox" name="attest_sent<?=$i;?>" <?if ($justif['bo_received']==1) echo "checked" ?> >
			</td>
	
				<td class="<?=$class?>">
				<textarea style="width:80px;height:20px;" name="attest_comment[]" cols="4" rows="1"><?=$justif['bo_comment']?></textarea>
			</td>
		</tr>
	<? $i++; } ?>
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
	}
?>

<br/>
<input type="button" value="Enregistrer" onclick="document.forms.update.submit();" /> ou <a href="javascript:history.go(-1)">Annuler</a>
<br/><br/>	
<? }?>
	
</div>
