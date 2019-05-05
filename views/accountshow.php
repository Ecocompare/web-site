<?php



	if (isset($_GET['section'])){
	
		$section = $_GET['section'];
		if($section== "informations_personnelles"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/infos.php");
		}
		else if($section== "modifier_mot_de_passe"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/maj_password.php");
		}
		else if($section== "derniers_scans"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/scans.php");
		}		
		else if($section== "saisie_EAN"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/saisie_ean.php");
		}
		else if($section== "preferences"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/priorites.php");
		}
		else if($section== "mes_priorites"){/*debut preferences utilisateur*/
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/priorites.php");
		}
		else if($section== "mes_criteres"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/criteres.php");
		}
		else if($section== "mes_labels"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/labels.php");
		}
		else if($section== "mes_categories"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/categories.php");
		}
		else if($section== "mes_marques"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/marques.php");
		}
		else if($section== "mes_impacts"){
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/impacts.php");
		}
		else if($section== "mes_avis"){
			include($_SERVER["DOCUMENT_ROOT"]."/views/avis.php");
		}
						/*fin preferences utilisateur*/
		else{
			include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/account.php");
		}

	}else{
		//include(dirname(__FILE__)."/../compte_ecoacteur/account.php");
		
		include($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/account.php");
		//var_dump($_SERVER["DOCUMENT_ROOT"]."/compte_ecoacteur/account.php");
	}
?>
