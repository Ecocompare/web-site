<? ?>
<h1><input type="button" onclick="window.location='categories?action=add'" value="Ajouter une catégorie" />Administration catégories</h1>

<table class="adminlist">
	<tr>
		<th>Catégorie</th>
		<th># Produits</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		foreach ($this->categories as $key=>$category) {
			$this->renderListItem($category, 0);
		}
	?>
</table>