<html>
	<head>
		<link rel="stylesheet" href="compte_ecoacteur/css/account.css">	
		<script type="text/javascript" src="compte_ecoacteur/account.js"></script>
	</head>
<?php	

echo '<body>';

		/*NON CONNECTE*/
		if(!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx']) || !isset($_SESSION['isValid']) ){
var_dump($_SESSION);exit;
				?>	<script> window.top.location.href="http://www.ecocompare.com/"; </script>   <?php 		

		}
		/*CONNECTE*/
		else{
			echo '<div id="box">';
			if(!isset($_SESSION['name'])||!isset($_SESSION['gender'])||!isset($_SESSION['birthyear'])||!isset($_SESSION['postalcode'])){
					?>	<script> window.top.location.href="http://www.ecocompare.com/espace-eco-acteur.html?section=informations_personnelles"; </script>   <?php 
				
				}else
				{
?>					<h1>Mes informations personnelles</h1>

					<div style="height : 0.5px; width : 100%;box-shadow: inset 0 3px 8px rgba(0,0,0,.24);  " ></div>	
					</br>

					
					<div style="float :right;margin-bottom : 3px;"><a href="espace-eco-acteur.html?section=informations_personnelles" >Mettre à jour ces informations</a></div> 
			<?php		
		
	

	$repertoire="/var/www/vhosts/ecocompare.com/httpdocs/iphone/usersImages/";
	$fichier=$_SESSION["id"].".png";
/*	
	$repertoire="www.ecocompare.com/httpdocs/iphone/usersImages/";
	$fichier=$_SESSION["id"].".png";
*/
		echo '<input type="hidden" value="'.$_SESSION['haspwd'].'" id="haspwd">
					<div style="width : 100%;">
							<div style="float : left;width : 250px; text-align : center;">';
							
							if (file_exists($repertoire.$fichier)){
								echo '<image alt="photo éco-acteur" src="/iphone/usersImages/'.$_SESSION["id"].'.png" style="margin-top : 110px;width : 130px;height : 130px;" >';
							}else{
								echo '<image alt="photo éco-acteur" src="/images/ecoacteurs/noimage.jpg" style="margin-top : 110px;width : 130px;height : 130px;" >';	
							}

							echo '</div><div >
								<table class="box" id="tabdonnees" CELLSPACING=0 >
									<tr><td colspan=2 ><div style="font-size : 18px;color : #636363;">'.$_SESSION["name"].'</div></td></tr>
									<tr><td class="col1">Adresse email</td><td class="col2">'.$_SESSION["email"].'</td></tr> 
									<tr><td class="col1">Genre</td><td class="col2">'.$_SESSION['gender'].'</td></tr> 
									<tr><td class="col1">Ann&eacute;e de naissance</td><td class="col2">'.$_SESSION["birthyear"].'</td></tr>
									<tr><td class="col1">Code postal</td><td class="col2">'.$_SESSION["postalcode"].'</td></tr> 
									<tr><td class="col1">Ville</td><td class="col2">'.$_SESSION["ville"].'</td></tr>
									<tr><td class="col1">Adresse</td><td class="col2">'.$_SESSION["address"].'</td></tr>
									<tr><td class="col1">N° téléphone</td><td class="col2">'.$_SESSION["tel"].'</td></tr>
									<tr><td class="col1">Activit&eacute;</td><td class="col2">'.$_SESSION['activite'].'</td></tr>
									<tr><td class="col1">Nombre d\'enfants</td><td class="col2">'.$_SESSION['nbchild'].'</td></tr>	
								</table>
							</div>
					</div>

					<div style="width : 100%;height : 1px;clear : both;"></div></br>			

					<div class="box">
						<table style="width : 100%;">
							<tr><td><div class="sstitre">Description de votre profil</div></td></tr>
							<tr><td><div style="text-align : justify;">'.$_SESSION["description"].'&nbsp;</div></td></tr>
						</table>
					</div>';
		?>

					<div id="medailles" ></div>
					<div style="width : 100%;height : 1px;clear : both;"></div></br>
					<div>
						
						<div class="divgauche box ">
							<table style="width : 100%;">
								<tr><td><div class="sstitre">Actuellement</div></td></tr>
								<tr><td><div class="list_stats"></div></td></tr>
							</table>
						</div>
						
						<div class="divdroite box ">
							<table style="width : 100%;">
								<tr><td><div class="sstitre">Dernier scan</div></td></tr>
								<tr><td><div class="dernier_scan"></div></td></tr>
								<tr><td style="border-top : 1.5px solid #efebe7;"><div id="list15"></div></td></tr>
							</table>
						</div>			
						
					</div>
					<div style="width : 100%;height : 1px;clear : both;"></div>
<?php		}
		  
			echo '</div></br></br></br>';
		}	
		?> 

			

<style>
	#box a {
	background-image: url(style/more2.png);
	background-repeat: no-repeat;
	background-position-y: 3px;
	padding-left: 20px;
	display: block;
	font-size: 13px;
	font-weight: bold;
	}
		
	.statrow{	
		padding-top : 4px;
		padding-bottom : 2px;
	}		
		
	#box{
		color : gray;
	}
	.box{
		-moz-box-shadow: inset 0 2px 8px rgba(0,0,0,.2);
		-webkit-box-shadow: inset 0 2px 8px rgba(0,0,0,.2);
		box-shadow: inset 0 2px 8px rgba(0,0,0,.2);
		
		background : #f9f9f9;
		padding : 5px 20px;
	}
	.medailles{
		padding-bottom : 10px;
	}
	.divgauche{
		width : 43%;
		float : left;
		margin-left : 2px;
		height : 185px;	
	}
		
	.divdroite{
		width : 43%;
		float : right;
		margin-right : 2px;
		height : 185px;
	}
		
	.partiegauche{float : left;}
		
	.partiedroite{float : right;}
		
	.col1{width : 160px;}
		
	.col2{
		width : 320px;
		font-weight : bold;
	}

	.sstitre{
		font-size : 18px;

		padding-bottom : 8px;
		border-bottom : 1px solid #efebe7;
	}
	#tabdonnees td{
		padding-bottom : 5px;
		padding-top : 5px;
		border-bottom : 1px solid #efebe7;
	}

	#tabdonnees{
		float : right;
	}
	
	/******scans******/
	.scan-row{overflow:hidden;}

	.scan-row{
	display : inline-block;
	}
	.scan-row .info{
		color:#828282;	
		overflow:hidden;
	}
	.scan-row .lib{	
		overflow:hidden;
	}
	.scan-row .brand{	
		overflow:hidden;
	}
	.status{	
		overflow:hidden;
		height:60px;
	}
	.tag{
		color:gray;
		font-size:1em;
		margin-top : 2px;
		margin-bottom : 5px;
		margin-left : 0px;
		text-align : center;
		border-radius:0px 20px 20px 0px;
	}
	.ok{
		border: 1px solid #92cd12;
		background : white;
	}
	.soon{
		border: 1px solid :#f4c124;
		background : white;	
	}
	.never{
		border: 1px solid :#f34040;
		background : white;	
	}
		
</style>		
			
					
	</body>
</html>

