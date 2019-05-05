<?php
require_once('Controller.php');

class ArticleCtrl extends Controller{
	
	
	function show(){
		require_once('CommentCtrl.php');

		global $db;
		$this->article = $db->getArticle(req('id'));
		$this->comments = $db->getComments('article', req('id'));
		$this->currentTab = "articles";
		$this->title = encodeQuotes($this->article['title']);
		$this->description = encodeQuotes(trimText($this->article['text'], 120));
		$this->keywords = encodeQuotes($this->article['tags']);
		
		$this->commentCtrl = new CommentCtrl();
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
		$this->render('articleshow.php');
	}
	
	function admin(){
	
		requireAdmin();
		global $db;
		$this->articles = $db->getArticles(0,'false');
		
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
		if (reqOrDefault('enable','off')=='on') $params['enable']=1; else $params['enable']=0;
			
		return $params;
	}

}