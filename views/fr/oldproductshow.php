<div itemscope itemtype="http://data-vocabulary.org/Product">

	<div class="productheader">
		<? if ($this->product['image'] != ''){ ?>
			<img class="productimage" src="comparateur-produit-eco-<?=toUrl($this->product['name'])?>-<? echo $this->product['id']; ?>.jpg" alt="Evaluation environnementale <?=stripslashes($this->product['name'])?>"/>
		<? } ?>

		<div class="badge" style='display:none' >

		</div>
		
		

		<span itemprop="brand"><?=$this->product['brand']?></span>
		<span itemprop="name"><?=$this->product['name']?></span>

		<div class="productfeatures">
			<h1>
				<?=stripslashes($this->product['name'])?><br/>
				<? if ($this->product['brand'] != ''){ ?>
					<span class="faded"><?=$this->product['brand']?></span>
				<? } ?>
			</h1>
			<? if ($this->company != null){ ?>
				<strong><a href="<?=$GLOBALS['base']?><?=toURL($this->company['title'])?>_c<?=$this->company['id']?>.html">Voir la page de <?=$this->company['title']?></a></strong><br/>
			<? } ?>
		
		<strong><font color="red">
		<?php if ($this->product['published'] == 'saved') { ?>
		Ce produit est en cours de renotation par nos services.
		<? } else { ?>
		Ce produit n'est plus référencé 
		<?}?>		
		</font></strong>
		
		</div>
		<span class="rating_system">
		
			<div class='rate' style='display:none' >
				<?=$this->rateGlobal;
				if((isset($_SESSION['id']) || isset($_SESSION['email'])|| isset($_SESSION['typecnx'])) ){
					if(!$this->checkRate){
				?>
					<a style='margin: 5px 5px 5px'id="liencnx" href="<?=$GLOBALS['base']?>/views/fr/formRatingProduct.php?product=<?=$this->product['id']?>" >▶ Donnez votre avis</a></br>
					
				<?	}?>
				<?}
				else{
				?>
					<a style='margin: 5px 5px 5px'id="liencnx" href="<?=$GLOBALS['base']?>/compte_ecoacteur/formcnx.php?url=<?=$_SERVER['REQUEST_URI']?>">▶ Donnez votre avis</a></br>
				<?}?>
				<a style='margin: 5px 5px 5px'id="lien" href="#productpanes" onClick="changeTabs('2')" >▶ Lire les avis</a>
			</div>
		</span>
	</div> 

	<div class="productdescription tooltip2">
		<span itemprop="description"><?=stripslashes(checkLink($this->product['description'],0))?></span>
		<div>
			
		</div>
		
		<div class="faded">
			Catégorie(s) : 
			<? foreach ($this->product['categories'] as $key=>$category){ ?>
				<a href="<?=$GLOBALS['base']?><?=toURL($category['name'])?>_r<?=$category['id']?>.html"><?=stripslashes($category['name'])?></a><? if ($key < count($this->product['categories']) - 1){ echo ', ';} ?>
			<? } ?>
		
			<span itemprop="category" content="<? foreach ($this->product['categories'] as $key=>$category){ echo $category['name']; } ?>"/></span>
			
			<? if ($this->product['tags'] != "") { ?>
				<br/>
				Tags : 
				<? 
					$tags = explode (',', $this->product['tags']);
					foreach ($tags as $key=>$tag){
						?>
						<a href="<?=$GLOBALS['base']?>search?keywords=<?=trim($tag)?>"><?=trim(stripslashes($tag))?></a><? if ($key < count($tags) -1){ echo ', ';} ?>
						<?
					}
				?>
			<? } ?>
			
			<? if (count($this->product['labels']) > 0){ ?>
					<br/>
					Label(s) : 
					<? foreach ($this->product['labels'] as $key=>$label) { ?>
						<a href="#" class="tooltip">
						<img alt="<?=$label['name']?>" src="<?=$GLOBALS['base']?>/images/labels_16/<?=$label['image']?>">&nbsp;<?=$label['name']?>&nbsp;<?=$label['referentiel']?>&nbsp;&nbsp;
						<span><?=nl2br($label['description']);?></span></a>
					<? } ?>
			<? } ?>
			
			
			<? if (count($this->product['indicators']) > 0){ ?>
					<br/>
					Impact(s) minimisé(s) : 
					<? foreach ($this->product['indicators'] as $key=>$indicator) { ?>
						<!-- <img alt="<?=$indicator['name']?>" src="<?=$GLOBALS['base']?>/images/labels_16/<?=$indicator['image']?>">&nbsp;-->
						<?=$indicator['name']?><? if ($key < count($this->product['indicators']) -1){ echo ', ';} ?>
					<? } ?>

			<? } ?>
			
			<? if ($this->product['pubdate'] != 0){ ?>
				<br/>Ajouté <? echo $this->formatTime($this->product['pubdate'])?><br/>
			<? } ?>
		</div>
	</div>


	<? if ($this->product['facts'] != ""){ ?> 
		<div class="facts tooltip2">
			<?=stripslashes(checkLink($this->product['facts'],9))?>
		</div>
	<? } ?>
<script type="text/javascript">
	function changeTabs(nb){
		if(nb == 1){
			$("#section2").hide();
			$("#section1").show();
			$("#tab1").removeClass('off');
			$("#tab1").addClass('on');
			$("#tab2").removeClass('on');
			$("#tab2").addClass('off');
		}
		else{
			$("#section1").hide();
			$("#section2").show();
			$("#tab1").removeClass('on');
			$("#tab1").addClass('off');
			$("#tab2").removeClass('off');
			$("#tab2").addClass('on');
		}
	
	}
</script>
	

	<div id="productpanes" style='display:none' >
		<div class="hometabs" style='display:none' >
			<a id="tab1" class="on" href="#productpanes" onClick="changeTabs('1')"><img src="<?=$GLOBALS['base']?>style/rating.png" alt="Notre avis"/>&nbsp;&nbsp;Notre avis</a>
			<a id="tab2" class="off" href="#productpanes" onClick="changeTabs('2')"><img src="<?=$GLOBALS['base']?>style/rating.png" alt="Avis consommateurs"/>&nbsp;&nbsp;Avis consommateurs</a>
		</div>

		<div class="ratings" id="section1">
	
			<!--	
			<?
				if ($ratingId == 4){
					$class = "ratingglobal";
					$prefix = "leaves";
				}else{
					$class = "ratingdetail";
					$prefix = "gauge";
				}	
			?>
			-->
			
			<!-- environnement -->
			<div class="ratingdetail">
				<div class="ratinglabel">
					Environnement
				</div>
				<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/gauge<?=arrondir_demi($this->product['score1'])?>.png" alt="<?=$this->product['score1']?>/5"/>
					&nbsp;&nbsp;<strong><?=arrondir2($this->product['score1']);?> / 5 </strong> 
					<?php $this->displayLifeCycleCompact($this->product['id']); ?>
				</div>
			</div>
			
			<div class="ratingdetail">
				<div class="ratinglabel">
					Sociétal
				</div>
				<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/gauge<?=arrondir_demi($this->product['score2'])?>.png" alt="<?=$this->product['score2']?>/5"/>
					&nbsp;&nbsp;<strong><?=arrondir2($this->product['score2']);?> / 5 </strong>
				
					<?php $this->displayThemescore($this->product['id'],'3,4,5,6,7'); ?>
				</div>
				
			</div>

			<div class="ratingdetail">
				<div class="ratinglabel"> 
					Santé
				</div>
				<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/gauge<?=arrondir_demi($this->product['score3'])?>.png" alt="<?=$this->product['score3'];?>/5"/>
					&nbsp;&nbsp;<strong><?=arrondir2($this->product['score3']);?> / 5 </strong> 
					<?php $this->displayRatingDetail($this->product['id'],'2',0); ?>
				</div>
			
			</div>
			
			<div class="ratingglobal">
				<div class="ratinglabel">
				Total
				</div>
				<div class="ratingcontent">
					<img src="<?=$GLOBALS['base']?>style/leaves<?=round($this->product['score4']*2)/2?>.png" alt="<?=$this->product['score4']?>/5"/>
					&nbsp;&nbsp;<strong><?=$this->product['score4']?> / 5 </strong>
					<? if ($this->product['globalcomment'] != ""){ ?>
						<div class="ratingcomment">
							 <?=stripslashes($this->product['globalcomment'])?>
						</div> 
					<? } ?>	
				</div>
			</div>
		</div>	
		<?
			$rate = new DrawratingCtrl();
		?>

		<div style='display:none' class="ratings" id="section2">
			<? if(count($this->userReviews)>0){
				foreach ($this->userReviews as $key=>$reviews){ ?>
					<div id='userReviews' style='background-color:#eff7ff;border:1px solid #c0e2ff;padding: 8px;margin-bottom: 10px;'>
						<table style='width:100%;border-collapse: separate; border-spacing: 5px 0px; '>
							<tr>
								<td style="width: 20%;border-right:1px solid #c0e2ff;">
									<b>Note :</b>
								</td>
								<td style="width: 50%;border-bottom:1px solid #c0e2ff;">
									<b><? echo $this->userReviews[$key]['titre'];?></b>
								</td>
								<td style='text-align:right;width: 20%'>
									<b><? 
										$date = new DateTime($this->userReviews[$key]['date']);
										echo $date->format('d/m/Y H:i:s');
									?></b>
								</td>
							</tr>
							<tr>
								<td  style="border-right:1px solid #c0e2ff;">
									<? echo $rate->rating_bar($this->product['id'],5,'static','',$this->userReviews[$key]['score']);?>
								</td>
								<td colspan='2' style="Vertical-Align: Top;">
									
									<? echo $this->userReviews[$key]['reponse'];?>
								</td>
								
							</tr>
						</table>
					</div>
				<?}
			}
			else{
				echo "Il n'y a encore aucun avis pour ce produit.";
			}?>
	
		</div>		

		<? if ($this->product['AE']!='') { ?>
			<div class="moitie marginright">
		<?}?>
		
		<? if ($this->product['findit'] != '' || count($this->partners)>0 ){ ?>
			<div class="hometabs">
				<a id="tab1" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/ou-trouver.png" alt="achat <?=$this->product['name'] ?>"/>&nbsp;&nbsp;Où le trouver ?</a>
			</div>
			
		<? if ($this->product['AE']!='')  $class="where2"; else $class="where";?>
			<div class="<?=$class?>" id="section1">
				<? $findit = stripslashes(nl2br($this->product['findit'])); ?>
				<? if (strpos($findit, 'href') === false){ $findit = autolink($findit,$this->product['id']);}?>
				<?=$findit?>
				<table border="0">
					<?php
						foreach ($this->partners as $key=>$partner){
							echo "<tr><td><br/><a href='".$partner['url']."' target='blank' title='".stripslashes($this->product['name'])." sur eco-sapiens.com'>".stripslashes($this->product['name'])."</a> sur eco-sapiens.com. au prix de ".$partner['price']." €<br/></td>";
							echo "<td><img src='http://www.eco-sapiens.com/xml/imgskill.php?id=".$partner['partnerid']."' alt='plus values eco-sapiens' /></td></tr>";
						}
					?>	
				</table>
			</div>
		<? } ?>
		
		<? if ($this->product['AE']!='') { ?>
			</div>
			<div class="moitie">
				<div class="hometabs">
					<a id="tab1" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/affichageenvironnemental.png" alt="Affichage environnemental ?"/>&nbsp;&nbsp;Affichage Environnemental</a>
				</div>
				<div class="where2" >
					<img src="<?=$GLOBALS['base']?>images/<?=$this->product['AE']?>" alt="affichage environnemental"/>
				</div>
			</div>
		<?}?>
		
		<? if (count($this->relatedProducts) != 0){ ?>
			<div class="hometabs">
				<a id="tab3" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/folder.png" alt="Produits associés"/>&nbsp;&nbsp;Produits de la même catégorie </a>
			</div>

			<div class="related" id="section3">
				<? foreach ($this->relatedProducts as $row){ ?>
					<div class="relatedproduct">
						<a href="<?=$GLOBALS['base']?><?=toURL($row['name'])?>_p<?=$row['id']?>.html" title="<?php echo $row['name']?>"><img src="fiche-eco-produit-<?php echo toUrl($row['name'])?>-<?php echo $row['id']?>.jpg" alt="Achat responsable <?php echo $row['name']?>"/></a><br/><a href="<?=$GLOBALS['base']?><?=toURL($row['name'])?>_p<?=$row['id']?>.html" title="<?php echo $row['name']?>"><?php echo $row['name'] ?></a>
					</div>
				<? } ?>
			</div>
		<? } ?>	
	
		<div style='display:none' class="hometabs">
			<a id="tab2" class="on" href="#1"><img src="<?=$GLOBALS['base']?>style/avis-produit-ecologique.png" alt="Avis produit écologique <?=$this->product['name']?>"/>&nbsp;&nbsp;Vos réactions (<?=count($this->comments)?>)</a>
		</div>

		<div style='display:none' class="comments" id="section2">
			<input type="hidden" id="returnurl" value="<?=urlencode($_SERVER['REQUEST_URI'])?>" />
			<? $this->commentCtrl->renderList($this->comments, $this->product['id']); ?>

			<strong>Donnez votre opinion sur ce produit</strong>
			<form id="form" action="<?=$GLOBALS['base']?>comments/add" method="post">
				<? $captcha = rand(1, 4); ?>
				<input type="hidden" name="key" value="<?=$captcha?>" />
				<input type="hidden" name="type" value="product" />
				<input type="hidden" name="productid" value="<?=$this->product['id']?>" />
				<label for="name" style="display:none">Pseudo</label><input name="name" id="name"/> Votre nom ou pseudo (requis)<br/>
				<label for="email" style="display:none">Email</label><input name="email" id="useremail"/> Votre email (requis, invisible pour les autres visiteurs)<br/>
				<label for="captcha" style="display:none">Tapez ce code (Vérification anti-spam)</label>
				<input name="TzUio23bc" id="captcha"/> Tapez ce code (Vérification anti-spam) : <br/>
				<img src="<?=$GLOBALS['base']?>/captcha/captcha.php" alt="code captcha"/><br/>
				<label for="text" style="display:none">Commentaire</label><textarea name="text" id="text"></textarea><br/>
				<input type="button" onclick="checkCommentAndSubmitForm()" value="Envoyer"/>
			</form>
		</div>

		<? /*if ($this->product['related'] != ''){ 
			<div class="comments" id="section3">
				<?=stripslashes(nl2br($this->product['related']))?>
			</div>
		*/ ?>
	</div>
</div>