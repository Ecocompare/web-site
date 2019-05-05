<?
	$class = "off";
	if ($current == $category['id']){
		$class = "on";
	}
	if (count($category['subcategories']) == 0){
		$hasSubcategories = false;
	}else{
		$hasSubcategories = true;
	}

	if (in_array($category, $currentPath)){
		$tempOpen = "block";
		$tempClosed = "none";
		$tempSubmenu = "block";
	}else{
		$tempOpen = "none";
		$tempClosed = "block";
		$tempSubmenu = "none";
	}
?>

<? $marginLevel = $level - 2; if ($marginLevel < 0){ $marginLevel = 0;}?>

<li class="<?=$class?>" style="padding-left: <?= 8 + 10 * $level?>px; margin-left: <?= -8 ?>px; width: <?=208 - 10 * $level ?>px;">
	
	
	
	<? if (isset($category['icon'])){ ?>
		<img class="disclose" src="<?=$GLOBALS['base']?>style/<?=$category['icon']?>" alt="<?=$category['icon']?>"/>
	<? } else if ($hasSubcategories) { ?>
		<span id="category<?=$category['id']?>on" class="disclose" style="display: <?=$tempOpen?>" onclick="discloseSubmenu('category<?=$category['id']?>')">
			<img src="<?=$GLOBALS['base']?>style/open.gif" alt="ouvert"/>
		</span>
		<span id="category<?=$category['id']?>off" class="disclose" style="display: <?=$tempClosed?>" onclick="discloseSubmenu('category<?=$category['id']?>')">
			<img src="<?=$GLOBALS['base']?>style/closed.gif" alt="fermé"/>
		</span>
	<? } else { ?>
		<img class="disclose" src="<?=$GLOBALS['base']?>style/noarrow.gif" alt="spacer"/>
	<? } ?>
	<?
		if (intval($category['id']) != 0){
			$tempId = toURL($category['name']).'_r'.$category['id'].'.html';
		}else{
			$tempId = $category['id'].'.html';
		}
	?>
	<a class="<?=$class?>" href="<?=$GLOBALS['base']?><?=$tempId?>">
	<? if ($level == 0) {?>
		<strong>
	<? } ?>
	<?=$category['name']?>
	<? if ($level == 0) {?>
		</strong>
	<? } ?>
	</a>

	<? if ($hasSubcategories){ ?>
		<ul id="category<?=$category['id']?>" style="display: <?=$tempSubmenu?>; margin-left: <?=  - 10 * $level ?>px">
			<?
				foreach ($category['subcategories'] as $key=>$subcategory){
					$this->renderMenuItem($subcategory, $level + 1, $current, $currentPath);
				}
			?>
		</ul>
	<? } ?>
</li>
