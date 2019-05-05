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
			echo '<input type="hidden" value="'.$_SESSION['id'].'" id="iduser">';
			$userPriorites = $db->getUserPriority($_SESSION['id']);
			 	 	 	 	 	 	 	 
			$pourcent_environnemental = $userPriorites['pourcent_environnemental'];
			$pourcent_sanitaire = $userPriorites['pourcent_sanitaire'];
			$pourcent_societal = $userPriorites['pourcent_societal'];
			
			$pourcent_social = $userPriorites['pourcent_social'];
			$pourcent_ethique = $userPriorites['pourcent_ethique'];
			$pourcent_fairtrade_n_s = $userPriorites['pourcent_fairtrade_n_s'];
			$pourcent_fairtrade_n_n = $userPriorites['pourcent_fairtrade_n_n'];
			$pourcent_qualite = $userPriorites['pourcent_qualite'];
			
			$pourcent_social2 = round($userPriorites['pourcent_social']/ $pourcent_societal*100 , 0);
			$pourcent_ethique2 = round($userPriorites['pourcent_ethique']/ $pourcent_societal*100 , 0);
			$pourcent_fairtrade_n_s2 = round($userPriorites['pourcent_fairtrade_n_s']/ $pourcent_societal*100 , 0);
			$pourcent_fairtrade_n_n2 = round($userPriorites['pourcent_fairtrade_n_n']/ $pourcent_societal*100 , 0);
			$pourcent_qualite2 = round($userPriorites['pourcent_qualite']/ $pourcent_societal*100 , 0);
			
			echo "<input type='hidden' id='valenvironnemental' value='".$pourcent_environnemental."' >";
			echo "<input type='hidden' id='valsanitaire' value='".$pourcent_sanitaire."' >";
			echo "<input type='hidden' id='valsocietal' value='".$pourcent_societal."' >";
			echo "<input type='hidden' id='valsocial' value='".$pourcent_social."' >";
			echo "<input type='hidden' id='valethique' value='".$pourcent_ethique."' >";
			echo "<input type='hidden' id='valfairtrade_n_s' value='".$pourcent_fairtrade_n_s."' >";
			echo "<input type='hidden' id='valfairtrade_n_n' value='".$pourcent_fairtrade_n_n."' >";
			echo "<input type='hidden' id='valqualite' value='".$pourcent_qualite."' >";
		?>

		<link rel="stylesheet" href="<?php dirname(__FILE__)?> /compte_ecoacteur/css/preferences.css">	
		<script type="text/javascript" src="<?php dirname(__FILE__)?> /compte_ecoacteur/account.js"></script>

		<h1> Mes préférences </h1>


		<ul class="nav2"> 
			<li id="encours" ><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_priorites">Priorités</a></li> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_criteres">Critères</a></li> 
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_categories">Catégories</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_labels">Labels</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_marques">Marques</a></li>  
			<li><a href="<?php dirname(__FILE__)?> /espace-eco-acteur.html?section=mes_impacts">Impacts</a></li>  
		</ul>  
		<HR>
			<div>	
				<div>
				<?php
				$souhait = $db->getEcoacSuivreNewsletter($_SESSION['id'], "news_priorites");
				if($souhait){
					echo '<input  id="souhait" checked type="checkbox" >Recevoir une alerte mail en fonction de mes priorités.';
				}else{
					echo '<input  id="souhait" type="checkbox" >Recevoir une alerte mail en fonction de mes priorités.';
				}
				?>
				</div></br></br>
			
				<div id="" >
					<span style = "margin : 0 10px;text-align : center;" id="choix12">Environnement : <?php echo $pourcent_environnemental; ?>% </span>
					<span style = "margin : 0 10px;text-align : center;" id="choix22">Sociétal  : <?php echo $pourcent_societal; ?>% </span>
					<span style = "margin : 0 10px;text-align : center;" id="choix32">Santé : <?php echo $pourcent_sanitaire; ?>%</span>
					<br>
					<table id="t1" width="480" cellspacing="0" cellpadding="0" border="0" ><!--class="CRZ"-->
						<tr><!--Societal et Social inversés sur le background de ce tableau-->
							<td id="env2" style="width: <?php echo $pourcent_environnemental/100*480; ?>px;" </td>
							<td id="social2" style="width: <?php echo $pourcent_societal/100*480; ?>px;">	</td>
							<td id="sante2" style="width: <?php echo $pourcent_sanitaire/100*480; ?>px;">	</td>						
						</tr>
					</table>
				</div>

				<div>
				<img style="z-index : -1;margin-left : 180px;height:85px;width : 550px;" src="style/effetzoom.png" >
				</div>
				
				<div style="margin-right : 30px;float : right;" >
					<table id="t2" width="550" cellspacing="0" cellpadding="0" border="0">
							<td id="social_1" class="case" style="width: <?php echo $pourcent_societal2/100*550; ?>px;"  ></td>
							<td id="ethique" class="case"  style="width: <?php echo $pourcent_ethique2/100*550; ?>px;" ></td>
							<td id="fartradens" class="case"  style="width: <?php echo $pourcent_fairtrade_n_s2/100*550; ?>px;" ></td>						
							<td id="fartradenn" class="case"  style="width: <?php echo $pourcent_fairtrade_n_n2/100*550; ?>px;" ></td>						
							<td id="qualite" class="case"  style="width: <?php echo $pourcent_qualite2/100*550; ?>px;" ></td>						
						</tr>
					</table>
					<br>
				</div>				

				<div style="margin-right : 10px;float : right;" >
					<span style = "margin : 0 10px;text-align : center;" id="choix_1">Social : <?php echo $pourcent_social2; ?>%, </span>
					<span style = "margin : 0 10px;text-align : center;" id="choix_2">Ethique  : <?php echo $pourcent_ethique2; ?>%, </span>
					<span style = "margin : 0 10px;text-align : center;" id="choix_3">Fartrade N-S : <?php echo $pourcent_fairtrade_n_s2; ?>%, </span>
					<span style = "margin : 0 10px;text-align : center;" id="choix_4">Fartrade N-N : <?php echo $pourcent_fairtrade_n_n2; ?>%, </span>
					<span style = "margin : 0 10px;text-align : center;" id="choix_5">Qualite : <?php echo $pourcent_qualite2; ?>%</span>
				</div>
			</div>
			</br></br>


		<script type="text/javascript">

			$(document).ready( function () {
				/* initialisation des var globales à partir des données issues de la BDD */
				pourcentenv=document.getElementById('valenvironnemental').value;
				pourcentsanitaire=document.getElementById('valsanitaire').value;
				pourcentsocietal=document.getElementById('valsocietal').value;
					/* chiffres basés sur la valeur de societal*/
					pourcentsocial	= document.getElementById('valsocial').value;
					pourcentethique	= document.getElementById('valethique').value;
					pourcentfartradens	= document.getElementById('valfairtrade_n_s').value;
					pourcentfartradenn	= document.getElementById('valfairtrade_n_n').value;
					pourcentqualite	= document.getElementById('valqualite').value;
					console.log("20 : "+pourcentqualite);
					/* chiffres en pourcents  */			
					pourcentsocial1	= document.getElementById('valsocial').value*100/ pourcentsocietal;
					pourcentethique1	= document.getElementById('valethique').value*100/ pourcentsocietal;
					pourcentfartradens1	= document.getElementById('valfairtrade_n_s').value*100/ pourcentsocietal;
					pourcentfartradenn1	= document.getElementById('valfairtrade_n_n').value*100/ pourcentsocietal;
					pourcentqualite1	= document.getElementById('valqualite').value*100/ pourcentsocietal;
console.log("chargement social :"+pourcentsocial);					
console.log("chargement social %:"+pourcentsocial1);					
			});

			$("#souhait").click( function () {
				url = "compte_ecoacteur/updateSuivreNewsletter.php";
				id = document.getElementById('iduser').value;
				nompreference = "news_priorites";	
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
			
			
			var onSlid = function(e){
				var columns = $(e.currentTarget).find("td");
				var ranges = [], total = 0, i, s = "Mes choix : ", w;
				for(i = 0; i<columns.length; i++){
					w = columns.eq(i).width()-10 - (i==0?1:0);
					ranges.push(w);
					total+=w;
				}		 
				for(i=0; i<columns.length; i++){			
					ranges[i] = 100*ranges[i]/total;
					carriage = ranges[i]-w
					s=" "+ Math.round(ranges[i]) +'%';			
				}		
				$("#choix12").html("Environnement : "+ Math.round(ranges[0]) +'%, ' );
				pourcentenv = Math.round(ranges[0]);
				$("#personnal2").val(Math.round(ranges[0])+'_'+Math.round(ranges[1])+'_'+Math.round(ranges[2]));
				$("#choix22").html("Sociétal : "+Math.round(ranges[1]) +'%, ' );
				pourcentsocietal = Math.round(ranges[1]);
				$("#choix32").html("Santé : "+Math.round(ranges[2]) +'%' );
				pourcentsanitaire = Math.round(ranges[2]);		
							
				url = "compte_ecoacteur/updateUserPriority.php";
				id = document.getElementById('iduser').value;
				$.ajax({
					url: url,
					data:{id: id, pourcentsocietal: pourcentsocietal, pourcentsanitaire : pourcentsanitaire, pourcentenvironnement : pourcentenv},
					contentType:'application/json',
					dataType: 'json',
					type:'GET',
					success: function(data){
						/*remise des valeurs des ss-themes de societal avec la nouvelle valeur de societal*/
						pourcentsocial	= pourcentsocial1/100* pourcentsocietal;
						pourcentethique	= pourcentethique1/100 *pourcentsocietal;
						pourcentfartradens	= pourcentfartradens1/100 *pourcentsocietal;
						pourcentfartradenn	= pourcentfartradenn1/100 *pourcentsocietal;
						pourcentqualite	= pourcentqualite1/100 *pourcentsocietal;
console.log("societal :"+pourcentsocietal);
console.log("en base : "+pourcentsocial+", "+pourcentethique);
console.log("pourcents :"+pourcentsocial1+", "+pourcentethique1+", "+pourcentfartradens1+", "+pourcentfartradenn1+", "+pourcentqualite1);
						url = "compte_ecoacteur/updateUserSocietalPriority.php";
						id = document.getElementById('iduser').value;
						$.ajax({
							url: url,
							data:{id: id, pourcentsocial: pourcentsocial, pourcentethique : pourcentethique, pourcentfartradens : pourcentfartradens, pourcentfartradenn : pourcentfartradenn, pourcentqualite : pourcentqualite},
							contentType:'application/json',
							dataType: 'json',
							type:'GET',
							success: function(data){
							},
							error: function(){
								console.log('Error');
							}
						});
					},
					error: function(){
						console.log('Error');
					}
				});
			}
					
			$("#t1").colResizable({
				liveDrag:true, 
				draggingClass:"rangeDrag", 
				gripInnerHtml:"<div class='rangeGrip'></div>", 
				onResize:onSlid,
				minWidth:8
			});	

			
			var onSlid2 = function(e){
				var columns = $(e.currentTarget).find("td");
				var ranges = [], total = 0, i, s = "Mes choix : ", w;
				for(i = 0; i<columns.length; i++){
					w = columns.eq(i).width()-10 - (i==0?1:0);
					ranges.push(w);
					total+=w;
				}		 
				for(i=0; i<columns.length; i++){			
					ranges[i] = 100*ranges[i]/total;
					carriage = ranges[i]-w
					s=" "+ Math.round(ranges[i]) +'%';			
				
				}		
				$("#choix_1").html("Social : "+ Math.round(ranges[0]) +'%, ' );
				$("#choix_2").html("Ethique : "+ Math.round(ranges[1]) +'%, ' );
				$("#choix_3").html("Fartrade N-S : "+Math.round(ranges[2]) +'%, ' );
				$("#choix_4").html("Fartrade N-N : "+Math.round(ranges[3]) +'%, ' );			
				$("#choix_5").html("Qualite : "+Math.round(ranges[4]) +'%' );

				//calcul pour les sous themes de societal
				//en pourcents
				pourcentsocial1	= Math.round(ranges[0]);
				pourcentethique1	= Math.round(ranges[1]);
				pourcentfartradens1	= Math.round(ranges[2]);
				pourcentfartradenn1	= Math.round(ranges[3]);
				pourcentqualite1	= Math.round(ranges[4]);
				//sur la base de societal
				pourcentsocial	= pourcentsocial1 * pourcentsocietal /100;
				pourcentethique	= pourcentethique1 * pourcentsocietal /100;
				pourcentfartradens	= pourcentfartradens1 * pourcentsocietal /100;
				pourcentfartradenn	= pourcentfartradenn1 * pourcentsocietal /100;
				pourcentqualite	= pourcentqualite1 * pourcentsocietal /100;

				console.log("___");console.log(pourcentsocial);console.log(pourcentethique	);
				console.log(pourcentfartradens);console.log(pourcentfartradenn);console.log(pourcentqualite);

				url = "compte_ecoacteur/updateUserSocietalPriority.php";
				id = document.getElementById('iduser').value;
				$.ajax({
					url: url,
					data:{id: id, pourcentsocial: pourcentsocial, pourcentethique : pourcentethique, pourcentfartradens : pourcentfartradens, pourcentfartradenn : pourcentfartradenn, pourcentqualite : pourcentqualite},
					contentType:'application/json',
					dataType: 'json',
					type:'GET',
					success: function(data){
					//	pourcentsocial	= pourcentsocial1 * pourcentsocietal /100;
					},
					error: function(){
						console.log('Error');
					}
				});
			}
					
			$("#t2").colResizable({
				liveDrag:true, 
				draggingClass:"rangeDrag", 
				gripInnerHtml:"<div class='rangeGrip'></div>", 
				onResize:onSlid2,
				minWidth:8
			});	
						
		</script>
					


		<style>
			#t1{
				border:1px solid #444;
				box-shadow: 2px 2px 2px #aaa;
				z-index : 20;
			}
			#t1 td{
				height:33px;
				border:none;
			}

			/* vegetables */
			#env2{
				background-color:#4F4F4F;
				border-right: 1px solid #2D6021 !important;
			}
			#env2:before{
				content:" ";
				display: block;
				background-image:url(style/reglette.png);
				background-repeat:no-repeat;
				background-position:2px 2px;
				width:102px;
				height:40px;
			}

			/* bread */
			#social2{
				background-color:#4F4F4F;
				border-right: 1px solid #827807 !important;
			}
			#social2:before{
				content:" ";
				display: block;
				background-image:url(style/reglette.png);
				background-repeat:no-repeat;
				background-position:-100px 2px;
				width:77px;
				height:40px;
				margin-left:2px;
			}

			#sante2{
				background-color: #4F4F4F;
				border-right: 1px solid #AB5D1D !important;
			}
			#sante2:before{
				content:" ";
				display: block;
				background-image:url(style/reglette.png);
				background-repeat:no-repeat;
				background-position:-177px 2px;
				width:70px;
				height:40px;
				margin-left:2px;
			}

			/***********************************************/

			#t2{
				border:1px solid #444;
				box-shadow: 2px 2px 2px #aaa;
				z-index : 18;
			}
			#t2 td{
				height:33px;
				border:none;
			}

			.case{
				background-color:#8f8f8f;
				border-right: 1px solid #827807 !important;
			}
			.case:before{
				content:" ";
				display: block;
				width:77px;
				height:40px;
				margin-left:2px;
			}

		</style>		
		
<?php	}
	}  
echo '</div></br></br></br>';
}	
?> 
		