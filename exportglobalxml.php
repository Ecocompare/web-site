<?php
error_reporting(E_ALL);
//ini_set('display_errors','On');

require_once '/var/www/vhosts/ecocompare.com/httpdocs/models/Db.php';
$db = new Db();
$GLOBALS['base'] = "http://www.ecocompare.com/";

$fichierMarqueXML="/var/www/vhosts/ecocompare.com/httpdocs/export/brands.xml";
$fichierProduitXML="/var/www/vhosts/ecocompare.com/httpdocs/export/products.xml";

// Chargement du fichier XML
$dom = new DOMDocument('1.0', 'utf-8');
$page = $dom->createElement('brands'); // on cr�� le nouveau noeud
$dom->appendChild($page); //on affecte le nouveau noeud au noeud de son choix

$query="SELECT * from companies order by id asc";
$results = mysql_query($query); 
 
 $i=1;        
 
 while ($row = mysql_fetch_assoc($results)) {


	//on rajoute l'attribut lang
	$langue_att1=$dom->createAttribute('lang'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode('FR');
	$langue_att1->appendChild($langue_text);
	
	//on rajoute l'attribut Date
	$langue_att1=$dom->createAttribute('date'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode(date('Y-m-d H:i:s'));
	$langue_att1->appendChild($langue_text);
	
	//on rajoute l'attribut lang
	$langue_att1=$dom->createAttribute('GMT'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode("+1");
	$langue_att1->appendChild($langue_text);
	
	//on rajoute l'attribut lang
	$langue_att1=$dom->createAttribute('version'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode('2.0');
	$langue_att1->appendChild($langue_text);
	
		//marque
	$marque= $dom->createElement('brand');
	$page->appendChild($marque);
	
	//on rajoute l'attribut lang
	$marque_att1=$dom->createAttribute('num'); 
	$marque->appendChild($marque_att1);
	
	//on rajoute le texte li� � l'attribut
	$marque_text=$dom->createTextNode($i);
	$marque_att1->appendChild($marque_text);
	
	
	addnode($dom,$marque,'id',$row['id']);
	addnode($dom,$marque,'name',$row['title']);
	addnode($dom,$marque,'url',$GLOBALS['base'].toURL($row['title'])."_c".$row['id'].".html");
	addnode($dom,$marque,'own_url_shop',$row['own_url_shop']);
	
	$i++;
}


$xml_result = $dom->saveXML();

//on enregistre
$fp = fopen($fichierMarqueXML, "w");
fwrite($fp, $xml_result);
fclose($fp);

// PRODUIT =========================================================================================================================
// Chargement du fichier XML
$dom = new DOMDocument('1.0', 'utf-8');
$page = $dom->createElement('catalog'); // on cr�� le nouveau noeud
$dom->appendChild($page); //on affecte le nouveau noeud au noeud de son choix

$query="SELECT products.id as pdtid,products.*,users.* from products left join users on products.userid=users.id where  state='published' ";
$query.=" and published='true' and rating1enabled='true' and rating2enabled='true' and rating3enabled='true' and rating4enabled='true' order by products.id asc";
$results = mysql_query($query); 
 if (mysql_errno()) {
     echo "MySQL error ".mysql_errno().": ".mysql_error()."\nWhen executing:<br>\n$query\n"; }



 $i=1;        
 
 while ($row = mysql_fetch_assoc($results)) {


	//on rajoute l'attribut lang
	$langue_att1=$dom->createAttribute('lang'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode('FR');
	$langue_att1->appendChild($langue_text);
	
	//on rajoute l'attribut Date
	$langue_att1=$dom->createAttribute('date'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode(date('Y-m-d H:i:s'));
	$langue_att1->appendChild($langue_text);
	
	//on rajoute l'attribut lang
	$langue_att1=$dom->createAttribute('GMT'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode("+1");
	$langue_att1->appendChild($langue_text);
	
	//on rajoute l'attribut lang
	$langue_att1=$dom->createAttribute('version'); 
	$page->appendChild($langue_att1);
	
	//on rajoute le texte li� � l'attribut
	$langue_text=$dom->createTextNode('2.0');
	$langue_att1->appendChild($langue_text);
	
		//marque
	$product= $dom->createElement('product');
	$page->appendChild($product);
	
	//on rajoute l'attribut lang
	$product_att1=$dom->createAttribute('num'); 
	$product->appendChild($product_att1);
	
	//on rajoute le texte li� � l'attribut
	$product_text=$dom->createTextNode($i);
	$product_att1->appendChild($product_text);
	
	//products.id=productsubratings.productid
	
	$idpdt=$row['pdtid'];
	
	addnode($dom,$product,'id',$idpdt);
	addnode($dom,$product,'name',$row['name']);
	addnode($dom,$product,'brand',$row['brand']);
	addnode($dom,$product,'url',$GLOBALS['base'].toURL($row['name'])."_p".$row['id'].".html");
	addnode($dom,$product,'img_score',$GLOBALS['base']."ecoimg.php?id=".$idpdt);
	addnode($dom,$product,'ean',$row['EAN']);
	
	//fabrication
	if ($row['rating1enabled']=='true') {
			$rating1= $dom->createElement('production');
			$product->appendChild($rating1);
	
			addAttribut($dom,$rating1,'score',$row['rating1']);
	 	  addCDATAnode($dom,$rating1,'comment_ecocompare',$row['rating1comment']);
			
			//recherche des sous-notes
			$query2="select * from subratings,productsubratings where productsubratings.subratingid=subratings.id and subratings.ratingid=1 and productsubratings.productid=".$idpdt;
			$results2 = mysql_query($query2); 
		 if (mysql_errno()) {
   		  echo "MySQL error ".mysql_errno().": ".mysql_error()."\nWhen executing:<br>\n$query2\n"; }
 
 			while ($row2 = mysql_fetch_assoc($results2)) {
					
			$critere= $dom->createElement('criteria');
			$rating1->appendChild($critere);
			
			addAttribut($dom,$critere,'shortname',$row2['shortname']);
			addAttribut($dom,$critere,'score',$row2['points']);
			addCDATAnode($dom,$critere,'name',$row2['name']);
			addCDATAnode($dom,$critere,'comment_user',$row2['comment']);
				
		}
	
	}
	
	//utilisation
	if ($row['rating2enabled']=='true') 
	{
		
			$rating2= $dom->createElement('use');
			$product->appendChild($rating2);
	
			addAttribut($dom,$rating2,'score',$row['rating2']);
	 	  addCDATAnode($dom,$rating2,'comment_ecocompare',$row['rating2comment']);
		
		
	//	echo ">>>".$idpdt."\n";

			//recherche des sous-notes
			$query2="select * from subratings,productsubratings where productsubratings.subratingid=subratings.id and subratings.ratingid=2 and productsubratings.productid=".$idpdt;
			$results2 = mysql_query($query2); 
		 if (mysql_errno()) {
   		  echo "MySQL error ".mysql_errno().": ".mysql_error()."\nWhen executing:<br>\n$query2\n"; }
 
 			while ($row2 = mysql_fetch_assoc($results2)) {
					
			$critere= $dom->createElement('criteria');
			$rating2->appendChild($critere);
			
			addAttribut($dom,$critere,'shortname',$row2['shortname']);
			addAttribut($dom,$critere,'score',$row2['points']);
			addCDATAnode($dom,$critere,'name',$row2['name']);
			addCDATAnode($dom,$critere,'comment_user',$row2['comment']);
		}
 	
	}
	
	//fin de vie
	if ($row['rating3enabled']=='true') {
		
	
			$rating3= $dom->createElement('end_of_life');
			$product->appendChild($rating3);
	
			addAttribut($dom,$rating3,'score',$row['rating3']);
	 	  addCDATAnode($dom,$rating3,'comment_ecocompare',$row['rating3comment']);
					
			//recherche des sous-notes
			$query2="select * from subratings,productsubratings where productsubratings.subratingid=subratings.id and subratings.ratingid=3 and productsubratings.productid=".$idpdt;
			$results2 = mysql_query($query2); 
		 if (mysql_errno()) {
   		  echo "MySQL error ".mysql_errno().": ".mysql_error()."\nWhen executing:<br>\n$query2\n"; }
 
 			while ($row2 = mysql_fetch_assoc($results2)) {
					
			$critere= $dom->createElement('criteria');
			$rating3->appendChild($critere);
			
			addAttribut($dom,$critere,'shortname',$row2['shortname']);
			addAttribut($dom,$critere,'score',$row2['points']);
			addCDATAnode($dom,$critere,'name',$row2['name']);
			addCDATAnode($dom,$critere,'comment_user',$row2['comment']);
				
		}
		
	}
	
	if ($row['rating4enabled']=='true') {
	
			$rating4= $dom->createElement('global');
			$product->appendChild($rating4);
	
			addAttribut($dom,$rating4,'score',$row['rating4']);
	 	  addCDATAnode($dom,$rating4,'comment_ecocompare',$row['rating4comment']);
		
	}
	
	addnode($dom,$product,'tags',$row['tags']);
	addnode($dom,$product,'marque_id',$row['companyid']);
	
	$i++;
}


$xml_result = $dom->saveXML();

//on enregistre
$fp = fopen($fichierProduitXML, "w");
fwrite($fp, $xml_result);
fclose($fp);


/*
print <<<XML_SHOW
$xml_result
XML_SHOW;*/



exit;

function addnode ($dom,$pere,$noeud,$valeur)
{
$newnode = $pere->appendChild($dom->createElement($noeud));
$newnode->appendChild($dom->createTextNode($valeur));
}

function toURL($string){
		$string = mb_ereg_replace('�', 'e', $string);
		$string = mb_ereg_replace('�', 'e', $string);
		$string = mb_ereg_replace('�', 'e', $string);	
		$string = mb_ereg_replace('�', 'o', $string);
		$string = mb_ereg_replace('&', '-', $string);
		$string = mb_ereg_replace(' ', '-', $string);
		$string = mb_ereg_replace('\:', '-', $string);
		$string = mb_ereg_replace('\?', '-', $string);
		$string = mb_ereg_replace('\&', '-', $string);
		$string = mb_ereg_replace('\!', '-', $string);
		$string = mb_ereg_replace('\'', '-', $string);
		$string = mb_ereg_replace('/', '-', $string);
		$string = mb_ereg_replace('�', 'c', $string);
		$string = urlencode($string);
		return $string;
    }

function addCDATAnode ($dom,$pere,$noeud,$valeur)
{
$newnode = $pere->appendChild($dom->createElement($noeud));
$newnode->appendChild($dom->createCDATASection($valeur));
return $newnode;
}

function addAttribut ($dom,$noeud,$cle,$valeur)
{
$newnode=$dom->createAttribute($cle);
$noeud->appendChild($newnode);

//on rajoute le texte li� � l'attribut
$node_text=$dom->createTextNode($valeur);
$newnode->appendChild($node_text);
			
return $newnode;
}

	function addCDATAAttribut ($dom,$noeud,$cle,$valeur)
{
$newnode=$dom->createAttribute($cle);
$noeud->appendChild($newnode);

//on rajoute le texte li� � l'attribut
$node_text=$dom->createCDATASection($valeur);
$newnode->appendChild($node_text);
			
return $newnode;
}
			
			
?>
