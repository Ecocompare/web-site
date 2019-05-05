<?php
require_once('Controller.php');

class CommentCtrl extends Controller{
	
	function admin(){
		global $db;
		$this->comments = $db->getPendingComments();
		
		$this->currentTab = "admin";	
		$this->render('commentadmin.php');
	}

	function validate(){
		global $db;
		$db->updateComment(req('id'), array('state' => 'published'));
		if (req('productid') == 0){
			$this->comments = $db->getPendingComments();
		}else{
			$this->comments = $db->getComments(req('productid'));
		}

		$this->renderList($this->comments, req('productid'));
	}
	
	function delete(){
		global $db;
		$db->updateComment(req('id'), array('state' => 'deleted'));
		if (req('productid') == 0){
			$this->comments = $db->getPendingComments();
		}else{
			$this->comments = $db->getComments(req('productid'));
		}

		$this->renderList($this->comments, req('productid'));
	}
	
	function edit(){
		global $db;
		$this->formValues = $db->getComment(req('id'));
		$this->currentTab = "admin";	
		$this->render('commentedit.php');
	}
	
	function update(){
		global $db;
		$db->updateComment(req('id'), $this->paramsList());
		header('Location: '.req('returnurl'));
	}

	function add(){
		global $db;
		$googleResponse = false;
		$ch = curl_init("https://www.google.com/recaptcha/api/siteverify");
		curl_setopt_array($ch, array(CURLOPT_POSTFIELDS => array("secret" => "6LfRqVgUAAAAACFmq1bxZZH6o1_gldZ-1NYgKMnb", "response" => $_POST["g-recaptcha-response"]), CURLOPT_RETURNTRANSFER => true));
		$response = curl_exec($ch);
		if(curl_errno($ch) == false && json_decode($response)->success == true) {
			$googleResponse = true;
		}
		curl_close($ch);
		
		if ($googleResponse==true) {
			$db->addComment($this->paramsList());
			$this->sendNotification();
			header('Location: '.$GLOBALS['base'].'content/show/commentaire envoye');	
			exit;			
		}else{
			echo '<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>Réponse à la question de vérification anti-spam erronée</body>';
		}
	}
	
	function renderList($comments, $productId = 0){
		include('./views/commentlist.php');	
	}

	function sendNotification(){
		$to      = 'contact@ecocompare.com';
		$subject = 'Nouveau commentaire sur Ecocompare de '.reqOrDefault('name', 'Anonyme');
		$headers = 
			'From: '.reqOrDefault('name', '').'<'.reqOrDefault('email', '').'>'."\n".
    		'Reply-To: '.reqOrDefault('email', '')."\n";
 		$headers.= "Content-Type: text/plain; charset=UTF-8;";
    	$message = reqOrDefault('text', '');
    	$message .= "\n\nhttp://www.ecocompare.com/comments/admin";
		mail($to, $subject, $message, $headers);
	}
	
	private function paramsList(){
		$params['type'] = req('type');
		$params['productid'] = req('productid');
		$params['name'] = req('name');
		$params['email'] = req('email');
		$params['text'] = req('text');
		return $params;
	}
}
