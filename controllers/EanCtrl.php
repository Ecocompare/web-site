<?php
require_once('Controller.php');


class EanCtrl extends Controller{
	
	function edit(){
	requireAdmin();
		global $db;

		$this->max=$db->getMaxEanToComplete();
		$this->eans = $db->getEanToComplete();
		$this->currentTab = "admin";
		$this->title = "Liste des eans à compléter";
		$this->render('eanedit.php');
	}
	
	function update(){
	requireAdmin();
		global $db;

		$description=addslashes(req('description'));
		$marque=addslashes(req('marque'));
		$ean=req('ean');

		if ($_POST['produitvert']=='on') $produitvert=1; else $produitvert=0;
		if ($_POST['introuvable']=='on') $introuvable=1; else $introuvable=0;
		
		$db->updateEan($ean,$description,$marque,$produitvert,$introuvable);
		
		$this->eans = $db->getEanToComplete();
		$this->currentTab = "admin";
		$this->title = "Liste des eans à compléter";
		$this->max=$db->getMaxEanToComplete();
			
		$this->render('eanedit.php');
	}
	
}
