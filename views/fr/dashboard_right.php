<div class="sideblockheader">
	
	<h1>Par où commencer ?</h1><br/><h2>5 étapes à suivre</h2>

	1 - Ajoutez un produit<br/>
  2 - Remplissez l’ensemble des informations demandées<br/>
  3 - Enregistrez la fiche ou soumettez la si elle est entièrement complétée<br/>
  4 - Envoyez et signez les justificatifs demandés<br/>
  5 - Votre produit sera publié après vérification<br/>

</div>

<div class="sideblock">						<h2>Infos compte</h2>
						<strong><?=$_SESSION['user']['username']?></strong><br/>
						Email : <?=$_SESSION['user']['email']?><br/>
						Type : Entreprise<br/><br/>
						
						<a href="<?=$GLOBALS['base']?>users/editPassword?returnurl=<?=urlencode($_SERVER["REQUEST_URI"])?>">Modifier mot de passe</a><br/>
						
						<a href="<?=$GLOBALS['base']?>login?action=logout">Déconnecter</a>
					</div>
						<div class="sideblock">
						<h2>Aide en ligne</h2>
						<a href="http://www.ecocompare.com/methodologie/Guide_de_referencement_ecocompare.pdf" target="_blank"><img src="<?=$GLOBALS['base']?>style/logo_pdf.png" border="0"> Guide accompagnement
					</a>
</div>