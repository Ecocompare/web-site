<? ?>
<h1><input type="button" onclick="window.location='labels?action=add'" value="Ajouter un label" />Administration labels</h1>

<h2>Labels (<?php echo count($this->labels); ?> items) </h2>
<table class="adminlist">
	<tr>
		<th>Image</th>
		<th>Nom</th>
		<th>Référentiel</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->labels as $key=>$label) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
					
			
						
					<td><img alt="<?=$label['name']?>" src="<?=$GLOBALS['base']?>/images/labels_16/<?=$label['image']?>"></td>
					<td><?=$label['name']?></td>
					<td><?=$label['referentiel']?></td>
				
					<td><?=$label['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Label&action=edit&id=<? echo $label['id'] ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
								<? if ($db->getAffectedLabelsCount($label['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $label['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>
