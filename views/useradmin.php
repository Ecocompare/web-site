<? ?>
<h1><input type="button" onclick="window.location='categories?action=add'" value="Ajouter un utilisateur" />Administration utilisateurs</h1>

<table class="adminlist">
	<tr>
		<th>Nom</th>
		<th>Email</th>
		<th class="actions"></th>
	</tr>
	<?
		$this->rowClass = "odd";
		foreach ($this->users as $key=>$user) {
			?>
				<tr class="<?=$this->rowClass?>">
					<td><?=$user['username']?></td>
					<td><a href="mailto:<?=$user['email']?>"><?=$user['email']?></a></td>				
					<td class="actions">
						<a href="edit?id=<?=$user['id']?>" alt="Modifier"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifier"/></a>&nbsp;&nbsp; 
						<a href="javascript: deleteUser(<?=$user['id']?>)" alt="Supprimer"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Modifier"/></a>
					</td>
				</tr>	
			<?
			if ($this->rowClass == "odd") {
				$this->rowClass = "even";
			}else{
				$this->rowClass = "odd";
			}
		}
	?>
</table>