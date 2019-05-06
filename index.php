<?php

function microtime_float()
{
    list($usec, $sec) = explode(" ", microtime());
    return ((float)$usec + (float)$sec);
}

	$startTime = microtime(true);
	
session_start();


//error_reporting(E_ERROR);
error_reporting(E_ALL);
ini_set('display_errors',1);

//maintenance
//if("88.185.120.172" != $_SERVER['REMOTE_ADDR'] and  "89.156.78.139" != $_SERVER['REMOTE_ADDR'] and "217.128.32.105" != $_SERVER['REMOTE_ADDR'] and "109.190.18.157" != $_SERVER['REMOTE_ADDR']) {
//header("location: /mmaintenance.html");
//exit;}

	require_once('models/Db.php');
	$db = new Db();
	$GLOBALS['base'] = "https://www.ecocompare.com/";
	$GLOBALS['productsperpage'] = 10;
	$GLOBALS['ctrl'] = reqOrDefault('ctrl', 'Home');
	$GLOBALS['action'] = reqOrDefault('action', 'show');
	$GLOBALS['method_version']="2.0";
		
	//echo $_SERVER['REQUEST_URI'];

	require_once('controllers/'.$GLOBALS['ctrl'].'Ctrl.php');
	
	eval ('$ctrlObj = new '.$GLOBALS['ctrl'].'Ctrl();');
	if ($ctrlObj instanceOf Controller){
		eval ('$ctrlObj->'.$GLOBALS['action'].'();');
	}

//nom du répertoire des langues
function langdir($lang=1) {
$array = array("1" => "fr/","2" => "en/");
return $array[$lang];
}

	function req($key){
		if (isset($_REQUEST[$key])){
			return $_REQUEST[$key];
		}else{
			echo 'Invalid request';
			exit;
		}
	}

function arrondir($valeur) {
	$entier=intval($valeur);
	$decimale=$valeur-$entier;
	
	//echo "$entier : $decimale";
	
	if ($decimale >0.5) return round($entier+1,1);
	if ($decimale <0.5) return round($entier,1);
	if ($decimale ==0.5) return round($valeur,1);
	
}

 function arrondir2($valeur) {
	$entier=intval($valeur);
	$decimale=$valeur-$entier;
	
	//echo "$entier : $decimale";
	
	if ($decimale ==0) return round($valeur); else return($valeur);
	
}

 function arrondir_demi($valeur) {
	return (round($valeur*2)/2);
	
}

	function reqOrDefault($key, $default = ''){
		if (isset($_REQUEST[$key]) && $_REQUEST[$key] != ''){
			return $_REQUEST[$key];
		}else{
			return $default;
		}
	}
	
	function encodeQuotes($string){
	  return str_replace ('"', "&quot;", $string );
	}

	function toURL($string){
		$string = mb_ereg_replace('é', 'e', $string);
		$string = mb_ereg_replace('à', 'a', $string);
		$string = mb_ereg_replace('è', 'e', $string);
		$string = mb_ereg_replace('ê', 'e', $string);	
		$string = mb_ereg_replace('ô', 'o', $string);
		$string = mb_ereg_replace('&', '-', $string);
		$string = mb_ereg_replace(' ', '-', $string);
		$string = mb_ereg_replace('\:', '-', $string);
		$string = mb_ereg_replace('\?', '-', $string);
		$string = mb_ereg_replace('\&', '-', $string);
		$string = mb_ereg_replace('\!', '-', $string);
		$string = mb_ereg_replace('\'', '-', $string);
		$string = mb_ereg_replace('/', '-', $string);
		$string = mb_ereg_replace('ç', 'c', $string);
		$string = mb_ereg_replace('"', '-', $string);
		$string = mb_ereg_replace(',', '-', $string);
		$string = mb_ereg_replace('î', 'i', $string);
		$string = mb_ereg_replace('ï', 'i', $string);
		$string = urlencode($string);
		return $string;
    }



	function trimText($text, $max){
		$rv = mb_substr(strip_tags(trim($text)), 0, $max);
		$lastSpace = mb_strrpos($rv, ' ');
		$rv = mb_substr($rv, 0, $lastSpace);
		$rv .= "...";
		return $rv;
	}

	function mb_ucfirst ($string){
        return mb_strtoupper (mb_substr ($string, 0, 1)) . mb_substr ($string, 1, mb_strlen ($string) - 1);
	}

	
	function text($id){
		global $db;
		$freeText = $db->getFreeText($id);
		return $freeText['text'];
	}
	
function autolink($text,$productid) {
  $pattern = "/(((http[s]?:\/\/)|(www\.))?(([a-z][-a-z0-9]+\.)?[a-z][-a-z0-9]+\.[a-z]+(\.[a-z]{2,2})?)\/?[a-z0-9._\/~#&=;%+?-]+[a-z0-9\/#=?]{1,1})/is";

  $text = preg_replace($pattern, " <a href='/click.php?id=$productid&url=$1' itemprop='url' target='_blank'>$1</a>", $text);
  //$text = preg_replace("/href=\"www/", "http://www", $text);
  return $text;
}
	
	function admin(){
		if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'admin'){
			return true;
		}else{
			return false;
		}
	
	}

	function company(){
		if (isset($_SESSION['user']) && $_SESSION['user']['type'] == 'company'){
			return true;
		}else{
			return false;
		}
	}
	
	function checkRights($userId){
		if (isset($_SESSION['user']) && ($_SESSION['user']['type'] == 'admin' || $_SESSION['user']['id'] == $userId)){
			return true;
		}else{
			return false;
		}
	}
	
	function requireAdminOrCompany(){
		if (admin() || company()){
			return true;
		}else{
			exit;
		}
	}
	
	function requireRights($userId){
		if (checkRights($userId)){
			return true;
		}else{
			exit;
		}
	}
	
	function requireAdmin(){
		if (admin()){
			return true;
		}else{
			exit;
		}
	
	}
	


?>
