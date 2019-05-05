<?php
require_once('Controller.php');

class ProductCtrl extends Controller{
	
	var $originalValues = null;
	
function show(){
		$db = new Db();
		require_once('CommentCtrl.php');
		require_once('CategoryCtrl.php');
		require_once('DrawratingCtrl.php');

		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
		if (reqOrDefault('lang', '')=='en')  $this->lang=2;
		
		//on log les stats
		$db->logProductStat(req('id'));
		
		$this->categories = $db->getCategories();	
		$this->product = $db->getProduct(req('id'),$this->lang);
		
		//check si existe dans la table products ou producs_old (pour le référencement)
		if (!isset($this->product['id'])) {
		$this->product =$db->getProduct_old(req('id'));
		$this->currentTab = "products";
			$this->categoryCtrl = new CategoryCtrl();
			$this->commentCtrl = new CommentCtrl();
			$this->ratingCtrl = new DrawratingCtrl();
		$this->render(langdir($this->lang).'oldproductshow.php');
		exit;
		}
		
		//V2
		$this->lifeCycles = $db->getLifecycles();
		$this->MaxEnvironnement=$db->getTypeMax($this->product['typeid'],1,0);
		$this->MaxSante=$db->getTypeMax($this->product['typeid'],2,0);
		$this->MaxSocietal=$db->getTypeMax($this->product['typeid'],3,0)+$db->getTypeMax($this->product['typeid'],4,0)+$db->getTypeMax($this->product['typeid'],5,0);
		//rating_bar(req('id'),5,'static');
		
		//Selon si équitable nord ou sud
		if ($this->product['equitable_sud']==1) 	
			$this->MaxSocietal+=$db->getTypeMax($this->product['typeid'],6,0); 
		else
			$this->MaxSocietal+=$db->getTypeMax($this->product['typeid'],7,0);

		//si pas de catégorie trouvée, produit inexistant, rediriger vers home
		if (count($db->getProductCategories(req('id')))!= 0 ) {
	
			$this->partners=$db->getProductPartnerByProduct(req('id'),'eco-sapiens');
			$this->relatedProducts = $db->getRelatedProducts(req('id'),$db->getProductCategories(req('id')), 5);
			$this->company = $db->getCompanyByUser($this->product['userid']);
				
		
			if ($this->product == null || ($this->product['published'] != 'true' && $this->product['published'] != 'saved')){
					requireRights($this->product['userid']);
			}
		
			$this->comments = $db->getComments('product', req('id'));
			$this->categoryCtrl = new CategoryCtrl();
			$this->commentCtrl = new CommentCtrl();
			$this->ratingCtrl = new DrawratingCtrl();
				
			
				
			if(isset($_SESSION['id'])){
				$this->rateGlobal = $this->ratingCtrl->rating_bar(req('id'),5,'static',$_SESSION['id']);
				$this->checkRate = $db->checkUserRate(req('id'),$_SESSION['id']);
				//$this->rateProduct = $this->ratingCtrl->rating_bar(req('id'),5,'',$_SESSION['id']);
			}
			else{
				$this->rateGlobal = $this->ratingCtrl->rating_bar(req('id'),5,'static');
				$this->checkRate = false;
			}
			
			$this->userReviews = $db->getUsersReviewsFor1Product(req('id'));
			
			
			$this->currentTab = "products";
			$this->title = encodeQuotes($this->product['name']);
			$this->description = encodeQuotes(trimText($this->product['description'], 120));
			$this->keywords = encodeQuotes($this->product['tags']);
		
			$this->socialNetworks = array(array("name" => "google",
											 "url" => "http://www.google.com/bookmarks/mark?op=edit&amp;bkmk=",
											 "logo" => "http://www.ecocompare.com/images/logo_google.png",
											 "alt" => "Favoris Google"),
											 array("name" => "yahoo",
											 "url" => "http://myweb2.search.yahoo.com/myresults/bookmarklet?u=",
											 "logo" => "http://www.ecocompare.com/images/logo_yahoo.gif",
											 "alt" => "Favoris Yahoo"),
											 array("name" => "live",
											 "url" => "http://favorites.live.com/quickadd.aspx?marklet=1&amp;mkt=fr-fr&amp;url=",
											 "logo" => "http://www.ecocompare.com/images/logo_live.gif",
											 "alt" => "Favoris Live"),
											 array("name" => "facebook",
											 "url" => "http://www.facebook.com/sharer.php?u=",
											 "logo" => "http://www.ecocompare.com/images/logo_facebook.gif",
											 "alt" => "Partager cet article sur Facebook"),
											 array("name" => "myspace",
											 "url" => "http://www.myspace.com/Modules/PostTo/Pages/?t=",
											 "logo" => "http://www.ecocompare.com/images/logo_myspace.png",
											 "alt" => "Ajouter sur MySpace"),
											 array("name" => "digg",
											 "url" => "http://digg.com/submit?phase=3&amp;url=",
											 "logo" => "http://www.ecocompare.com/images/logo_digg.jpg",
											 "alt" => "Partager sur Digg"),
											 array("name" => "delicious",
											 "url" => "http://del.icio.us/post?v=2&amp;url=",
											 "logo" => "http://www.ecocompare.com/images/logo_delicious.gif",
											 "alt" => "Partager sur Del.Ici.Us"),
											 array("name" => "technorati",
											 "url" => "http://technorati.com/faves?add=",
											 "logo" => "http://www.ecocompare.com/images/logo_technorati.gif",
											 "alt" => "Ajouter sur Technorati"),
											 array("name" => "blogmarks",
											 "url" => "http://www.blogmarks.net/my/new.php?url=",
											 "logo" => "http://www.ecocompare.com/images/logo_blogmarks.gif",
											 "alt" => "Ajouter sur Blogmarks"));		
		
			if (!(company() || admin()) && $this->product['published'] == 'saved') $this->render(langdir($this->lang).'oldproductshow.php');
			else $this->render(langdir($this->lang).'productshow.php');
		}
		else  header('Location: /index.php');   
	}	

		function ajax4(){
		global $db;
		$this->formValues = $db->getProduct(req('id'));
		$this->type_id=req('type_id');
		
		//si langue en session (back office)
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
		
		$this->lifeCycles = $db->getLifecycles(0,$_SESSION['user']['lang']); 
		$this->targetAction = "update";
		$this->render2(langdir($this->lang).'ajaxsection4.php');
	}
	
	function ajax5(){
		global $db;
		$this->formValues = $db->getProduct(req('id'));
		$this->type_id=req('type_id');
		//si langue en session (back office)
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
	
		$this->targetAction = "update";
		$this->render2(langdir($this->lang).'ajaxsection5.php');
	}
	
	function ajax6(){
		global $db;
		$this->formValues = $db->getProduct(req('id'));
		$this->type_id=req('type_id');
		//si langue en session (back office)
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
	
		$this->targetAction = "update";
		$this->render2(langdir($this->lang).'ajaxsection6.php');
	}
	
	function ajax7(){
		global $db;
		$this->formValues = $db->getProduct(req('id'));
		$this->type_id=req('type_id');
		//si langue en session (back office)
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
		
		$this->targetAction = "update";
		$this->render2(langdir($this->lang).'ajaxsection7.php');
	}
	 
		function ajax8(){
		global $db;
		$this->formValues = $db->getProduct(req('id'));
		$this->type_id=req('type_id');
		//si langue en session (back office)
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
		
		$this->targetAction = "update";
		$this->render2(langdir($this->lang).'ajaxsection8.php');
	}
	
		function ajax9(){
		global $db;
		$this->formValues = $db->getProduct(req('id'));
		$this->type_id=req('type_id');
		$this->equitable_sud=req('equitable_sud');
		//si langue en session (back office)
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
	
		$this->targetAction = "update";
		$this->render2(langdir($this->lang).'ajaxsection9.php');
	}


	function showcounter() {
	global $db;
	echo $db->getCountEans();
		
	}
	function syncLabelsWithSubratings(){
		global $db;
	
		$products = $db->getAllProducts();
		foreach($products as $key=>$product){
			$db->syncLabelsWithSubratings($product['id']);
		}

	}
	
	function browse(){
		global $db;
		$this->productsCount = $db->searchProducts2(reqOrDefault('keywords', ''), reqOrDefault('category', 'new'), reqOrDefault('orderby', 'pubdate DESC'), reqOrDefault('label'), reqOrDefault('brand', ''), 0, 0, true,reqOrDefault('personnal', '')); // Considérablement optimisable ;-)
		
		//echo $db->searchProducts2(reqOrDefault('keywords', ''), reqOrDefault('category', 'new'), reqOrDefault('orderby', 'pubdate DESC'), reqOrDefault('label'), reqOrDefault('brand', ''), 0, 0, true);

		$this->pages = intval(($this->productsCount - 1) / $GLOBALS['productsperpage']) + 1;
		$this->offset = (reqOrDefault('page', 1) - 1) * $GLOBALS['productsperpage'];
		$this->limit = $GLOBALS['productsperpage'];
		
		$this->products = $db->searchProducts2(
			reqOrDefault('keywords', ''),
			reqOrDefault('category', 'new'),
			reqOrDefault('orderby', 'pubdate DESC'),
			reqOrDefault('label'),
			reqOrDefault('brand', ''),
			$this->limit,
			$this->offset,
			false,
			reqOrDefault('personnal', '')
			
		);

		if ($this->productsCount == 1 && reqOrDefault('keywords', '') != ''){
			header('Location: '.toURL($this->products[0]['name'].'_p'.$this->products[0]['id']).'.html?keywords='.reqOrDefault('keywords', ''));			
		}

		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		
		if (reqOrDefault('category', 'new') != 'new' && reqOrDefault('category', 'new') != 'selection' && reqOrDefault('category', 'new') != 'bad'){
			$this->category = $db->getCategory(reqOrDefault('category', ''));
			$this->title = "Produits de la catégorie ".encodeQuotes($this->category['name']);
			if (reqOrDefault('label')>0) $this->title.= " et ".$db->getLabelName(reqOrDefault('label'));
			$this->description = encodeQuotes($this->category['text']);
			$this->keywords = encodeQuotes($this->category['name']);
		}else{
		//	$this->title = "Comparateur de produits";
			if (reqOrDefault('keywords', '') != '')	$this->title = "Résultats de recherche pour ".reqOrDefault('keywords', ''); else $this->title = "Sélection de produits responsables";
		}

		$this->orders[] = array("id" => "name ASC", "name" => "Nom");
		$this->orders[] = array("id" => "brand ASC, name ASC", "name" => "Marque");
		$this->orders[] = array("id" => "pubdate DESC", "name" => "Date de publication");
		$this->orders[] = array("id" => "score4 DESC", "name" => "Note globale");
		$this->orders[] = array("id" => "rating1 DESC, score4 DESC", "name" => "Note Environnement");
		$this->orders[] = array("id" => "rating2 DESC, score4 DESC", "name" => "Note Sociétale");
		$this->orders[] = array("id" => "rating3 DESC, score4 DESC", "name" => "Note Santé");

		
		$rawLabels = $db->getLabels();
		$this->labels = array();
		foreach($rawLabels as $key=>$label){
			if ($db->searchProducts2(reqOrDefault('keywords', ''), reqOrDefault('category', 'new'), reqOrDefault('orderby', 'pubdate DESC'), $label['id'], reqOrDefault('brand', ''), 0, 0, true,reqOrDefault('personnal', '')) > 0){
				$this->labels[] = $label;
			}
		}
		array_unshift($this->labels, array("id" => "", "name" => "Tous"));
   
    	
   $this->selection = array();
		for ($i = 1; reqOrDefault("selection$i", '') != ''; $i++){
			$this->selection[] = req("selection$i");
		}

		$this->onload = "updateCompareButton()";
		$this->currentTab = "products";

		if ($this->productsCount > 0) 
			$this->render('productbrowse.php'); 
		else 
			header('Location: '.$GLOBALS['base'].'index.php');   

	}

//générer un doc PDF qui résume la liste des pièces à fournir, par produit
	function showproof(){
	
		global $db;
		
		if (reqOrDefault('userId',$_SESSION['user']['id'])!='') $userId=req('userId');

		$lang=reqOrDefault('lang', '1');
		
		$mode=req('mode');
		$this->user = $db->getUser($userId);
		$this->products = $db->getUserProducts($userId,reqOrDefault('published', '1'));

		$this->company = $db->getCompany($this->user['companyid']);		
		
	
		$repertoire="/var/www/vhosts/ecocompare.com/httpdocs/";
		
		//on change le titre si justificatifs ou attestation sur l'honneur
		$titre="";
		if ($mode==1 && $lang==1) $titre="Liste des justificatifs à fournir et nous renvoyer";
		if ($mode==2 && $lang==1) $titre="Attestation sur l'honneur à signer et nous renvoyer";
		
		if ($mode==1 && $lang==2) $titre="Supporting to provide and send back";
		if ($mode==2 && $lang==2) $titre="Honour certificates to sign and send back";

		
		//Excel
		define('PHPEXCEL_ROOT',$repertoire.'/Classes/');
		ini_set('include_path', ini_get('include_path').';'.$repertoire.'/Classes/');
		
	

		//echo ini_get('include_path');
		include ('Classes/PHPExcel.php');
		include("Classes/PHPExcel/IOFactory.php");
		include ('Classes/PHPExcel/Writer/IWriter.php');
		include ('Classes/PHPExcel/IComparable.php');
		include ('Classes/PHPExcel/Shared/String.php');
		include ('Classes/PHPExcel/CachedObjectStorageFactory.php');
		include ('Classes/PHPExcel/Worksheet/PageSetup.php');
		include ('Classes/PHPExcel/Worksheet/PageMargins.php');
		include ('Classes/PHPExcel/Worksheet/HeaderFooter.php');
		include ('Classes/PHPExcel/Worksheet/SheetView.php');
		include ('Classes/PHPExcel/Worksheet/AutoFilter.php');
		include ('Classes/PHPExcel/Worksheet/Protection.php');
		include ('Classes/PHPExcel/Worksheet/RowDimension.php');
		include ('Classes/PHPExcel/Worksheet/ColumnDimension.php');
		include ('Classes/PHPExcel/Worksheet/Drawing/Shadow.php');
		include ('Classes/PHPExcel/Worksheet/BaseDrawing.php');
		include ('Classes/PHPExcel/Worksheet/Drawing.php');
		include ('Classes/PHPExcel/DocumentProperties.php');
		include ('Classes/PHPExcel/DocumentSecurity.php');
		include ('Classes/PHPExcel/Style.php');
		include ('Classes/PHPExcel/Style/Font.php');
		include ('Classes/PHPExcel/Style/Protection.php');
		include ('Classes/PHPExcel/Style/Color.php');
		include ('Classes/PHPExcel/Style/Fill.php');
		include ('Classes/PHPExcel/Style/Borders.php');
		include ('Classes/PHPExcel/Style/Border.php');
		include ('Classes/PHPExcel/Style/Alignment.php');
		include ('Classes/PHPExcel/Style/NumberFormat.php');
		include ('Classes/PHPExcel/Worksheet.php');
		include ('Classes/PHPExcel/Writer/PDF.php');
		include ('Classes/PHPExcel/CachedObjectStorage/CacheBase.php');
		include ('Classes/PHPExcel/CachedObjectStorage/ICache.php');
		include ('Classes/PHPExcel/CachedObjectStorage/Memory.php');
		include ('Classes/PHPExcel/Calculation.php');
		include ('Classes/PHPExcel/Calculation/Functions.php');
		include ('Classes/PHPExcel/Calculation/Function.php');
		include ('Classes/PHPExcel/Settings.php');
		include ('Classes/PHPExcel/Cell.php');
		include ('Classes/PHPExcel/Cell/DataType.php');
		include ('Classes/PHPExcel/Cell/IValueBinder.php');
		include ('Classes/PHPExcel/Cell/DefaultValueBinder.php');
		include ('Classes/PHPExcel/ReferenceHelper.php');
		include ('Classes/PHPExcel/WorksheetIterator.php');
		include ('Classes/PHPExcel/Writer/Excel2007/WriterPart.php');
		include ('Classes/PHPExcel/Writer/Excel2007/StringTable.php');
		include ('Classes/PHPExcel/Writer/Excel2007/ContentTypes.php');
		include ('Classes/PHPExcel/Writer/Excel2007/DocProps.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Rels.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Theme.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Style.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Workbook.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Worksheet.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Drawing.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Comments.php');
		include ('Classes/PHPExcel/Writer/Excel2007/Chart.php');
		include ('Classes/PHPExcel/Writer/HTML.php');
		include ('Classes/PHPExcel/HashTable.php');
		include ('Classes/PHPExcel/Shared/XMLWriter.php');
		include ('Classes/PHPExcel/Shared/Date.php');
		include ('Classes/PHPExcel/Shared/File.php');
		include ('Classes/PHPExcel/Shared/Drawing.php');
		include ('Classes/PHPExcel/Shared/Font.php');

	//PDF
		$rendererLibraryPath = $repertoire.'/tcpdf/'; 
		
		$rendererLibrary ='tcppdf';
		$rendererName = PHPExcel_Settings::PDF_RENDERER_TCPDF; 
		
		if (!PHPExcel_Settings::setPdfRenderer($rendererName,$rendererLibraryPath)) {
		die('NOTICE: Please set the $rendererName and $rendererLibraryPath values');}
		include ('Classes/PHPExcel/Writer/PDF/Core.php');
		include ('Classes/PHPExcel/Writer/PDF/tcPDF.php');
									
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Ecocompare")
							 ->setLastModifiedBy("Ecocompare")
							 ->setTitle("lISTE DES JUSTIFICATIFS ")
							 ->setSubject("Notation de produit")
							 ->setDescription("Permet de noter un produit selon 5 thèmes")
							 ->setKeywords("office PHPExcel php");
					
$sheet0 = $objPHPExcel->getActiveSheet();
	
$sheet0->setShowGridlines(false);
//logo
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Logo');
$objDrawing->setDescription('Logo');
$objDrawing->setPath($repertoire.'/images/ecocompare_clair_mini.jpg');
$objDrawing->setHeight(36);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$sheet0->setCellValue('B1',$titre);
$styleA1 = $sheet0->getStyle('B1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$sheet0->getColumnDimension('A')->setWidth(50);
$sheet0->getColumnDimension('B')->setWidth(50);


//on positionne le texte en haut de la cellule
$sheet0->getStyle('A1:A7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);


$sheet0->setCellValue('A3',$this->company['title']);
$styleA1 = $sheet0->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');


//boucle sur les produits

$i=4;
foreach ($this->products as $key=>$product) {
	
	//si il ya des points à justifier
	if (count($db->getProductSubratingProof($product['id'],$mode))>0) {
	
			
			$sheet0->setCellValue("A$i",$product['name']);	
			$sheet0->getStyle("A$i:B$i")->getBorders()->applyFromArray(
			    		array(
			    			'allborders' => array(
			    				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
			    				'color' => array(
			    					'rgb' => '808080'
			    				)
			    			)
			    		)
			    );
			    $sheet0->mergeCells("A$i:B$i");
			    //liste des criteres qui demandes des justifications
			    $justifs=$db->getProductSubratingProof($product['id'],$mode,$lang);
			    foreach($justifs as $key2=>$justif) {
			    	$i++;
			    	$sheet0->setCellValue("A$i",$justif['name']);	
		      	$sheet0->setCellValue("B$i",$justif['proof_exist']);	
						//echo $justif['name']."<br/>";
			    }
			$i++;
			}

		}
$i++;


$sheet0->setTitle('Description');

$i++;
//bloc signature
if ($mode==2) {
	
	$sheet0->mergeCells("A$i:B$i");
	if ($lang==1) $sheet0->setCellValue("A$i","Merci de signer ce document et nous l'envoyer par courrier (7 avenue de verdun, 26300 Bourg de Péage) ou par mail (support@ecocompare.com)" );
  else $sheet0->setCellValue("A$i","Please sign this document and post it (7 avenue de verdun, 26300 Bourg de Péage - France) or send it by email (support@ecocompare.com)" );

	$i++;
	$sheet0->setCellValue("A$i",	"Signature) ");

		$styleA1 = $sheet0->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(12);
		$styleFont->setName('Arial');

	$i++;
	$sheet0->getRowDimension($i)->setRowHeight(40);
		$sheet0->getStyle("A$i")->getBorders()->applyFromArray(
			    		array(
			    			'allborders' => array(
			    				'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
			    				'color' => array(
			    					'rgb' => '808080'
			    				)
			    			)
			    		)
			    );
}

if ($mode==1) {
	
	$sheet0->mergeCells("A$i:B$i");
	if ($lang==1) $sheet0->setCellValue("A$i","Merci de nous envoyer les justificatifs par courrier (7 avenue de verdun, 26300 Bourg de Péage) ou par mail (support@ecocompare.com)" );
  else $sheet0->setCellValue("A$i","Please send all supporting by mail (7 avenue de verdun, 26300 Bourg de Péage - France ) or by email (support@ecocompare.com)" );
}

$i++;
// version et date
$sheet0->setCellValue("A$i",	"File  generate on ".date("Y-m-d H:i:s").", version ".$GLOBALS['method_version']);
$styleA1 = $sheet0->getStyle("A$i");
$styleFont = $styleA1->getFont();
$styleFont->setItalic(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

//footer
$sheet0->getHeaderFooter()->setOddFooter('Please treat this document as confidential!');
$sheet0->getSheetView()->setZoomScale(75);
	
// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'PDF');

if ($mode==1) $fichier='pdf/justificatif_';
if ($mode==2) $fichier='pdf/attestation_';

$fichier.=trim(str_replace(' ','_',$this->company['title'])).'.pdf';
unlink($fichier);
//echo $fichier;
$objWriter->save($fichier);

//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

//header("Pragma: public");
//header("Expires: 0");
//header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//header("Content-Type: application/force-download");
//header("Content-Type: application/octet-stream");
//header("Content-Type: application/download");;
//header("Content-Transfer-Encoding: binary");
//header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//header('Content-Disposition: attachment; filename="'.trim($this->type['name']).'.xlsx"');
//header('Cache-Control: max-age=0');

$handle = fopen($fichier, "r");
$contents = fread($handle, filesize($fichier));
fclose($handle);


header("Location: ".$GLOBALS['base'].$fichier);
}
	function compare(){
		global $db;
		$this->products = array();
		$libelle="";
		for ($i = 1; $i <=5; $i++){
			if (reqOrDefault('selection'.$i, 0) != 0){
				$this->products[] = $db->getProduct(reqOrDefault('selection'.$i, 0));
				$libelle.=substr($this->products[$i-1]['name'],0,22)."-";
				

			}
		}
		
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		
		$this->currentTab = "products";
		
		$this->title = "Votre comparaison $libelle";
		$this->render('productcompare.php');
	}

function updateJustify() {
	//var_dump($_POST["attest_id"]);
	global $db;
	$productId=$_POST["productId"];
	$userId=$_POST["userId"];
	
	//Sauvegarde des attestations
	if (isset($_POST["attest_id"])) {
	$i=0;
	foreach ($_POST["attest_id"] as $id) {
		
		if (isset($_POST["attest_date"][$i])) $attest_date=$_POST["attest_date"][$i]; else $attest_date="";
		if (isset($_POST["attest_sent$i"]) && $_POST["attest_sent$i"]=='on') $attest_sent=1; else $attest_sent=0;
		if (isset($_POST["attest_comment"][$i])) $attest_comment=$_POST["attest_comment"][$i]; else $attest_comment="";
		
		
		//echo "$id, $attest_date,$attest_sent,$attest_comment <br/>";
		
		$db->saveJustif($productId,$id,$attest_date,$attest_sent,$attest_comment);
		
		
		$i++;
	}}
	
	if (isset($_POST["justif_id"])) {
	$i=0;
	foreach ($_POST["justif_id"] as $id) {
		
		if (isset($_POST["justif_date"][$i])) $justif_date=$_POST["justif_date"][$i]; else $justif_date="";
		if (isset($_POST["justif_sent$i"]) && $_POST["justif_sent$i"]=='on') $justif_sent=1; else $justif_sent=0;
		if (isset($_POST["justif_comment"][$i])) $justif_comment=$_POST["justif_comment"][$i]; else $justif_comment="";
		
		//echo "$id, $justif_date,$justif_sent,$justif_comment <br/>";
		$db->saveJustif($productId,$id,$justif_date,$justif_sent,$justif_comment);
		$i++;
	}
}
	
	
	header('Location: products?action=justify&userId='.$userId.'&productId='.$productId);
		
} 

function justify(){
		
	global $db;
		requireAdminOrCompany();
	
		if ($_SESSION['user']['type'] == 'company'){
			header('Location: '.$GLOBALS['base'].'products/dashboard');
		}
		
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		//true, permet de rechercher le nombre de justifs non remplis
		$this->users=$db->getBrands(true);
		$userId=-1;

		
		if (company()){
			$userId = $_SESSION['user']['id'];
		}else{
			$userId = -1;
		}
		
		$productId="";
		
		if (reqOrDefault('userId','')!='') $userId=req('userId');
		if (reqOrDefault('productId','')!='') { $productId=req('productId');
			$this->product=$db->getProduct($productId);
    	$this->justifs=$db->getProductSubratingProof($productId,1);
    	$this->attestations=$db->getProductSubratingProof($productId,2);
		}

		if ($productId!="") $this->nbProductJustification=$db->getNumberToJustify(0,$productId); else $this->nbProductJustification=0;

		
		$this->propositionsCount = count($db->getProducts(reqOrDefault('category', ''), reqOrDefault('orderby', 'created DESC'), "submission", 0, 99999, $userId));
				
		if ($this->propositionsCount > 0 && !isset($_REQUEST['published'])){
			$_REQUEST['published'] = 'submission';
		}
		
		$this->productsCount = count($db->getProducts('', '', reqOrDefault('published', "true"), 0, 99999, $userId));
		
		$page = reqOrDefault('page', 1);
		
		$this->products = $db->getUserProducts($userId,0);
			
		//$this->products = $db->getProducts('', '', reqOrDefault('published', "true"), 0, 1000, $userId);
		
		$this->proofs=array();
	  
	  
		$this->onload = "";		
		$this->currentTab = "admin";
		$this->title = "Gestion des Justificatifs";
		$this->render('productjustify.php');
	}
	
	
function admin(){
		
	global $db;
		requireAdminOrCompany();
		
		
		if ($_SESSION['user']['type'] == 'company'){
			header('Location: '.$GLOBALS['base'].'products/dashboard');
		}
		
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		$this->users=$db->getBrands();
		if (company()){
			$userId = $_SESSION['user']['id'];
		}else{
			$userId = 0;
		}
		
		if (reqOrDefault('userId','')!='') $userId=req('userId');
		
		$this->propositionsCount = count($db->getProducts(reqOrDefault('category', ''), reqOrDefault('orderby', 'created DESC'), "submission", 0, 99999, $userId));
				
		if ($this->propositionsCount > 0 && !isset($_REQUEST['published'])){
			$_REQUEST['published'] = 'submission';
		}
		
		$this->productsCount = count($db->getProducts(reqOrDefault('category', ''), reqOrDefault('orderby', 'created DESC'), reqOrDefault('published', "true"), 0, 99999, $userId));
		
		$page = reqOrDefault('page', 1);
		$this->products = $db->getProducts(reqOrDefault('category', ''), reqOrDefault('orderby', 'majdate DESC'), reqOrDefault('published', "true"), ($page - 1)*50, 50, $userId);
		
		$this->orders[] = array("id" => "name ASC", "name" => "Par nom");
		$this->orders[]	 = array("id" => "brand ASC", "name" => "Par marque");
		$this->orders[] = array("id" => "created DESC", "name" => "Par date d'ajout");
		$this->orders[] = array("id" => "majdate DESC", "name" => "Par date modification");
		$this->orders[] = array("id" => "score4 DESC", "name" => "Par note globale");

		$this->nb_products=$db->getStat('nb_products');		
		$this->nb_ecoacteur_total=$db->getStat('nb_ecoacteur_total');		
		$this->nb_ecoacteur_actif=$db->getStat('nb_ecoacteur_actif');		
		$this->nb_iphone_scan=$db->getStat('nb_iphone_scan');		
		$this->nb_iphone_request=$db->getStat('nb_iphone_request');		
		$this->nb_ean_total=$db->getStat('nb_ean_total');		
		$this->nb_ean_desc=$db->getStat('nb_ean_desc');		
		$this->stats=$db->getStatMonth();		
		$this->onload = "";
						
		$this->currentTab = "admin";
		$this->title = "Administration"; 
		$this->render('productadmin.php');
	}

	function dashboard(){
		global $db;
		requireAdminOrCompany();
		
		$userId = $_SESSION['user']['id'];
		$this->lang=$_SESSION['user']['lang'];
		$this->user = $db->getUser($userId);
		$this->products = $db->getUserProducts($userId,0);
		$this->company = $db->getCompany($this->user['companyid']);		
		
		$this->nb_justif_1=$db->countProductSubratingProof($_SESSION['user']['id'],1,1);
		$this->nb_attestation_1=$db->countProductSubratingProof($_SESSION['user']['id'],2,1);
	
		$this->nb_justif_2=$db->countProductSubratingProof($_SESSION['user']['id'],1,2);
		$this->nb_attestation_2=$db->countProductSubratingProof($_SESSION['user']['id'],2,2);
	
	
		$this->currentTab = "admin";
		$this->title = "Administration";
		$this->render(langdir($this->lang).'dashboard.php');
	}
 
	function propose(){
		//requireAdmin();
			global $db;
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		require_once('LabelCtrl.php');
		$this->title = "Proposez un produit à noter sur ecocompare";
		$this->types = $db->getTypes();
		$this->labelCtrl = new LabelCtrl();
		$this->targetAction = "submit";
		$this->formValues['rating1'] = 0;
		$this->formValues['rating2'] = 0;
		$this->formValues['rating3'] = 0;
		$this->formValues['score4'] = 0;
	
		$this->formValues['subratings'] = array();
		
		$this->currentTab = "products";
		$this->render('productedit.php');
	}

	function add(){
	
		global $db;
	
		requireAdminOrCompany();
		$db->saveHistory($_SESSION['user']['id'],0,"add new product");
		
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
			
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		require_once('LabelCtrl.php');
		$this->labelCtrl = new LabelCtrl();
		$this->users = $db->getUsers();
		$this->types = $db->getTypes();

		//V2
		$this->lifeCycles = $db->getLifecycles(0,$lang);
		
		$this->targetAction = "create";
		$this->formValues['rating1'] = 0;
		$this->formValues['rating2'] = 0;
		$this->formValues['rating3'] = 0;
		$this->formValues['score4'] = 0;
		
		$this->formValues['subratings'] = array();
		
		if (isset($_SESSION['user'])){
			$this->formValues['contact'] = $_SESSION['user']['email'];
		}
		$this->onload = "";
		$this->currentTab = "admin";
		$this->render(langdir($this->lang).'productedit.php');
	}
	
	function create(){
		requireAdminOrCompany();
		global $db;
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
			
		$params = $this->paramsList();
		$params['created'] = time();
		if ($params['published'] == 'true'){
			$params['pubdate'] = time();
		}
		$id = $db->createProduct($params);
	
		$db->saveHistory($_SESSION['user']['id'],$id,"create new product");
	
		$this->handleImage($id);
	
		$db->updateProductCategories($id, reqOrDefault('categories', array()));
		$db->updateProductLabels($id, reqOrDefault('labels', array()),$lang);
		$db->updateProductSubratings($id, reqOrDefault('subratings', array()));
		
		foreach(reqOrDefault('subratings', array()) as $key=>$subrating){
		
			$db->updateProductSubratingComment($id, $subrating, reqOrDefault('subrating'.$subrating.'comment'));
			$db->updateProductSubratingFeedback($id, $subrating, reqOrDefault('subrating'.$subrating.'feedback'));
			
		}
		$this->onload = "";
		$this->buildImages($id);
		
		if ($params['published'] == 'submission'){
			$this->sendNotification($params['brand']."-".$params['name']);
		}
		
		header('Location: products?action=admin');
	}

	function submit(){
		//requireAdmin();
		global $db;
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
			
		$params = $this->paramsList();
		$params['created'] = time();
		$id = $db->createProduct($params);
		
		$db->saveHistory($_SESSION['user']['id'],$id,"submit product");
				
		$this->handleImage($id);
		$db->updateProductCategories($id, reqOrDefault('categories', array()));
		
		$db->updateProductSubratings($id, reqOrDefault('subratings', array()));
		
	

		foreach(reqOrDefault('subratings', array()) as $key=>$subrating){
			//echo 'hop';
			$db->updateProductSubratingComment($id, $subrating, reqOrDefault('subrating'.$subrating.'comment'));
			$db->updateProductSubratingFeedback($id, $subrating, reqOrDefault('subrating'.$subrating.'feedback'));
		}
		$db->updateProductLabels($id, reqOrDefault('labels', array()),$lang);
		$this->sendNotification($params['brand']."-".$params['name']);
		$this->onload = "";
		header('Location: /');
	}

	function edit(){
	
		global $db;
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
		require_once('CategoryCtrl.php');
		$this->categoryCtrl = new CategoryCtrl();
		$this->users = $db->getUsers();
		$this->types = $db->getTypes();
		require_once('LabelCtrl.php');
	
		$this->labelCtrl = new LabelCtrl();
		$this->formValues = $db->getProduct(req('id'));
		$this->nbFeedback=$db->getProductFeedback(req('id'));
	
		$db->saveHistory($_SESSION['user']['id'],req('id'),"edit product");
						
		
						
		//V2
		$this->lifeCycles = $db->getLifecycles(0,$this->lang);
		
		if ($this->formValues['refid'] == 0){
			$this->originalValues = null;
		}else{
		 
			$this->originalValues = $db->getProduct($this->formValues['refid']);
		}

		$this->targetAction = "update";
		
		$this->currentTab = "admin";
		$this->onload = "";
		requireRights($this->formValues['userid']);
		
		$this->render(langdir($this->lang).'productedit.php');
	}

	function deactivate(){
		global $db;
		
		$original = $db->getProduct(req('id'));
		requireRights($original['userid']);
		
		$db->saveHistory($userId,req('id'),"deactivate product");
			
		$params = array("published" => "deactivated");
		
		$db->updateProduct(req('id'), $params);
		header('Location: '.$GLOBALS['base'].'products/dashboard');		
		
	}

	function reactivate(){
		global $db;
		
		$original = $db->getProduct(req('id'));
		requireRights($original['userid']);
		$db->saveHistory($_SESSION['user']['id'],req('id'),"reactivate product");
		$params = array("published" => "true");
		
		$db->updateProduct(req('id'), $params);
		header('Location: '.$GLOBALS['base'].'products/dashboard');		
		
	}

	function update(){
		global $db;
	
	//error_log("pass update ".reqOrDefault('subaction', '')." \n", 3, "update.log");
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
		
		$original = $db->getProduct(req('id'));

		if ($original == null){
			header('Location: '.req('returnurl'));
		}
		
		
		requireRights($original['userid']);
					
		$params =  $this->paramsList();
					
		if (admin() || $original['published'] == 'submission' || $original['published'] == 'saved' ){
				//error_log("pass 1 \n", 3, "update.log");
			if ($original['refid'] != 0 && reqOrDefault('subaction', '') == 'publish'){ // Publication d'un brouillon de modif
				
					//error_log("pass2 \n", 3, "update.log");
				$params['refid'] = 0;
				$params['published'] = 'true';
				
				$params['majdate'] = time();
				

				$params['image'] = $original['image'];
				$id = $original['refid'];
				$db->saveHistory($_SESSION['user']['id'],req('id'),"submission requested, replace draft product ".$original['id']." to $id");
						
				if (file_exists('./productimages/product'.$original['id'])){
					copy('./productimages/product'.$original['id'], './productimages/product'.$original['refid']);
				}
				if (file_exists('./cache/thumb'.$id.'.jpg')){
					unlink('./cache/thumb'.$id.'.jpg');
				}
				if (file_exists('./cache/medium'.$id.'.jpg')){
					unlink('./cache/medium'.$id.'.jpg');
				}				
							
				$db->updateProduct($id, $params);							
				$db->deleteProduct($original['id']);
				
			}else{
	//error_log("pass 3 \n", 3, "update.log");
	
				if ($original['pubdate'] == 0 && $params['published'] == 'true'){ // Publication
					$params['pubdate'] = time();
					
				
				}
			
				
			// si on passe à submission et pas précédement
			if ($original['published']!= 'submission' && $params['published'] == 'submission') $this->sendNotification($params['brand']."-".$params['name']);
			if ($params['published']=='true' && reqOrDefault('sendmail','off')=='on')  $this->sendCustomerNotification($params['name'],req('id'),$params['contact']);
					 
			$db->saveHistory($_SESSION['user']['id'],req('id'),"update product, published=".$params['published']);
		
				$params['majdate'] = time();
				$params['majuserid'] = $_SESSION['user']['id'];
				$db->updateProduct(req('id'), $params);
				$id = req('id');
		
		
			}
		}else{ // Création d'un brouillon de modif, cas ou déja publiée et mise à jour par le client
	//error_log("pass 4 \n", 3, "update.log");
			$params['refid'] = $original['id'];
			$params['published'] = 'saved';
			$params['created'] = $original['created'];
			$params['pubdate'] = $original['pubdate'];
		  $params['majdate'] = time();
			$params['image'] = $original['image'];
			$id = $db->createProduct($params);	
			$db->saveHistory($_SESSION['user']['id'],$original['id'],"draft product created, new id = $id");			
			
			if (file_exists('./productimages/product'.$original['id'])){
				copy('./productimages/product'.$original['id'], './productimages/product'.$id);
			}
			
			//$this->sendNotification($params['brand']."-".$params['name']);	
		
		}
		
		$this->handleImage($id);
		
	

		$db->updateProductCategories($id, reqOrDefault('categories', array()));
	
		//on met à jours les criteres	(INSERTION)
		$db->updateProductSubratings($id, reqOrDefault('subratings', array()));

		foreach(reqOrDefault('subratings', array()) as $key=>$subrating){
		
			$db->updateProductSubratingComment($id, $subrating, reqOrDefault('subrating'.$subrating.'comment'));
			$db->updateProductSubratingFeedback($id, $subrating, reqOrDefault('subrating'.$subrating.'feedback'));
		}

		
		
		//rajouter code pour enregistrer les labels
		$db->updateProductLabels($id, reqOrDefault('labels', array()),$this->lang);

//on check si il y a des remarques pour les critères checkés par les labels
		// on FORCE à entrer le commentaire utilisateur
		foreach(reqOrDefault('subratingslabel', array()) as $key=>$subratingid){
			if (reqOrDefault('subratinglabel'.$subratingid.'comment')!='') $db->insertLabelComment($id, $subratingid, reqOrDefault('subratinglabel'.$subratingid.'comment'));
		}
	
	
		$db->recalculate($id);

		$this->buildImages($id);
		
		
		header('Location: '.req('returnurl'));
	}
		
	function 	getProductNote($productId,$themeId,$lifecycleId){
	global $db;
	if ($productId>0) return $db->getProductNote($productId,$themeId,$lifecycleId);	else return;
		}
		
	function recalculate(){
		global $db;
		$products = $db->getAllProducts();
		if (isset($_SESSION['user']['lang'])) $this->lang=$_SESSION['user']['lang']; else $this->lang=1;
			
	
		foreach($products as $key=>$product){
			
	
			$labelsId=array();		
			$labels = $db->getProductLabels($product['id']);
		
			foreach ($labels as $key=>$label) {
				$labelsId[]=$label['id'];
			}
				
	
			//rajouter code pour enregistrer les labels
			$db->updateProductLabels($product['id'], $labelsId,$this->lang);
			$db->recalculate($product['id']);

		
		}
	
	}
		function delete(){
		global $db;		
		$original = $db->getProduct(req('id'));
		requireRights($original['userid']);
		$db->saveHistory($_SESSION['user']['id'],req('id'),"delete product");
		$db->deleteProduct(req('id'),$original['userid']);
		
		header('Location: products?action=admin&published='.req('published').'&page='.req('page'));
	}
	
	function duplicate(){
		global $db;		
		$id = $db->duplicateProduct(req('id'));
		$db->saveHistory($_SESSION['user']['id'],req('id'),"duplicate product, new id : $id");
				
		if (file_exists('./productimages/product'.req('id') )){
				copy('./productimages/product'.req('id'), './productimages/product'.$id);
				}
				if (file_exists('./cache/thumb'.$id.'.jpg')){
				unlink('./cache/thumb'.$id.'.jpg');
				}
				if (file_exists('./cache/medium'.$id.'.jpg')){
					unlink('./cache/medium'.$id.'.jpg');
				}				
		
		header('Location: products?action=admin&published='.req('published').'&page='.req('page'));
	}
	
	function feedback(){
				global $db;	
		$product = $db->getProduct(req('id'));
	
		requireRights($original['userid']);

//$this->formatTime(
		//$db->deleteProduct(req('id'));
		if ($product['contact']=='') $to='support@ecocompare.com'; else $to=$product['contact'];
		
		$nombrefeedback=$db->getProductFeedback(req('id'));
		
		// si pas de demandes pas d'envoi
		if ($nombrefeedback > 0) {
			
		$subject = 'Demande de précisions pour la fiche  : '.$product['brand']." - ".$product['name'];
		$headers = 'From: Ecocompare <support@ecocompare.com>'."\n";
		$headers.= "Bcc: support@ecocompare.com\n";
 		$headers.= "Content-Type: text/html; charset=UTF-8;";
   	
   	$message = "Bonjour, <br/><br/>Suite à la demande de publication de votre fiche produit sur ecocompare.com, nous avons quelques demandes de précisions à vous soumettre concernant la fiche  <b>'".$product['name']."'</b> enregistrée ".$this->formatTime($product['created']).".<br/><br/>";
   	
   	$message.= "Pourriez-vous vous connecter à notre back office et répondre aux questions affichées en rouge ? <br/><br/>";
   	$message.="Voici l'url de connexion : <a href='".$GLOBALS['base']."/login'>".$GLOBALS['base']."/login</a><br/><br/>";
   	$message.="Une fois l’ensemble des réponses validé, votre fiche produit sera publiée sur notre site dans les plus brefs délais.<br/><br/>";
   	
   	$message.="En vous remerciant <br/> L'équipe Support Ecocompare.<br/> http://www.ecocompare.com<br>+33 4 75 70 18 11";
   	
		echo "envoi:".mail($to, $subject, $message, $headers);
	}
				
		header('Location: products?action=admin');
	}
	
	function showCheckBoxesForCategory(){
		global $db;
		$this->produts = $db->searchProducts2('', req('category'), 'name ASC', '', '');
		include ('../views/productcheckboxes.php');
	}
	
	function showList($products){
		$this->products = $products;
		include("./views/productlist.php");
 	}
	
	function showHomeList($products){
		$this->products = $products;
		include("./views/producthomelist.php");
 	}


	function showGrid($products){
		$this->products = $products;
		include("./views/productgrid.php");
 	}

	function showGrid2($products){
		$this->products = $products;
		include("./views/productgrid2.php");
 	}
	

	function buildImages($id){
	
		$sizes = array('thumb', 'medium');
	
		foreach($sizes as $key=>$size){
	
			if ($size == "thumb"){
				$width = 42;
			}else{
				$width = 145;
			}
		
			$name = 'cache/'.$size.$id.'.jpg';
			if (!file_exists('./'.$name)){
				$original = './productimages/product'.$id;
			
				if (file_exists($original)){
					$originalImage = null;
					try{
						$originalImage = imageCreateFromJpeg($original);
					}catch (Exception $e){
					}
					if ($originalImage == null){
						$originalImage = imageCreateFromGif($original);
					}
					if ($originalImage == null){
						$originalImage = imageCreateFromPng($original);
					}
					//error_log("image origine:$original \n", 3, "/tmp/image.log");
					
					//largeur origine
					$src_w=	imagesx($originalImage);
					//hauteur origine
					$src_h=	imagesy($originalImage);
				
					//error_log("largeur origine X: $src_w, hauteur Y: $src_h \n", 3, "/tmp/image.log");
				
					$dst_y=0;
					$dst_x=0;
					$dst_w=imagesx($resampledImage);
					$dst_h=imagesy($resampledImage);
					
					//on centre verticalement
				  if ($src_w>$src_h) {
				  	$ratio=$width / $src_w;
				  	
			 	
				  
				  	$dst_w=$width;
				  	$dst_h=$src_h*$ratio;
				  	$dst_y=($width-$dst_h)/2; 	
				  		  	
				  	//error_log("plus large que haute, on centre verticalement à $dst_y \n", 3, "/tmp/image.log"); 
				  	//error_log("nouvelle dimension : $dst_w X $dst_h \n", 3, "/tmp/image.log");
			
				  	}
				  	
				  if ($src_h>$src_w) {
				  	$ratio=$width / $src_h;
				  	$dst_w=$src_w*$ratio;
				  	$dst_h=$width;
				  	
				  	$dst_x=($width-$dst_w)/2;
				  	//error_log("plus haute que large on centre horizontalement à $dst_x \n", 3, "/tmp/image.log");
				  	//error_log("nouvelle dimension : $dst_w X $dst_h \n", 3, "/tmp/image.log");

				  	}

					if ($src_h==$src_w) {
					$ratio = $width / $src_h;	
					$dst_w=$src_w*$ratio;
					$dst_h=$src_h*$ratio;
					 	// error_log("image carree \n", 3, "/tmp/image.log");
					}
					
			
				//image carrée
				$resampledImage = imageCreateTruecolor($width, $width);
				$white = imagecolorallocate($resampledImage, 255, 255, 255);
				imagefilledrectangle($resampledImage, 0, 0, $width, $width, $white);
				
				imageCopyResampled($resampledImage, $originalImage, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, imagesx($originalImage), imagesy($originalImage));
				imagejpeg($resampledImage, './'.$name,100);
			
			
				}else{
					$resampledImage = imageCreateTruecolor($width, $width);
					imagejpeg($resampledImage, $name, 85);
				}
			}
		}
	}


	function showImage(){


		if (req("size") == "thumb"){
			$width = 42;
		}else{
			$width = 145;
		}
		$name = 'cache/'.req('size').req('id').'.jpg';
		if (!file_exists('./'.$name)){
			$original = './productimages/product'.req('id');
			
			error_log("image cache $name existe pas, création  a partir de $original \n", 3, "image.log");
			
			if (file_exists($original)){
				$originalImage = null;
				try{
					$originalImage = imageCreateFromJpeg($original);
					error_log("Jpeg \n", 3, "image.log");
				}catch (Exception $e){
				}
				if ($originalImage == null){
					$originalImage = imageCreateFromGif($original);
					error_log("GIF \n", 3, "image.log");
				}
				if ($originalImage == null){
					$originalImage = imageCreateFromPng($original);
					error_log("PNG \n", 3, "image.log");
				}
						//largeur origine
					$src_w=	imagesx($originalImage);
					//hauteur origine
					$src_h=	imagesy($originalImage);
				
					error_log("largeur origine X: $src_w, hauteur Y: $src_h \n", 3, "image.log");
				
					$dst_y=0;
					$dst_x=0;
					$dst_w=imagesx($resampledImage);
					$dst_h=imagesy($resampledImage);
					
					//on centre verticalement
				  if ($src_w>$src_h) {
				  	$ratio=$width / $src_w;
				  	
			 	
				  
				  	$dst_w=$width;
				  	$dst_h=$src_h*$ratio;
				  	$dst_y=($width-$dst_h)/2; 	
				  		  	
				  	error_log("plus large que haute, on centre verticalement à $dst_y \n", 3, "image.log"); 
				  	error_log("nouvelle dimension : $dst_w X $dst_h \n", 3, "/tmp/image.log");
			
				  	}
				  	
				  if ($src_h>$src_w) {
				  	$ratio=$width / $src_h;
				  	$dst_w=$src_w*$ratio;
				  	$dst_h=$width;
				  	
				  	$dst_x=($width-$dst_w)/2;
				  	error_log("plus haute que large on centre horizontalement à $dst_x \n", 3, "image.log");
				  	error_log("nouvelle dimension : $dst_w X $dst_h \n", 3, "image.log");

				  	}

					if ($src_h==$src_w) {
					$ratio = $width / $src_h;	
					$dst_w=$src_w*$ratio;
					$dst_h=$src_h*$ratio;
					 error_log("image carree \n", 3, "image.log");
					}
					
			
				//image carrée
				$resampledImage = imageCreateTruecolor($width, $width);
				$white = imagecolorallocate($resampledImage, 255, 255, 255);
				imagefilledrectangle($resampledImage, 0, 0, $width, $width, $white);
				
				imageCopyResampled($resampledImage, $originalImage, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, imagesx($originalImage), imagesy($originalImage));
				if (!imagejpeg($resampledImage, './'.$name,100))   	error_log("Erreur création jpeg \n", 3, "image.log");
		
		
			}else{
				$resampledImage = imageCreateTruecolor($width, $width);
				imagejpeg($resampledImage, $name, 85);
			}
		}
	
		$filename = basename($name);
		$file_extension = strtolower(substr(strrchr($filename,"."),1));

		switch( $file_extension ) {
			case "gif": $ctype="image/gif"; break;
			case "png": $ctype="image/png"; break;
			case "jpeg":
			case "jpg": $ctype="image/jpeg"; break;
			default:
		}


		header('Content-type: ' . $ctype);
		readfile($name);

		//header('location: ./'.$name);
		
	}

	protected function showMark($name, $rating, $comment){
		echo '<div class="markchoice">';
		for($i = -1; $i <= 5; $i++){
			if ($i == -1){
				$option = "N/A";
			}else{
				$option = $i;
			}
			if ($i == $rating){
				echo '<input class="rating" name="'.$name.'" type="radio" value="'.$i.'" checked /> '.$option.'&nbsp;&nbsp;';
			}else{
				echo '<input class="rating" name="'.$name.'" type="radio" value="'.$i.'"/> '.$option.'&nbsp;&nbsp;';
			} 
		}
		echo '</div>';
		echo '<textarea class="ratingcomment" name="'.$name.'comment">'.stripslashes($comment).'</textarea>';
	}
	private function handleImage($id){
	
		if (req('fileaction') == "upload"){
			move_uploaded_file($_FILES["image"]["tmp_name"], "./productimages/" . 'product'.$id);
			if (file_exists('./cache/thumb'.$id.'.jpg')){
				unlink('./cache/thumb'.$id.'.jpg');
			}
			if (file_exists('./cache/medium'.$id.'.jpg')){
				unlink('./cache/medium'.$id.'.jpg');
			}
			$params['image'] = $_FILES['image']['name'];
		}			
	}

	private function paramsList(){
		if (req('fileaction') == "upload"){
			$params['image'] = $_FILES['image']['name'];
		}
		

		if (isset($_REQUEST['contact'])){
			$params['contact'] = reqOrDefault('contact', '');
		}
			
		$params['name'] = req('name');
		$params['brand'] = req('brand');
		$params['EAN'] = req('EAN');
		$params['description'] = req('description');
		$params['tags'] = req('tags');
		
		for ($i = 1; $i <= 6; $i++){
		$params["rating$i"."comment"] = reqOrDefault("rating$i"."comment", '');
		}
				
		$params['globalcomment'] = req('globalcomment');		
		$params['price'] = req('price');		
		$params['co2'] = req('co2');	
		$params['facts'] = req('facts');
		$params['findit'] = req('findit');
		//$params['related'] = req('related');
		
		$params['userid'] = reqOrDefault('userid', 0);
		$params['typeid'] = reqOrDefault('typeid', 0);
		if (reqOrDefault('equitable_sud','')=='on') $params['equitable_sud'] = 1; else $params['equitable_sud'] = 0;	
		
	
		if (company()){
			$params['userid'] = $_SESSION['user']['id'];
		}		

		$params['published'] = reqOrDefault('published', "submission");
		if (req('subaction') == 'publish'){
			$params['published'] = 'true';
		}
		if (req('subaction') == 'saved'){
			$params['published'] = 'saved';
		}
		
	 
		return $params;
	}	
	
		function displaySubratings($typeId,$themeId,$lifecycleId,$lang=1){
	
		global $db;
	
		$subratings = $db->getSubratings2($typeId,$themeId,$lifecycleId,0,$lang);

		foreach ($subratings as $key=>$subrating){
			$checked = isset($this->formValues['subratingsdetail'][$subrating['id']]) || isset($this->formValues['subratingslabel'][$subrating['id']]);

			
			$changed = '';			
			if ($this->originalValues === null){
			}else{
					if (isset($this->formValues['subratingsdetail'][$subrating['id']]) || isset($this->originalValues['subratingsdetail'][$subrating['id']])){
					if (isset($this->formValues['subratingsdetail'][$subrating['id']]) && isset($this->originalValues['subratingsdetail'][$subrating['id']]) == false){
					$changed = 'changed';
					}

				}
			}
			
			?>
				<div class="subratingcheck">
			 
			<?php 
			
	
			//on détertime si cet id est coché pour cause de label
				 if (isset($this->formValues['subratingslabel'][$subrating['id']]) && $this->formValues['subratingslabel'][$subrating['id']]!='' ) $caseacocher="subratingslabel[]"; else $caseacocher="subratings[]"; ?>
					
				<input type="checkbox" value="<?=$subrating['id']?>" name="<?php echo $caseacocher;?>" id="rating<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" value=<?=$subrating['id']?> onclick="changeSubrating(<?=$themeId?>,<?=$lifecycleId?>,<?=$key?>)" <?php if (in_array($subrating['id'], $this->formValues['subratings'])){ echo 'checked="checked"';} ?>> 
				<input type="hidden" value="<?=$subrating['name']?>" id="question<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>"/>
				
					<div><strong class="<?=$changed?>"> <?=$subrating['name']?></strong>
									
				<!-- si critere justifié automatiquement par label -->
					<?php if ($caseacocher=="subratingslabel[]" ) { ?>
						<div class="precisions">
							<?php //on liste tous les commentaires de label
						
							foreach ($this->formValues['subratingslabel'][$subrating['id']] as $key2=>$commentlabel) { ?>
							<img src="<?=$GLOBALS['base']?>style/subrating.png" border="0" alt="check <?php echo $commentlabel['comment'];?>"/> <?php  echo $commentlabel['comment'];?><br/>
			
							<?}?>
						<!-- si renseigné par label alors on met une valeur pour passer le check javascript si vide  + valeur vide pour saisie manuelle-->	
						<input type="hidden" id="commentlabel<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" name="subra" value="rien"/>
						<input type="hidden" id="comment<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" name="subra2" value=""/>
					</div>
					
					<?} else { ?>
					<!-- pas rempli par label donc vide --> 
					 	<input type="hidden" id="commentlabel<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" name="subra" value=""/>
				<?php } ?>
				
				<!-- bloc de saisie commentaire marque, ouvert que si cliqué -->
				<div id="precisions<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" <?php if (!$checked) {echo 'style="display: none"';}?> class="precisions">
		
				<?php //si label coché, possibilité de saisir un commentaire en plus
				if ($caseacocher=="subratingslabel[]") { 
				if ($lang==1) echo "Vous pouvez ajouter un commentaire falcultatif";  else 	echo "You can add a free comment "; ?>
		
					<textarea  name="subratinglabel<?=$subrating['id']?>comment"><?php if (isset($this->formValues['subratingsdetail'][$subrating['id']]) ) {echo htmlspecialchars($this->formValues['subratingsdetail'][$subrating['id']]);} ?></textarea>
				<?	} 
									
				else { echo  $subrating['proof_new']; 
						
				 if ($subrating['ask_proof']==0)  {?>
						<textarea id="comment<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" name="subrating<?=$subrating['id']?>comment"><?php if ($checked) {echo htmlspecialchars($this->formValues['subratingsdetail'][$subrating['id']]);} ?></textarea>
				<?php } 
				 if ($subrating['ask_proof']==1 || $subrating['ask_proof']==2)  {?>
					 		<input type="hidden" id="comment<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" name="subra" value="rien"/>
				<?php } }?>
				
										
					</div>
					
					<!-- ADMIN systeme de feedback automatique -->  
					<?php if($_SESSION['user']['type']=='admin' ) { ?>
						<div id="feedback<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" <?php if (!$checked) {echo 'style="display: none"';}?> class="precisions">
							Remarques ECOCOMPARE: <textarea  name="subrating<?=$subrating['id']?>feedback"><?php if ($checked) {echo htmlspecialchars($this->formValues['subratingsfeedback'][$subrating['id']]);} ?></textarea>
						</div>
						<?php } 
					
					//Si FRONT et que remarques alors demander des compléments d'info
					 if($_SESSION['user']['type']!='admin' && isset($this->formValues['subratingsfeedback'][$subrating['id']]) && trim($this->formValues['subratingsfeedback'][$subrating['id']])!='') { ?>
						<div id="feedback<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" <?php if (!$checked) {echo 'style="display: none"';}?> class="precisions">
						<input type="hidden" id="comment<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>" name="subrating<?=$subrating['id']?>feedback" value="<?php echo $this->formValues['subratingsfeedback'][$subrating['id']];?>"/>
						<img src="<?=$GLOBALS['base']?>images/warning.png" alt="remarque importante ecocompare"/> <font color="red"><b>Remarques ECOCOMPARE: </b><br/><?php if ($checked) {echo nl2br(htmlspecialchars($this->formValues['subratingsfeedback'][$subrating['id']]));} ?></font>
					</div>
					<?php } ?>
					
					</div>
					<input type="hidden" id="rating<?=$themeId?>-<?=$lifecycleId?>-<?=$key?>-points" value="<?=$subrating['points']?>"/>
					 <a href="#" class="tooltip"><img src="<?=$GLOBALS['base']?>images/help.png" alt="Aide <?=$subrating['name']?>" /><span><?=nl2br($subrating['question']."<br/><hr/>".$subrating['example']);?></span></a>
					<span>+<?=$subrating['points']?>pts</span>
					</div>
			<?php
		}
		
		//echo '<div id="rating'.$ratingId.'">nan</div>';
	}
	
	function displayRatingDetailCompact($product, $ratingId){

	
		global $db;
		$subratings = $db->getSubratings($ratingId);
		
		if (count($subratings) == 0){
			return;
		}
		
		ob_start();
		
		$total = 0;
		foreach ($subratings as $key=>$subrating){
			if (in_array($subrating['id'], $product['subratings'])){
				$total++;
				?>
					<div class="shortsubrating">
						<?=$subrating['shortname']?>
					</div>
				<?php
			}
		}


    	$content = ob_get_contents();
		ob_end_clean();		

		if ($total != 0){

			return $content;		
		}
		

	}	
	
	//Affiche les sousnotes de la partie FRONT environnement
function getRatingProductDetail($productId, $themeId,$lifecycleId,$lang=1){

	
		global $db;
	
		$subratings = $db->getRatingProductDetail($productId,$themeId,$lifecycleId,$lang);
		
		if (count($subratings) == 0) return; 
		
	ob_start();
	
		
		echo '<div class="subratings" id="subratings'.$lifecycleId.'">';
	
		$total = 0;
		foreach ($subratings as $key=>$subrating){
		
				$total++; ?>
			
				<div class="subratingdetail" style="width:572px;" >
				<!-- <span>+<?php echo ($subrating['points']-floor($subrating['points'])==0)?round($subrating['points']):$subrating['points'];?>pts</span> -->
					<div class="tooltip2" style="width:570px;">
						<strong>
							<?//=$subrating['id']?> 
							 <?=$subrating['name']?></strong>
						<br/> 
						<?php 
						
						if ($subrating['islabel']==1) { 
												
							foreach ($subrating['subratingslabel'] as $key2=>$commentlabel) { ?>
								<img src="<?=$GLOBALS['base']?>style/subrating.png" border="0" alt="check <?php echo $commentlabel['comment'];?>"/> <?php  echo $commentlabel['comment'];?><br/>	
							<?php }

							echo checkLink($subrating['comment'],$subrating['id']);
							
						} else { 
						switch($subrating['ask_proof']) {
						case "0": echo checkLink($subrating['comment'],$subrating['id']);
						break;
						case "1": echo $this->getproof(1,$lang);
						break;
						case "2": echo $this->getproof(2,$lang);
						break;
											 
						}
					}
						 ?>
				</div>
				</div>
				<?php
			
		}

		echo '</div>';

    $content = ob_get_contents();
		ob_end_clean();		
		if ($total != 0) echo $content;	
		
		

	}

function displayLifeCycleCompact($productId,$lang=1){

		global $db;
		$lifecycles = $db->getLifecycles($productId,$lang);

		if (count($lifecycles) == 0){
				return;
		}
		
		ob_start();
			
		echo '<div class="subratings" id="subratings'.$productId.'">';
	
		$total = 0;
		
		
		foreach ($lifecycles as $key=>$lifecycle){ ?>
	
	<script type="text/javascript">
				
				$(document).ready(function(){ 

			$("#lien<?=$lifecycle['lifecycle_id']?>").click(function () {
      $("#cat<?=$lifecycle['lifecycle_id']?>").slideToggle("slow");
   		 });
  		});
      </script>
      
  
				<div class="subratingdetailopen" >
			<!--		<span>+<?php echo ($lifecycle['score']-floor($lifecycle['score'])==0)?round($lifecycle['score']):$lifecycle['score'];?>pts</span> -->
					<div class="tooltip2" style="width:420px;">
						<a class="cursor" name="<?=$lifecycle['lifecycle_id']?>"  id='lien<?=$lifecycle['lifecycle_id']?>'><img border="0" src="style/expand.png"/><strong> <?=$lifecycle['name']?></strong></a>
					</div>
				
					<div  style="display:none;" id="cat<?=$lifecycle['lifecycle_id']?>" class="opendetail">

						<?php $this->getRatingProductDetail($this->product['id'],1,$lifecycle['lifecycle_id'],$lang); ?>		
				 </div>
				 
				</div>
				<?
			
		}

		echo '</div>';
 

    	$content = ob_get_contents();
		ob_end_clean();		
	

			echo $content;		
	
		

	}
	
	//appele depuis affichage produit
	function displayThemeScore($productId,$themeList,$lang=1){

		global $db;
		$subratings = $db->getThemeScore($productId,$themeList,$lang);


		if (count($subratings) == 0){
				return;
		}	
		
		ob_start();
			
		echo '<div class="subratings" id="subratings'.$productId.'">';
	
		$total = 0;
		foreach ($subratings as $key=>$subrating){ ?>
	<script type="text/javascript">
				
				$(document).ready(function(){ 

			$("#lien2<?=$subrating['id']?>").click(function () {
      $("#cat2<?=$subrating['id']?>").slideToggle("slow");
   		 });
  		});
      </script>

				<div class="subratingdetailopen">
					<div class="tooltip2" style="width:460px;">
					<a class="cursor" name="<?=$subrating['id']?>"  id='lien2<?=$subrating['id']?>'><img border="0" src="style/expand.png"/><strong> <?=$subrating['name']?></strong></a>
					</div>
						<div  style="display:none;" id="cat2<?=$subrating['id']?>" class="opendetail">
						<?php $this->getRatingProductDetail($this->product['id'],$subrating['theme_id'], 0,$lang); ?>		
				 </div>
				 
				</div>
				<?php
			
		}

		echo '</div>';


    	$content = ob_get_contents();
		ob_end_clean();		
	

			echo $content;		
	
		

	}	
	//affiche les notes pour autre que environnement
	function displayRatingDetail($productId,$themeId,$lifecycleId=0,$lang=1){
	
		global $db;
		$subratings = $db->getRatingProductDetail($productId,$themeId,$lifecycleId,$lang);
		

		if (count($subratings) == 0){
			return;
		}
		
		ob_start();
		
		
		echo '<div class="subratings" id="subratings'.$themeId.'">';

		$total = 0;
		foreach ($subratings as $key=>$subrating){
			if (in_array($subrating['id'], $this->product['subratings'])){
				$total++;
				?>
				<div class="subratingdetail">
	
					<div class="tooltip2" style="width:478px;">
						<strong><?=$subrating['name']?></strong>
						<br/>
					<?php if ($subrating['islabel']==1)  { 
												
							foreach ($subrating['subratingslabel'] as $key2=>$commentlabel) { ?>
								<img src="<?=$GLOBALS['base']?>style/subrating.png" border="0" alt="check <?php echo $commentlabel['comment'];?>"/> <?php  echo $commentlabel['comment'];?><br/>	
							<?php }
							echo checkLink($subrating['comment'],$subrating['id']);
							
							
						}  else {
						//si critère pas 
						switch($subrating['ask_proof'] ) {
						case "0": echo checkLink($subrating['comment'],$subrating['id']);
						break;
						case "1": echo $this->getproof(1,$lang);
						break;
						case "2": echo $this->getproof(2,$lang);
						break;
											 
						}
					}
					
						 ?>
				</div>
				</div>
				<?php
			}
		}

		echo '</div>';


    	$content = ob_get_contents();
		ob_end_clean();		
		if ($total != 0){

			echo $content;		
		}
	}
	function hasChanged($index){
	
		if ($this->originalValues === null) {return '';}
		
		//echo $this->originalValues[$index].' / '.$this->formValues[$index].'<br/>';
		
		if ($this->originalValues[$index] != $this->formValues[$index] )    {return 'changed';}
		
		if (is_array($this->originalValues[$index]) &&	count(array_diff($this->originalValues[$index], $this->formValues[$index])) != 0){return 'changed';}
		
		return '';

}
	
	function sendNotification($productName){
		$to      = 'support@ecocompare.com';
		$subject = 'Nouvelle fiche produit à valider sur Ecocompare : '.$productName;
		$headers = 'From: Notification Ecocompare <noreply@ecocompare.com>'."\n";
 		$headers.= "Content-Type: text/plain; charset=UTF-8;";
   	$message = "Connectez vous sur ".$GLOBALS['base']."login pour valider cette fiche.";

		mail($to, $subject, $message, $headers);
	}



function sendCustomerNotification($productName,$productId,$email){
	global $db;

		$to=$email;
		//$to      = 'patrick@montier.com';
		$subject = 'Nouvelle fiche produit publiée : '.$productName;
		$headers = 'From: Notification Ecocompare <noreply@ecocompare.com>'."\n";
 		$headers.= "Content-Type: text/plain; charset=UTF-8;";
		$message = "Bonjour, \n\nNous vous confirmons que votre fiche produit $productName vient d’être validée par le comité de vérification et publiée sur les plateformes web et mobile ecocompare.";
		$message .= "Vous pouvez dès maintenant visualiser la fiche sur la page suivante : \n".$GLOBALS['base'].toURL($productName)."_p$productId.html";
		$message .= "\n\nVous disposez dorénavant d’un délai de 2 mois afin de nous faire parvenir l’ensemble des preuves et justifications demandées (si applicable) sans quoi votre fiche se retrouvera dépubliée et sauvegardée au sein de votre espace client.\n\n";
		$message .= "Merci pour votre participation.\n\nL'équipe Support Ecocompare.\n\n http://www.ecocompare.com\n+33 4 75 70 18 11";
		
		mail($to, $subject, $message, $headers);
		
		$db->saveHistory($_SESSION['user']['id'],$productId,"email published sent to $to for $productName");
		
	}	
}