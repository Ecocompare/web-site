<?php	

/*NON CONNECTE*/
if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
		?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 

}
/*CONNECTE*/
else{
	echo '<div id="box">';
	/*connecté et email non validé*/
	if($_SESSION['isValid']==0){ 
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

		<h1> Mes préférences </h1>


		<ul class="nav2"> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_priorites">Priorités</a></li> 
			<li id="encours" ><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_criteres">Critères</a></li> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_categories">Catégories</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_labels">Labels</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_marques">Marques</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_impacts">Impacts</a></li>  
		</ul>  
		<hr>
		
		<div>
		<?php
		$souhait = $db->getEcoacSuivreNewsletter($_SESSION['id'], "news_criteres");
		if($souhait){
			echo '<input  id="souhait" checked type="checkbox">Recevoir une alerte mail en fonction de mes critères.';
		}else{
			echo '<input  id="souhait" type="checkbox">Recevoir une alerte mail en fonction de mes critères.';
		}
		?>
		</div></br></br>
	
	<?php

	/*_______________________________________ ENVIRONNEMENTAUX _______________________________________*/
		?>
		<div class="titre_theme" >
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr><td style="width : 50px;font-size : 20px;">&nbsp;&nbsp;+</td><td>Environnementaux</td></tr>
			</table>
		</div>
	
		<div class="divcont" id="envt">
		
		<?php

			$env = $db->getSubratingsTries(1,1);
			$userEnv = $db->getEcoacSubratings(1,1,$_SESSION['id']);


			echo '<div><div class="ss_titre_crit" >Mes critères environnementaux</div>';
			$previouslifecycle = 0;
			echo '<div>';
			foreach($userEnv as $row){
				if($row['lifecycle_id'] != $previouslifecycle){//id_criteria, m_criteria.name, lifecycle_id, theme_id 
					echo '</div><div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>'.$row['namelifecycle'].'</strong></div><div class="invisible">';
				}
				echo '<div class="nomcrit" name="'.$row['lifecycle_id'].'" ><input  name="'.$row['name'].'" type="checkbox" checked value="'.$row['id_criteria'].'">'.$row['name'].'</div>';  
				$previouslifecycle = $row['lifecycle_id'];
			}	
			echo '</div>';
			
			echo '</div><div><div class="ss_titre_crit" >Autres critères environnementaux</div>';
			$previouslifecycle = 0;
			echo '<div>';
			foreach($env as $row){
				if($this->est_dans($userEnv, $row['idcriteria'], 'id_criteria')=== false){
					if($row['lifecycle_id'] != $previouslifecycle){
						echo '</div><div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>'.$row['namelifecycle'].'</strong></div><div class="invisible">';
					}
					echo '<div class="nomcrit"  name="'.$row['lifecycle_id'].'"><input type="checkbox"  name="'.$row['namecriteria'].'" value="'.$row['idcriteria'].'">'.$row['namecriteria'].'</div>';  
					$previouslifecycle = $row['lifecycle_id'];
				}
			}	
			echo '</div></div>';
		?></div><?php
		

	/*_______________________________________ SOCIETAUX _______________________________________*/
	
		?>	
		<div class="titre_theme">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr><td style="width : 50px;font-size : 20px;">&nbsp;&nbsp;+</td><td>Sociétaux</td></tr>
			</table>
		</div>	

	
			<div class="divcont" id="soc" ><?php

			$qualite = $db->getSubratingsTries(3, 1);
			$ethique = $db->getSubratingsTries(5, 1);
			$social = $db->getSubratingsTries(4, 1);
			$fartadens = $db->getSubratingsTries(6, 1);
			$fartadenn = $db->getSubratingsTries(7, 1);

			$userqualite = $db->getEcoacSubratings(3, 1,$_SESSION['id']);
			$userethique = $db->getEcoacSubratings(5, 1,$_SESSION['id']);
			$usersocial = $db->getEcoacSubratings(4, 1,$_SESSION['id']);
			$userfartadens = $db->getEcoacSubratings(6, 1,$_SESSION['id']);
			$userfartadenn = $db->getEcoacSubratings(7, 1,$_SESSION['id']);


			echo '<div><div  class="ss_titre_crit" >Mes critères sociétaux</div>';
			if ($usersocial != null){
				echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Social</strong></div>';
				echo '<div  class="invisible">';
				foreach($usersocial as $row){
					echo '<div class="nomcrit" ><input type="checkbox"  checked value="'.$row['id_criteria'].'">'.$row['name'].'</div>';  
				}
				echo '</div>';
			}
			if ($userqualite!= null){
				echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Qualité</strong></div>';
				echo '<div  class="invisible">';
				foreach($userqualite as $row){
					echo '<div class="nomcrit" ><input type="checkbox"  checked value="'.$row['id_criteria'].'">'.$row['name'].'</div>';  
				}	
				echo '</div>';
			}
			if ($userethique!= null){			
				echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Ethique</strong></div>';
				echo '<div  class="invisible">';				
				foreach($userethique as $row){
				
					echo '<div class="nomcrit" ><input type="checkbox"  checked value="'.$row['id_criteria'].'">'.$row['name'].'</div>';  
				}	
				echo '</div>';
			}
			if ($userfartadens!= null){		
				echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Fartade Nord-Sud</strong></div>';
				echo '<div  class="invisible">';
				foreach($userfartadens as $row){
					echo '<div class="nomcrit" ><input type="checkbox"  checked value="'.$row['id_criteria'].'">'.$row['name'].'</div>';  
				}
				echo '</div>';
			}
			if ($userfartadenn!= null){			
				echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Fartade Nord-Nord</strong></div>';
				echo '<div  class="invisible">';
				foreach($userfartadenn as $row){
					echo '<div class="nomcrit" ><input type="checkbox"  checked value="'.$row['id_criteria'].'">'.$row['name'].'</div>';  
				}	
				echo '</div>';
			}
			echo '</div>';

			
			//env:1-sante:2-qualité:3-social:4-ethique:5-fartrade n/s:6-fartrade n/n:7
			echo '<div><div  class="ss_titre_crit" >Autres critères socitaux</div>';			
				if(count($usersocial) != count($social)){
					echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Social</strong></div>';
					echo '<div  class="invisible">';
					foreach($social as $row){
						if($this->est_dans($usersocial, $row['id'], 'id_criteria')=== false)			
							echo '<div  name="4" class="nomcrit" ><input type="checkbox" name="'.$row['name'].'"  value="'.$row['id'].'">'.$row['name'].'</div>';  
					}
					echo '</div>';
				}
				if(count($userqualite) != count($qualite)){				
					echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Qualité</strong></div>';			
					echo '<div  class="invisible">';
					foreach($qualite as $row){
						if($this->est_dans($userqualite, $row['id'], 'id_criteria')=== false)			
							echo '<div  name="3" class="nomcrit" ><input type="checkbox"  name="'.$row['name'].'" value="'.$row['id'].'">'.$row['name'].'</div>';  
					}	
					echo '</div>';
				}	
				if(count($userethique) != count($ethique)){		
					echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Ethique</strong></div>';
					echo '<div  class="invisible">';
					foreach($ethique as $row){
						if($this->est_dans($userethique, $row['id'], 'id_criteria')=== false)			
							echo '<div  name="5" class="nomcrit" ><input type="checkbox"  name="'.$row['name'].'" value="'.$row['id'].'">'.$row['name'].'</div>';  
					}	
					echo '</div>';
				}
				if(count($userfartadens) != count($fartadens)){				
					echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Fartade Nord-Sud</strong></div>';
					echo '<div  class="invisible">';
					foreach($fartadens as $row){
						if($this->est_dans($userfartadens, $row['id'], 'id_criteria')=== false)			
							echo '<div  name="6" class="nomcrit" ><input type="checkbox"  name="'.$row['name'].'" value="'.$row['id'].'">'.$row['name'].'</div>';  
					}
					echo '</div>';
				}	
				if(count($userfartadenn) != count($fartadenn)){					
					echo '<div onClick="deroule(this);"><img class="exp" src="style/expand2.png"/><strong>Fartade Nord-Nord</strong></div>';
					echo '<div  class="invisible">';
					foreach($fartadenn as $row){
						if($this->est_dans($userfartadenn, $row['id'], 'id_criteria')=== false)			
							echo '<div  name="7" class="nomcrit" ><input type="checkbox"  name="'.$row['name'].'" value="'.$row['id'].'">'.$row['name'].'</div>';  
					}				
					echo '</div>';
				}
				echo '</div>';			
			echo '</div>';

			
	/*_______________________________________ SANITAIRES _______________________________________*/
			?>

		<div class="titre_theme">
			<table border="0" cellspacing="0" cellpadding="0" width="100%">
				<tr><td style="width : 50px;font-size : 20px;">&nbsp;&nbsp;+</td><td>Sanitaires</td></tr>
			</table>
		</div>
		<div class="divcont" id="san"><?php

		$sante = $db->getSubratingsTries(2, 1);
	
		$usersante = $db->getEcoacSubratings(2, 1,$_SESSION['id']);

			echo '<div><div  class="ss_titre_crit" >Mes critères sanitaires</div>';
			foreach($usersante as $row){
					echo '<div class="nomcrit" ><input type="checkbox" checked name="'.$row['name'].'" value="'.$row['id_criteria'].'">'.$row['name'].'</div>';  
				}
			echo '</div>';
				
			echo '<div><div  class="ss_titre_crit" >Autres critères sanitaires</div>';			
			foreach($sante as $row){
				if($this->est_dans($usersante, $row['id'], 'id_criteria')=== false){			
					echo '<div class="nomcrit" ><input type="checkbox"  name="'.$row['name'].'" value="'.$row['id'].'">'.$row['name'].'</div>';  
				}
			}
			echo '</div>';
		
			echo '</div>';

			
?>		
<?php
echo '<input type="hidden" value="'.$_SESSION['id'].'" id="iduser">';
	}} echo '</div></br></br></br>'; } ?> 

			
<script>
	$(document).ready( function () {
		$(".divcont").hide();   
	 
		$(".titre_theme").click( function () {
			if($(this).next("div").css("display") == "none"){
				$(".divcont").slideUp("normal");
				$(this).next("div").slideDown("normal");
				$(document).scrollTop(0);
			}
		});
	});

	$("#souhait").click( function () {
		url = "compte_ecoacteur/updateSuivreNewsletter.php";
		id = document.getElementById('iduser').value;
		nompreference = "news_criteres";	
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
			
				
	function deroule(elm){
		if(elm.nextSibling.style.display == 'block'){
			elm.nextSibling.style.display = 'none';
			elm.firstChild.src="style/expand2.png";
		}
		else{
			elm.nextSibling.style.display = 'block';
			elm.firstChild.src="style/expand.png";
		}
	}



	$('#soc input[type=checkbox]').click( function () {
		
		if($(this).is(':checked')){
			url = "compte_ecoacteur/addUserCritere.php";
			theme_id = $(this).parent().attr('name');
			id = document.getElementById('iduser').value;
			idcritere = $(this).val();
			nomcritere = $(this).attr('name');
			$(this).parent().css("background","#f0fcec");
			$.ajax({
				url: url,
				data:{id: id, idcriteria: idcritere},
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
			url = "compte_ecoacteur/deleteUserCritere.php";
			id = document.getElementById('iduser').value;
			idcritere = $(this).val();
			$(this).parent().css("background","#fcecec");
			$.ajax({
				url: url,
				data:{id: id, idcriteria: idcritere},
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

	$('#envt input[type=checkbox]').click( function () {
		
		if($(this).is(':checked')){
			url = "compte_ecoacteur/addUserCritere.php";
			lifecycleid = $(this).parent().attr('name');
			id = document.getElementById('iduser').value;
			idcritere = $(this).val();
			nomcritere = $(this).attr('name');
			$(this).parent().css("background","#f0fcec");		
			$.ajax({
				url: url,
				data:{id: id, idcriteria: idcritere},
				contentType:'application/json',
				dataType: 'json',
				type:'GET',
				success: function(data){				
	//				alert("ok");
				},
				error: function(){
					console.log('Error');
				}
			});
		}else{
			url = "compte_ecoacteur/deleteUserCritere.php";
			id = document.getElementById('iduser').value;
			idcritere = $(this).val();
			$(this).parent().css("background","#fcecec");
			$.ajax({
				url: url,
				data:{id: id, idcriteria: idcritere},
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


	$('#san input[type=checkbox]').click( function () {
		
		if($(this).is(':checked')){
			url = "compte_ecoacteur/addUserCritere.php";
			id = document.getElementById('iduser').value;
			idcritere = $(this).val();
			nomcritere = $(this).attr('name');
			$(this).parent().css("background","#f0fcec");		
			$.ajax({
				url: url,
				data:{id: id, idcriteria: idcritere},
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
			url = "compte_ecoacteur/deleteUserCritere.php";
			id = document.getElementById('iduser').value;
			idcritere = $(this).val();
			$(this).parent().css("background","#fcecec");
			$.ajax({
				url: url,
				data:{id: id, idcriteria: idcritere},
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

</script>		
	
<style>

.exp{
	margin : 0 3px;
}

.ss_titre_crit{
	text-align : center;
	color : #78ba14;
	font-weight : bold;
	font-size : 12px;
	border-top :  1px solid #78ba14;
	border-bottom :  1px solid #78ba14;
	margin-top : 10px;
}

.nomcrit{
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

.criteres{
²	background : #e8e8e8;
}
</style>			