<?php
require_once('Controller.php');

class TypepdtCtrl extends Controller{
	
	function admin(){
		global $db;
		$this->listTypes = $db->getTypes();
	
		$this->currentTab = "admin";	
		$this->render('typepdtadmin.php');
	}

	function add(){
		requireAdmin();
		$this->targetAction = "create";
		
		$this->currentTab = "admin";	
		$this->render('subratingedit.php');
	}

	function create(){
		requireAdmin();
		global $db;
		$db->createSubrating($this->paramsList());		
		header('Location: subratings?action=admin');
	}
	
	function edit(){
		requireAdmin();
		global $db;
		$this->typeDetails = $db->getTypeDetail(req('id'));
		$this->type=$db->getType(req('id'));

		$this->targetAction = "update";	
		
		$this->currentTab = "admin";	
		$this->render('typepdtedit.php');
	}
	
		function excel(){
		requireAdmin();
		global $db;
		$lang=req('lang');
		$this->typeDetails = $db->getTypeDetail(req('id'));
		$this->type=$db->getType(req('id'));
		$categorie=trim($this->type['name']);
		$repertoire="/var/www/vhosts/projets2.idnext.net/httpdocs/ecocompare2";
		
		
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
			include ('Classes/PHPExcel/Exception.php');

		
		include ('Classes/PHPExcel/Writer/Excel2007.php');
		include ('Classes/PHPExcel/CachedObjectStorage/CacheBase.php');
		include ('Classes/PHPExcel/CachedObjectStorage/ICache.php');
		include ('Classes/PHPExcel/CachedObjectStorage/Memory.php');
		include ('Classes/PHPExcel/Calculation.php');
		include ('Classes/PHPExcel/Calculation/Functions.php');
		include ('Classes/PHPExcel/Calculation/Function.php');
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
		include ('Classes/PHPExcel/HashTable.php');
		include ('Classes/PHPExcel/Settings.php');
		include ('Classes/PHPExcel/Shared/XMLWriter.php');
		include ('Classes/PHPExcel/Shared/Date.php');
		include ('Classes/PHPExcel/Shared/File.php');
		include ('Classes/PHPExcel/Shared/Drawing.php');
		include ('Classes/PHPExcel/Shared/PasswordHasher.php');
		
					
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Ecocompare")
							 ->setLastModifiedBy("Ecocompare")
							 ->setTitle("Notation d'un produit de catégorie ".$categorie)
							 ->setSubject("Notation de produit")
							 ->setDescription("Permet de noter un produit selon 5 thèmes")
							 ->setKeywords("office PHPExcel php");
					




//Textes selon langue

if ($lang==1) {
	$txt_type=$this->type['name'];
	$txt_home= "Accueil";
	$txt_env=		"Environnement";
	$txt_social=		"Social";
	$txt_health=		"Santé";
	$txt_ethic=		"Ethique";
	$txt_quality=		"Qualité";
	$txt_fairtradeNN=		"Commerce équitable Nord-Nord";
	$txt_fairtradeNS=		"Commerce équitable Nord-Sud";
	$txt_group=	"Groupe / Critère";
	$txt_question="Question";
	$txt_proofexist="Preuve si produit déjà référencé";
	$txt_proofnew="Preuve si premier référencement";
	$txt_response="Votre réponse";
	$txt_example="Exemple";
	$txt_welcome="Bienvenue sur la méthodologie d'évaluation de produits élaborée par Bossa Verde pour le site Ecocompare.com";
	$txt_intro1="Ecocompare.com, site de référencement en ligne de produits vertueux, et Bossa Verde, cabinet de conseil en éco-socio-conception, se sont associés pour développer une méthodologie";
	$txt_intro2="d'évaluation qualitative des produits de grande consommation. Cette méthodologie :";
	$txt_methodo1="- Maximise la couverture des enjeux environnementaux du couple produit/emballage et les insèrent dans une approche cycle de vie";
	$txt_methodo2="- Inclut des critères sanitaires, sociaux, équitables, d’éthique et de qualité";
	$txt_methodo3="- Réalise une correspondance directe entre les labels privés et publics et les critères de cette méthodologie afin d’accélérer le référencement de produit";
	$txt_methodo4="La méthodologie a été développée sous la direction d'Olivier BABOULET, Directeur Technique de Bossa Verde et Directeur Technique d'Ecocompare. ";
	$txt_contact1="Contact:";
	$txt_contact2="Pour toutes questions relatives au référencement de produits, veuilllez nous écrire à l'adresse suivante support@ecocompare.com  ou nous téléphoner au 04.75.70.18.13";
	$txt_contact3="Pour toutes questions relatives à la méthodologie, veuilllez nous écrire à l'adresse suivante olivier.baboulet@bossaverde.com  ou nous téléphoner au 01.77.14 .10.68";
	$txt_contact4="Pour toutes questions générales relatives au site ecocompare.com, veuillez nous écrire à l’adresse suivante contact@ecocompare.com ";
	$txt_warning1="Avertissement :";
	$txt_warning2="Ce référentiel est protégé par les dispositions du Code de la propriété intellectuelle, notamment par celles de ses dispositions relatives à la propriété littéraire et artistique et aux droits";
	$txt_warning3="d'auteur. Ces droits sont la propriété exclusive de Bossa Verde. Toute reproduction intégrale ou partielle, par quelque moyen que ce soit, non autorisée par Bossa Verde ou ses ayants";
	$txt_warning4="droit, est strictement interdite.";
	$txt_copyright="© 2013 Bossa Verde. Strictement confidentiel. Reproduction interdite sans accord écrit préalable. Version ".$GLOBALS['method_version'];

	}
else
{
	$txt_type=$this->type['name_en'];
	$txt_home= "Home";
	$txt_env=		"Environment";
	$txt_social=		"Social";
	$txt_health=		"Health";
	$txt_ethic=		"Ethics";
	$txt_quality=		"Quality";
	$txt_fairtradeNN=		"Fairtrade North-North";
	$txt_fairtradeNS=		"Fairtrade North-South";
	$txt_group=	"Group / Criteria";
	$txt_question="Question";
	$txt_proofexist="Proof if product exist";
	$txt_proofnew="Prof if new product";
	$txt_response="Your Answer";
	$txt_example="Example";
	$txt_welcome="Welcome to the product assessment methodology developed by Bossa Verde for the website Ecocompare.com";
	$txt_intro1="Ecocompare.com, online referencing platform of virtuous products, and Bossa Verde, a socio-eco-design consultancy, have teamed up to develop a qualitative methodology for evaluating";
	$txt_intro2=" consumer products. This methodology:";
	$txt_methodo1="Maximizes the coverage of environmental issues for the pair product / packaging and inserts them along a life-cycle approac";
	$txt_methodo2="Includes health, social, fair, ethical and quality criteria";
	$txt_methodo3="Enables a direct correspondence between public and private labels and the criteria of this methodology to accelerate product referencing";
	$txt_methodo4="The methodology was developed under the direction of Olivier BABOULET, Bossa Verde and Ecocompare CTO";
	$txt_contact1="Contact:";
	$txt_contact2="For questions regarding the referencing of products, please contact us at the following address: support@ecocompare.com or call us at +33 (4) 75 70 18 13";
	$txt_contact3="For questions regarding the methodology, please contact us at the following address: olivier.baboulet@bossaverde.com  or call us at +33 (1) 77 14 10 68";
	$txt_contact4="For questions regarding the ecocompare.com website, please contact us at the following address: contact@ecocompare.com";
	$txt_warning1="Warning:";
	$txt_warning2="This framework is protected by the provisions of the Code of Intellectual Property, including provisions relating to the literary and artistic property and copyright. These rights are the";
	$txt_warning3="means whatsoever, and not permitted by Bossa Verde or assigns, is strictly prohibited.";
	$txt_warning4="";
	$txt_copyright="© 2013 Bossa Verde. Strictly confidential. Reproduction prohibited without prior written  permission. Release ".$GLOBALS['method_version'];

}


// ############################### HOME ###########################
$sheet0 = $objPHPExcel->getActiveSheet();
$sheet0->setTitle($txt_home);

$sheet0->setCellValue('A10',$txt_welcome);
$styleA1 = $sheet0->getStyle('A10');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setUnderline(true);
$styleFont->setSize(18);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A12',$txt_intro1);
$styleA1 = $sheet0->getStyle('A12');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A13',$txt_intro2);
$styleA1 = $sheet0->getStyle('A13');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('B15',$txt_methodo1);
$styleA1 = $sheet0->getStyle('B15');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('B16',$txt_methodo2);
$styleA1 = $sheet0->getStyle('B16');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('B17',$txt_methodo3);
$styleA1 = $sheet0->getStyle('B17');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A19',$txt_methodo4);
$styleA1 = $sheet0->getStyle('A19');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A21',$txt_contact1);
$styleA1 = $sheet0->getStyle('A21');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setUnderline(true);
$styleFont->setSize(18);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A22',$txt_contact2);
$styleA1 = $sheet0->getStyle('A22');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A23',$txt_contact3);
$styleA1 = $sheet0->getStyle('A23');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A24',$txt_contact4);
$styleA1 = $sheet0->getStyle('A24');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A26',$txt_warning1);
$styleA1 = $sheet0->getStyle('A26');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setUnderline(true);
$styleFont->setSize(18);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A27',$txt_warning2);
$styleA1 = $sheet0->getStyle('A27');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A28',$txt_warning3);
$styleA1 = $sheet0->getStyle('A28');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

$sheet0->setCellValue('A29',$txt_warning4);
$styleA1 = $sheet0->getStyle('A29');
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');

// HEADER
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Header');
$objDrawing->setDescription('Header');
$objDrawing->setPath($repertoire.'/images/header_excel.png');
$objDrawing->setHeight(174);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// Footer
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('Header');
$objDrawing->setDescription('Header');
$objDrawing->setPath($repertoire.'/images/footer_excel.png');
$objDrawing->setHeight(84);
$objDrawing->setCoordinates('A30');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

//Copyright
$sheet0->mergeCells('C34:P34');
$sheet0->setCellValue('C34',$txt_copyright);
$styleA1 = $sheet0->getStyle('C34');
$styleA1->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$styleFont = $styleA1->getFont();
$styleFont->setSize(11);
$styleFont->setName('Calibri');


//On vérouille
$objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
$objPHPExcel->getActiveSheet()->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);

// ############################### ENVIRONNEMENT ###########################
$sheet1 = $objPHPExcel->createSheet();
//On vérouille
$sheet1->getProtection()->setSheet(true);
$sheet1->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);


$sheet1->setTitle($txt_env);
$sheet1->setCellValue('A1',$txt_type.' - '.$txt_env);
$sheet1->setCellValue('A3','Id');
$sheet1->setCellValue('B3',$txt_group);
$sheet1->setCellValue('C3',$txt_question);
$sheet1->setCellValue('D3',$txt_proofexist);
$sheet1->setCellValue('E3',$txt_proofnew);
$sheet1->setCellValue('F3',$txt_example);
$sheet1->setCellValue('G3',$txt_response);

$styleA1 = $sheet1->getStyle('A1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$styleA1 = $sheet1->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet1->getStyle('B3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet1->getStyle('C3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet1->getStyle('D3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet1->getStyle('E3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet1->getStyle('F3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet1->getStyle('G3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet1->getStyle('H3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');


//$sheet1->getColumnDimension('A')->setWidth(20);
$sheet1->getColumnDimension('A')->setWidth(10);
$sheet1->getColumnDimension('B')->setWidth(50);
$sheet1->getColumnDimension('C')->setWidth(50);
$sheet1->getColumnDimension('D')->setWidth(80);
$sheet1->getColumnDimension('E')->setWidth(80);
$sheet1->getColumnDimension('F')->setWidth(80);
$sheet1->getColumnDimension('H')->setWidth(100);
$sheet1->getColumnDimension('G')->setWidth(80);
$lifecycles=$db->getLifecycles(0,$lang);
$i=3;

foreach ($lifecycles as $lifecycle) {
		$i++;	
	//$sheet1->setCellValue("A$i",$lifecycle['id'].':'.$lifecycle['name']);
	$sheet1->setCellValue("A$i",$lifecycle['id']);
	$sheet1->setCellValue("B$i",$lifecycle['name']);
	
	$styleA1 = $sheet1->getStyle("A$i");
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$styleFont->setSize(10);
	$styleFont->setName('Arial');
		$styleA1 = $sheet1->getStyle("B$i");
	$styleFont = $styleA1->getFont();
	$styleFont->setBold(true);
	$styleFont->setSize(10);
	$styleFont->setName('Arial');
	
	$headings=$db->getHeadings(1,req('id'),$lifecycle['id'],$lang);
	foreach ($headings as $heading) {
	$i++;
		//$sheet1->setCellValue("B$i",$heading['id'].':'.$heading['name']);
		$sheet1->setCellValue("A$i",$heading['id']);
		$sheet1->setCellValue("B$i",$heading['name']);
		$styleA1 = $sheet1->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');

		$styleA1 = $sheet1->getStyle("B$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');


		
		//$type_id,$themeId,$lifecycleId=0,$headingId=
		$criterias=$db->getSubratings2(req('id'),1,$lifecycle['id'],$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet1->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet1->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
		//	echo $criteria['name'].'<br/>';
				$sheet1->setCellValue("A$i",$criteria['id']);
					$sheet1->setCellValue("B$i",$criteria['name']);
				//$sheet1->setCellValue("C$i",$criteria['id'].':'.$criteria['name']);
				$sheet1->setCellValue("C$i",$criteria['question']);
			

				$sheet1->setCellValue("D$i",$criteria['proof_exist']);
				$sheet1->setCellValue("E$i",$criteria['proof_new']);
				$sheet1->setCellValue("F$i",$criteria['example']);
				
				//on dévérouille pour la saisie
				$sheet1->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);

				
		}
	}
}


// ############################### SANTE ###########################

$sheet2 = $objPHPExcel->createSheet();
//On vérouille
$sheet2->getProtection()->setSheet(true);
$sheet2->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);

$sheet2->setTitle($txt_health);
$sheet2->setCellValue('A1',$txt_type.' - '.$txt_health);
$sheet2->setCellValue('A3','Id');
$sheet2->setCellValue('B3',$txt_group);
$sheet2->setCellValue('C3',$txt_question);
$sheet2->setCellValue('D3',$txt_proofexist);
$sheet2->setCellValue('E3',$txt_proofnew);
$sheet2->setCellValue('F3',$txt_example);
$sheet2->setCellValue('G3',$txt_response);

$styleA1 = $sheet2->getStyle('A1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$styleA1 = $sheet2->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet2->getStyle('B3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet2->getStyle('C3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet2->getStyle('D3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet2->getStyle('E3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet2->getStyle('F3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet2->getStyle('G3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

//$sheet2->getColumnDimension('A')->setWidth(20);
$sheet2->getColumnDimension('A')->setWidth(10);
$sheet2->getColumnDimension('B')->setWidth(50);
$sheet2->getColumnDimension('C')->setWidth(50);
$sheet2->getColumnDimension('D')->setWidth(80);
$sheet2->getColumnDimension('E')->setWidth(80);
$sheet2->getColumnDimension('F')->setWidth(100);
$sheet2->getColumnDimension('G')->setWidth(80);


$i=3;

//theme, type, lifecycle
	$headings=$db->getHeadings(2,req('id'),0,$lang);
	foreach ($headings as $heading) {
	$i++;
//		$sheet2->setCellValue("A$i",$heading['id'].':'.$heading['name']);
		$sheet2->setCellValue("A$i",$heading['id']);
		$sheet2->setCellValue("B$i",$heading['name']);
		$styleA1 = $sheet2->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');
		$styleA1 = $sheet2->getStyle("B$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');

		
		//$type_id,$themeId,$lifecycleId=0,$headingId=
		$criterias=$db->getSubratings2(req('id'),2,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet2->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet2->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet2->setCellValue("A$i",$criteria['id']);
				$sheet2->setCellValue("B$i",$criteria['name']);
				$sheet2->setCellValue("C$i",$criteria['question']);
				$sheet2->setCellValue("D$i",$criteria['proof_exist']);
				$sheet2->setCellValue("E$i",$criteria['proof_new']);
				$sheet2->setCellValue("F$i",$criteria['example']);
				//on dévérouille pour la saisie
				$sheet2->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
				
				
		}
	}

// ############################### QUALITE ###########################

$sheet3 = $objPHPExcel->createSheet();
//On vérouille
$sheet3->getProtection()->setSheet(true);
$sheet3->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);

$sheet3->setTitle($txt_quality);
$sheet3->setCellValue('A1',$txt_type.' - '.$txt_quality);
$sheet3->setCellValue('A3','Id');
$sheet3->setCellValue('B3',$txt_group);
$sheet3->setCellValue('C3',$txt_question);
$sheet3->setCellValue('D3',$txt_proofexist);
$sheet3->setCellValue('E3',$txt_proofnew);
$sheet3->setCellValue('F3',$txt_example);
$sheet3->setCellValue('G3',$txt_response);

$styleA1 = $sheet3->getStyle('A1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$styleA1 = $sheet3->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet3->getStyle('B3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet3->getStyle('C3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet3->getStyle('D3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet3->getStyle('E3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet3->getStyle('F3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet3->getStyle('G3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

//$sheet2->getColumnDimension('A')->setWidth(20);
$sheet3->getColumnDimension('A')->setWidth(10);
$sheet3->getColumnDimension('B')->setWidth(50);
$sheet3->getColumnDimension('C')->setWidth(50);
$sheet3->getColumnDimension('D')->setWidth(80);
$sheet3->getColumnDimension('E')->setWidth(80);
$sheet3->getColumnDimension('F')->setWidth(100);
$sheet3->getColumnDimension('G')->setWidth(80);


$i=3;

//theme, type, lifecycle
	$headings=$db->getHeadings(3,req('id'),0,$lang);
	foreach ($headings as $heading) {
	$i++;
//		$sheet2->setCellValue("A$i",$heading['id'].':'.$heading['name']);
		$sheet3->setCellValue("A$i",$heading['id']);
		$sheet3->setCellValue("B$i",$heading['name']);
		$styleA1 = $sheet3->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');
		$styleA1 = $sheet3->getStyle("B$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');

		
		//$type_id,$themeId,$lifecycleId=0,$headingId=
		$criterias=$db->getSubratings2(req('id'),3,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet3->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet3->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet3->setCellValue("A$i",$criteria['id']);
				$sheet3->setCellValue("B$i",$criteria['name']);
				$sheet3->setCellValue("C$i",$criteria['question']);
				$sheet3->setCellValue("D$i",$criteria['proof_exist']);
				$sheet3->setCellValue("E$i",$criteria['proof_new']);
				$sheet3->setCellValue("F$i",$criteria['example']);
				//on dévérouille pour la saisie
				$sheet3->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
				
		}
	}

// ############################### SOCIAL ###########################

$sheet4 = $objPHPExcel->createSheet();
//On vérouille
$sheet4->getProtection()->setSheet(true);
$sheet4->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);

$sheet4->setTitle($txt_social);
$sheet4->setCellValue('A1',$txt_type.' - '.$txt_social);
$sheet4->setCellValue('A3','Id');
$sheet4->setCellValue('B3',$txt_group);
$sheet4->setCellValue('C3',$txt_question);
$sheet4->setCellValue('D3',$txt_proofexist);
$sheet4->setCellValue('E3',$txt_proofnew);
$sheet4->setCellValue('F3',$txt_example);
$sheet4->setCellValue('G3',$txt_response);

$styleA1 = $sheet4->getStyle('A1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$styleA1 = $sheet4->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet4->getStyle('B3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet4->getStyle('C3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet4->getStyle('D3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet4->getStyle('E3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet4->getStyle('F3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet4->getStyle('G3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

//$sheet4->getColumnDimension('A')->setWidth(20);
$sheet4->getColumnDimension('A')->setWidth(10);
$sheet4->getColumnDimension('B')->setWidth(50);
$sheet4->getColumnDimension('C')->setWidth(50);
$sheet4->getColumnDimension('D')->setWidth(80);
$sheet4->getColumnDimension('E')->setWidth(80);
$sheet4->getColumnDimension('F')->setWidth(100);
$sheet4->getColumnDimension('G')->setWidth(80);


$i=3;

//theme, type, lifecycle
	$headings=$db->getHeadings(4,req('id'),0,$lang);
	foreach ($headings as $heading) {
	$i++;
//		$sheet4->setCellValue("A$i",$heading['id'].':'.$heading['name']);
		$sheet4->setCellValue("A$i",$heading['id']);
		$sheet4->setCellValue("B$i",$heading['name']);
		$styleA1 = $sheet4->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');
		$styleA1 = $sheet4->getStyle("B$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');

		
		//$type_id,$themeId,$lifecycleId=0,$headingId=
		$criterias=$db->getSubratings2(req('id'),4,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet4->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet4->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet4->setCellValue("A$i",$criteria['id']);
				$sheet4->setCellValue("B$i",$criteria['name']);
				$sheet4->setCellValue("C$i",$criteria['question']);
				$sheet4->setCellValue("D$i",$criteria['proof_exist']);
				$sheet4->setCellValue("E$i",$criteria['proof_new']);
				$sheet4->setCellValue("F$i",$criteria['example']);
				//on dévérouille pour la saisie
				$sheet4->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		}
	}

// ############################### ETHIQUE ###########################

$sheet5 = $objPHPExcel->createSheet();
//On vérouille
$sheet5->getProtection()->setSheet(true);
$sheet5->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);

$sheet5->setTitle($txt_ethic);
$sheet5->setCellValue('A1',$txt_type.' - '.$txt_ethic);
$sheet5->setCellValue('A3','Id');
$sheet5->setCellValue('B3',$txt_group);
$sheet5->setCellValue('C3',$txt_question);
$sheet5->setCellValue('D3',$txt_proofexist);
$sheet5->setCellValue('E3',$txt_proofnew);
$sheet5->setCellValue('F3',$txt_example);
$sheet5->setCellValue('G3',$txt_response);

$styleA1 = $sheet5->getStyle('A1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$styleA1 = $sheet5->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet5->getStyle('B3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet5->getStyle('C3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet5->getStyle('D3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet5->getStyle('E3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet5->getStyle('F3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet5->getStyle('G3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

//$sheet5->getColumnDimension('A')->setWidth(20);
$sheet5->getColumnDimension('A')->setWidth(10);
$sheet5->getColumnDimension('B')->setWidth(50);
$sheet5->getColumnDimension('C')->setWidth(50);
$sheet5->getColumnDimension('D')->setWidth(80);
$sheet5->getColumnDimension('E')->setWidth(80);
$sheet5->getColumnDimension('F')->setWidth(100);
$sheet5->getColumnDimension('G')->setWidth(80);


$i=3;

//theme, type, lifecycle
	$headings=$db->getHeadings(5,req('id'),0,$lang);
	foreach ($headings as $heading) {
	$i++;
//		$sheet5->setCellValue("A$i",$heading['id'].':'.$heading['name']);
		$sheet5->setCellValue("A$i",$heading['id']);
		$sheet5->setCellValue("B$i",$heading['name']);
		$styleA1 = $sheet5->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');
		$styleA1 = $sheet5->getStyle("B$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');

		
		//$type_id,$themeId,$lifecycleId=0,$headingId=
		$criterias=$db->getSubratings2(req('id'),5,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet5->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet5->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet5->setCellValue("A$i",$criteria['id']);
				$sheet5->setCellValue("B$i",$criteria['name']);
				$sheet5->setCellValue("C$i",$criteria['question']);
				$sheet5->setCellValue("D$i",$criteria['proof_exist']);
				$sheet5->setCellValue("E$i",$criteria['proof_new']);
				$sheet5->setCellValue("F$i",$criteria['example']);
				//on dévérouille pour la saisie
				$sheet5->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		}
	}

// ############################### EQUITABLE NORD/NORD ###########################

$sheet6 = $objPHPExcel->createSheet();
//On vérouille
$sheet6->getProtection()->setSheet(true);
$sheet6->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);

$sheet6->setTitle($txt_fairtradeNN);
$sheet6->setCellValue('A1',$txt_type.' - '.$txt_fairtradeNN);
$sheet6->setCellValue('A3','Id');
$sheet6->setCellValue('B3',$txt_group);
$sheet6->setCellValue('C3',$txt_question);
$sheet6->setCellValue('D3',$txt_proofexist);
$sheet6->setCellValue('E3',$txt_proofnew);
$sheet6->setCellValue('F3',$txt_example);
$sheet6->setCellValue('G3',$txt_response);

$styleA1 = $sheet6->getStyle('A1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$styleA1 = $sheet6->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet6->getStyle('B3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet6->getStyle('C3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet6->getStyle('D3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet6->getStyle('E3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet6->getStyle('F3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet6->getStyle('G3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

//$sheet6->getColumnDimension('A')->setWidth(20);
$sheet6->getColumnDimension('A')->setWidth(10);
$sheet6->getColumnDimension('B')->setWidth(50);
$sheet6->getColumnDimension('C')->setWidth(50);
$sheet6->getColumnDimension('D')->setWidth(80);
$sheet6->getColumnDimension('E')->setWidth(80);
$sheet6->getColumnDimension('F')->setWidth(100);
$sheet6->getColumnDimension('G')->setWidth(80);


$i=3;

//theme, type, lifecycle

	$headings=$db->getHeadings(7,req('id'),0,$lang);
		
	foreach ($headings as $heading) {
	$i++;
	// echo ">>".$heading['name'];
//		$sheet6->setCellValue("A$i",$heading['id'].':'.$heading['name']);
		$sheet6->setCellValue("A$i",$heading['id']);
		$sheet6->setCellValue("B$i",$heading['name']);
		$styleA1 = $sheet6->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');
		$styleA1 = $sheet6->getStyle("B$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');

		
		//$type_id,$themeId,$lifecycleId=0,$headingId=
		$criterias=$db->getSubratings2(req('id'),7,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			// echo $criteria['name'];
			$sheet6->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet6->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet6->setCellValue("A$i",$criteria['id']);
				$sheet6->setCellValue("B$i",$criteria['name']);
				$sheet6->setCellValue("C$i",$criteria['question']);
				$sheet6->setCellValue("D$i",$criteria['proof_exist']);
				$sheet6->setCellValue("E$i",$criteria['proof_new']);
				$sheet6->setCellValue("F$i",$criteria['example']);
				//on dévérouille pour la saisie
				$sheet6->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		}
	}
// ############################### EQUITABLE NORD/SUD ###########################

$sheet7 = $objPHPExcel->createSheet();
//On vérouille
$sheet7->getProtection()->setSheet(true);
$sheet7->getProtection()->setPassword($GLOBALS['phpexcel_pwd']);

$sheet7->setTitle($txt_fairtradeNS);
$sheet7->setCellValue('A1',$txt_type.' - '.$txt_fairtradeNS);
$sheet7->setCellValue('A3','Id');
$sheet7->setCellValue('B3',$txt_group);
$sheet7->setCellValue('C3',$txt_question);
$sheet7->setCellValue('D3',$txt_proofexist);
$sheet7->setCellValue('E3',$txt_proofnew);
$sheet7->setCellValue('G3',$txt_example);
$sheet7->setCellValue('G3',$txt_response);

$styleA1 = $sheet7->getStyle('A1');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(12);
$styleFont->setName('Arial');

$styleA1 = $sheet7->getStyle('A3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet7->getStyle('B3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet7->getStyle('C3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet7->getStyle('D3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');
$styleA1 = $sheet7->getStyle('E3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet7->getStyle('F3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

$styleA1 = $sheet7->getStyle('G3');
$styleFont = $styleA1->getFont();
$styleFont->setBold(true);
$styleFont->setSize(10);
$styleFont->setName('Arial');

//$sheet7->getColumnDimension('A')->setWidth(20);
$sheet7->getColumnDimension('A')->setWidth(10);
$sheet7->getColumnDimension('B')->setWidth(50);
$sheet7->getColumnDimension('C')->setWidth(50);
$sheet7->getColumnDimension('D')->setWidth(80);
$sheet7->getColumnDimension('E')->setWidth(80);
$sheet7->getColumnDimension('F')->setWidth(100);
$sheet7->getColumnDimension('G')->setWidth(80);


$i=3;

//theme, type, lifecycle
	$headings=$db->getHeadings(6,req('id'),0,$lang);
	foreach ($headings as $heading) {
	$i++;
//		$sheet7->setCellValue("A$i",$heading['id'].':'.$heading['name']);
		$sheet7->setCellValue("A$i",$heading['id']);
		$sheet7->setCellValue("B$i",$heading['name']);
		$styleA1 = $sheet7->getStyle("A$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');
		$styleA1 = $sheet7->getStyle("B$i");
		$styleFont = $styleA1->getFont();
		$styleFont->setBold(true);
		$styleFont->setSize(10);
		$styleFont->setName('Arial');

		
		//$type_id,$themeId,$lifecycleId=0,$headingId=
		$criterias=$db->getSubratings2(req('id'),6,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet7->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet7->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet7->setCellValue("A$i",$criteria['id']);
				$sheet7->setCellValue("B$i",$criteria['name']);
				$sheet7->setCellValue("C$i",$criteria['question']);
				$sheet7->setCellValue("D$i",$criteria['proof_exist']);
				$sheet7->setCellValue("E$i",$criteria['proof_new']);
				$sheet7->setCellValue("F$i",$criteria['example']);
				//on dévérouille pour la saisie
				$sheet7->getStyle("G$i")->getProtection()->setLocked(PHPExcel_Style_Protection::PROTECTION_UNPROTECTED);
		}
	}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

if ($lang==1) $fichier='excel/criteria_'.$txt_type.'_FR.xlsx'; else $fichier='excel/criteria_'.$txt_type.'_EN.xlsx';

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


	
	function update(){
		requireAdmin();
		global $db;
		// a coder

		if (mail($to, $subject, $message, $headers)){
			header('Location: typepdt?action=admin');
		}
	}
	
	function delete(){
		requireAdmin();
		global $db;
		$product = $db->deleteSubrating(req('id'));		
		header('Location: subratings?action=admin');
	}
	
	private function paramsList(){
		$params['theme_id'] = req('themeid');
		$params['lifecycle_id'] = req('lifecycleid');
		$params['heading_id'] = req('headingid');
		$params['question'] = req('question');
		$params['proof_exist'] = req('proof_exist');
		$params['proof_new'] = req('proof_new');
		$params['example'] = req('example');
		$params['points'] = req('points');
		return $params;
	}
	
	function renderListItem($category, $level, $tpl = "categoryitem.php"){
		include("./views/".$tpl);
	}

	function showCheckboxes($selected){
		global $db;
		$categories = $db->getCategories();
		foreach ($categories as $key=>$category){
			$this->renderCheckbox($category, 0, $selected);
		}
	}
	
	function renderCheckbox($category, $level, $selected){
		include("./views/categorycheckbox.php");
	}

	function showOptions($selected, $startLevel = 0, $showCount = false){
		global $db;
		$categories = $db->getCategories();
		foreach ($categories as $key=>$category){
			$this->renderOption($category, $startLevel, $selected, $showCount);
		}
	}
	
	function renderOption($category, $level, $selected, $showCount = false){
		include("./views/categoryoption.php");
	}
	
	function show2LevelsList(){
		global $db;
		$this->categories = $db->getCategories(0);
		include("./views/category2levelslist2.php");
	}
	
	function showMenu($current){
		global $db;
		$categories = $db->getCategories(0);
		array_unshift($categories, array('id' => 'new', "icon" => "new10-trans.png", "name" => "Nouveauts", "subcategories" => array()));
		array_unshift($categories, array('id' => 'selection', "icon" => "selec10.png", "name" => "Notre selection", "subcategories" => array()));

		
		$currentPath = array();
		
		//if ($current > 0){
			$tempId = $current;
			for($i = 0; $i < 10; $i++){		
				$tempCategory = $db->getCategory($tempId);
				if ($tempCategory == null){
					break;
				}
				$currentPath[] = $tempCategory;
				if ($tempCategory['parentid'] != 0){
					$tempId = $tempCategory['parentid'];
				}else{
					break;
				}
			}
		//}		
				
		foreach ($categories as $key=>$category){
			$this->renderMenuItem($category, 0, $current, $currentPath);
		}				
	}

	function renderMenuItem($category, $level, $current, $currentPath){
		include("./views/categorymenuitem.php");
	}

}