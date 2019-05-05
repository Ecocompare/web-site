<?php
require_once('Controller.php');

class CompanyCtrl extends Controller{
	
	
	function show(){
		global $db;
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		$this->company = $db->getCompany(req('id'));
		$this->categories = $db->getCategories();	
		$this->partners=$db->getBrandPartnerByCompany(req('id'));
		$this->currentTab = "companies";
		$this->title = encodeQuotes($this->company['title']);
		$this->enable = $this->company['enable'];
		$this->description = encodeQuotes(trimText($this->company['text'], 120));
		//echo ">>".$this->company['title'];
		$this->products = $db->getProductsByCompany(req('id'));
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
		$this->render('companyshow.php');
	}
	
	function TopProducts() {
	global $db;
	$this->brand=req('brand');

  $this->products=$db->getScanBrandProducts($this->brand,20);
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
	$this->title = "Top 20 des produits responsables les plus scannés de la marque ".req('brand');
	
	$this->onload="startcanva();";
	$this->currentTab = "topbrands";
	$this->render('topbrandproducts.php');

	}
	
	function admin(){
	
	
		if ($_SESSION['user']['type'] == 'company'){
			header('Location: '.$GLOBALS['base'].'products/dashboard');
		}
	
		$userId = 0;
		if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'company'){
			$userId = $_SESSION['user']['id'];
		}
	
		global $db;
		$this->companies = $db->getCompanies(0, "title ASC", $userId, true,true);
		
		$this->currentTab = "admin";	
		$this->render('companyadmin.php');
	}

	function browse(){
		global $db;
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		$this->categories = $db->getCategories();	

		$this->companies = $db->getCompanies();
		
		$this->currentTab = "companies";	
		$this->title = "Entreprises impliquées";
		$this->render('companybrowse.php');
	}

	function add(){
		requireAdmin();
		global $db;
		$this->formValues['action'] = "create";
		
		$this->currentTab = "admin";
		$this->render('companyedit.php');
	}

	function create(){
		requireAdmin();
		global $db;
		$params = $this->paramsList();
		$params['created'] = time();
		$id = $db->addCompany($params);
		$this->handleImage($id);
		header('Location: companies?action=admin');
	}
	
	function edit(){

		global $db;
		$this->formValues = $db->getCompany(req('id'));
		$this->formValues['action'] = "update";
		$this->users = $db->getUsers();
		
		if (admin() || isset($_SESSION['user']) && req('id') == isset($_SESSION['user']['id'])){
		}else{
			exit;
		}
		
		$this->currentTab = "admin";
		$this->render('companyedit.php');
	}
	
	function update(){
	
		global $db;	
	
		$original = $db->getCompany(req('id'));
	
		if (admin() || isset($_SESSION['user']) && req('id') == isset($_SESSION['user']['id'])){
		}else{
			exit;
		}

		$db->updateCompany(req('id'), $this->paramsList());
		$this->handleImage(req('id'));
		header('Location: companies?action=admin');
	}
	
	function delete(){
		requireAdmin();
		global $db;
		$db->deleteCompany(req('id'));		
		header('Location: companies?action=admin');
	}
	
	function showImage(){
		if (req("size") == "thumb"){
			$width = 42;
		}else{
			$width = 80;
		}
		$name = 'cache/company'.req('size').req('id').'.jpg';
		if (!file_exists('./'.$name)){
			$original = './companyimages/company'.req('id');
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
							//largeur origine
					$src_w=	imagesx($originalImage);
					//hauteur origine
					$src_h=	imagesy($originalImage);
				
					//error_log("largeur origine X: $src_w, hauteur Y: $src_h \n", 3, "/tmp/image.log");
				
					$dst_y=0;
					$dst_x=0;
					$dst_w=imagesx($resampledImage);
					$dst_h=imagesy($resampledImage);
					
					//on centre verticalement
				  if ($src_w>$src_h) {
				  	$ratio=$width / $src_w;
				  	
			 	
				  
				  	$dst_w=$width;
				  	$dst_h=$src_h*$ratio;
				  	$dst_y=($width-$dst_h)/2; 	
				  		  	
				  	//error_log("plus large que haute, on centre verticalement à $dst_y \n", 3, "/tmp/image.log"); 
				  	//error_log("nouvelle dimension : $dst_w X $dst_h \n", 3, "/tmp/image.log");
			
				  	}
				  	
				  if ($src_h>$src_w) {
				  	$ratio=$width / $src_h;
				  	$dst_w=$src_w*$ratio;
				  	$dst_h=$width;
				  	
				  	$dst_x=($width-$dst_w)/2;
				  	//error_log("plus haute que large on centre horizontalement à $dst_x \n", 3, "/tmp/image.log");
				  	//error_log("nouvelle dimension : $dst_w X $dst_h \n", 3, "/tmp/image.log");

				  	}

					if ($src_h==$src_w) {
					$ratio = $width / $src_h;	
					$dst_w=$src_w*$ratio;
					$dst_h=$src_h*$ratio;
					 	// error_log("image carree \n", 3, "/tmp/image.log");
					}
					
			
				//image carrée
				$resampledImage = imageCreateTruecolor($width, $width);
				$white = imagecolorallocate($resampledImage, 255, 255, 255);
				imagefilledrectangle($resampledImage, 0, 0, $width, $width, $white);
				
				imageCopyResampled($resampledImage, $originalImage, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, imagesx($originalImage), imagesy($originalImage));
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
			move_uploaded_file($_FILES["image"]["tmp_name"], "./companyimages/" . 'company'.$id);
			if (file_exists('./cache/companythumb'.$id.'.jpg')){
				unlink('./cache/companythumb'.$id.'.jpg');
			}
			if (file_exists('./cache/companymedium'.$id.'.jpg')){
				unlink('./cache/companymedium'.$id.'.jpg');
			}
			$params['image'] = $_FILES['image']['name'];
		}			
	}
	
	private function paramsList(){
		if (req('fileaction') == "upload"){
			$params['image'] = $_FILES['image']['name'];
		}
		$params['title'] = req('title');
		$params['site'] = req('site');
		$params['text'] = req('text');
		if (reqOrDefault('enable','off')=='on') $params['enable']=1; else $params['enable']=0;
		
		return $params;
	}

}