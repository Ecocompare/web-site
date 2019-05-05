<?php
require_once('Controller.php');

class FreeTextCtrl extends Controller{


	function show(){

		global $db;
		$this->freeText = $db->getFreeText(req('id'));
		$this->onload ="";
		$this->currentTab = '';
		$this->title = $this->freeText['id'];
		$this->render('freetextshow.php');
	}

function oldmethodo(){

		global $db;
		$this->freeText = $db->getFreeText(req('id'));
		$this->onload ="";
		$this->freeText['text'] = str_replace( "%category%", $this->listCategory() , $this->freeText['text']);
		$this->currentTab = 'methodo';		
		$this->freeText['text'] = str_replace( "%subratings1%", $this->listSubratings(1) , $this->freeText['text']);
	/*	$this->freeText['text'] = str_replace( "%subratings2%", $this->listSubratings(2) , $this->freeText['text']);
			$this->freeText['text'] = str_replace( "%subratings3%", $this->listSubratings(3) , $this->freeText['text']);*/
		
		$this->rightside=('Methodo_rightside');

		$this->title = $this->freeText['id'];
		$this->render('freetextshow.php');
	}

function methodo(){
		$this->title = "Méthodologie ecocompar sur les axes environnement, santé, éthique, équitable, sociétal";
		$this->currentTab = 'methodo';		
		$this->rightside=('Methodo_rightside');
		$this->render('methodo.php');
	}
	
	
	function demarche(){	
	$this->title = "Présentation de la démarche Ecocompare de transparence produit";	
		$this->currentTab = '';
		$this->render('demarche.php');$this->currentTab = '';
		
	}

	function cgu(){		
		$this->title = "Conditions Générales d'Utilisation du site ecocompare.com";
		$this->currentTab = '';
		$this->render('cgu.php');$this->currentTab = '';
	}
	
	function faq(){
		$this->currentTab = '';
		$this->title = "Foire Aux Questions";
		$this->render('faq.php');
	}
	
	function admin(){
		requireAdmin();
		global $db;
		$this->freeTexts = $db->getFreeTexts();

		$this->currentTab = "admin";
		$this->render('freetextadmin.php');
	}

	function edit(){
		requireAdmin();		
		global $db;
		$this->freeText = $db->getFreeText(req('id'));

		$this->currentTab = "admin";
		$this->render('freetextedit.php');
	}
	
	function update(){
		requireAdmin();	
		global $db;
		$db->updateFreeText(req('id'), req('text'));
		header('Location: content?action=admin');
	}
	
	function send(){
		$to      = 'contact@ecocompare.com';
		$subject = '(Ecocompare) '.reqOrDefault('Sujet', 'Nouveau message');
		$headers = 
			'From: '.reqOrDefault('Nom', '').'<'.reqOrDefault('Email', '').'>'."\n".
    		'Reply-To: '.reqOrDefault('Email', '')."\n";
 		$headers.= "Content-Type: text/plain; charset=UTF-8;";
    	$message = '';
    	foreach($_REQUEST as $key=>$value){
    		if ($key != 'ctrl' && $key != 'action' && $key != 'PHPSESSID' && $key != '__utma' && $key != '__utmb' && $key != '__utmc'){
    			$message .= $key.' : '."\n".$value."\n\n";
    		}
    	}

		if (mail($to, $subject, $message, $headers)){
			header('Location: '.$GLOBALS['base'].'content/show/Message envoye');
		}
	}

	function listSubratings($ratingId){
	
		global $db;
		$subratings = $db->getSubratings($ratingId);
		
		ob_start();

	
		foreach ($subratings as $key=>$subrating){
			?>
				<div class="subratingslist">
					<span>+<?=$subrating['points']?>pts</span>
					<div><?=$subrating['name']?></div>

				</div>
			<?
		}
		
		$rv = ob_get_contents();
		ob_end_clean();
		return $rv;
	}

function listCategory(){
		global $db;
		ob_start();
		//$subratings = $db->getSubratings($ratingId);
		$types=$db->getTypes();
	  include("./views/methodologie.php");
    $rv = ob_get_contents();
		ob_end_clean();
		return $rv;
		
	}
	
}
