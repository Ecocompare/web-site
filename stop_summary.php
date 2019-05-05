<?php
//error_reporting(E_ALL);
//ini_set('display_errors','On');
/** supprime l'abonnement recap hebdomadaire **/


$id=$_GET['id'];

 // MySQL database information
  $host = 'localhost';
  $username = 'usereco';
  $password = 'TrB6uXzz';
  $database = 'ecocompare';


  $con = mysql_connect($host, $username, $password);
  mysql_select_db($database);
	mysql_query("SET NAMES 'utf8'");
		
$query="update iphone_users set stopsummary=1 where iphone_id='".$id."'";
$results = mysql_query($query);

Header("Location: http://www.ecocompare.com");
exit;

?>
