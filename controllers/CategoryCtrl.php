<?php
require_once('Controller.php');

class CategoryCtrl extends Controller{
	
	function admin(){
		global $db;
		$this->categories = $db->getCategories();
		
		$this->currentTab = "admin";	
		$this->render('categoryadmin.php');
	}

	function add(){
		requireAdmin();
		$this->targetAction = "create";
		
		$this->currentTab = "admin";	
		$this->render('categoryedit.php');
	}

	function create(){
		requireAdmin();
		global $db;
		$db->createCategory($this->paramsList());		
		header('Location: categories?action=admin');
	}
	
	function edit(){
		requireAdmin();
		global $db;
		$this->formValues = $db->getCategory(req('id'));
		$this->targetAction = "update";	
		
		$this->currentTab = "admin";	
		$this->render('categoryedit.php');
	}
	
	function update(){
		requireAdmin();
		global $db;
		$product = $db->updateCategory(req('id'), $this->paramsList());		
		header('Location: categories?action=admin');
	}
	
	function delete(){
		requireAdmin();
		global $db;
		$product = $db->deleteCategory(req('id'));		
		header('Location: categories?action=admin');
	}
	
	private function paramsList(){
		$params['id'] = req('id');
		$params['name'] = req('name');
		$params['parentid'] = req('parentid');
		$params['text'] = req('text');
		return $params;
	}
	
	function renderListItem($category, $level, $tpl = "categoryitem.php"){
		include("./views/".$tpl);
	}

	function showCheckboxes($selected,$lang=1){
		global $db;
		$categories = $db->getCategories();
	  	foreach ($categories as $key=>$category){
			$this->renderCheckbox($category, 0, $selected, $lang);
		}
	}
	
	function renderCheckbox($category, $level, $selected, $lang=1){
		
		include("./views/categorycheckbox.php");
	}

	function showOptions($selected, $startLevel = 0, $showCount = false){
		global $db;
		$categories = $db->getCategories();
		foreach ($categories as $key=>$category){
			$this->renderOption($category, $startLevel, $selected, $showCount);
		}
	}
	
	function renderOption($category, $level, $selected, $showCount = false){
		include("./views/categoryoption.php");
	}
	
	function show2LevelsList(){
		global $db;
		$this->categories = $db->getCategories(0);
		include("./views/category2levelslist2.php");
	}
	
	function showMenu($current){
		global $db;
		$categories = $db->getCategories(0);
		array_unshift($categories, array('id' => 'nouveaux-produits-responsables', "icon" => "new10-trans.png", "name" => "Nouveautés", "subcategories" => array()));
		array_unshift($categories, array('id' => 'selection-produits-responsables', "icon" => "selection-produits-ecologiques.png", "name" => "Notre selection", "subcategories" => array()));

		
		$currentPath = array();
		
		//if ($current > 0){
			$tempId = $current;
			for($i = 0; $i < 10; $i++){		
				$tempCategory = $db->getCategory($tempId);
				if ($tempCategory == null){
					break;
				}
				$currentPath[] = $tempCategory;
				if ($tempCategory['parentid'] != 0){
					$tempId = $tempCategory['parentid'];
				}else{
					break;
				}
			}
		//}		
				
		foreach ($categories as $key=>$category){
			$this->renderMenuItem($category, 0, $current, $currentPath);
		}				
	}

	function renderMenuItem($category, $level, $current, $currentPath){
		include("./views/categorymenuitem.php");
	}

}