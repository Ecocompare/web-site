<?php
require_once('Controller.php');

class LabelCtrl extends Controller{
	
	function admin(){
		global $db;
		$this->labels = $db->getLabels();
		$this->currentTab = "admin";	
		$this->render('labeladmin.php');
	}
	
	function showCheckboxes($selected){
		global $db;
		$labels = $db->getLabels();
		foreach ($labels as $key=>$label){
			$this->renderCheckbox($label, $selected);
		}
	}
	
	function edit(){
		requireAdmin();
		global $db;
		$this->formValues = $db->getLabels(req('id'),true,true);
		$this->subratings = $db->getNewSubratings(0,0);
		$this->targetAction = "update";	
		$this->currentTab = "admin";	
		$this->render('labeledit.php');
	}
	
		function delete(){
		requireAdmin();
		global $db;
		$product = $db->deleteLabel(req('id'));		
		header('Location: '.$GLOBALS['base'].'labels?action=update');
	}
	
	function showCheckboxesType($selected,$typeid){
		global $db;
		$labels = $db->getLabelsType($typeid);
		foreach ($labels as $key=>$label){
			$this->renderCheckbox($label, $selected);
		}
	}
	
	function ajaxlabel(){
		global $db;
		$this->type_id=req('type_id');
	  $labels = $db->getLabelsType(req('type_id'));
		foreach ($labels as $key=>$label){
			$this->renderCheckbox($label, array());
			
		}
	}
	
	function addLabelCriteria() {
			global $db;
			$db->addSubratingLabel(req('labelId'),req('criteriaid'),req('value'));
			header('Location: '.$GLOBALS['base'].'labels?action=edit&id='.req('labelId'));
	}
	
	function update(){
		requireAdmin();
		global $db;
		$db->updateNewLabel(req('id'), $this->paramsList());
		header('Location: '.$GLOBALS['base'].'labels?action=admin');
	}
	
	
	private function paramsList(){
		$params['image'] = req('image');
		$params['name'] = 	req('name');
		$params['referentiel'] = req('referentiel');
		$params['version'] = req('version');
		$params['description'] = req('description');	
		return $params;
	}
	
	
	function renderCheckbox($label, $selected){
		include("./views/labelcheckbox.php");
	}

}