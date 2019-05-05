
<table id="footer_tab">
	<tr>
		<th colspan="5">
			<h1>Accès rapide aux 5 derniers produits:</h1>
		</th>
	</tr>

	<? $i = 0; global $db; $footerCat = $db->getCategoriesParent();?>
	<? foreach ($footerCat as $row) { ?>

	<? if ($i%5 == 0) { ?>
	<tr>
	<? } ?>

		<td class="tdcat">
			<h2><?=$row['name'] ?></h2>

			<? $footerProducts[] = $db->getAllProductsParentsCategories($row['id'], 5);?>
			<? foreach ($footerProducts[$i] as $row1){ ?>
				<a href=" <?=$GLOBALS['base']?><?=toURL($row1['name'])?>_p<?=$row1['id'] ?>.html"><?=$row1['name'] ?></a><br/>
			<? } ?>
		</td>

	<? $i++; ?>
	<? } ?>

	<tr>
		<td colspan="5" id="tdcloud">
			<h1>Nuage de tags :</h1>

			<? $footerTags = $db->getTags(1); ?>
			<? foreach ($footerTags as $row) { ?>
				<a href="<?=$GLOBALS['base']?>search?keywords=<?=urlencode($row['libelle'])?>"><?=str_replace(' ', '&nbsp;',$row['libelle'])?></a>
			<? } ?>
		</td>
	</tr>

	<tr>
		<td colspan="5" id="tdfoot">

		</td>
	</tr>
</table>