<?php
	
mysql_connect("localhost", "ecocomp", "Zt95xxp");
mysql_select_db("ecocompare");
mysql_query("SET NAMES 'utf8'");
		
$ean=$_REQUEST['ean'];
$query = "SELECT id FROM products where EAN LIKE '".$ean."'";
$results = mysql_query($query);
$result = mysql_fetch_assoc($results);
$id =$result['id'];

//echo ">>".$id;	
if ($id > 0) { header('Location: /products/show/'.$id); }
else {header('Location: /');}

?>