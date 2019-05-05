<li><? for($i = 0; $i < $level; $i++){ echo '&nbsp;&nbsp;&nbsp;&nbsp;'; } ?><?=$category['name']?></li>
<? $previousLevel = $level; ?>
<? $level++; ?>
<? foreach ($category['subcategories'] as $key=>$category){ ?>
<? require('categorysidelistitem.php'); ?>
<? } ?>
<? $level--; ?>