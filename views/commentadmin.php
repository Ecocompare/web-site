<h1>Administration commentaires</h1>

<input type="hidden" id="returnurl" value="<?=urlencode($_SERVER['REQUEST_URI'])?>" />

<? $this->renderList($this->comments); ?>
