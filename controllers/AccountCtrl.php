<?php
require_once('Controller.php');

class AccountCtrl extends Controller{


	function show(){
		require_once('CommentCtrl.php');
		require_once('DrawratingCtrl.php');
		$db = new Db();
		//global $db;
		$this->onload = "getUserScans(".$_SESSION['id'].");getUserStats(".$_SESSION['id'].");";
		
		if (isset($_SESSION['id'])){
			$this->userReviews = $db->getUsersReviewsFor1User($_SESSION['id']);
		}
	
/*		$this->comments = $db->getComments('article', req('id'));
		$this->currentTab = "articles";
		$this->title = encodeQuotes($this->article['title']);
*/
		$this->currentTab = "espace-eco-acteur";
		$this->render('accountshow.php');
	}
	
	function est_dans($tab, $data, $champs) {
		foreach($tab as $key => $value) {
			if($value[$champs] == $data) return true;
		}
		return false;
	}



}