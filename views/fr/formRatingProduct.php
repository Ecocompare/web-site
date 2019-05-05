<? session_start(); ?>
<? include (dirname(__FILE__).'/../../controllers/DrawratingCtrl.php');?>
<? include (dirname(__FILE__).'/../../models/Db.php');?>
<html>
	<head>
	    <script type="text/javascript" src="../../js/jquery-1.8.2.min.js"></script>
	    <script type="text/javascript" src="../../compte_ecoacteur/connexion.js"></script>
		<link rel="stylesheet" href="../../compte_ecoacteur/css/formulairecx.css">		
		<link rel="stylesheet" type="text/css" href="../../style/rating.css" />
		<?$rate = new DrawratingCtrl();
		$db = new Db();
		?>
	</head>
	<body>
		<div id="contenu_page">
			<form id='form' method='post' action="" name="form_rate">
				<div class="titre">Donnez votre avis</div>
				<div style='width:100%' class="formulairecnx" >   
					<span style='text-align:center'><b>Notez le produit</b></span></br>
					<span style='text-align:left;font-size:12px'>Cliquez sur les étoiles pour donner une note globale du produit</span></br></br>
					<div style='text-align:left;'>
					<div class='title' style='float:left;marging-right:10px'>Note globale : </div>
					<div class='rating' style='float:left;margin-top:-2px;'><?=$rate->rating_bar($_GET['product'],5,'',$_SESSION['id']);?></div>
					</div>
					<div class="line"></div>
					<span style='text-align:left'><b>Donnez votre avis</b></span></br>
					<?foreach ($db->getQuestionProduct() as $question){
					?>
						<div style='float:left;' class="question_<?=$question['id'];?>">
							<span style='float:left;margin-right:10px;'><?=$question['question'];?> :</span></br>
							<span><textarea id="reponse_<?=$question['id'];?>" name="reponse_<?=$question['id'];?>"style="width:400px;" required ></textarea></span></br>
						</div>
					<?
					}
					?>
					<div class="line"></div>
					<input type='hidden' id='rate_product' name='rate_product' value='0'>
					<input type='hidden' id='id_product' name='id_product' value="<?=$_GET['product'];?>">
					<input type='submit' id='btn' value='Valider' class="btn_rate">
				</div>
			</form>
		</div>	
	</body>
</html>

<script type="text/javascript">

	$( "#form" ).on( "submit", function( event ) {
       form = $("#form").serialize();

		$.ajax({
			type: "POST",
			url: "<?php $pos = strpos($_SERVER['HTTP_HOST'], 'idnext'); 
				if($pos === false){
					$domainName = "http://www.ecocompare.com";
				}
				else{
					$domainName = "http://projets2.idnext.net/ecocompare";
				}
				echo $domainName.'/index.php?ctrl=Drawrating&action=addRate';?>",
			data: form,

		   success: function(data){
				parent.window.location.reload();
		   }

		});
     event.preventDefault();
     return false;  //stop the actual form post !important!

  });

	$(document).ready(function(){
		$(".current-rating").css("width","0px");
		$("#total_vote").css("display","none");

	});
	
	function rate(width){
		$(".current-rating").width(width);
		$("#rate_product").val(width/20);
	}
	
	
</script>