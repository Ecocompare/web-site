<? ?>
<h1>Textes</h1>

<table class="adminlist">

	<? $even = false; ?>
	<? foreach ($this->freeTexts as $key=>$freeText) { ?>
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
		<tr class="<?=$class?>">
			<td><?=$freeText['id']?></td>
			<td class="actions">
				<a href="content?action=edit&id=<?=$freeText['id']?>" alt="Modifier"><img src="style/edit.gif" alt="Modifier"/></a>
			</td>
		</tr>
	<? } ?>
</table>