<? ?>
<h1><input type="button" onclick="window.location='articles?action=add'" value="Ajouter un article" />Administration dossiers conseil</h1>

<table class="adminlist">
	<tr>
		<th>Titre</th>
		<th>Ajouté</th>
		<th class="actions"></th>
	</tr>
	<? $even = false; ?>
	<? foreach ($this->articles as $key=>$article) { ?>
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
		<tr class="<?=$class?>">
			<td><?=$article['title']?></td>
			<td><? echo $this->formatTime($article['created']) ?></td>
			<td class="actions">
				<a href="articles?action=edit&id=<?=$article['id']?>" alt="Modifier"><img src="style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; 
				<a href="javascript: deleteArticle(<?=$article['id']?>)" alt="Supprimer"><img src="style/delete.gif" alt="Modifier"/></a>
			</td>

		</tr>
	<? } ?>
</table>