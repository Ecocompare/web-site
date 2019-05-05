<? ?>
<h1>Matchs produits</h1>

<?=text('Intro matchs')?><br/><br/>

<? foreach ($this->matches as $key=>$match) { ?>
	<a href="<?=$GLOBALS['base']?><?=toURL($match['title'])?>_m<?=$match['id']?>.html">
		<strong><?=$match['title']?></strong>
		<div class="faded">
		<? 
			for ($i = 0; $i < count($match['productids']); $i++){
				global $db;
				$product = $db->getProduct($match['productids'][$i]);
				echo $product['name'];
				if ($i != count($match['productids']) - 1){
					echo '&nbsp;/ ';
				}
			}
		?>
		</div>
	</a>					
	<br/>
<? } ?>
<br/>
