<h1><?=$_SESSION['user']['username']?>Dashboard </h1>

<h2 class="dashboard">Company description <? if ($this->company != null){ ?> <input type="button" onclick="window.location='<?=$GLOBALS['base']?>companies?action=edit&id=<?=$this->company['id']?>'" value="Edit" /><? } ?></h2>

<? if ($this->company == null){ ?>

No company page attached to your account.<br/><br/>

<? } else { ?>


		<div class="productheader">
				
			<img class="productimage" src="<?=$GLOBALS['base']?>companies?action=showImage&size=medium&id=<? echo $this->company['id']; ?>" />
			<div class="productfeatures">
				<strong><?=$this->company['title']?></strong><br/>
				Ajoutée <? echo $this->formatTime($this->company['created']) ?><br/>
				<? echo trimText($this->company['text'], 300); ?><br/>
			</div>

		</div>
	<? ?>


<? } ?>

<h2 class="dashboard">Supporting evidence & Statement on the honour of <font color="#E46C0A">published</font> products : 
	<? if ($this->nb_justif_1==0 && $this->nb_attestation_1==0) { ?> None <?} else { 
		if ($this->nb_attestation_1 > 0) { ?>
			<input type="button" onclick="window.open('products?action=showproof&mode=2&lang=2&published=1&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_attestation_1?> Certificate(s)"/>
		<? }
		if ($this->nb_justif_1>0) { ?>
	
	<input type="button" onclick="window.open('products?action=showproof&mode=1&lang=2&published=1&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_justif_1?> Proof(s)" /></h2>
	
<?} }?>
<h2 class="dashboard">Supporting evidence & Statement on the honour of <font color="#E46C0A">saved</font> or <font color="#E46C0A">in review</font> products: 
	<? if ($this->nb_justif_2==0 && $this->nb_attestation_2==0) { ?> None <?} else { 
		if ($this->nb_attestation_2 > 0) { ?>
			<input type="button" onclick="window.open('products?action=showproof&lang=2&mode=2&published=2&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_attestation_2?> Certificate(s)" />
		<? }
		if ($this->nb_justif_2>0) { ?>
	
	<input type="button" onclick="window.open('products?action=showproof&mode=1&lang=2&published=2&userId=<? echo $_SESSION['user']['id'];?>');" value="<?=$this->nb_justif_2?> Proof(s)" /></h2>
	
<?} }?>

<h2 class="dashboard">Your products<? // $this->productsCount ?><input type="button" onclick="window.location='products?action=add'" value="Add a product" /></h2>


<table class="adminlist">
	<tr>

		<th colspan="2">Product</th>
		<th>Brand</th>
		<th>Added on</th>
		<th>Status</th>
		<th class="actions"></th>
	</tr>
	<? $even = false; ?>	
	<? foreach ($this->products as $key=>$product) { ?>
		<? if ($product['referer'] == null){ ?>
			<? if ($even == false){ $class = "odd"; $even = true; }else{ $class = "even"; $even = false;} ?>
				<tr class="<? echo $class; ?>">

				<td class="image">
					<? if ($product['image'] != ''){ ?>
						<img src="<?=$GLOBALS['base']?>products?action=showImage&size=thumb&id=<? echo $product['id']; ?>" />
					<? } ?>
				</td>
				<?
					if ($product['referer'] != null || $product['published'] == "deactivated"){
						$class="faded";
					}else{
						$class="";
					}
				?>
				<td class="<?=$class?>">
					<? echo stripSlashes($product['name']) ?> 
				</td>
				<td class="<?=$class?>">
					<? echo stripSlashes($product['brand']) ?>
				</td>
				<td class="<?=$class?>">
					<? echo $this->formatTime($product['created'],$this->lang); ?>
				</td>
				<td class="faded">
					<? if ($product['referer'] == null) { ?>
					<? if ($product['refid'] != 0 && $product['published'] == 'submission'  ){ ?>
						In review
					<? } else if ($product['published'] == 'submission'){ ?>
						In review
					<? } else if ($product['published'] == 'saved'){ ?>
						Saved
					<? } else if ($product['published'] == 'true'){ ?>
						Published
					<? } else if ($product['published'] == 'deactivated'){ ?>
						Desactivated
					<? }} ?>
				</td>
				<td class="actions">
						<a href="<?=$GLOBALS['base']?>products?action=show&id=<? echo $product['id'] ?>" title="Display"><img src="<?=$GLOBALS['base']?>style/display.gif" alt="Display"/></a>&nbsp;&nbsp;
						
						<? if ($product['published'] != 'deactivated') { ?>
							<a href="<?=$GLOBALS['base']?>products?action=edit&id=<? echo $product['id'] ?>&returnurl=<?=urlencode($_SERVER["REQUEST_URI"])?>" title="Modify"><img src="<?=$GLOBALS['base']?>style/edit.gif" alt="Modifify"/></a>&nbsp;&nbsp; 
						<? } else { ?>
							<img src="<?=$GLOBALS['base']?>style/edit.gif" class="inactive" alt="Modify"/>&nbsp;&nbsp;
						<? } ?>
							
							<a href="javascript: duplicateProduct(<? echo $product['id'] ?>,2)" alt="Duplicate" title="Duplicate"><img src="<?=$GLOBALS['base']?>style/duplicate.png" alt="Duplicate" title="Duplicate"/></a>&nbsp;&nbsp; 

							<a href="javascript: deleteProduct(<? echo $product['id'] ?>,0,0,2)" alt="Delete" title="Delete"><img src="<?=$GLOBALS['base']?>style/delete.gif" alt="Delete" title="Delete"/></a>
					
							<? if ($product['published'] == 'true'){ ?>
								<a href="products?action=deactivate&id=<? echo $product['id'] ?>" title="Disable"><img src="<?=$GLOBALS['base']?>style/deactivate.png" alt="Disable" title="Disable"/></a>
							<? } else if ($product['published'] == 'deactivated'){ ?>
								<a href="products?action=reactivate&id=<? echo $product['id'] ?>" title="Enable"><img src="<?=$GLOBALS['base']?>style/reactivate.png" alt="Enable" title="Enable"/></a>
							<? } else { ?>
								<img src="<?=$GLOBALS['base']?>style/deactivate.png" class="inactive" alt="Disable"/></a>
							<? } ?>
					
				</td>
			</tr>
		<? }?>
	<? } ?>
</table>

