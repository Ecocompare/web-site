
<? 
	if ($this->match != null) {
		echo '<h1>'.$this->match['title'].'</h1>';
		echo $this->match['intro'].'<br/><br/>';
	}else{
		echo "<h1>Comparaison produits</h1>";
	}
?>
</h1>

<? if (count($this->products) == 0){ ?>
	<div class="notfound">
			Aucun produit selectionné
	</div>
<? } ?>

<? 
	$columns = array();
	$titles = array();
	$titles[] = "";
	$titles[] = "Produit";
	$titles[] = "Marque";
	$titles[] = "Fabrication";
	$titles[] = "Utilisation";
	$titles[] = "Fin de vie";	
	$titles[] = "Note&nbsp;globale";
	$titles[] = "Labels";
	$titles[] = "Prix";
	$columns[] = $titles;
	
	foreach($this->products as $key=>$product){
		$item = array();
		
		$tempHTML = '';
		
		if ($product['image'] != ''){
			$tempHTML .= '<a href="'.$GLOBALS['base'].toURL($product['name']).'_p'.$product['id'].'.html">';
			$tempHTML .= '<img src="'.$GLOBALS['base'].'products?action=showImage&size=medium&id='.$product['id'].'" alt="'.stripslashes($product['name']).'"/>';
			$tempHTML .= '</a>';
		}
		$item[] = $tempHTML;
		
		$item[] = '<a href="'.$GLOBALS['base'].toURL($product['name']).'_p'.$product['id'].'.html">'.stripslashes($product['name']).'</a>';
		$item[] = $product['brand'];
		
		$ratingLabels = array();
		$ratingLabels[1] = "Fabrication";
		$ratingLabels[2] = "Utilisation";
		$ratingLabels[3] = "Fin de vie";
		$ratingLabels[4] = "Note globale";

		foreach ($ratingLabels as $ratingId => $ratingLabel){
			$tempHTML = '';
			if ($product['rating'.$ratingId] != -1){
				if ($product['rating'.$ratingId.'enabled'] == "true"){
				if ($ratingId == 4){
					$tempHTML .= '<img src="'.$GLOBALS['base'].'style/leaves'.round($product['rating'.$ratingId]).'.png" class="gauge" alt="'.$product['rating'.$ratingId].' / 5"/><br/>'.$product['rating'.$ratingId].' / 5';
					
				}else{
					$tempHTML .= '<img src="'.$GLOBALS['base'].'style/gauge'.arrondir($product['rating'.$ratingId]).'.png" class="gauge" alt="'.arrondir($product['rating'.$ratingId]).'/5"/>';
						/*<img src="<?=$GLOBALS['base']?>style/<?=$prefix?><?=$product['score'.$ratingLabel['id']]?>.png" alt="<?=$product['rating'.$ratingLabel['id']]?>/5"/>*/
				$tempHTML .= '  <span class="faded">'.$product['score'.$ratingId].'&nbsp;/&nbsp;'.$product['maxscore'.$ratingId].'</span>';		
				}

				
				
				$tempHTML .= '<br/>';
				}
				$tempHTML .= stripslashes($product['rating'.$ratingId.'comment']);
				$tempHTML .= $this->displayRatingDetailCompact($product,$ratingId);
			}
			$item[] = $tempHTML;
		}

		$tempHTML = '';
		foreach ($product['labels'] as $key=>$label) {
			$tempHTML .= '<img src="'.$GLOBALS['base'].'/style/label'.$label['id'].'.gif">&nbsp;'.$label['name'].'<br/>';
		}

		$item[] = $tempHTML;
		$item[] = $product['price'];
		$columns[] = $item;
	}
?>
<div class="matchhtml">
<table id="compare">

<? for ($i = 0; $i < 9; $i++){ ?>
	<tr class="tr<?=$i?>">
	<?
		$th = true;
		$class = 'even';
	?>
	<? foreach ($columns as $key=>$column) { ?>
		<? if ($th == true) { ?>
			<th>
			<? $th = false; ?>
		<? } else{ ?>
			<td class="<?=$class?>">
		<? } ?>
			<?=$column[$i]?>
		</td>
		<?
			if ($class == 'even'){
				$class = 'odd';
			}else{
				$class = 'even';
			}
		?>
	<? } ?>
	</tr>
<? } ?>

</table>

	<?
	if ($this->match != null) {
		echo '<div class="matchconclusion">'.$this->match['conclusion'].'<br/><br/></div>';
	}
	?>


	<? if ($this->match != null) { ?>
	<div class="hometabs">
		<a id="tab2" class="on" href="#1" onclick="switchFormSection(2)"><img src="<?=$GLOBALS['base']?>style/comments2.png" alt="Commentaires"/> Vos réactions (<?=count($this->comments)?>)</a>
	</div>
	<div class="comments" id="section2">
		<input type="hidden" id="returnurl" value="<?=urlencode($_SERVER['REQUEST_URI'])?>" />
		<? $this->commentCtrl->renderList($this->comments, $this->match['id']); ?>

		<strong>Donnez votre opinion sur cet article</strong>
		<form id="form" action="<?=$GLOBALS['base']?>comments/add" method="post">
			<? $captcha = rand(1, 4); ?>
			<input type="hidden" name="key" value="<?=$captcha?>" />
			<input type="hidden" name="type" value="match" />
			<input type="hidden" name="productid" value="<?=$this->match['id']?>" />
			<label for="name" style="display:none">Pseudo</label><input name="name" id="name"/> Votre nom ou pseudo (requis)<br/>
			<label for="email" style="display:none">Email</label><input name="email" id="useremail"/> Votre email (requis, invisible pour les autres visiteurs)<br/>
			<label for="captcha" style="display:none">Tapez ce code (Vérification anti-spam)</label><input name="captcha" id="captcha"/> Tapez ce code (Vérification anti-spam) : <img src="<?=$GLOBALS['base']?>captcha/captcha<?=$captcha?>.png"/><br/>
			<label for="text" style="display:none">Commentaire</label><textarea name="text" id="text"></textarea><br/>
			<input type="button" onclick="checkCommentAndSubmitForm()" value="Envoyer"/>
		</form>
	</div>
	
	<? } ?>
</div>