<? ?>
<h1><?=$this->max?> codes eans sans description</h1>

<table class="adminlist">

	<? $even = false; ?>
	<tr><td style="width:100px;">EAN</td><td style="width:100px;">Date</td><td style="width:280px;">Description</td><td>Marque</td><td style="width:50px;">produit<br/> resp</td><td style="width:50px;">pas<br/> trouvé</td><td style="width:30px;"></td></tr>
	<? foreach ($this->eans as $key=>$ean) { ?>
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
		
		<tr class="<?=$class?>">
			<form name="maj<?=$ean['ean']?>" action="ean" method="post">
			<input type="hidden" name="action" value="update"/>
			<input type="hidden" name="ean" value="<?=$ean['ean']?>" />
			<td><?=$ean['ean']?></td>
			<td ><?=$ean['date_request']?></td>
			<td><input type="text" name="description"  /></td>
			<td><input type="text" name="marque" value="<?=$ean['marque']?>" style="width:150px;" /></td>
			<td><input type="checkbox" name="produitvert"/></td>
			<td><input type="checkbox" name="introuvable"/></td>
				
			<td class="actions">
				<a href="javascript:document.forms.maj<?=$ean['ean']?>.submit();" alt="Modifier"><img src="style/edit.gif" alt="Modifier"/></a>
			</td>
</form>
		</tr>
	<? } ?>
</table>
