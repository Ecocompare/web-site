<? ?>
<h1><input type="button" onclick="window.location='news?action=add'" value="Ajouter une actualité" />Administration actualités</h1>

<table class="adminlist">
	<tr>
		<th>Titre</th>
		<th>Ajouté</th>
		<th class="actions"></th>
	</tr>
	<? $even = false; ?>
	<? foreach ($this->news as $key=>$new) { ?>
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
		<tr class="<?=$class?>">
			<td><?=$new['title']?></td>
			<td><? echo $this->formatTime($new['created']) ?></td>
			<td class="actions">
				<a href="news?action=edit&id=<?=$new['id']?>" alt="Modifier"><img src="style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; 
				<a href="javascript: deleteNew(<?=$new['id']?>)" alt="Supprimer"><img src="style/delete.gif" alt="Modifier"/></a>
			</td>

		</tr>
	<? } ?>
</table>