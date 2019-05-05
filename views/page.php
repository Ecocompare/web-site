<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" >
	<head>
		<title><?php if ($GLOBALS['ctrl'] == "Product" && $GLOBALS['action'] == "show") { ?><?= $this->product['name'].' '.$this->product['brand'].' : évaluation écologique, sociétale et sanitaire Ecocompare' ?><?php } else {?><?=trim($this->title)?><?php } ?></title>
		
		<!-- section des méta -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
		<meta property="og:title" content="<?php if ($this->description == ''){ echo text('Meta description'); } else { echo $this->description; }?>" />
		<?php if ($GLOBALS['ctrl'] == "Product" && $GLOBALS['action'] == "show") { ?>
		<meta property="og:image" content="<?=$GLOBALS['base']?>comparateur-produit-eco-<?=toUrl($this->product['name'])?>-<?php echo $this->product['id']; ?>.jpg" />
		<?php }?>
		<meta name="google-site-verification" content="DdX3h_Srvbpy9XHVC_OVNTzk3TbcH-6MXSvCoE6S08o" />
		<meta name="verify-v1" content="3xrl5f4hZ7nazGwzkY/2eG/ggmSthUfGjLo3IOJFG0g=" />
		<meta name="keywords" value="<?php if ($this->keywords == ''){ echo text('Meta keywords'); } else { echo $this->keywords; }?>" >
		<meta name="description" value="<?php if ($this->description == ''){ echo text('Meta description'); } else { echo $this->description; }?>" >
		<meta property="fb:admins" content="pmontier26"/>
		<?php if ($GLOBALS['action'] == "classements") { ?> <meta http-equiv="refresh" content="10" /> <?php } ?>
		
		<?php if ($GLOBALS['ctrl'] == "Company" && $GLOBALS['action'] == "show") {  ?> 
			<meta property="og:image" content="<?=$GLOBALS['base']?>comparateur-produit-ecologique-<?=toURL($this->company['title'])?>-<?php echo $this->company['id']; ?>.jpg" />
		<?php }?>
		
		<!-- section de link -->
		<link rel="stylesheet" href="<?=$GLOBALS['base']?>/style/styles.css" type="text/css" />
		<link rel="stylesheet" type="text/css" href="<?=$GLOBALS['base']?>style/reglette.css" />
		<link type="text/css" href="<?=$GLOBALS['base']?>/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Arvo:400,700' rel='stylesheet' type='text/css'>
		<link rel="alternate" type="application/rss+xml" href="/produits_rss_ecocompare.html" title="Produits Ecocompare" />
		<?php if ($this->currentTab == "iphone" ){ ?>			
			<link rel="image_src" href="https://www.ecocompare.com/images/ecoacteur_100.jpg" alt="ecoacteur" title="scannez avec votre smartphone"/ >
		<?php }?>
		<link rel="stylesheet" type="text/css" href="<?=$GLOBALS['base']?>/style/rating.css" />
		
		<!-- section de scripts 3-->
		<script type="text/javascript"></script>
	
		<script type="text/javascript" src="<?=$GLOBALS['base']?>js/jquery.js"></script>
		<script type="text/javascript" src="<?=$GLOBALS['base']?>js/ui.js"></script>
		<script type="text/javascript" src="<?=$GLOBALS['base']?>js/colResizable-1.3.min.js"></script>
		<script type="text/javascript" src="<?=$GLOBALS['base']?>js/prettify.js"></script>  
		<script type="text/javascript" src="<?=$GLOBALS['base']?>js/main.js"></script> 
		<script type="text/javascript"src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDKJpSMYbl6B2bbtWzJ_Ix90HVCO0tK3EE&sensor=false"></script>
		<script src ="<?=$GLOBALS['base']?>js/scripts.php"></script>
		<script type="text/javascript" src="<?=$GLOBALS['base']?>/js/fancybox/jquery.fancybox.js" ></script>
		<script type="text/javascript" src="<?=$GLOBALS['base']?>/js/jquery.mousewheel-3.0.6.pack.js" ></script>
		<script type="text/javascript" src="<?=$GLOBALS['base']?>js/tagcanvas.min.js"></script> 
		<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
		
		<!-- Script systeme de vote produit -->
		<script type="text/javascript" language="javascript" src="<?=$GLOBALS['base']?>/js/behavior.js"></script>
		<script type="text/javascript" language="javascript" src="<?=$GLOBALS['base']?>/js/rating.js"></script>
		
		<?php if ($this->currentTab == "iphone"  ){ ?>			
			<link rel="image_src" href="http://www.ecocompare.com/images/scanparty/logo_scanparty.png" alt="scanning Week du 1er au 7 Avril 2012" title="scannez avec votre smartphone"/ >
			<meta property="og:image" content="http://www.ecocompare.com/images/scanparty/logo_scanparty.png" />
			<meta property="og:url" content="http:www.ecocompare.com/scanparty.html" />
			<meta property="og:description" content="Classement des ecoacteurs les plus actifs" /> 
			<link rel="stylesheet" type="text/css" href="<?=$GLOBALS['base']?>style/counter.css" />
			<script type="text/javascript" src="<?=$GLOBALS['base']?>js/flipcounter.js"></script>

			<script type="text/javascript">
				window.onload = function() {
					try {
						TagCanvas.Start('myCanvas','tag2s',{
						textColour: '#71C146',
						outlineColour: '#606060',
						reverse: true,
						depth: 0.8,
						maxSpeed: 0.02
					  });
					} 
					catch(e) {
					  // something went wrong, hide the canvas container
					  alert('hs');
					  document.getElementById('myCanvasContainer').style.display = 'none';
					}
				};
			</script>
		<?php }?>
	</head>

	<body onLoad="<?=$this->onload?>">
		<div id="fb-root"></div>
		<script>
			(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
					js = d.createElement(s); js.id = id;
					js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
					fjs.parentNode.insertBefore(js, fjs);
			}
			(document, 'script', 'facebook-jssdk'));
		</script>
		
		<?php
			global $startTime;global $db;
			$totalTime = microtime(true) - $startTime;
			//	echo '<div id="debug">'.$totalTime.'</div>';	
			
			if (reqOrDefault('personnal', '') !='') {
				list($choix_score1, $choix_score2, $choix_score3) = preg_split("/_/", reqOrDefault('personnal', ''), 3);
			}
			else 
			{
				$choix_score1="33";
				$choix_score2="33";
				$choix_score3="33";
			}
		?>

		<?php if (admin() || company() == true){?>
			<div id="accountinfo">
				<img src="<?=$GLOBALS['base']?>style/user.png" />
				&nbsp;&nbsp;
				<strong>
					<?=$_SESSION['user']['username']?> | <a href="<?=$GLOBALS['base']?>products/admin/"><?php if (!admin()){ echo 'Tableau de bord';} else { echo 'Administration';} ?></a></strong> <a href="<?=$GLOBALS['base']?>login?action=logout"><img id="logout" src="<?=$GLOBALS['base']?>style/logout.png" /></a></div>
		<?php } ?>

		<div id="header">
			<script type="text/javascript">
				function affdivcx(classnom){
						document.getElementById("divcx").className=classnom;
				}

				$(document).ready(function() {

					$("#liencnx").fancybox({
						'width'				: '450px',
						'height'			: '450px',
						'autoScale'			: false,
						'fitToView'   		: false,
						'autoSize'   		: false,
						'transitionIn'		: 'none',
						'transitionOut'		: 'none',
						'type'				: 'iframe',
						'closeBtn'			: false,
						'padding'			: '0px',

					});
					
					$(".lieninscription").fancybox({
						'width'				: '450px',
						'height'			: '450px',
						'autoScale'			: false,
						'fitToView'   		: false,
						'autoSize'   		: false,
						'transitionIn'		: 'none',
						'transitionOut'		: 'none',
						'type'				: 'iframe',
						'padding'			: '0',
						'closeBtn'			: false
					});

				});
				
			</script>

			<div id="inner-header">
				<div id="social-networks">
					<!-- MODIF EFFECTUEE ICI : -->
					<?php
						if (!admin() && !company() ) {
							if((!isset($_SESSION['id']) || !isset($_SESSION['email'])|| !isset($_SESSION['typecnx'])) ){
					?>
								<a href="#" id="buttoncx" onMouseOver="affdivcx('divcnxhover');" onMouseOut="affdivcx('invisible');" class="buttoncnx" > Connexion </a></br></br>						
								<div class="invisible" onMouseOver="affdivcx('divcnxhover');" onMouseOut="affdivcx('invisible');" id="divcx">						
									<a  id="liencnx" href= "<?=$GLOBALS['base']?>/compte_ecoacteur/formcnx.php" > Se connecter </a></br>
									<a class="lieninscription" href="<?=$GLOBALS['base']?>/compte_ecoacteur/forminscription.php"> Pas encore éco-acteur ? </a>	
									<a   href= "<?=$GLOBALS['base']?>login" > Accès entreprise </a></br>
								</div>							
								<?php
							}else
							{
								?>
								<a href="#" id="buttoncx" onMouseOver="affdivcx('divcnxhover');" onMouseOut="affdivcx('invisible');" class="buttoncnx" > Mon compte </a></br></br>
									<div class="invisible" onMouseOver="affdivcx('divcnxhover');" onMouseOut="affdivcx('invisible');" id="divcx">
									<a href="<?php dirname(__FILE__)?>espace-eco-acteur.html" > Mon espace éco-acteur </a></br>
									<a href="<?=$GLOBALS['base']?>compte_ecoacteur/destructionSession.php" > Se déconnecter </a></br>
									</div>
								<?php 
							}
						}
						?>
					<!-- FIN MODIF-->
				</div>

				<div id="nav">		
					<a <?php if ($this->currentTab == "home") echo "class='selected'"; ?> href="<?=$GLOBALS['base']?>" ><img src="<?=$GLOBALS['base']?>style/logo.png" id="logo" alt="produits responsables"/></a>
					<a <?php if ($this->currentTab == "products") echo "class='selected'"; ?> href="<?=$GLOBALS['base']?>selection-produits-responsables.html" >Sélection</a>
					<a <?php if ($this->currentTab == "actualite") echo "class='selected'"; ?> href="<?=$GLOBALS['base']?>actualite.html" >Notre actualité</a>
					<a <?php if ($this->currentTab == "articles") echo "class='selected'"; ?> href="<?=$GLOBALS['base']?>articles.html">Articles</a>
					<a <?php if ($this->currentTab == "iphone") echo "class='selected'"; ?> href="<?=$GLOBALS['base']?>ecoacteur-smartphone.html">Eco-acteur</a>
				</div>
		
				<form id="newsletterform" name="" method="post" action="http://www.idnext.net/12all/box.php" style="display: none" accept-charset='iso-8859-1'>
					<input name="email" type="text" id="newsletterinput" onFocus="initNewsletter()" value="Votre email"><img src="<?=$GLOBALS['base']?>style/ok.png" onclick="document.getElementById('newsletterform').submit()"/>
					<input name="funcml" type="hidden" value="add">
					<input type="hidden" name="field[]" />
					<input name="p" type="hidden" id="p" value="1">
					<input type="hidden" name="nlbox[1]" value="1">		
				</form>
						
		
				<div id="search">		
					<form id="headersearch" action="<?=$GLOBALS['base']?>search" method="get">
						<input type="text" placeholder="Recherche Produits" name="keywords"  />
					</form>
					<div class="button"><img alt="produits respectueux du développement durable" src="<?=$GLOBALS['base']?>style/search.png" onclick="document.getElementById('headersearch').submit()" />
						<div id="search-popover" style="width:400px;">
							Définissez vous même vos préférences de recherche en <br/> utilisant la reglette ci-dessous :
							<br/><br/>
								<table id="sample4" width="400" cellspacing="0" cellpadding="0" border="0">
									<tr>
										<td id="env" width="<?=$choix_score1?>%"> </td>
										<td id="social" width="<?=$choix_score2?>%">	</td>
										<td id="sante" width="<?=$choix_score3?>%">	</td>						
									</tr>
								</table>
							<br/>
							<span id="choix1" >Environnement : <?=$choix_score1?>%, </span>
							<span id="choix2" >Sociétal  : <?=$choix_score2?>%, </span>
							<span id="choix3" >Santé : <?=$choix_score3?>%</span>
							<form name="advanced" method="get" action="<?=$GLOBALS['base']?>choixperso.html"/>
								<input type="hidden" name="orderby" value="pubdate desc" />
								<input type="hidden" name="category" value="personnal" />
								<input type="hidden" id="personnal" name="personnal" value="<?=$choix_score1?>_<?=$choix_score2?>_<?=$choix_score3?>"/>
								<center>
									<input type="submit" value="     Rechercher" />
								</center>
							</form>
							
							<script type="text/javascript">
								$(function(){
									$("table").colResizable();
								});
							
								var onSlider = function(e){
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
									
									$("#choix1").html("Environnement : "+ Math.round(ranges[0]) +'%, ' );
									$("#personnal").val(Math.round(ranges[0])+'_'+Math.round(ranges[1])+'_'+Math.round(ranges[2]));
									$("#choix2").html("Sociétal : "+Math.round(ranges[1]) +'%, ' );
									$("#choix3").html("Santé : "+Math.round(ranges[2]) +'%' );							
								}
									
								$("#sample4").colResizable({
									liveDrag:true, 
									draggingClass:"rangeDrag", 
									gripInnerHtml:"<div class='rangeGrip'></div>", 
									onResize:onSlider,
									minWidth:8
								});	
							</script>
								
								
						</div>
					</div>
					<img src="<?=$GLOBALS['base']?>style/personnalisez.png" class="personnalisez" alt="Personnalisez votre recherche de produits responsables"/>
				</div>
			</div>
		</div>

		<?php  if ( $this->currentTab == "home"){ ?>
			<div id="outer-highlights">
				<div id="highlights">
					<img src="style/drawings.png" id="jumps" alt="Produits en accord avec mes sensibilités"/>
					<div class="highlight">
						<h2 style="font-size:20px">Moi, consommateur</h2>
						Je recherche des produits respectueux du développement durable et partage mon avis sur les 
						produits et les points que j'aimerais voir améliorés.
						<a href="<?=$GLOBALS['base']?>selection.html">Consulter les produits</a> 
						<a href="<?=$GLOBALS['base']?>ecoacteur-smartphone.html">Devenir eco-acteur</a> 
					</div>
					<div class="highlight">
						<h2 style="font-size:20px">Moi, fabricant</h2>
						Je suis engagé dans une démarche d'amélioration continue de mes produits sur les aspects sociétaux, environnementaux et sanitaires.
						<a href="<?=$GLOBALS['base']?>marques-responsables.html">Voir les entreprises engagées</a> 
						<a href="<?=$GLOBALS['base']?>demarche-ecocompare.html">Référencer mes produits</a> 
					</div>
					<div class="highlight">
						<h2 style="font-size:20px">Nous, Ecocompare</h2>
						Nous évaluons les produits de façon transparente et nous fournissons des outils pour faciliter la communication entre consommateurs et marques.<br/>
						<a  href="http://itunes.apple.com/fr/app/ecocompare/id393539838" target="_blank" style="background-image:none;padding-left:0;margin-top:0;display:inline;"><img src="style/applestore_ecocompare.png" alt="Téléchargement ecocompare mobile Apple Store" style="margin-top:10px;"/></a> 
						<a href="https://play.google.com/store/apps/details?id=com.ecocompare" style="background-image:none;padding-left:0;margin-top:0;display:inline;" target="_blank"><img src="style/google_play_ecocompare.png" Alt="Téléchargement ecocompare mobile google play" style="margin-top:10px;"/> </a>
								<!--AJOUT EFFECTUEE ICI : -->
						<a href="http://www.facebook.com/ecocompare" style="background-image:none;padding-left:0;margin-top:0;display:inline;" target="_blank"><img Alt="Page Facebook ecocompare" src="<?=$GLOBALS['base']?>style/f.gif"  style="margin-top:10px;"/></a>
						<a href="http://twitter.com/ecocompare" style="background-image:none;padding-left:0;margin-top:0;display:inline;" target="_blank"><img Alt="Compte Twitter ecocompare" src="<?=$GLOBALS['base']?>style/t.gif"  style="margin-top:10px;"/></a>
						<a href="https://plus.google.com/108443347821538807647" rel="author" style="background-image:none;padding-left:0;margin-top:0;display:inline;" target="_blank"><img Alt="Page google plus ecocompare" src="<?=$GLOBALS['base']?>style/googleplus.gif"  style="margin-top:10px;"/></a>
					</div>
					<div class="clearer"> </div>
				</div>
			</div>
			<div id="wrapper">
					<?php include($tpl) ?>
			</div>

		<?php } else { ?>
			<div id="wrapper">
				<div id="main">
					<?php include($tpl) ?>
				</div>
				<div id="side">
					<!-- telechargement mobile -->					
					<?php if ($this->currentTab == "iphone"){ ?>
					<div class="sideblock">
							<h3>Application mobile</h3>
						<a href="https://play.google.com/store/apps/details?id=com.ecocompare" target="_blank"><img src="http://www.ecocompare.com/images/telecharger_google.jpg" alt="Téléchargement application mobile ecocompare sur google play"/></a> 	<a href="http://itunes.apple.com/fr/app/ecocompare/id393539838" target="_blank"><img border="0" src="http://www.ecocompare.com/images/telecharger_apple.jpg" alt="Téléchargement application mobile iPhone/iPad sur Apple Store"/></a>
					</div>
					<?php } ?>
					
					<!-- bloc catégories de produit -->
					<?php if ( $this->currentTab == "products"){ ?>
						<div class="sideblock">
							<ul>
								<?php
									$current = reqOrDefault('category', 0);
									if ($GLOBALS['action'] != "browse" || reqOrDefault("keywords", '') != ''){
										$current = -1;
									}
									$this->categoryCtrl->showMenu($current);
								?>
							</ul>
						</div>
					<?php } ?>

					<!-- bloc partis pris si info metofo -->
					<?php if ($GLOBALS['ctrl'] == "FreeText" && $GLOBALS['action'] == "methodo" ){ ?>
						<div class="sideblock">
							<?=text('Methodo_rightside')?>	
						</div>
					<?php } ?>
			
			
					<?php if ($this->currentTab != "admin"  && 	$this->currentTab != "iphone2"    && 	$this->currentTab != "iphone"    && 	 $this->currentTab != "espace-eco-acteur" ){ ?>
						<div class="sideblock">
							<div id="sidecompanies">
								<?php $count=0;  $companies = $db->getCompanies(0, "rand()");?>
								<?php foreach($companies as $key=>$company){ ?>
									<?php if ($company['image'] != '' && $count < 9){ ?>
										<a href="<?=$GLOBALS['base']?><?=toUrl($company['title'])?>_c<?=$company['id']?>.html" title="<?=$company['title']?>">
											<table>
												<tr>
													<td class="companylogo">
														<!--<img src="<?=$GLOBALS['base']?>cache/companymedium<?php echo $company['id']; ?>.jpg" alt="ecocompare et <?=$company['title']?>" width="55px" /> -->
														<img src="<?=$GLOBALS['base']?>comparateur-marque-ecologique-<?=toUrl($company['title'])?>-<?=$company['id']; ?>.jpg" alt="Comparer les produits de <?=toUrl($company['title'])?>" width="55px" />
													</td>
												</tr>
											</table>
										</a>
									<?php $count++; ?>
									<?php } ?>
								<?php } ?>
							</div>
							<!--img src="style/companies.png" style="margin-top: 4px"/--><br/>
							<a href="<?=$GLOBALS['base']?>marques-responsables.html">» Toutes les entreprises engagées</a>
						</div>
					<?php } ?>

					<?php if ($this->currentTab == "iphone"){ ?>						
						<div class="sideblock">
							<h3>Dernier scan</h3>
							<div id="map_canvas" style="width:200px;"></div>
							<br/>
							<h3>Historique des résultats</h3>
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-avril.html#classement">AVRIL</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-mars.html#classement">MARS</a>, 
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-fevrier.html#classement">FEVRIER</a>, 
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-janvier.html#classement">JANVIER</a>	
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-decembre.html#classement">DECEMBRE</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-novembre.html#classement">NOVEMBRE</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-octobre.html#classement">OCTOBRE</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-septembre.html#classement">SEPTEMBRE</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-aout.html#classement">AOUT</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-juillet.html#classement">JUILLET</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-juin.html#classement">JUIN</a>,
							<a href="<?= $GLOBALS['base']; ?>eco-acteur-gagnants-mai.html#classement">MAI</a>
					
							

							<br/>
							<br/>
							<h3>Les CLASSEMENTS</h3>
							<a href="#marques">TOP 50 des marques les plus scannées</a><br/>
							<a href="#regions">TOP 50 des régions les plus actives</a><br/>
							<br/>
							<h3>Le TOP des ECO-ACTEURS</h3>
							<br/>
							<?php $count=0;  ?>
							<?php foreach($this->randomEcoacteur as $key=>$random){ ?>
							<?php
								$repertoire="/var/www/vhosts/ecocompare.com/httpdocs/iphone/usersImages/";
								$fichier=$random['iphone_id']."_100.png";
								$fichier2='/var/www/vhosts/ecocompare.com/httpdocs/cache/thumbmobileuser'.$random['user_id'].'.jpg';

								//echo ">>".$repertoire.$fichier."::".file_exists($repertoire.$fichier)."::";
								//http://www.ecocompare.com/ecoacteur-photo-6201
								//$name = 'cache/'.req('size').'mobileuser'.req('id').'.jpg';
									
								if (file_exists($repertoire.$fichier)) {
								?>
									<img  src="ecoacteur-photo-<?=$random['iphone_id']?>" alt="image ecoacteur <?=$random['name']?>"><br>
								 <?php } 
								 else if (file_exists($fichier2)) { ?>
									<img  src="ecoacteur-photo-<?=$random['user_id']?>" alt="image ecoacteur <?=$random['name']?>"><br>
								<?php }
								 else { ?>
									<img width="75" src="http://www.ecocompare.com/images/ecoacteurs/noimage.jpg" alt="image ecoacteur <?=$random['name']?>"><br>
								 <?php } ?>
								 
								<?=trim($random['name'])?>, <?=$random['nbscans']?> scans en <a href="http://www.ecocompare.com/ecoacteur-smartphone.html?id=<?=$random['month']?>&year=<?=$random['year']?>"><?=utf8_encode($db->getMonth($random['month']))?> <?=$random['year']?></a><br/><br/>

							<?php } ?>
							<h3>5 Produits les plus scannés non encore référencés</h3>
							<?php foreach($this->fiveproducts as $key=>$product){ ?>
								+ <?=ucfirst(mb_strtolower($product['description'],'UTF-8'))?><br/>
							<?php } ?>	
							<br/>
							Les réponses <a href="/ecoacteur-smartphone.html?mode=fabricant">des fabricants</a><br>
							Les témoignages des <a href="ecoacteur-smartphone.html?mode=ecoacteurs">eco-acteurs</a>
							<br/>Voir le <a href='/ecoacteur-smartphone.html?id=<?php echo $this->prev_month?>'>mois précédent</a>
							<br/>
							<h3>Classement par catégorie</h3>
							<img src="images/puce.png" alt="lessive ecolo"/><a href="classement-lessives-ecologiques.html"> LESSIVES </a><br/>
							<img src="images/puce.png" alt="liquide vaisselle ecolo"/><a href="classement-liquide-vaisselle.html"> LIQUIDES VAISSELLE</a><br/>
							<br/>
					 
					 
						</div>
					<?php } ?>
			
					<!--Bloc compte eco-acteur-->
					<?php if ($this->currentTab == "espace-eco-acteur"){ ?>
							<div class="sideblock">
								<h2>Mon espace &eacute;co-acteur</h2>
								<strong>Bienvenue <?=$_SESSION['name']?>,</strong><br/>
								<div onClick='showEanForm()'><a href="#">Saisir un code EAN</a></div>
									<div style="margin-left : 5%;" id="eanform" class="invisible">
										<div style="color : red; font-size : 11px;" id='msg'></div>
											<input style="width : 70%;" id='ean' type='text' placeholder='Code Ean' />
											<input value='Voir le produit' type='button' id='eanpdt' />
											</br>
											</br>
									</div>
								<a href="<?php dirname(__FILE__) ?>espace-eco-acteur.html?section=informations_personnelles">Informations personnelles</a><br/>
								<a href="<?php dirname(__FILE__) ?>espace-eco-acteur.html?section=preferences">Mes préférences</a><br/>
								<a href="<?php dirname(__FILE__) ?>espace-eco-acteur.html?section=derniers_scans">Mes 15 derniers scans</a><br/>
								<a href="<?php dirname(__FILE__) ?>espace-eco-acteur.html?section=mes_avis">Mes avis</a><br/>
								<a href="<?php dirname(__FILE__) ?>espace-eco-acteur.html?section=modifier_mot_de_passe">Modifier mon mot de passe</a><br/>
								<a href="<?=$GLOBALS['base']?>compte_ecoacteur/destructionSession.php">Déconnexion</a>
								<div id="box"></div>	
							</div>
					<?php } ?>	
			        <script type="text/javascript">
						function showEanForm(){
							if(document.getElementById("eanform").className != "")
								document.getElementById("eanform").className = "";
							else
								document.getElementById("eanform").className = "invisible"
						}
					
						$('#eanpdt').click(function(){
							var msg = document.getElementById("msg");
							var checkEan = new RegExp("^[0-9]{13}$","g");
							var ean = document.getElementById('ean').value;
							if(!checkEan.test(ean)){
								msg.innerHTML = 'Veuillez entrer un code à 13 chiffres';
							}else{
								getProductEan(ean);
						    }
						});

					</script>

					<?php if ($this->currentTab == "admin"){ ?>
						<?php if (admin()){ ?>
							<?php include('menubackoffice.php') ?>
						<?php } else include(langdir().'dashboard_right.php') ?>
					<?php } ?>	

				</div>

		<?php } ?>
			
			 <script type="text/javascript">
				$(".tooltip2 a").mouseover(function(){
				$('label[for="' + $(this).attr("id") + '"]').show();
				}).mouseout(function(){
				$('label[for="' + $(this).attr("id") + '"]').hide();
				});
			</script>

			<script type="text/javascript">
				var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
				document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
				</script>
				<script type="text/javascript">
				var pageTracker = _gat._getTracker("UA-4434636-1");
				pageTracker._initData();
				pageTracker._trackPageview();
			</script>
		
			<?php
				global $startTime;
				$totalTime = microtime(true) - $startTime;
				//echo '<div id="debug">'.$totalTime.'</div>';	
			?>
		</div>
	</body>
	<div id="footer">

		<a href="<?=$GLOBALS['base']?>Pourquoi-Ecocompare.html">Pourquoi Ecocompare ?</a>&nbsp;&nbsp;&nbsp;
		<a href="<?=$GLOBALS['base']?>Methodologie.html">Méthodologie</a>&nbsp;&nbsp;&nbsp;
		<a href="<?=$GLOBALS['base']?>Proposez-un-produit.html">Proposez un produit</a>&nbsp;&nbsp;&nbsp;
		<a href="<?=$GLOBALS['base']?>FAQ.html">FAQ</a>&nbsp;&nbsp;&nbsp;
		<a href="<?=$GLOBALS['base']?>conditions-utilisation.html" rel="nofollow">CGU</a>&nbsp;&nbsp;&nbsp;
		<a href="<?=$GLOBALS['base']?>Partenaires.html">Partenaires</a>&nbsp;&nbsp;&nbsp;
		<a href="<?=$GLOBALS['base']?>Contactez-nous.html" rel="nofollow">Contact</a>&nbsp;&nbsp;&nbsp;
		<a href="#footer" onclick="document.getElementById('newsletterform').style.display='block'; document.getElementById('topadd').style.display='none';">Inscription Newsletter</a>&nbsp;&nbsp;&nbsp;
		<a href="http://www.wattimpact.com/sceau2.aspx?urlreferrer=http://www.ecocompare.com"  target="_blank"><img src="http://stats.wattimpact.com/images/b3c275aba39a4e46b1e3c0faa9ca2382_16_45v2010.imgw" border="0" alt="Vignette wattimpact.com"/></a><br/>
		<a href="<?=$GLOBALS['base']?>eco-acteur-temoignages.html">Lire les témoignages</a>&nbsp;&nbsp;&nbsp;
		<a href="<?=$GLOBALS['base']?>eco-acteur-avis.html">Lire les avis de consommateurs</a>&nbsp;&nbsp;&nbsp;
		Site & appli mobile développés par la société <a href="http://www.idnext.net" alt="Société de développement de sites web et d'applications mobiles"> IDnext</a>
	</div>