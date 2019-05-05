<html>
	<head>
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> compte_ecoacteur/css/account.css">	
		<link rel="stylesheet" href="<?php dirname(__FILE__)?> compte_ecoacteur/css/scans.css">	

		<script type="text/javascript" src="<?php dirname(__FILE__)?> js/jquery-1.8.2.min.js"></script>
		<script type="text/javascript" src="<?php dirname(__FILE__)?> compte_ecoacteur/account.js"></script>
	</head>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$(".scan-row").css("height", "auto")
			
		});
	
	</script>
<?php
	$rate = new DrawratingCtrl();	
	echo '<body>';
		/*NON CONNECTE*/
		if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
				?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 

		}
		/*CONNECTE*/
		else{
		
			echo '<div class="box">
		
			<h1>Mes Avis</h1>
			<div style="border-top : 0.5px solid #91dd0b; margin-top : -15px;height : 1px; width : 100%; background : #c5dd0b;"></div>

			<div style="margin-top:10px" class="box-notif information"></div>
			<form id="account"></form>';	

			/*connecté et email non validé*/
			if($_SESSION['isValid']==0){ //TODO : TESTER LA FONCTION RESEND
				echo "Afin d'utiliser les fonctionnalités éco-acteur, vous devez valider votre adresse email. Si vous n'avez pas reçu d'email, vous pouvez toujours vous en renvoyer un depuis le bouton ci-dessous.
						<input type='button' value='Renvoyez-moi un mail' onClick='resendValidationMail(".$_SESSION['id'].");' />";
			}
			/*connecté et email validé*/
			else{
				if(count($this->userReviews)>0){
					foreach ($this->userReviews as $key=>$reviews){ ?>
						<div id='userReviews' class='scan-row' style='margin-bottom:10px'>
							<table style='width:100%;border-collapse: separate; border-spacing: 5px 0px; '>
								<tr>
									<th >
									
									</th>
									<th style="float:left" colspan='2'>
									
										<a href="<?=$GLOBALS['base']?><?=toURL($this->userReviews[$key]['product_name'])?>_p<?=$this->userReviews[$key]['product']?>.html">
											<? echo $this->userReviews[$key]['product_name'];?>
										</a>
									</th>
								</tr>
								
								<tr>
									<td style="width: 20%;border-right:1px solid #c5dd0b;">
										<b>Note :</b>
									</td>
									<td style="width: 50%;border-bottom:1px solid #c5dd0b;">
										<b><? echo $this->userReviews[$key]['titre'];?></b>
									</td>
									<td style='text-align:right;width: 20%'>
										<b><? 
											$date = new DateTime($this->userReviews[$key]['date']);
											echo $date->format('d/m/Y H:i:s');
										?></b>
									</td>
								</tr>
								<tr>
									<td  style="border-right:1px solid #c5dd0b;">
										<? echo $rate->rating_bar($this->userReviews[$key]['product'],5,'static','',$this->userReviews[$key]['score']);?>
									</td>
									<td colspan='2' style="Vertical-Align: Top;">
										
										<? echo $this->userReviews[$key]['reponse'];?>
									</td>
									
								</tr>
							</table>
						</div>
					<?}
				}
				else{
					echo "Il n'y a encore aucun avis pour ce produit.";
				}
			
			}  
			echo "</div>";
		}	
		?> 
	</body>
</html>