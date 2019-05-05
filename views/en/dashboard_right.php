<div class="sideblockheader">
	
	<h1>How to start ?</h1><br/><h2>By following those 5 easy steps</h2>

	1 - Add a product<br/>
  2 - Enter all required information<br/>
  3 - Save the form and submit it if fully completed<br/>
  4 - Sign and send the requested documents<br/>
  5 - Your product will be published after being reviewed<br/>

</div>

<div class="sideblock">						<h2>Your account</h2>
						<strong><?=$_SESSION['user']['username']?></strong><br/>
						Email : <?=$_SESSION['user']['email']?><br/>
						Type : Company<br/><br/>
						
						<a href="<?=$GLOBALS['base']?>users/editPassword?returnurl=<?=urlencode($_SERVER["REQUEST_URI"])?>">Change password</a><br/>
						
						<a href="<?=$GLOBALS['base']?>login?action=logout">Logout</a>
					</div>
						<div class="sideblock">
						<h2>Online help</h2>
						<a href="http://www.ecocompare.com/methodologie/Guide_de_referencement_ecocompare.pdf" target="_blank"><img src="<?=$GLOBALS['base']?>style/logo_pdf.png" border="0"> User’s manual (French only) 
					</a>
</div>