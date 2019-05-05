<?php
require_once('Controller.php');

class UserCtrl extends Controller{
	

	function admin(){
		requireAdmin();
		global $db;
		$this->currentTab = 'admin';
		$this->users = $db->getUsers();
		$this->render('useradmin.php');
	}

	function edit(){
		requireAdmin();
		global $db;
		$this->currentTab = 'admin';
		$this->targetAction = 'update';
		$this->formValues = $db->getUser(req('id'));
		$this->companies = $db->getCompanies(0, "title ASC", 0, true,true);
		$this->render('useredit.php');
	}

function getTestimony() {
	global $db;	
	echo 	json_encode($db->getRandomTestimony());
}

function userReview() {
	global $db;	
	$this->title="Avis des consommateurs ayant utilisés l'appli ecocompare";
	$this->description="Liste des avis des consommateurs engagés ayant utilisés l'application ecocompare iphone ou android";
	$this->userReviews=$db->getUserReview();
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
		$this->onload="";
		$this->title="Avis des ecoacteurs ayant utilisés l'application ecocompare";
		$this->currentTab = 'userreview';
		$this->render('userreview.php');
	
}

	function editPassword(){
		requireRights($_SESSION['user']['id']);
		global $db;
		$this->currentTab = 'admin';
		$this->formValues = array();
		$this->formValues['returnurl'] = req("returnurl");
		$this->render('passwordedit.php');
	}

	function updatePassword(){
		requireRights($_SESSION['user']['id']);
		global $db;
		
		$params = array();
		
		$params['password'] = sha1(req('password'));		
		
		$db->updateUser($_SESSION['user']['id'], $params);
		header('Location: '.req('returnurl'));
	}

	function add(){
		requireAdmin();
		global $db;
		$this->currentTab = 'admin';
		$this->targetAction = 'insert';
		//$this->formValues = $db->getUser(req('id'));
		$this->companies = $db->getCompanies(0, "title ASC", 0, true,true);
		$this->render('useredit.php');
	}

	function insert(){
		requireAdmin();
		global $db;

		if (reqOrDefault('sendmail','off')=='on') $this->sendAccount(req('email'),req('password'), req('username'));

		$db->createUser($this->paramsList());
		header('Location: '.$GLOBALS['base'].'users/admin');
	}

	function update(){
		requireAdmin();
		global $db;
			if (reqOrDefault('sendmail','off')=='on') $this->sendAccount(req('email'),req('password'), req('username'));
			
		$db->updateUser(req('id'), $this->paramsList());
	
		header('Location: '.$GLOBALS['base'].'/users/admin');
	}

	function delete(){
	
		requireAdmin();
		global $db;
		$db->deleteUser(req('id'));
		header('Location: '.$GLOBALS['base'].'/users/admin');		

	}

	function login(){
		global $db;
		
		if ($db->checkUser(req('username'), req('password'))){
			$_SESSION['admin'] = true;
			header('Location: '.$GLOBALS['base'].'products?action=admin');
		}else{
			header('Location: '.$GLOBALS['base'].'login');
		}
	}

	function paramsList(){
		$params = array();
		$params['username'] = req('username');
		$params['email'] = req('email');
		$params['type'] = req('type');
		$params['companyid'] = req('companyid');
		$params['lang'] = req('langid');
		if (req('password') != ''){
			$params['password'] = sha1(req('password'));
		}
		return $params;
	}

	function logout(){
		session_destroy();
		header('Location: '.$GLOBALS['base']);
	}

function sendAccount($userEmail,$userMdp, $userName){
		$to      = 'support@ecocompare.com';
		$subject = 'Votre compte PRO ecocompare ';
		$headers = 'From: Ecocompare <support@ecocompare.com>'."\n";
		$headers.= 'Bcc:support@ecocompare.com'."\r\n";
 		$headers.= "Content-Type: text/plain; charset=UTF-8;";
   	$message = "Bonjour, \n\nVoici les informations de connexion concernant votre compte ecocompare '".$userName."' : \n\n Lien de connexion :  ".$GLOBALS['base']."login \n Identifiant : $userEmail\n Mot de passe : $userMdp \n\n";
   	$message.="Avec ce compte vous pourrez créer, modifier des produits mais aussi accéder au guide d'accompagnement ou encore mettre à jour la démarche environnementale de votre société qui apparaitra dans la rubrique 'entreprises engagées'. \n\n";
		$message.="Nous restons à votre diposition si vous avez des questions.\n\nCordialement\nL'équipe ecocompare - support@ecocompare.com - +33 4 75 70 18 11";
		$rc=mail($userEmail, $subject, $message, $headers);
		
	}
	
	function showImage(){
		global $db;
				
		if (req("size") == "thumb"){
			$width = 75;
		}else{
			$width = 145;
		}
		
		$user=$db->getMobileUser(req('id'));
		
		$name = 'cache/'.req('size').'mobileuser'.req('id').'.jpg';
		if (!file_exists('./'.$name)){
			$original = './iphone/usersImages/'.req('id').'.png';
			
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
				//$resampledImage = imageCreateTruecolor($width, $width);
				//imagejpeg($resampledImage, $name, 85);
				if ($user['gender']=='Femme') 	$name="images/ecoacteurs/noimagef.png"; else $name="images/ecoacteurs/noimageh.png";
			}
		}
		
		header('location: ./'.$name);
	}
}