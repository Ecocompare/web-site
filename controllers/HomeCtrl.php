<?php
require_once('Controller.php');


class HomeCtrl extends Controller{
	
	function show(){
		global $db;

		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		
		require_once('ProductCtrl.php');
		$this->productCtrl = new ProductCtrl();

		require_once('ArticleCtrl.php');
		$this->articleCtrl = new ArticleCtrl();
		
		require_once('NewCtrl.php');
		$this->newCtrl = new NewCtrl();
		
		$this->randomEcoacteur=$db->getRandomEcoacteur();
		$this->matches = $db->getMatches();

		$this->articles = $db->getArticles(5);
		//$this->users = $db->getEcoactors('03','2011',5);
		$this->users = $db->getEcoactors(Date('m'),Date('Y'),5);
		
		$this->testimony=$db->getRandomTestimony();
		
		
//$this->news = $db->getNews(7);
		// pour afficher la carte geoloc dernier scan
		$scans=$db->getLastScan();
			
		$this->selection = $db->getProductsSelection("score4 >= 2 and id not in (select productid from productcategories where categoryid in (58,11,12,59,50))");
		//$this->noel = $db->searchProducts2(
		//	reqOrDefault('keywords', ''),
		//	reqOrDefault('category', '64'),
		//	reqOrDefault('orderby', 'pubdate DESC'),
		//	reqOrDefault('label'),
		//	reqOrDefault('brand', ''),
		//	4,
		//	0
		//);
		
		$this->new = $db->searchProducts2(
			reqOrDefault('keywords', ''),
			reqOrDefault('category', '0'),
			reqOrDefault('orderby', 'majdate DESC'),
			reqOrDefault('label'),
			reqOrDefault('brand', ''),
			4,
			0
		);


		$this->prev_month=$m_prev=date('m',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
		$this->currentTab = "home";
		
			
		//a faire remettre iPhoneAlert();
		$this->onload="initialize(".$scans['latitude'].",".$scans['longitude'].",'".$scans['name']."','".$scans['description']."-".$scans['marque']."');return false;";
		
		$this->title = "Développement durable par des produits et marques vertueux";
		$this->render('homeshow.php');
	}
}
