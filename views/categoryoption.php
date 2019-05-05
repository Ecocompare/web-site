<?

	$temp = "";
	if ($selected == $category['id']){
		$temp = " selected ";
	}
?>
<option value="<? echo $category['id'] ?>"<? echo $temp; ?>>
<?
	for($i = 0; $i < $level*2; $i++) {
		echo "&nbsp;";
	}
	echo stripSlashes($category['name']);
	if ($showCount){
		echo ' ('.$category['productscount'].')';
	}
?> 
</option>
<?
	foreach($category['subcategories'] as $key=>$subcategory){
		$this->renderOption($subcategory, $level + 1, $selected, $showCount);
	}	
?>