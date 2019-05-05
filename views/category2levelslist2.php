<?
$row = 0;
$rows = intval((count($this->categories) + 1)/ 2);
for ($i = 0; $i < count($this->categories); $i++){

	$category = $this->categories[$i];

	if ($row == 0){
		?>
			<div class="column">
		<?
	}

	?>
		<div class="twolevelscategory">
			<a href="<?=$GLOBALS['base']?><?=toURL($category['name'])?>_r<?=$category['id']?>.html"><strong><?=$category['name']?></strong></a><br/>
	<?
	for ($j = 0; $j < count($category['subcategories']); $j++){
		$subcategory = $category['subcategories'][$j];
		?><a class="faded" href="<?=$GLOBALS['base']?><?=toURL($subcategory['name'])?>_r<?=$subcategory['id']?>.html"><?=$subcategory['name']?></a><?
		if ($j < count($category['subcategories']) - 1){
			echo ', ';
		}
	}
	?>
		</div>
	<?
	
	$row++;
	if ($row == $rows){
	
		?>
			</div>
		<?
		$row = 0;
	}
}
if ($row != 0){
	?>
		</div>
	<?
}

?>
<br/>