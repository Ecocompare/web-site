<?php		
/*NON CONNECTE*/
if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
		?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 

}
/*CONNECTE*/
else{
	echo '<div id="box">';
	/*connecté et email non validé*/
	if($_SESSION['isValid']==0){ //TODO : TESTER LA FONCTION RESEND
		echo "Afin d'utiliser les fonctionnalités éco-acteur, vous devez valider votre adresse email. Si vous n'avez pas reçu d'email, vous pouvez toujours vous en renvoyer un depuis le bouton ci-dessous.
				<input type='button' value='Renvoyez-moi un mail' onClick='resendValidationMail(".$_SESSION['id'].");' />";
	}
	/*connecté et email validé*/
	else{
		if(!isset($_SESSION['name'])||!isset($_SESSION['gender'])||!isset($_SESSION['birthyear'])||!isset($_SESSION['postalcode'])){
			?>	<script> window.top.location.href="http://www.ecocompare.com/espace-eco-acteur.html?section=informations_personnelles"; </script>   <?php 
		}else{
?>		
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> /compte_ecoacteur/css/preferences.css">	
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /compte_ecoacteur/account.js"></script>

		<h1> Mes impacts </h1>


		<ul class="nav2"> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_priorites">Priorités</a></li> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_criteres">Critères</a></li> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_categories">Catégories</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_labels">Labels</a></li>
  			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_marques">Marques</a></li>  
			<li id="encours" ><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_impacts">Impacts</a></li>  
		</ul>  
		<HR>

				<div>
				<?php
				$souhait = $db->getEcoacSuivreNewsletter($_SESSION['id'], "news_impacts");
				if($souhait){
					echo '<input  id="souhait" checked type="checkbox">Recevoir une alerte mail en fonction de mes impacts.';
				}else{
					echo '<input  id="souhait" type="checkbox">Recevoir une alerte mail en fonction de mes impacts.';
				}
				?>
				</div></br></br>

				<div class="divcont" id="impacts"><?php

			$impacts = $db->getAllImpacts();
			$userimpacts = $db->getEcoacImpacts($_SESSION['id']);

				echo '<div><div class="ss_titre_impact" >Mes impacts</div>';
				foreach($userimpacts as $row){
						echo '<div class="nomimpact" ><input type="checkbox" checked name="'.$row['name'].'" value="'.$row['id_impact'].'">'.$row['name'].'</div>';  
					}
				echo '</div>';
					
				echo '<div><div  class="ss_titre_impact" >Autres impacts</div>';			
				foreach($impacts as $row){
				if($this->est_dans($userimpacts, $row['id'], 'id_impact')=== false){			
						echo '<div class="nomimpact" ><input type="checkbox"  name="'.$row['name'].'" value="'.$row['id'].'">'.$row['name'].'</div>';  
					}
				}
				echo '</div>';

		?></div><?php

		
		}
	}  
	echo '<input type="hidden" value="'.$_SESSION['id'].'" id="iduser">';
echo '</div></br></br></br>';
}	
?> 


<script>
	$("#souhait").click( function () {
		url = "compte_ecoacteur/updateSuivreNewsletter.php";
		id = document.getElementById('iduser').value;
		nompreference = "news_impacts";	
		if($(this).is(':checked')){
			souhait = 1;	
			$.ajax({
				url: url,
				data:{id: id, souhait: souhait, nompreference: nompreference},
				contentType:'application/json',
				dataType: 'json',
				type:'GET',
				success: function(data){				
				},
				error: function(){
					console.log('Error');
				}
			});
		}else{
			souhait = 0;	
			$.ajax({
				url: url,
				data:{id: id, souhait: souhait, nompreference: nompreference},
				contentType:'application/json',
				dataType: 'json',
				type:'GET',
				success: function(data){				
				},
				error: function(){
					console.log('Error');
				}
			});
		}
	});

$('#impacts input[type=checkbox]').click( function () {
	
	if($(this).is(':checked')){
		url = "compte_ecoacteur/addUserImpact.php";
		id = document.getElementById('iduser').value;
		idimpact = $(this).val();
		$(this).parent().css("background","#f0fcec");		
		$.ajax({
			url: url,
			data:{id: id, id_impact: idimpact},
			contentType:'application/json',
			dataType: 'json',
			type:'GET',
			success: function(data){				
			},
			error: function(){
				console.log('Error');
			}
		});
	} else{
		url = "compte_ecoacteur/deleteUserImpact.php";
		id = document.getElementById('iduser').value;
		idimpact = $(this).val();
		$(this).parent().css("background","#fcecec");
		$.ajax({
			url: url,
			data:{id: id, id_impact: idimpact},
			contentType:'application/json',
			dataType: 'json',
			type:'GET',
			success: function(data){
			},
			error: function(){
				console.log('Error');
			}
		});

	} 
});



function deroule(elm){
	if(elm.nextSibling.style.display == 'block'){
		elm.nextSibling.style.display = 'none';
		console.log(elm.firstChild.src);
		elm.firstChild.src="style/expand2.png";
	}
	else{
		elm.nextSibling.style.display = 'block';
		elm.firstChild.src="style/expand.png";
	}
}

</script>
<style>
.exp{
	margin : 0 3px;
}

.ss_titre_impact{
	text-align : center;
	color : #78ba14;
	font-weight : bold;
	font-size : 12px;
	border-top :  1px solid #78ba14;
	border-bottom :  1px solid #78ba14;
	margin-top : 10px;
}

.nomimpact{
	border-bottom :  1px solid #eaebe9;
	padding : 2px 8px;
} 

.titre_theme{
	cursor : pointer;
	font-size : 13px;
	font-weight :bold;
	color : white;
	background : #78ba14;
	text-align : left;
	margin-top : 5px;
	margin-bottom : 5px;
}

.divcont{
	width : 98.86%;
	-moz-box-shadow: inset 0 2px 8px rgba(0,0,0,.2);
	-webkit-box-shadow: inset 0 2px 8px rgba(0,0,0,.2);
	box-shadow: inset 0 2px 8px rgba(0,0,0,.2);
	
	background : #f9f9f9;
	padding : 5px;
	margin-bottom : 10px;
}

.impact{
	background : #e8e8e8;
}

</style>
		