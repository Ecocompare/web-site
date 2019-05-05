<table border="0" width="100%">
	<tr valign="top">
		<td>
<h1><input type="button" onclick="window.location='subratings?action=add&lang=<?=$this->lang?>'" value="Add" />Criterias</h1> <a href="subratings?action=export&lang=1" target='_blank'><img src="<?=$GLOBALS['base']?>images/picto_excel.gif" alt="export excel" border="0"/>FR</a><a href="subratings?action=export&lang=2" target='_blank'><img src="<?=$GLOBALS['base']?>images/picto_excel.gif" alt="export excel" border="0"/>EN</a>
<td>
	<a href="subratings?action=admin&lang=1">View FR</a> <a href="subratings?action=admin&lang=2">View EN</a>
	<td>
		
	</tr>
</table>
<font size="+1">
<a href="#sante">Health</a> <a href="#qualite">Quality</a> <a href="#social">Social</a> <a href="#ethique">Ethics</a> <a href="#equitableN">Fairtrade N/N</a> <a href="#equitableS">Fairtrade N/S</a>
</font><br/><br/>
<h2>Environment (<?php echo count($this->envSubratings); ?> items) </h2>
<table class="adminlist">
	<tr>
		<th>LifeCycle</th>
		<th>Heading</th>
		<th>Name</th>
		<th>Points</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->envSubratings as $key=>$subrating) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
					<td><?=$subrating['lifecycle']?></td>
					<td><?=$subrating['heading']?></td>
					<td><?=$subrating['name']?></td>
					<td><?=$subrating['points']?></td>
					<td><?=$subrating['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Subrating&action=edit&id=<? echo $subrating['id'] ?>&lang=<? echo $this->lang; ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
						<?
							global $db;
							if ($db->getAffectedProductsCount($subrating['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $subrating['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>
<a name="sante">
<h2>Health (<?php echo count($this->santeSubratings); ?> items)</h2></a>
<table class="adminlist">
	<tr>

		<th>Heading</th>
		<th>Name</th>
		<th>Points</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->santeSubratings as $key=>$subrating) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
				
					<td><?=$subrating['heading']?></td>
					<td><?=$subrating['name']?></td>
				 <td><?=$subrating['points']?></td>
				 	<td><?=$subrating['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Subrating&action=edit&id=<? echo $subrating['id'] ?>&lang=<? echo $this->lang; ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
						<?
							global $db;
							if ($db->getAffectedProductsCount($subrating['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $subrating['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>
<a name="qualite">
<h2>Quality (<?php echo count($this->qualiteSubratings); ?> items)</h2></a>
<table class="adminlist">
	<tr>
	
		<th>Heading</th>
		<th>Name</th>
		<th>Points</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->qualiteSubratings as $key=>$subrating) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
			
					<td><?=$subrating['heading']?></td>
					<td><?=$subrating['name']?></td>
				  <td><?=$subrating['points']?></td>
				  	<td><?=$subrating['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Subrating&action=edit&id=<? echo $subrating['id'] ?>&lang=<? echo $this->lang; ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
						<?
							global $db;
							if ($db->getAffectedProductsCount($subrating['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $subrating['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>
<a name="social">
<h2>Social (<?php echo count($this->socialSubratings); ?> items)</h2></a>
<table class="adminlist">
	<tr>
	
		<th>Heading</th>
		<th>Name</th>
		<th>Points</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->socialSubratings as $key=>$subrating) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
				
					<td><?=$subrating['heading']?></td>
					<td><?=$subrating['name']?></td>
				  <td><?=$subrating['points']?></td>
				  	<td><?=$subrating['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Subrating&action=edit&id=<? echo $subrating['id'] ?>&lang=<? echo $this->lang; ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
						<?
							global $db;
							if ($db->getAffectedProductsCount($subrating['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $subrating['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>
<a name="ethique">
<h2>Ethics (<?php echo count($this->ethiqueSubratings); ?> items)</h2></a>
<table class="adminlist">
	<tr>
	
		<th>Heading</th>
		<th>Name</th>
		<th>Points</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->ethiqueSubratings as $key=>$subrating) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
				
					<td><?=$subrating['heading']?></td>
					<td><?=$subrating['name']?></td>
				  <td><?=$subrating['points']?></td>
				  	<td><?=$subrating['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Subrating&action=edit&id=<? echo $subrating['id'] ?>&lang=<? echo $this->lang; ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
						<?
							global $db;
							if ($db->getAffectedProductsCount($subrating['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $subrating['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>
<a name="equitableN">
<h2>Fairtrade North/North(<?php echo count($this->equitableNordSubratings); ?> items)</h2></a>
<table class="adminlist">
	<tr>
	
		<th>Heading</th>
		<th>Name</th>
		<th>Points</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->equitableNordSubratings as $key=>$subrating) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
				
					<td><?=$subrating['heading']?></td>
					<td><?=$subrating['name']?></td>
				  <td><?=$subrating['points']?></td>
				  	<td><?=$subrating['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Subrating&action=edit&id=<? echo $subrating['id'] ?>&lang=<? echo $this->lang; ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
						<?
							global $db;
							if ($db->getAffectedProductsCount($subrating['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $subrating['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>

<a name="equitableS">
<h2>Fairtrade North/South (<?php echo count($this->equitableSudSubratings); ?> items)</h2></a>
<table class="adminlist">
	<tr>
	
		<th>Heading</th>
		<th>Name</th>
		<th>Points</th>
		<th>Id</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		$even = false;
		foreach ($this->equitableSudSubratings as $key=>$subrating) {
			?>
				<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">
				
					<td><?=$subrating['heading']?></td>
					<td><?=$subrating['name']?></td>
				  <td><?=$subrating['points']?></td>
				  	<td><?=$subrating['id']?></td>
					<td class="actions">
						<a href="<?=$GLOBALS['base']?>index.php?ctrl=Subrating&action=edit&id=<? echo $subrating['id'] ?>&lang=<? echo $this->lang; ?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp;
						<?
							global $db;
							if ($db->getAffectedProductsCount($subrating['id']) == 0) {
								?>
									<a href="javascript: deleteSubrating(<? echo $subrating['id'] ?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Supprimer"/></a>
								<?
							}
						?>
					</td>
				</tr>
			<?
		}
	?>
</table>