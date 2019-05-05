<?php
session_start();

//	class Session{	

		function newsession($user = NULL, $userstat = NULL, $typecnx = NULL){
		
			if($typecnx != NULL){
				$_SESSION['typecnx'] = $typecnx;
			}				
			if ($user != NULL){
				$_SESSION['isValid'] = $user['isValid'];		
				$_SESSION['email'] = $user['email'];
				$_SESSION['id'] = $user['id'];
				$_SESSION["name"] = $user['name'];
				$_SESSION["gender"] = $user['gender'];
				$_SESSION["birthyear"] = $user['birthyear'];
				$_SESSION["postalcode"] = $user['postalcode'];
				$_SESSION["ville"] = $user['ville'];
				$_SESSION["address"] = $user['address']; 
				$_SESSION["tel"] = $user['tel'];
				$_SESSION["activite"]= $user['job'];	
				$_SESSION["nbchild"]= $user['nb_child'];
				$_SESSION["description"]= $user['description'];
				$_SESSION["haspwd"]= ($user['pwd'] != "") ? true : false;
			}
			if ($userstat != NULL){
				//	$_SESSION["nbpoints"]=$user['donnees']['nbpoints'];
				//	$_SESSION["position"]="";
				$_SESSION["total_scan"]=$userstat['total_scan'];
				$_SESSION["total_resp_scan"]=$userstat['total_resp_scan'];
				$_SESSION["medailles"]="";

			}	
		}
		
//	}	
		
?>	