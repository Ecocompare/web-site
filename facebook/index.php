<?php


require 'src/facebook.php';
require_once 'config.php';
require_once '../models/Db.php';
$db = new Db();
$GLOBALS['base'] = "http://www.ecocompare.com/";

$facebook = new Facebook(array('appId' =>$app_id,
'secret' => $app_secret
));

$DEBUG=0;

// Get User ID
$user = $facebook->getUser();

// We may or may not have this data based on whether the user is logged in.
//
// If we have a $user id here, it means we know the user is logged into
// Facebook, but we don't know if the access token is valid. An access
// token is invalid if the user logged out of Facebook.


if ($user) {
  try {
    // Proceed knowing you have a logged in user who's authenticated.
    $user_profile = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    error_log($e);
    $user = null;
  }
}
 
// Login or logout url will be needed depending on current user state.
if ($user) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
 // $loginUrl = $facebook->getLoginUrl(array( 'canvas' => 1, 'scope' => 'publish_stream,email','fbconnect' => 0 ));
  $loginUrl   = $facebook->getLoginUrl(array( 'canvas' => 1,'scope'=> 'email,publish_stream','redirect_uri'  => $app_canvas
  ) ); 
  
  echo '<fb:redirect url="' . $loginUrl . '" />';
//echo "<script type='text/javascript'>top.location.href='".$loginUrl."';</script>"; exit();  
exit();
 
}

/*
$session = $facebook->getSession();

$me = null;
// Session based API call.
if ($session) {
  try {
    $uid = $facebook->getUser();
    $me = $facebook->api('/me');
  } catch (FacebookApiException $e) {
    
    error_log($e);
    
  }
}

// login or logout url will be needed depending on current user state.
if ($me) {
  $logoutUrl = $facebook->getLogoutUrl();
} else {
  $loginUrl = $facebook->getLoginUrl(array( 'canvas' => 1, 'req_perms' => 'publish_stream,email','fbconnect' => 0 ));
 
 echo '<fb:redirect url="' . $loginUrl . '" />';
//echo "<script type='text/javascript'>top.location.href='".$loginUrl."';</script>"; exit();  
 
}

*/

/*fin*/

$me= $facebook->api('/me');


$user_id = $me['id']; 
$user_email = $me['email'];


//on stoke l'email  
error_log(Date('d/m/Y H:i:s').";".$user_email.";".$me['name']."\n",3,'../backup/facebook.log');

//var_dump($me);

//on met ?our la table user pur indiquer que vient de facebook
if ($user_email!='') {
$query="update iphone_users set FB_id='$user_id' where email like '$user_email'";

$results = mysql_query($query);
}
?>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">

<head>

<meta property="og:title" content="Soyez actif ! devenez eco-acteur, chaque vote compte..">
<meta property="og:url" content="https://apps.facebook.com/ecocompare/">
<!--<meta property="og:image" content="http://thesocialrecruit.com/fb/images/main_app_image.png">-->
<meta property="og:site_name" content="Eco-acteur">
<meta property="fb:app_id" content="123581301002800">


 <link rel="stylesheet" href="<?=$GLOBALS['base']?>/style/styles.css?4" type="text/css" />
<title>Soyez actif ! devenez eco-acteur, chaque vote compte...</title>
	</head>
  <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId   : '<?php echo $facebook->getAppId(); ?>',
          session : <?php echo json_encode($session); ?>, // don't refetch the session when PHP already has it
          status  : true, // check login status
          cookie  : true, // enable cookies to allow the server to access the session
          xfbml   : true // parse XFBML
        });

        // whenever the user logs in, we refresh the page
        FB.Event.subscribe('auth.login', function() {
          window.location.reload();
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());

    </script>

    <h1>Scannez des codes-barre de produits et gagnez des cadeaux!</h1>


<div class="iphonelistFB">	
Bonjour, <?php echo $me['name']; ?>. Vous &ecirc;tes sensibilis&eacute;(e) &agrave; l'&eacute;cologie et vous avez marre du greenwashing ? aidez-nous &agrave; d&eacute;busquer les vrais produits plus respecteux de l'environnement en devenant un <b>eco-acteur !</b><br/><br/>
<H2>Pourquoi cette application ?</H2>
Trop de produits sont pr&eacute;sent&eacute;s comme &eacute;cologiques, bon pour la plan&egrave;te ou l'environnement alors qu'ils ne le sont pas. Sur le guide internet <a href="http://www.ecocompare.com" target="_blank">ecocompare.com</a>, vous trouverez de nombreux produits dont les qualit&eacute;s &eacute;cologiques sont d&eacute;taill&eacute;es
sur le cycle de vie (fabrication, utilisation ou fin de vie). Pour acc&eacute;l&eacute;rer le r&eacute;f&eacute;rencement de ces produits et donc lutter contre le greenwashing, nous vous proposons de participer &agrave; une exp&eacute;rience collaborative
unique : gr&agrave;ce &agrave; votre iPhone, vous devenez ecoacteur et scannez les produits dont vous souhaiteriez connaitre les r&eacute;elles qualit&eacute;s &eacute;cologiques<br/>

Cette application facebook permet de suivre en temps r&eacute;el les votes des eco-acteurs. Chaque mois nous r&eacute;compenserons deux gagnants distincts ((le plus de scan tout produit et le plus de scan de produits verts) qui recevront des bons d'achats de la boutique <a href="http://www.decodurable.com" target="_blank">decodurable.com</a>.
	
	<!--<link rel="image_src" href="http://www.ecocompare.com/images/ecoacteur.png" />-->
	
	<table class="participer"><tr><td><img src="http://www.ecocompare.com/images/ecoacteur.png" alt="mode eco-acteur"/ > </td><td><br/><p>
	Pour participer, rien de plus simple : <br/><br/><ul>
	<li> 1) T&eacute;l&eacute;chargez notre <a href="http://itunes.apple.com/fr/app/ecocompare/id393539838" target="_blank">application iPhone ecocompare</a>, gratuite</li>
	<li> 2) Activez le mode eco-acteur et v&eacute;rifiez que l'adresse email soit la m&ecirc;me (dans mon compte) que celle de votre compte facebook (compte, param&egrave;tre du compte) </li>
	<li> 3) Scannez les codes barre de produits <b>&eacute;cologiques</b> dont vous souhaiteriez connaitre les r&egrave;elles qualit&eacute;s environnementales</li>
</ul>

<p><br><strong>Mois de Mars </strong>BRAVO à <b>Vieverte</a></b>, prix du plus grand nombre de scans (87) et <b>	Dinetteb</b> (32) prix du plus grand nombre de produits scannés verts, ils remportent chacun un bon d'achat de 25 € !</p>


	
</td></tr></table>
	<br/>
	<h1><?php echo utf8_encode(ucwords ($db->getMonth(Date('m'))));?>: classement des 15 eco-acteurs les plus actifs </h1>
			  
	
<p>Ce tableau r&eacute;capitule le classement des eco-acteurs ayant le plus scann&eacute;s de codes barre uniques pour le mois en cours avec leur <a href="http://itunes.apple.com/fr/app/ecocompare/id393539838" target="_blank">application ecocompare iPhone</a> (rafraichissement toutes les 10 minutes).</p>
<br/>
<center>
	<table >
		<tr class="header"><td style="text-align: left">Position</td><td style="text-align: center">Compte FB</td><td>Nom</td><td style="text-align: center">Nb de scan</td><td style="text-align: center">dont produits verts</td><td align="center">Photo</td></tr>
<?php 

  $month=Date('m');
  $year=Date('Y');
  
	$query="SELECT max(totalproduitvert) as max  from iphone_query_month A, iphone_users B where A.iphone_id=B.iphone_id and month='$month' order by total desc, totalproduitvert desc";
  $results = mysql_query($query);
  $result = mysql_fetch_assoc($results);
  echo mysql_error();
  $maxgreen=$result['max'];
 
	$query="SELECT A.iphone_id,email,name,tel,total,totalproduitvert,month,FB_id,win_max,win_maxgreen from iphone_query_month A, iphone_users B where A.iphone_id=B.iphone_id and month='$month' and year='$year'  order by total desc, totalproduitvert desc, name asc";
	$results = mysql_query($query); 
 
 $i=0;        
 $my_position=0;   
 $my_scan=0;    
 while ($row = mysql_fetch_assoc($results)) {
	$i++;
//mon classement
//echo $row['email']."::".$user_id;
	if ($row['FB_id']==$user_id) 
	{	$my_position=$i;
		$my_greenscore=round($row['totalproduitvert']*100/$row['total']);
   	$my_scan=	$row['total'];
}

?>

<tr <?php if ($row['FB_id']!=$user_id) echo "class=\"header\""; else echo "class=\"trselect\"";?>>
	
<td style="text-align: left">
	 <img src="<?=$repertoire=$GLOBALS['base'];?>/images/ecoacteurs/ecoacteur_min_<?=$i;?>.png" border="0" alt="Classement ecoacteur, position <?=$i;?>"/>
	 <?if ($row['win_max'])  {?>	<img src="<?=$repertoire=$GLOBALS['base'];?>/images/ecoacteurs/star.png" title="Eco-acteur ayant le plus de scans"/> <?}?>
	 	<?if ($row['win_maxgreen'])  {?>	<img src="<?=$repertoire=$GLOBALS['base'];?>/images/ecoacteurs/star.png" title="Eco-acteur ayant le plus de scans de produits verts"/> <?}?>

	 </td>
<td style="text-align: center"> 
	<?php
		if ($row['FB_id']!='') { echo "<img src=\"http://www.ecocompare.com/style/facebook.png\" alt=\"compte facebook\" width=\"32\"/>";}
	?>
			
</td>
	<td >
		<?php
		if ($row['FB_id']!='') {
	
	echo "<fb:name useyou=\"false\" linked=\"true\" uid=\"".$row['FB_id']."\" />";
	
	}
	else
	{
	echo $row['name'];
}?>
</td>
<td style="text-align: center">
			<?if ($row['win_max'] ) echo "<b>"; ?>
					<?= $row['total'];?>
			<?if ($row['win_max'] ) echo "</b>"; ?>
	</td><td style="text-align: center">
			<?if ($row['win_maxgreen'] ) echo "<b>"; ?>
						<?= $row['totalproduitvert'];?> (<?=round($row['totalproduitvert']*100/$row['total']); ?> %)
			<?if ($row['win_maxgreen'] ) echo "</b>"; ?>
		</td>
<td align="center">
	<?php

	if ($row['FB_id']=='') {

	$repertoire=$GLOBALS['base'];
	$baseweb="http://www.ecocompare.com/iphone/usersImages/";
	$repertoire="/var/www/vhosts/ecocompare.com/httpdocs/iphone/usersImages/";
	$fichier=$row['iphone_id'].".png";
//echo $repertoire.$fichier;

	if (file_exists($repertoire.$fichier)) echo "<img border='0' width='50' src='".$baseweb.$fichier."'>"; 
}

else
{ $ecoacteur = $facebook->api('/' . $row['FB_id']);
	echo  "<img src=\"http://graph.facebook.com/".$row['FB_id']."/picture\" alt=\"".$ecoacteur['name']."\" />";
}
	?>

</td>

	</tr>
<?}?>
</table>
</center>

<br />

  
<div id="fb-root"></div>
 <script> 

 window.fbAsyncInit = function() { 

 FB.init({appId: "123581301002800", status: true, cookie: true, 

 xfbml: true}); 

 }; 

 (function() { 

 var e = document.createElement("script"); e.async = true; 

 e.src = document.location.protocol + 

 "//connect.facebook.net/en_US/all.js"; 

 document.getElementById("fb-root").appendChild(e); 

 }());

function streamPublish(){

//Facebook.streamPublish();

var attachment = {'description':'Vous avez un iPhone et vous en avez marre du greenwashing ? Devenez eco-acteur en scannant le code-barre de produits verts. Les produits les plus demandés feront l\'objet d\'une démarche ecocompare auprès des fabricants. Ensemble mettons les produits verts en avant !','media':[{'type':'image','src':'<?=$repertoire=$GLOBALS['base'];?>/images/ecoacteurs/ecoacteur_<?=$my_position;?>.png','href':'http://apps.facebook.com/ecocompare/'}]};
Facebook.streamPublish('Ecoacteur : Avec <?=$my_scan;?> scans de produits (dont <?=$my_greenscore;?> % produits verts) , je suis passé en position N° <?=$my_position;?> !', attachment);


}




 
 </script>
 
 
<?php
//echo ">>".$my_position;
if ($my_position >0) { echo "<p style=\"text-align: center;font-size:14px;\"><a onclick='streamPublish();' >Publier mon score sur mon mur. </a></p<br/>";}

 $query="SELECT * from iphone_eans A,iphone_eans_desc B where A.month='$month' and A.year='$year' and A.ean=B.ean  order by total desc,A.ean desc";
 $results = mysql_query($query);
 $i=0;
       
?>


<br/>

<p>Ce tableau récapitule le classement des codes barre de produits plus écologiques (*), non référencés dans ecocompare les plus scannés pour le mois en cours par <a href="http://itunes.apple.com/fr/app/ecocompare/id393539838" target="_blank">application ecocompare iPhone</a> (rafraichissement toutes les 10 minutes).</p>
<br/>
<center>
	<table>
		<tr class="header"><td align="center">Position</td><td>Code EAN</td><td>Libellé</td><td>Marque</td><td align="center">Nb de scan</td><td align="center">Déjà référencé ?</td></tr>
<? while ($ean = mysql_fetch_assoc($results)) { 	$i++;?>
<tr <?php if($ean['ecocompare']!=0) echo "class=\"trselect\"";?>>	
	<td align="center"><?=$i?></td><td><?= $ean['ean'];?></td><td><?= $ean['description'];?></td><td><?= $ean['marque'];?></td><td align="center"><?= $ean['total'];?></td>
	<td align="center">
		<?php if($ean['ecocompare']!=0) echo "Oui"; else echo "Non"; ?>
		</td>

	</tr>
<?}?>
</table>
</center>

<br/>
<fb:comments xid="comments" canpost="true" candelete="false" returnurl="http://apps.facebook.com/ecocompare/">
<fb:title>Votre avis</fb:title>
</fb:comments>

</div>

</html>
