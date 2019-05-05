<?php
require_once('Controller.php');

class MatchCtrl extends Controller{
	
	function admin(){
		global $db;
		$this->matches = $db->getMatches();

		$this->currentTab = "admin";
		$this->title = "Administration";
		$this->render('matchadmin.php');

	}


	function show(){
		global $db;
		require_once('CommentCtrl.php');
		$this->commentCtrl = new CommentCtrl;
		$this->products = array();
		$this->match = $db->getMatch($_REQUEST['matchid']);
		
		/*for ($i = 1; $i <=5; $i++){
			if (reqOrDefault('selection'.$i, 0) != 0){
				$this->products[] = $db->getProduct(reqOrDefault('selection'.$i, 0));
			}
		}*/
		
		foreach ($this->match['productids'] as $key=>$productId){
			$this->products[] = $db->getProduct($productId);
		}
		
		$this->comments = $db->getComments('match', req('matchid'));
		
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		
		$this->currentTab = "matches";
		
		$this->title = $this->match['title'];;
		$this->render('productcompare.php');
	}

	function browse(){
		global $db;
		$this->matches = $db->getMatches();
		
		$this->currentTab = "matches";	
		$this->title = "Matchs produits";
		$this->render('matchbrowse.php');
	}
	
	function add(){
		global $db;
		$this->products = $db->getProducts("", "", 'true', 0, 999999);
		$this->currentTab = "admin";
		$this->title = "Administration";
		$this->targetAction = "create";
		$this->render('matchedit.php');

	}

	function edit(){
		global $db;
		$this->formValues = $db->getMatch(req('id'));
		$this->products = $db->getProducts("", "", 'true', 0, 999999);
		$this->currentTab = "admin";
		$this->title = "Administration";
		$this->targetAction = "update";
		$this->render('matchedit.php');

	}
	
	function delete(){
		global $db;
		$db->deleteMatch(req('id'));
	}

	function create(){
		global $db;
		$id = $db->addMatch(addslashes(req('title')));
		$db->updateMatch($id, array("title" => req('title'), "intro" => req('intro'), "conclusion" => req('conclusion')));
		$db->setMatchProducts($id, req('productids'));
		header('Location: '.$GLOBALS['base'].'matches/admin');
	}
	
	function update(){
		global $db;
		$id = req('id');
		$db->updateMatch($id, array("title" => req('title'), "intro" => req('intro'), "conclusion" => req('conclusion')));
		$db->setMatchProducts($id, req('productids'));
		header('Location: '.$GLOBALS['base'].'matches/admin');
	}
	
	function renderCheckbox($label, $selected){
		include("./views/labelcheckbox.php");
	}

	function displayRatingDetailCompact($product, $ratingId){

	
		global $db;
		$subratings = $db->getSubratings($ratingId);
		
		if (count($subratings) == 0){
			return;
		}
		
		ob_start();
		
		$total = 0;
		foreach ($subratings as $key=>$subrating){
			if (in_array($subrating['id'], $product['subratings'])){
				$total++;
				?>
					<div class="shortsubrating">
						<?=$subrating['shortname']?>
					</div>
				<?
			}
		}


    	$content = ob_get_contents();
		ob_end_clean();		

		if ($total != 0){

			return $content;		
		}
		

	}
	
	function displayRatingDetail($product, $ratingId){

	
		global $db;
		$subratings = $db->getSubratings($ratingId);
		
		if (count($subratings) == 0){
			return;
		}
		
		ob_start();
		
		$total = 0;
		foreach ($subratings as $key=>$subrating){
			if (in_array($subrating['id'], $product['subratings'])){
				$total++;
				?>
					<div class="shortsubrating">
						<?=$subrating['shortname']?>
					</div>
				<?
			}
		}


    	$content = ob_get_contents();
		ob_end_clean();		

		if ($total != 0){

			return $content;		
		}
		

	}
	

}