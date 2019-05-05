<?php
require_once('Controller.php');

class IphoneCtrl extends Controller{
	
	
	function testimonyshow(){
	//	require_once('CommentCtrl.php');
		global $db;
		$this->title="Témoignages des ecoacteurs lauréats";
		$this->description="Liste des témoignages des eco-acteurs ayant participés et remportés le concours. Les raisons de leur participation à cette démarche transparente et collective";
		$this->currentTab = "testimony";
		$this->socialNetworks = array(array("name" => "google",
								 		 "url" => "http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_google.png",
								 		 "alt" => "Favoris Google"),
								   		 array("name" => "yahoo",
								 		 "url" => "http://myweb2.search.yahoo.com/myresults/bookmarklet?u=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_yahoo.gif",
								 		 "alt" => "Favoris Yahoo"),
										 array("name" => "live",
						 		 		 "url" => "http://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=fr-fr&amp;url=",
							     		 "logo" => "http://www.ecocompare.com/images/logo_live.gif",
								 		 "alt" => "Favoris Live"),
										 array("name" => "facebook",
				 				 		 "url" => "http://www.facebook.com/sharer.php?u=",
				 				 		 "logo" => "http://www.ecocompare.com/images/logo_facebook.gif",
				 				 		 "alt" => "Partager cet article sur Facebook"),
										 array("name" => "myspace",
		 				 		 		 "url" => "http://www.myspace.com/Modules/PostTo/Pages/?t=",
		 						 		 "logo" => "http://www.ecocompare.com/images/logo_myspace.png",
		 						 		 "alt" => "Ajouter sur MySpace"),
										 array("name" => "digg",
										 "url" => "http://digg.com/submit?phase=3&amp;url=",
										 "logo" => "http://www.ecocompare.com/images/logo_digg.jpg",
										 "alt" => "Partager sur Digg"),
										 array("name" => "delicious",
								 		 "url" => "http://del.icio.us/post?v=2&amp;url=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_delicious.gif",
								 		 "alt" => "Partager sur Del.Ici.Us"),
										 array("name" => "technorati",
						 		 		 "url" => "http://technorati.com/faves?add=",
						 		 		 "logo" => "http://www.ecocompare.com/images/logo_technorati.gif",
						 		 		 "alt" => "Ajouter sur Technorati"),
										 array("name" => "blogmarks",
				 		 		 		 "url" => "http://www.blogmarks.net/my/new.php?url=",
				 		 		 	     "logo" => "http://www.ecocompare.com/images/logo_blogmarks.gif",
				 		 		 		 "alt" => "Ajouter sur Blogmarks"));	
		$this->render('testimonyshow.php');
	}
	
	
	function oldshow(){
	//	require_once('CommentCtrl.php');
		global $db;

	setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
	
    if (req('id')=='') $id=Date('m'); else $id=req('id');
    if (req('year')=='') $year=Date('Y'); else $year=req('year');
 		if (reqOrDefault('mode', '')!='') $this->mode=req('mode'); else  $this->mode=''; 
 		  
 		$this->users = $db->getEcoactors($id,$year,15);
 		$this->maxgreen= $db->getMaxGreenProduct($id,$year);
		$this->fiveproducts=$db->getFiveProducts();
		$this->randomEcoacteur= $db->getrandomEcoacteur();

		$scans=$db->getLastScan();
		$this->onload="initialize(".$scans['latitude'].",".$scans['longitude'].",'".$scans['name']."','".$scans['description']."-".$scans['marque']."');startcanva();";
		
		
 		$this->eans = $db->getIphoneEans($id,$year);
 		$this->brands=$db->getIphoneBrands(50);

 	
 		$this->month=$id;
 		$this->year=$year;
 		$this->month_desc=utf8_encode(ucwords ($db->getMonth($id)));
 		$this->stats=$db->getStatMonth($id,$year);		
 		$this->prev_month=$m_prev=date('m',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
 		
 		if ($this->mode=="scanparty") 	{
 			$this->description="Pendant la semaine du développement durable du 1er au 7 Avril, soyons eco-acteurs et mettons les produits 'verts' à l'honneur!";
 			    $this->title = "Semaine du développement durable 2012, soyons tous eco-acteurs !";
 		}
 		else {
	 	$this->title = "Classement des eco-acteurs pour le mois de ".	$this->month_desc. " ".$year;
	 	$this->description="Scannez le code barre des produits dont vous souhaitez obtenir les caractéristiques écologiques, sanitaires et sociétales réelles. Un scan = Un vote. La transparence collective...";}
 	
 				
 		$this->currentTab = "iphone";
		$this->socialNetworks = array(array("name" => "google",
								 		 "url" => "http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_google.png",
								 		 "alt" => "Favoris Google"),
								   		 array("name" => "yahoo",
								 		 "url" => "http://myweb2.search.yahoo.com/myresults/bookmarklet?u=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_yahoo.gif",
								 		 "alt" => "Favoris Yahoo"),
										 array("name" => "live",
						 		 		 "url" => "http://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=fr-fr&amp;url=",
							     		 "logo" => "http://www.ecocompare.com/images/logo_live.gif",
								 		 "alt" => "Favoris Live"),
										 array("name" => "facebook",
				 				 		 "url" => "http://www.facebook.com/sharer.php?u=",
				 				 		 "logo" => "http://www.ecocompare.com/images/logo_facebook.gif",
				 				 		 "alt" => "Partager cet article sur Facebook"),
										 array("name" => "myspace",
		 				 		 		 "url" => "http://www.myspace.com/Modules/PostTo/Pages/?t=",
		 						 		 "logo" => "http://www.ecocompare.com/images/logo_myspace.png",
		 						 		 "alt" => "Ajouter sur MySpace"),
										 array("name" => "digg",
										 "url" => "http://digg.com/submit?phase=3&amp;url=",
										 "logo" => "http://www.ecocompare.com/images/logo_digg.jpg",
										 "alt" => "Partager sur Digg"),
										 array("name" => "delicious",
								 		 "url" => "http://del.icio.us/post?v=2&amp;url=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_delicious.gif",
								 		 "alt" => "Partager sur Del.Ici.Us"),
										 array("name" => "technorati",
						 		 		 "url" => "http://technorati.com/faves?add=",
						 		 		 "logo" => "http://www.ecocompare.com/images/logo_technorati.gif",
						 		 		 "alt" => "Ajouter sur Technorati"),
										 array("name" => "blogmarks",
				 		 		 		 "url" => "http://www.blogmarks.net/my/new.php?url=",
				 		 		 	     "logo" => "http://www.ecocompare.com/images/logo_blogmarks.gif",
				 		 		 		 "alt" => "Ajouter sur Blogmarks"));	
		$this->render('iphoneshow.php');
	}
	
	function show(){
	//	require_once('CommentCtrl.php');
		global $db;

	setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
	
    if (req('id')=='') $id=Date('m'); else $id=req('id');
    if (req('year')=='') $year=Date('Y'); else $year=req('year');
 		if (reqOrDefault('mode', '')!='') $this->mode=req('mode'); else  $this->mode=''; 
 		  
 		$this->users = $db->getEcoactors($id,$year,15);
 		$this->maxgreen= $db->getMaxGreenProduct($id,$year);
		$this->fiveproducts=$db->getFiveProducts();
		$this->randomEcoacteur= $db->getrandomEcoacteur();

		$scans=$db->getLastScan();
		$this->onload="initialize(".$scans['latitude'].",".$scans['longitude'].",'".$scans['name']."','".$scans['description']."-".$scans['marque']."');startcanva();";
		
		
 		$this->eans = $db->getIphoneEans($id,$year);
 		$this->brands=$db->getIphoneBrands(50);

 	
 		$this->month=$id;
 		$this->year=$year;
 		$this->month_desc=utf8_encode(ucwords ($db->getMonth($id)));
 		$this->stats=$db->getStatMonth($id,$year);		
 		$this->prev_month=$m_prev=date('m',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
 		
 		if ($this->mode=="scanparty") 	{
 			$this->description="Pendant la semaine du développement durable du 1er au 7 Avril, soyons eco-acteurs et mettons les produits 'verts' à l'honneur!";
 			    $this->title = "Semaine du développement durable 2012, soyons tous eco-acteurs !";
 		}
 		else {
	 	$this->title = "Classement des eco-acteurs pour le mois de ".	$this->month_desc. " ".$year;
	 	$this->description="Scannez le code barre des produits dont vous souhaitez obtenir les caractéristiques écologiques, sanitaires et sociétales réelles. Un scan = Un vote. La transparence collective...";}
 	
 				
 		$this->currentTab = "iphone";
		$this->socialNetworks = array(array("name" => "google",
								 		 "url" => "http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_google.png",
								 		 "alt" => "Favoris Google"),
								   		 array("name" => "yahoo",
								 		 "url" => "http://myweb2.search.yahoo.com/myresults/bookmarklet?u=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_yahoo.gif",
								 		 "alt" => "Favoris Yahoo"),
										 array("name" => "live",
						 		 		 "url" => "http://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=fr-fr&amp;url=",
							     		 "logo" => "http://www.ecocompare.com/images/logo_live.gif",
								 		 "alt" => "Favoris Live"),
										 array("name" => "facebook",
				 				 		 "url" => "http://www.facebook.com/sharer.php?u=",
				 				 		 "logo" => "http://www.ecocompare.com/images/logo_facebook.gif",
				 				 		 "alt" => "Partager cet article sur Facebook"),
										 array("name" => "myspace",
		 				 		 		 "url" => "http://www.myspace.com/Modules/PostTo/Pages/?t=",
		 						 		 "logo" => "http://www.ecocompare.com/images/logo_myspace.png",
		 						 		 "alt" => "Ajouter sur MySpace"),
										 array("name" => "digg",
										 "url" => "http://digg.com/submit?phase=3&amp;url=",
										 "logo" => "http://www.ecocompare.com/images/logo_digg.jpg",
										 "alt" => "Partager sur Digg"),
										 array("name" => "delicious",
								 		 "url" => "http://del.icio.us/post?v=2&amp;url=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_delicious.gif",
								 		 "alt" => "Partager sur Del.Ici.Us"),
										 array("name" => "technorati",
						 		 		 "url" => "http://technorati.com/faves?add=",
						 		 		 "logo" => "http://www.ecocompare.com/images/logo_technorati.gif",
						 		 		 "alt" => "Ajouter sur Technorati"),
										 array("name" => "blogmarks",
				 		 		 		 "url" => "http://www.blogmarks.net/my/new.php?url=",
				 		 		 	     "logo" => "http://www.ecocompare.com/images/logo_blogmarks.gif",
				 		 		 		 "alt" => "Ajouter sur Blogmarks"));	
		$this->render('iphoneshow.php');
	}
	
		function classement(){
	
		global $db;
		//on met à jour la géoloc
		
		$db->updateGeoloc();
	  setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
	
 		if ($_REQUEST['mode']!='') $this->mode=req('mode'); 
 	
 	//	$this->month=$id;
 	//	$this->month_desc=utf8_encode(ucwords ($db->getMonth($id)));
 	//	$this->stats=$db->getStatMonth($id);		
 		$this->prev_month=$m_prev=date('m',mktime(0, 0, 0, date("m")-1, date("d"),   date("Y")));
 		$this->fiveproducts=$db->getFiveProducts();
 		$this->stats=$db->getStatMonth(4);	
 			
 		if ($this->mode=="kbane") 	{
 			$this->description="Concours KBANE, classement pour la Scanning Party !";
 			$this->title = "Scanning party KBANE, classement pour la Scanning Party !";
 			$this->lieu= "Magasin KBANE";
 			// codepostal=59520, codeinsee=59386 
 			
 			// mois, année, codeInsee, datejour, liste EAN
 			$this->users =$db->getEcoactors(9,2013,15,'','28/09/2013','5420008514135,9782215097426,9782350321288,9782914717762,3700081418479,3542640131524,3542640145576,3542640136970,3760141661122,3538394911079,3351840207492,3417068800027,8413893201218,3770000374025,3770000374025,4004552037503,3700666401001,3760194390017,3760194390062,4006387029852,3760126195451,3375536001904,5016402052740,3513140504149,2090000031720,4029955615714,3261543136695,3174269043393,4012561328659');
 			$this->eans = $db->getEans(9,2013,15,'','28/09/2013','5420008514135,9782215097426,9782350321288,9782914717762,3700081418479,3542640131524,3542640145576,3542640136970,3760141661122,3538394911079,3351840207492,3417068800027,8413893201218,3770000374025,3770000374025,4004552037503,3700666401001,3760194390017,3760194390062,4006387029852,3760126195451,3375536001904,5016402052740,3513140504149,2090000031720,4029955615714,3261543136695,3174269043393,4012561328659');
 			 			
 		}
 		else if ($this->mode=="paris") 	{
 			$this->description="Semaine du développement durable 2012, classement pour l'Ile de France !";
 			$this->title = "Scanning week 2012, classement pour l'Ile de France !";
 			$this->users = $db->getInseeUsers('78517');
 			$this->eans = $db->getInseeEans('78517');
 			$this->lieu= "Ile de France";
 			$this->logo= "banniereAPD_132x110.jpg";
 			
 		}
 		
 		else {
	 	$this->description="Semaine du développement durable 2012, classement pour la France entière !";
 			$this->title = "Scanning week 2012, classement pour la France entière !";
 			$this->users = $db->getSWUsers('');
 			$this->eans = $db->getSWEans('');
 			
			$this->getMaxSWUsers = $db->getMaxSWUsers('');
 			$this->getMaxSWEans = $db->getMaxSWEans('');
			
			
			$this->lieu= "La France entière";
 			$this->logo= "france.jpg";
 		}
 	
 				
 		$this->currentTab = "iphone";
		$this->socialNetworks = array(array("name" => "google",
								 		 "url" => "http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_google.png",
								 		 "alt" => "Favoris Google"),
								   		 array("name" => "yahoo",
								 		 "url" => "http://myweb2.search.yahoo.com/myresults/bookmarklet?u=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_yahoo.gif",
								 		 "alt" => "Favoris Yahoo"),
										 array("name" => "live",
						 		 		 "url" => "http://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=fr-fr&amp;url=",
							     		 "logo" => "http://www.ecocompare.com/images/logo_live.gif",
								 		 "alt" => "Favoris Live"),
										 array("name" => "facebook",
				 				 		 "url" => "http://www.facebook.com/sharer.php?u=",
				 				 		 "logo" => "http://www.ecocompare.com/images/logo_facebook.gif",
				 				 		 "alt" => "Partager cet article sur Facebook"),
										 array("name" => "myspace",
		 				 		 		 "url" => "http://www.myspace.com/Modules/PostTo/Pages/?t=",
		 						 		 "logo" => "http://www.ecocompare.com/images/logo_myspace.png",
		 						 		 "alt" => "Ajouter sur MySpace"),
										 array("name" => "digg",
										 "url" => "http://digg.com/submit?phase=3&amp;url=",
										 "logo" => "http://www.ecocompare.com/images/logo_digg.jpg",
										 "alt" => "Partager sur Digg"),
										 array("name" => "delicious",
								 		 "url" => "http://del.icio.us/post?v=2&amp;url=",
								 		 "logo" => "http://www.ecocompare.com/images/logo_delicious.gif",
								 		 "alt" => "Partager sur Del.Ici.Us"),
										 array("name" => "technorati",
						 		 		 "url" => "http://technorati.com/faves?add=",
						 		 		 "logo" => "http://www.ecocompare.com/images/logo_technorati.gif",
						 		 		 "alt" => "Ajouter sur Technorati"),
										 array("name" => "blogmarks",
				 		 		 		 "url" => "http://www.blogmarks.net/my/new.php?url=",
				 		 		 	     "logo" => "http://www.ecocompare.com/images/logo_blogmarks.gif",
				 		 		 		 "alt" => "Ajouter sur Blogmarks"));	
				 		 		 		 
		$scans=$db->getLastScan();
		
		// $this->onload="JavaScript:timedRefresh(10000)";
		$this->onload="initialize(".$scans['latitude'].",".$scans['longitude'].",'".$scans['name']."','".$scans['description']."');javaScript:timedRefresh(10000);return false;";
		$this->render('iphoneclassement.php');
	}
	
	function deletescan() {
		global $db;
		
		$db->deletescan(req('date'),req('insee'));
		
	}
		function category(){
		global $db;
		   if (req('cat')!='')  $cat=urldecode(req('cat'));
		$this->fiveproducts=$db->getFiveProducts();
		$this->randomEcoacteur= $db->getrandomEcoacteur();
		$scans=$db->getLastScan();
		
		$this->onload="initialize(".$scans[0]['latitude'].",".$scans[0]['longitude'].",'".trim(addslashes($scans[0]['name']))."','".trim(addslashes($scans[0]['description']))."-".trim(addslashes($scans[0]['marque']))."');return false;";
		$this->title = "Liste des $cat écologique ou responsables ";
		$this->cats = $db->getScanCategory($cat);
		$this->ScanCount=$db->getCountScanCategory($cat,'scancount');
		$this->EcoScanCount=$db->getCountScanCategory($cat,'ecoscancount');
		$this->UserScanCount=$db->getCountScanCategory($cat,'userscancount');
		
		$this->ScanTotal=	$this->ScanCount+$this->EcoScanCount;
		$this->ScanMoy=	round($this->EcoScanCount*100/$this->ScanTotal);
		
		$scans=$db->getLastScan();
		$this->onload="initialize(".$scans['latitude'].",".$scans['longitude'].",'".$scans['name']."','".$scans['description']."-".$scans['marque']."');return false;";
	
		$this->category=$cat;
		$this->currentTab = "iphone";
		$this->render('scanCategory.php');
	}
	
	function admin(){
	
		requireAdmin();
		global $db;
		$this->articles = $db->getArticles();
		
		$this->currentTab = "admin";	
		$this->render('articleadmin.php');
	}

	function browse(){
		global $db;
		$this->articles = $db->getArticles();
		
		$this->currentTab = "articles";	
		$this->title = "Dossiers conseil";
		$this->render('articlebrowse.php');
	}
	
	function upload(){
	
		requireAdmin();
		global $db;
		
		$pathParts = pathinfo($_FILES["image"]['name']);
		$extension = strtolower($pathParts['extension']);
		
		if ($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png"){
			$params = array();
			$params['originalname'] = $_FILES["image"]['name'];
			$id = $db->createArticleImage($params);
			move_uploaded_file($_FILES["image"]["tmp_name"], "./articleimages/img$id.$extension");
			echo '<script>window.parent.delayedInsertImage("articleimages/img'.$id.'.'.$extension.'");</script>';
		}
	}

	function add(){
		requireAdmin();
		global $db;
		$this->formValues['action'] = "create";
		
		$this->currentTab = "admin";
		$this->render('articleedit.php');
	}

	function create(){
		requireAdmin();
		global $db;
		$params = $this->paramsList();
		$params['created'] = time();
		$id = $db->addArticle($params);
		$this->handleImage($id);
		header('Location: articles?action=admin');
	}
	
	function edit(){
		requireAdmin();
		global $db;
		$this->formValues = $db->getArticle(req('id'));
		$this->formValues['action'] = "update";
		
		$this->currentTab = "admin";
		$this->render('articleedit.php');
	}
	
	function update(){
		requireAdmin();
		global $db;
		$db->updateArticle(req('id'), $this->paramsList());
		$this->handleImage(req('id'));
		header('Location: articles?action=admin');
	}
	
	function delete(){
		requireAdmin();
		global $db;
		$db->deleteArticle(req('id'));		
		header('Location: articles?action=admin');
	}
	
	function showImage(){
		if (req("size") == "thumb"){
			$width = 42;
		}else{
			$width = 80;
		}
		$name = 'cache/article'.req('size').req('id').'.jpg';
		if (!file_exists('./'.$name)){
			$original = './articleimages/article'.req('id');
			if (file_exists($original)){
				$originalImage = null;
				try{
					$originalImage = imageCreateFromJpeg($original);
				}catch (Exception $e){
				}
				if ($originalImage == null){
					$originalImage = imageCreateFromGif($original);
				}
				if ($originalImage == null){
					$originalImage = imageCreateFromPng($original);
				}
				$ratio = $width / max(imagesx($originalImage), imagesy($originalImage));
				$height = imagesy($originalImage) * $ratio;		
				$resampledImage = imageCreateTruecolor($width, $height);
				imageCopyResampled($resampledImage, $originalImage, 0, 0, 0, 0, imagesx($resampledImage), imagesy($resampledImage), imagesx($originalImage), imagesy($originalImage));
				imagejpeg($resampledImage, './'.$name,100);
		
			}else{
				$resampledImage = imageCreateTruecolor($width, $width);
				imagejpeg($resampledImage, $name, 85);
			}
		}
		header('location: ./'.$name);
	}
	
	private function handleImage($id){
		if (req('fileaction') == "upload"){
			move_uploaded_file($_FILES["image"]["tmp_name"], "./articleimages/" . 'article'.$id);
			if (file_exists('./cache/articlethumb'.$id.'.jpg')){
				unlink('./cache/articlethumb'.$id.'.jpg');
			}
			if (file_exists('./cache/articlemedium'.$id.'.jpg')){
				unlink('./cache/articlemedium'.$id.'.jpg');
			}
			$params['image'] = $_FILES['image']['name'];
		}			
	}
	
	private function paramsList(){
		if (req('fileaction') == "upload"){
			$params['image'] = $_FILES['image']['name'];
		}
		$params['title'] = req('title');
		$params['tags'] = req('tags');
		$params['text'] = req('text');
		return $params;
	}

}
