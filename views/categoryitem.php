<tr class="<? echo $this->rowClass; ?>">
	<td>
		<? for($i = 0; $i < $level * 8; $i++) { echo "&nbsp;"; } ?>
		<? if ($level == 0){ echo '<strong>';} ?>
		<? echo stripSlashes($category['name']) ?>
		<? if ($level == 0){ echo '</strong>';} ?>
	</td>
	<td>
		<a href="products?action=admin&category=<? echo $category['id']?>"><? echo $category['productscount']; ?></a>
	</td>
	<td class="actions">
		<a href="categories?action=edit&id=<? echo $category['id'] ?>" alt="Modifier"><img src="style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; 
		<a href="javascript: deleteCategory(<? echo $category['id'] ?>)" alt="Supprimer"><img src="style/delete.gif" alt="Modifier"/></a>
	</td>
</tr>
<?
	if ($this->rowClass == "odd"){
		$this->rowClass = "even";
	}else{
		$this->rowClass = "odd";
	}
	
	foreach($category['subcategories'] as $key=>$subcategory){
		$this->renderListItem($subcategory, $level + 1);
	}	
?>
