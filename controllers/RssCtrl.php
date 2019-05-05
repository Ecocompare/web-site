<?php
require_once('Controller.php');

class RssCtrl extends Controller{

	function products(){
		
		global $db;
	
		$this->products = $db->searchProducts2(
			reqOrDefault('keywords', ''),
			reqOrDefault('category', '0'),
			reqOrDefault('orderby', 'created DESC'),
			reqOrDefault('label'),
			reqOrDefault('brand', ''),
			15,
			0
		);
	
		include('./views/rssproduct.php');
	}
	
		function show(){
		
		global $db;
	
		$this->products = $db->searchProducts2(
			reqOrDefault('keywords', ''),
			reqOrDefault('category', '0'),
			reqOrDefault('orderby', 'created DESC'),
			reqOrDefault('label'),
			reqOrDefault('brand', ''),
			15,
			0
		);
	
		include('./views/rssproduct.php');
	}
	
	function articles(){
		
		global $db;
	
		$this->articles = $db->getArticles();
		
	
		include('./views/rssarticle.php');
	}
	
}

?>