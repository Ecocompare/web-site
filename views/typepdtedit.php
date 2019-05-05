<h1>
<?php
	if ($GLOBALS['action'] == "edit"){
		echo "Modifier ".stripSlashes($this->getFormValue('name'));
	}else {
		echo "Ajouter une catégorie";
	}
?>
</h1>
<div>
<? ?>
<h1>Score ideal de la catégorie <?=$this->type['name'];?> </h1>
<br/>
<h2>Types de produit  </h2>
	<form action="typepdt?action=<? echo $this->targetAction; ?>" method="post" enctype="multipart/form-data">
<table class="adminlist">
	<tr>
		<th>Thème</th>
		<th>Life cycle</th>
		<th>Scoreidéal</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->typeDetails as $key=>$typeDetail) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
					<td><?=$typeDetail['theme']?></td>
					<td><?=$typeDetail['lifecycle']?></td>
						<td><input style="width:40px;" type="text" name="score<?=$typeDetail['id']?>" value="<?=$typeDetail['scoreideal']?>" /></td>
					<td class="actions">
					<!--	<a href="<?=$GLOBALS['base']?>index.php?ctrl=Typepdt&action=edit&id=<? echo $listtype['id'] ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; -->
				
					</td>
				</tr>
			<?
		}
	?>
</table>
	<div class="formbuttons">
			<input type="submit" value="Enregistrer"/> ou <a href="typepdt?action=admin">Annuler</a>
		</div>
</form>
</div>