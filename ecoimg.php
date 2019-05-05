<?php
error_reporting(E_ALL);
//ini_set('display_errors','On');


// on spécifie le type de document que l'on va créer (ici une image au format PNG
//header ("Content-type: image/png");  

require_once('models/Db.php');
$db = new Db();

$ean = null; $id = null;
$lang=1;

if(isset($_GET['ean'])) {
  $ean = mysql_escape_string($_GET['ean']);
}

if(isset($_GET['id'])) {  
  $id = intval($_GET['id']);
}


if(isset($_GET['lang'])) $lang = intval($_GET['lang']); else $lang=1;


if ($ean==null && $id==null) {createimage(0,0,0,0);

	exit;}
	
	
if($ean != null) $query = "SELECT * FROM products where INSTR(EAN, '$ean')>0;";
if($id != null)   $query = "SELECT * FROM products where id = $id";


$results = mysql_query($query);

if($product = mysql_fetch_assoc($results)) {


$name="cache/score-".arrondir($product['score1'])."-".arrondir($product['score2'])."-".arrondir($product['score3'])."-".(round($product['score4']*2)/2)."-".$lang.".png";

error_log("$name\n", 3, "ecocompare.log");

if (!file_exists($name)) createimage(arrondir($product['score1']),arrondir($product['score2']),arrondir($product['score3']),round($product['score4']*2)/2,$name,$lang);

}
else $name="cache/score-0-0-0-0.png";

header('location: ./'.$name);

exit;

function arrondir($valeur) {
	$entier=intval($valeur);
	$decimale=$valeur-$entier;
	
	//echo "$entier : $decimale";
	
	if ($decimale >0.5) return round($entier+1,1);
	if ($decimale <0.5) return round($entier,1);
	if ($decimale ==0.5) return round($valeur,1);
	
}


function createimage($environnement=0,$social=0,$sante=0,$total=0,$name='',$lang=1) {
error_log("CREATE : $environnement,$social,$sante,$total,$name,$lang \n", 3, "ecocompare.log");
if ($lang==1) $fichier_source = "images/gd/badge-0-0-0-0-carre-v2.png";  else  $fichier_source = "images/gd/badge-0-0-0-0-carre-v2_en.png";
$fichier_environnement=	"images/gd/score".$environnement.".png";  
$fichier_social=	"images/gd/score".$social.".png";  
$fichier_sante=	"images/gd/score".$sante.".png";  
$fichier_total=	"images/gd/total".$total.".png";  

//echo ">>images/gd/score".$social.".png";  

$im_source = ImageCreateFromPng ($fichier_source);  
$larg_destination = imagesx ($im_source); 

//Fabrication
//echo "Fabrication:".$fichier_environnement;
$im_fabrication = ImageCreateFromPng($fichier_environnement); 
$x_note=97;
$y_note=36;
$larg_note=78;
$haut_note=12;

@imageCopyMerge ($im_source, $im_fabrication, 
      $x_note, $y_note, 0, 0, $larg_note, 
      $haut_note, 70);  

//Utilisation
//echo "Fabrication:".$fichier_environnement;
$im_utilisation = ImageCreateFromPng($fichier_social); 
$x_note=97;
$y_note=53;
$larg_note=78;
$haut_note=12;

@imageCopyMerge ($im_source, $im_utilisation, 
      $x_note, $y_note, 0, 0, $larg_note, 
      $haut_note, 70);  

//Fin de vie
//echo "Fabrication:".$fichier_environnement;
$im_findevie = ImageCreateFromPng($fichier_sante); 
$x_note=97;
$y_note=69;
$larg_note=78;
$haut_note=12;

@imageCopyMerge ($im_source, $im_findevie, 
      $x_note, $y_note, 0, 0, $larg_note, 
      $haut_note, 70);  
      
//Global
//echo "Fabrication:".$fichier_environnement;
$im_total = ImageCreateFromPng($fichier_total); 
$x_note=97;
$y_note=86;
$larg_note=78;
$haut_note=12;

@imageCopyMerge ($im_source, $im_total, 
      $x_note, $y_note, 0, 0, $larg_note, 
      $haut_note, 70);  

// on affiche notre image copyrightée
Imagepng ($im_source,$name);  
imagedestroy($im_source);

}


// imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )
/*
dst_im 
Ressource de l'image de destination. 

src_im 
Ressource de l'image source. 

dst_x 
X : coordonnée du point de destination. 

dst_y 
Y : coordonnée du point de destination. 

src_x 
X : coordonnée du point source. 

src_y 
Y : coordonnée du point source. 

src_w 
Largeur de la source. 

src_h 
Hauteur de la source. 

pct 
Les deux images seront fusionnées suivant le paramètre pct , qui peut valoir de 0 à 100. Si pct = 0, aucune action n'est faite, alors que si pct = 100, imagecopymerge() se comporte exactement comme imagecopy() pour les images de palette, tandis qu'il implémente la transparence alpha pour les images en couleur vraies. 



*/
?> 
