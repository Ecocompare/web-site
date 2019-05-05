<div id="commentslist">
<? foreach ($comments as $key=>$comment){ ?>
	<div class="comment" name="comment<?=$comment['id']?>">
		<?
			if (isset($comment['product'])){
				?>
					<div class="faded"><strong><?=$comment['product']['name']?></strong></div>
				<?
			}
			
			if (isset($comment['article'])){
				?>
					<div class="faded"><strong><?=$comment['article']['title']?></strong></div>
				<?
			}
			
			if (isset($comment['match'])){
				?>
					<div class="faded"><strong><?=$comment['match']['title']?></strong></div>
				<?
			}			
		?>
		<strong><?=$comment['name']?></strong>
		<? if (admin()){ ?>
			(<a href="mailto: <?=$comment['email']?>"><?=$comment['email']?></a>)
		<? } ?>
		<br/>
		<span class="faded"><?=ucfirst($this->formatTime($comment['date']))?></span><br/>
		<?=nl2br(strip_tags($comment['text']))?><br/>
		<? if (admin()){ ?>
			<? if ($comment['state'] != 'published'){ ?>
				<a href="javascript: validateComment('<?=$comment['id']?>', <?=$productId?>)">Valider</a> |
			<? } ?>
			<a href="javascript: editComment('<?=$comment['id']?>')"> Modifier</a> |
			<a href="javascript: deleteComment('<?=$comment['id']?>', <?=$productId?>)">Supprimer</a>
		<? } ?>
	</div>
<? } ?>
</div>