<h2>Catégories</h2>
<? $level = 0; ?>
<? foreach ($this->categories as $key=>$category){ ?>
<? require('categorysidelistitem.php'); ?>
<? } ?>