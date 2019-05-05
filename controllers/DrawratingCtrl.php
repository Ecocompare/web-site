<?php
require_once('Controller.php');


/*
Page:           _drawrating.php
Created:        Aug 2006
Last Mod:       Mar 18 2007
The function that draws the rating bar.
--------------------------------------------------------- 
ryan masuga, masugadesign.com
ryan@masugadesign.com 
Licensed under a Creative Commons Attribution 3.0 License.
http://creativecommons.org/licenses/by/3.0/
See readme.txt for full credit details.
--------------------------------------------------------- */
class DrawratingCtrl extends Controller{

	var $units = 5;

	function rating_bar($product_id, $units='', $static='', $id_user=null, $rating=null) {
		require_once (dirname(__FILE__).'/../models/Db.php'); // get the db connection info
		
		$db = new Db();
		
		//var_dump($db);exit;
		//set some variables
		$rating_unitwidth = 20;
		if (!$units){
			$units = 10;
		}
		if (!$static){
			$static = FALSE;
		}
		
		if ($rating != null){
			$valueRating = $rating;
		}
		else{
			// get votes, values, ips for the current rating bar
			$valueRating = $db->getAvgRatingProduct($product_id);
		}
		
		
		$voted = false;
		
		if($id_user != null){
			// test si l'utilisateur connecté à déja voté
			$voted = $db->checkUserRate($product_id, $id_user);
		}
		
		// insert the id in the DB if it doesn't exist already
		
		
		$numbers = $db->getCountRatingProduct($product_id);
		if ($numbers < 1){
			$count = 0; 
		}
		else {
			$count=$numbers; 
		}
		
		if ($count==1){
			$tense="vote";
		}
		else{
			$tense="votes";
		}

		// determine whether the user has voted, so we know how to draw the ul/li
		//$req = DB::getInstance()->query("SELECT used_ips FROM ratings WHERE used_ips LIKE '%".$ip."%' AND page_id='".$product_id."'");

		// now draw the rating bar

		$rating_width = number_format($valueRating,2)*$rating_unitwidth;

		$rating1 = @number_format($valueRating,2);
		$rating2 = @number_format($valueRating,2);
		if ($static == 'static') {

				$static_rater = array();
				$static_rater[] .= "\n".'<div class="ratingblock">';
				$static_rater[] .= '<div id="unit_long'.$product_id.'">';
				$static_rater[] .= '<ul id="unit_ul'.$product_id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
				$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
				$static_rater[] .= '</ul>';
				$static_rater[] .= '<p class="static"><strong> '.$rating1.'</strong>/'.$units;
				if ($rating == null){
					$static_rater[] .= ' ('.$count.' '.$tense.')</p>';
				}
				$static_rater[] .= '</div>';
				$static_rater[] .= '</div>'."\n\n";
				return join("\n", $static_rater);
		} 
		else {
			
			$rater ='';
			$rater.='<div class="ratingblock">';
			$rater.='<div id="unit_long'.$product_id.'">';
			$rater.='<ul id="unit_ul'.$product_id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
			$rater.='<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
			$current_rate_width = 20;
			for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
			   if(!$voted) { // if the user hasn't yet voted, draw the voting stars
				  $rater.='<li><a onClick="rate('.$current_rate_width.')" title="'.$ncount.' sur '.$units.'" class="r'.$ncount.'-unit rater" rel="nofollow">'.$ncount.'</a></li>';
			   }
			   $current_rate_width= $current_rate_width + 20;
			}
			
			$ncount=0; // resets the count

			$rater.='  </ul>';
			$rater.='  <p id="total_vote"';
			if($voted){ 
				$rater.=' class="voted"'; 
			}
			$rater.='><strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.')';
			$rater.='  </p>';
			$rater.='</div>';
			$rater.='</div>';
			
			
			return $rater;
		}
	}
	
	function addRate(){
		require_once (dirname(__FILE__).'/../models/Db.php'); // get the db connection info
		$db = new Db();
		
		foreach ($db->getQuestionProduct() as $question){
			$db->addResponseReview($question["id"],$_POST['reponse_'.$question['id'].''],$_POST["id_product"],$_SESSION["id"]);

		}
		$db->addProductReview($_POST['id_product'],$_POST['rate_product'],$_SESSION['id']);
		echo true;
	}
}

?>