<? ?>
<h1>Administration Types de produit</h1>
<br/>
<h2>Types de produit  </h2>
<table class="adminlist">
	<tr>
		<th>Nom</th>
		<th>Commentaire</th>
		<th class="Actions">Actions</th>
		
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->listTypes as $key=>$listtype) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
					<td><?=$listtype['name']?></td>
					<td><?=$listtype['comment']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Typepdt&action=edit&id=<? echo $listtype['id'] ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
				<a href="<?=$GLOBALS['base']?>index.php?ctrl=Typepdt&action=excel&lang=1&id=<? echo $listtype['id'] ?>"><img src="<?=$GLOBALS['base']?>images/picto_excel.gif" alt="export excel FR" border="0"/> FR</a>
					<a href="<?=$GLOBALS['base']?>index.php?ctrl=Typepdt&action=excel&lang=2&id=<? echo $listtype['id'] ?>"><img src="<?=$GLOBALS['base']?>images/picto_excel.gif" alt="export excel EN" border="0"/> EN</a></td>

				</tr>
			<?
		}
	?>
</table>
