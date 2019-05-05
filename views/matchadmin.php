<? ?>
<h1><input type="button" onclick="window.location='matches?action=add'" value="Ajouter un match" />Administration matchs</h1>

<table class="adminlist">
	<tr>
		<th>Match</th>
		<th class="actions"></th>
	</tr>
	<? $even = false; ?>	
	<? foreach ($this->matches as $key=>$match) { ?>
		<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
			<tr class="<? echo $class; ?>">
			<td>
				<?=$match['title']?>
				<? /* 
					for ($i = 0; $i < count($match['productids']); $i++){
						global $db;
						$product = $db->getProduct($match['productids'][$i]);
						echo $product['name'];
						if ($i != count($match['productids']) - 1){
							echo ' / ';
						}
					}
				*/?>
			</td>
			<td class="actions">
				<a href="<?=$GLOBALS['base']?>matches/edit?id=<? echo $match['id'] ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; 
				<a href="javascript: deleteMatch(<? echo $match['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Modifier"/></a>
			</td>
		</tr>
	<? } ?>
</table>