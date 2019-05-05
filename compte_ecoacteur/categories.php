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
			?>	<script> window.top.location.href="http://ecocompare.com/espace-eco-acteur.html?section=informations_personnelles"; </script>   <?php 
		}else{
?>		
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> /compte_ecoacteur/css/preferences.css">	
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /compte_ecoacteur/account.js"></script>

		<h1> Mes préférences </h1>


		<ul class="nav2"> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_priorites">Priorités</a></li> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_criteres">Critères</a></li> 
			<li id="encours"><a href="<?php dirname(__FILE__)?>/espace-eco-acteur.html?section=mes_categories">Catégories</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_labels">Labels</a></li>
  			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_marques">Marques</a></li>  
			<li ><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_impacts">Impacts</a></li>  
		</ul>  
		<HR>
		
				<div>
				<?php
				$souhait = $db->getEcoacSuivreNewsletter($_SESSION['id'], "news_categories");
				if($souhait){
					echo '<input  id="souhait" checked type="checkbox">Recevoir une alerte mail en fonction de mes catégories.';
				}else{
					echo '<input  id="souhait" type="checkbox">Recevoir une alerte mail en fonction de mes catégories.';
				}
				?>
				</div></br></br>
			


		<div class="divcont" id="cat">
		
		<?php

			$cat = $db->getAllCategories();
			$userCat = $db->getEcoacCategories($_SESSION['id']);
	

	
			echo '<div><div class="ss_titre_cat" >Mes catégories</div>';
			$previousparent = 0;
			echo '<div>';
			foreach($userCat as $row){
				if($row['idparentcat'] != $previousparent){
					echo '</div><div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>'.$row['nomparent'].'</strong></div><div class="invisible">';
				}
				echo '<div class="nomcat" ><input  name="'.$row['idparentcat'].'" type="checkbox" checked value="'.$row['idcat'].'">'.$row['nomcat'].'</div>';  
				
				$previousparent = $row['idparentcat'];
			}	
			echo '</div>';
			
			echo '</div><div><div class="ss_titre_cat" >Autres catégories</div>';
			$previousparent = 0;
			echo '<div>';
			foreach($cat as $row){
				if($this->est_dans($userCat, $row['idcat'], 'idcat')=== false){
					if($row['idparentcat'] != $previousparent){
						echo '</div><div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>'.$row['nomparent'].'</strong></div><div class="invisible">';
					}

					echo '<div class="nomcat" ><input type="checkbox"  name="'.$row['idparentcat'].'" value="'.$row['idcat'].'">'.$row['nomcat'].'</div>';  
					
					$previousparent = $row['idparentcat'];
				}
			}	
			echo '</div></div>';
	

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
		nompreference = "news_categories";	
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

$('#cat input[type=checkbox]').click( function () {
	
	if($(this).is(':checked')){
		url = "compte_ecoacteur/addUserCat.php";
		id = document.getElementById('iduser').value;
		idcat = $(this).val();
		idparent = $(this).attr('name');
		nbcat = $(this).attr('id');

		$(this).parent().css("background","#f0fcec");		
		$.ajax({
			url: url,
			data:{id: id, id_categorie: idcat, id_parent: idparent},
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
		url = "compte_ecoacteur/deleteUserCat.php";
		id = document.getElementById('iduser').value;
		idcat = $(this).val();
		nbcat = $(this).attr('id');
		idparent = $(this).attr('name');
		$(this).parent().css("background","#fcecec");
		$.ajax({
			url: url,
			data:{id: id, id_categorie: idcat, id_parent: idparent},
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

.divexp:hover{
	cursor : pointer;
}

.exp{
	margin : 0 3px;
}

.ss_titre_cat{
	text-align : center;
	color : #78ba14;
	font-weight : bold;
	font-size : 12px;
	border-top :  1px solid #78ba14;
	border-bottom :  1px solid #78ba14;
	margin-top : 10px;
}

.nomcat{
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

.cat{
	background : #e8e8e8;
}

</style>
