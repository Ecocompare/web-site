<?
foreach ($this->categories as $key=>$category){
	?>
		<a href="<?=$GLOBALS['base']?>products/browse/<?=$category['id']?>/"><strong><?=$category['name']?></strong></a><br/>
	<?
	for ($i = 0; $i < count($category['subcategories']); $i++){
		$subcategory = $category['subcategories'][$i];
		?><a class="faded" href="<?=$GLOBALS['base']?>products/browse/<?=$subcategory['id']?>/"><?=$subcategory['name']?></a><?
		if ($i < count($category['subcategories']) - 1){
			echo ', ';
		}else{
			echo '<br/>';
		}
	}
}
?>
<br/>