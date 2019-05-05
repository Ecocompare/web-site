<div class="productheader">

	<!--<? if ($this->article['image'] != ''){ ?>
		<img class="productimage" src="<?=$GLOBALS['base']?>articles?action=showImage&size=medium&id=<? echo $this->article['id']; ?>" alt="<?=$this->article['title']?>"/>
	<? } ?>
-->

	<div class="productfeatures">
		<h1><?=$this->new['title']?></h1>
		Ajouté <?=$this->formatTime($this->new['created'])?><br/>
		Tags : <?=$this->new['tags']?>
	</div>
	
	<div class="socialnetworks">
			<? $pageURL = $_SERVER['REQUEST_URI']?>
			<? $pageURL = substr($pageURL,1)?>
			<? foreach ($this->socialNetworks as $row){ ?>
				<a href="<?=$row['url'].$GLOBALS['base'].$pageURL ?>" title="<?=$row['alt']?>" class="socialnetwork"><img src="<?=$row['logo']?>" alt="<?=$row['alt']?>"/></a>
			<? } ?>
		</div>
		
		
</div> 


<div class="articlehtml">
	<?
		$html = $this->new['text'];
		//$html = str_replace('articleimages/', $GLOBALS['base'].'/articleimages/', $html);
	?>
	<?=$html?><br/>

<div class="more"><a href="<?=$GLOBALS['base']?>news/browse/">» Voir toutes les actualités</a></div>


</div>


	
	



