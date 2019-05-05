<?php	
header('Content-Type: application/json');

require_once('../models/Db.php');

$db = new Db();


if(isset($_GET['id'])&&isset($_GET['id_categorie'])&&isset($_GET['id_parent'])){

	$params = array(
			  'id_ecoac' => $_GET['id'], 
			  'id_categorie' => $_GET['id_categorie'],
			  'id_parent' => $_GET['id_parent'],
			);
	$db->insertEcoacCategorie($params, $first);
	echo json_encode("true");

}
				
?>	