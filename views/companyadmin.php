<? ?>
<h1><? if (admin()) { ?><input type="button" onclick="window.location='companies?action=add'" value="Ajouter une entreprise" /><? } ?>Administration entreprises engagées</h1>

<? if (count($this->companies) == 0){ ?>

Aucune page "entreprise engagée" n'est rattachée à votre compte.<br/><br/>

<? } else { ?>
<table class="adminlist">
	<tr>
		<th>Nom</th>
		<th>Ajouté</th>
		<th class="actions"></th>
	</tr>
	<? $even = false; ?>
	<? foreach ($this->companies as $key=>$company) { ?>
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
		<tr class="<?=$class?>">
			<td><?=$company['title']?></td>
			<td><? echo $this->formatTime($company['created']) ?></td>
			<td class="actions">
				<a href="companies?action=edit&id=<?=$company['id']?>" alt="Modifier"><img src="style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
				<? if (admin()){ ?>
					<a href="javascript: deleteCompany(<?=$company['id']?>)" alt="Supprimer"><img src="style/delete.gif" alt="Modifier"/></a>
				<? } ?>
			</td>

		</tr>
	<? } ?>
</table>

<? } ?>