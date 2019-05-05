<div class="productheader">

	<? if ($this->article['image'] != ''){ ?>
		<img class="productimage" src="<?=$GLOBALS['base']?>articles?action=showImage&size=medium&id=<? echo $this->article['id']; ?>" alt="<?=$this->article['title']?>"/>
	<? } ?>


	<div class="productfeatures">
		<h1><?=$this->article['title']?></h1>
		Ajouté <?=$this->formatTime($this->article['created'])?><br/>
		Tags : <?=$this->article['tags']?>
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
		$html = $this->article['text'];
		$html = str_replace('articleimages/', $GLOBALS['base'].'/articleimages/', $html);
	?>
	<?=$html?><br/>


	<div class="hometabs">
		<a id="tab2" class="on" href="#1" onclick="switchFormSection(2)"><img src="<?=$GLOBALS['base']?>style/comments2.png" alt="Commentaires"/> Vos réactions (<?=count($this->comments)?>)</a>
	</div>
	<div class="comments" id="section2">
		<input type="hidden" id="returnurl" value="<?=urlencode($_SERVER['REQUEST_URI'])?>" />
		<? $this->commentCtrl->renderList($this->comments, $this->article['id']); ?>

		<strong>Donnez votre opinion sur cet article</strong>
		<form id="form" action="<?=$GLOBALS['base']?>comments/add" method="post">
			<input type="hidden" name="key" value="<?=$captcha?>" />
			<input type="hidden" name="type" value="article" />
			<input type="hidden" name="productid" value="<?=$this->article['id']?>" />
			<label for="name" style="display:none">Pseudo</label><input name="name" id="name"/> Votre nom ou pseudo (requis)<br/>
			<label for="email" style="display:none">Email</label><input name="email" id="useremail"/> Votre email (requis, invisible pour les autres visiteurs)<br/>
			<div class="g-recaptcha" data-sitekey="6LfRqVgUAAAAAODPpfNG0UuMNxa1Xd9um5kN3PV-"></div>
		
			<label for="text" style="display:none">Commentaire</label><textarea name="text" id="text"></textarea><br/>
			<input type="button" onclick="checkCommentAndSubmitForm()" value="Envoyer"/>
		</form>
	</div>
	
</div>

