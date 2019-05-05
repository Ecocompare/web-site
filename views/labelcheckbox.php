<div id="labeltable">
<?
	$checked = false;
		if (is_array($selected)){
			foreach ($selected as $key=>$item){
				if ($item['id'] == $label['id']){
					$checked = " checked ";
				}
			}
		}

?>
<input type="checkbox" onclick="alert('ATTENTION : Les justifications automatiques éventuellement liées à ce critère seront rajoutées lors de la sauvegarde de la fiche.')" name="labels[]" value="<? echo $label['id'] ?>"<? echo $checked; ?>/>
<img width="16" height="16" src="<?=$GLOBALS['base']?>images/labels_16/<? echo $label['image'] ?>" alt="<? echo stripSlashes($label['name']) ?>"/>
<? echo stripSlashes($label['name']) ?> <? echo stripSlashes($label['referentiel']) ?>

</div>