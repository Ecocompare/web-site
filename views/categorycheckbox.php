<div id="labeltable">
<?
	for($i = 0; $i < $level * 4; $i++) {
		echo "&nbsp;";
	}
	$checked = false;
	if (is_array($selected)){
		foreach ($selected as $key=>$item){
			if ($item['id'] == $category['id']){
				$checked = " checked ";
			}
		}
	}
?>
<? if ($level > 0) { ?>
	<input type="checkbox" name="categories[]" value="<? echo $category['id'] ?>"<? echo $checked; ?>/>
<? } ?>
<? if ($level == 0){ echo '<strong class="faded">';} ?>

<? if ($lang==1) echo stripSlashes($category['name']); else echo stripSlashes($category['name_en']);?>

<? if ($level == 0){ echo '</strong>';} ?><br/>
<?
	foreach($category['subcategories'] as $key=>$subcategory){
		$this->renderCheckbox($subcategory, $level + 1, $selected,$lang);
	}	
?>
</div>