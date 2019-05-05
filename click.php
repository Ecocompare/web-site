<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

  /**
   * tClick v 0.93 beta
   * Copyright 2001 Stephen G. Walizer aka Technomancer all rights reserved.
   * This software is licensed under the GNU GPL. See the file GPL or
   * http://www.gnu.org for details.
   **/
   
//check if call from ecocompare or not

if (isset($_SERVER['HTTP_REFERER'])) $server=$_SERVER['HTTP_REFERER']; else $server='';
if (strpos($server, 'www.ecocompare.com')=== false) {
	header('HTTP/1.0 403 Forbidden');
	die();}
	

if (isset($_GET['url'])) $url=$_GET['url']; else $url="";
if (isset($_GET['id'])) $productid=$_GET['id']; else $productid="";
if (isset($_GET['page']))  $page=$_GET['page']; else $page="";

//if (strpos($url,"http://")===false) $url = "http://".$url;
if ($productid=='') $productid=0;

if ($productid=='' && $page=='' && $url=='') exit;

 // MySQL database information
  $host = 'localhost';
  $username = "usereco";
  $password = "vp2Ko23?";
  $database = "patrick_montier_";
  $clicktable = 'tclicktable';
  $autoadd = 'Y';

  $con = mysql_connect($host, $username, $password);
  mysql_select_db($database);
	mysql_query("SET NAMES 'utf8'");
		
	

if ($url!='http://') $statusCode = validateurl($url); else $statusCode="";
$adresseip=$_SERVER['REMOTE_ADDR'];
$server_addr=$_SERVER['SERVER_ADDR'];
$server_name=$_SERVER['SERVER_NAME'];
if (isset($_SERVER['HTTP_REFERER'])) $http_referer=$_SERVER['HTTP_REFERER']; else $http_referer="";
$http_host=$_SERVER['HTTP_HOST'];
$http_user_agent=$_SERVER['HTTP_USER_AGENT'];


if ($statusCode!='404' ) {

    if($autoadd == 'Y') {
      $query = "INSERT INTO $clicktable (id, url, clicks, deleted,date,ip,productid,page) VALUES (NULL, '$url', 1, 'N',NOW(),'$adresseip',$productid,'".$page."')";
     	mysql_query($query);
       echo mysql_error();
       echo $query;
       
     
    }   
 // }
Header("Location: $url");
exit;
}

else {
	
		$to      = 'contact@ecocompare.com';
		$subject = 'Url notfound : '.$url;
		$headers = 'From: Notification Ecocompare <noreply@ecocompare.com>'.'\n';
 		$headers.= "Content-Type: text/plain; charset=iso-8859-1;";
		$message = "Problème d'url 404 pour la fiche du produit n° $productid et l'url : $url, origine : $http_referer";

		mail($to, $subject, $message, $headers);
	
	   $query = "INSERT INTO productlinkhs (url, productid,date,server_addr,server_name,http_referer,http_host,http_user_agent) VALUES ( '".$url."', $productid,now(),'".$server_addr."','".$server_name."','".$http_referer."','".$http_host."','".$http_user_agent."')";
     mysql_query($query);

	Header("Location: http://www.ecocompare.com");
}
 
 
  mysql_close($con);
  
  exit;
  
  function url_exists($url_a_tester)
{
    $F=@fopen($url_a_tester,"r");

    return ($F)? 1 : 0;
}

function validateurl($url)
{
  // Initialize the handle
  $ch = curl_init();
  // Set the URL to be executed
  curl_setopt($ch, CURLOPT_URL, $url);
  // Set the curl option to include the header in the output
  curl_setopt($ch, CURLOPT_HEADER, true);
  // Set the curl option NOT to output the body content
  curl_setopt($ch, CURLOPT_NOBODY, true);
  /* Set to TRUE to return the transfer
  as a string of the return value of curl_exec(),
  instead of outputting it out directly */
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // Execute it
  $data = curl_exec($ch);
  // Finally close the handle
  curl_close($ch);
  /* In this case, we’re interested in
  only the HTTP status code returned, therefore we
  use preg_match to extract it, so in the second element
  of the returned array is the status code */
  preg_match("/HTTP\/1\.[1|0]\s(\d{3})/",$data,$matches);
  if (isset($matches[1])) return $matches[1]; else return;
}


?>
