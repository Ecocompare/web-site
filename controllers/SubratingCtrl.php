<?php
require_once('Controller.php');

class SubratingCtrl extends Controller{
	
	function admin(){
		global $db;
		$this->lang= reqOrDefault('lang',1);
		$this->envSubratings = $db->getNewSubratings(0,1,$this->lang);
		$this->santeSubratings = $db->getNewSubratings(0,2,$this->lang);
		$this->qualiteSubratings = $db->getNewSubratings(0,3,$this->lang);
		$this->socialSubratings = $db->getNewSubratings(0,4,$this->lang);
		$this->ethiqueSubratings = $db->getNewSubratings(0,5,$this->lang);
		$this->equitableSudSubratings = $db->getNewSubratings(0,6,$this->lang);
		$this->equitableNordSubratings = $db->getNewSubratings(0,7,$this->lang);
				
		$this->currentTab = "admin";	
		$this->render('subratingadmin.php');
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
		$this->formValues = $db->getNewSubrating(req('id'),req('lang'));
		$this->themes=$db->getThemes(0,req('lang'));
		$this->headings=$db->getHeadings($this->formValues['theme_id'],0,0,req('lang'));
		$this->lifecycles=$db->getLifecycles(0,req('lang'));
		$this->types=$db->getTypesCriteria(req('id'));
		$this->labels=$db->getLabelCriteria(req('id'),req('lang'));
		$this->targetAction = "update";	
		
		$this->currentTab = "admin";	
		$this->render('subratingedit.php');
	}
	
		function export(){
		requireAdmin();
		global $db;
		$repertoire="/var/www/vhosts/ecocompare.com/httpdocs";
		$lang=req('lang');
	
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
					
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Ecocompare")
							 ->setLastModifiedBy("Ecocompare")
							 ->setTitle("Critères de notation ".$categorie)
							 ->setSubject("Notation de produit")
							 ->setDescription("Critères de notation")
							 ->setKeywords("office PHPExcel php");
					
//Textes selon langue

if ($lang==1) {
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
	
	}
else
{
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
}	
// ############################### ENVIRONNEMENT ###########################
$sheet1 = $objPHPExcel->getActiveSheet();
$sheet1->setTitle('Environnement');
$sheet1->setCellValue('A1',$txt_env);
$sheet1->setCellValue('A3','Id');
$sheet1->setCellValue('B3',$txt_group);
$sheet1->setCellValue('C3',$txt_question);
$sheet1->setCellValue('D3',$txt_proofexist);
$sheet1->setCellValue('E3',$txt_proofnew);
$sheet1->setCellValue('F3',$txt_response);
$sheet1->setCellValue('G3',$txt_example);

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
	
	$headings=$db->getHeadings(1,0,$lifecycle['id'],$lang);
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
		$criterias=$db->getSubratings2(0,1,$lifecycle['id'],$heading['id'],$lang);
		
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
				
		}
	}
}



// ############################### SANTE ###########################

$sheet2 = $objPHPExcel->createSheet();
$sheet2->setTitle($txt_health);
$sheet2->setCellValue('A1',$txt_health);
$sheet2->setCellValue('A3','Id');
$sheet2->setCellValue('B3',$txt_group);
$sheet2->setCellValue('C3',$txt_question);
$sheet2->setCellValue('D3',$txt_proofexist);
$sheet2->setCellValue('E3',$txt_proofnew);
$sheet2->setCellValue('F3',$txt_response);
$sheet2->setCellValue('G3',$txt_example);

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
	$headings=$db->getHeadings(2,0,0,$lang);
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
		$criterias=$db->getSubratings2(0,2,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet2->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet2->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet2->setCellValue("A$i",$criteria['id']);
				$sheet2->setCellValue("B$i",$criteria['name']);
				$sheet2->setCellValue("C$i",$criteria['question']);
				$sheet2->setCellValue("D$i",$criteria['proof_exist']);
				$sheet2->setCellValue("E$i",$criteria['proof_new']);
				$sheet2->setCellValue("G$i",$criteria['example']);
				
		}
	}

// ############################### QUALITE ###########################

$sheet3 = $objPHPExcel->createSheet();
$sheet3->setTitle($txt_quality);
$sheet3->setCellValue('A1',$txt_quality);
$sheet3->setCellValue('A3','Id');
$sheet3->setCellValue('B3',$txt_group);
$sheet3->setCellValue('C3',$txt_question);
$sheet3->setCellValue('D3',$txt_proofexist);
$sheet3->setCellValue('E3',$txt_proofnew);
$sheet3->setCellValue('F3',$txt_response);
$sheet3->setCellValue('G3',$txt_example);

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
	$headings=$db->getHeadings(3,0,0,$lang);
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
		$criterias=$db->getSubratings2(0,3,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet3->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet3->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet3->setCellValue("A$i",$criteria['id']);
				$sheet3->setCellValue("B$i",$criteria['name']);
				$sheet3->setCellValue("C$i",$criteria['question']);
				$sheet3->setCellValue("D$i",$criteria['proof_exist']);
				$sheet3->setCellValue("E$i",$criteria['proof_new']);
				$sheet3->setCellValue("G$i",$criteria['example']);
				
		}
	}

// ############################### SOCIAL ###########################

$sheet4 = $objPHPExcel->createSheet();
$sheet4->setTitle($txt_social);
$sheet4->setCellValue('A1',$txt_social);
$sheet4->setCellValue('A3','Id');
$sheet4->setCellValue('B3',$txt_group);
$sheet4->setCellValue('C3',$txt_question);
$sheet4->setCellValue('D3',$txt_proofexist);
$sheet4->setCellValue('E3',$txt_proofnew);
$sheet4->setCellValue('F3',$txt_response);
$sheet4->setCellValue('G3',$txt_example);

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
	$headings=$db->getHeadings(4,0,0,$lang);
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
		$criterias=$db->getSubratings2(0,4,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet4->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet4->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet4->setCellValue("A$i",$criteria['id']);
				$sheet4->setCellValue("B$i",$criteria['name']);
				$sheet4->setCellValue("C$i",$criteria['question']);
				$sheet4->setCellValue("D$i",$criteria['proof_exist']);
				$sheet4->setCellValue("E$i",$criteria['proof_new']);
				$sheet4->setCellValue("G$i",$criteria['example']);
				
		}
	}

// ############################### ETHIQUE ###########################

$sheet5 = $objPHPExcel->createSheet();
$sheet5->setTitle($txt_ethic);
$sheet5->setCellValue('A1',$txt_ethic);
$sheet5->setCellValue('A3','Id');
$sheet5->setCellValue('B3',$txt_group);
$sheet5->setCellValue('C3',$txt_question);
$sheet5->setCellValue('D3',$txt_proofexist);
$sheet5->setCellValue('E3',$txt_proofnew);
$sheet5->setCellValue('F3',$txt_response);
$sheet5->setCellValue('G3',$txt_example);

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
	$headings=$db->getHeadings(5,0,0,$lang);
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
		$criterias=$db->getSubratings2(0,5,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet5->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet5->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet5->setCellValue("A$i",$criteria['id']);
				$sheet5->setCellValue("B$i",$criteria['name']);
				$sheet5->setCellValue("C$i",$criteria['question']);
				$sheet5->setCellValue("D$i",$criteria['proof_exist']);
				$sheet5->setCellValue("E$i",$criteria['proof_new']);
				$sheet5->setCellValue("G$i",$criteria['example']);
				
		}
	}

// ############################### EQUITABLE NORD/NORD ###########################

$sheet6 = $objPHPExcel->createSheet();
$sheet6->setTitle($txt_fairtradeNN);
$sheet6->setCellValue('A1',$txt_fairtradeNN);
$sheet6->setCellValue('A3','Id');
$sheet6->setCellValue('B3',$txt_group);
$sheet6->setCellValue('C3',$txt_question);
$sheet6->setCellValue('D3',$txt_proofexist);
$sheet6->setCellValue('E3',$txt_proofnew);
$sheet6->setCellValue('F3',$txt_response);
$sheet6->setCellValue('G3',$txt_example);

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

	$headings=$db->getHeadings(7,0,0,$lang);
		
	foreach ($headings as $heading) {
	$i++;
	//echo ">>".$heading['name'];
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
		$criterias=$db->getSubratings2(0,7,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			//echo $criteria['name'];
			$sheet6->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet6->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet6->setCellValue("A$i",$criteria['id']);
				$sheet6->setCellValue("B$i",$criteria['name']);
				$sheet6->setCellValue("C$i",$criteria['question']);
				$sheet6->setCellValue("D$i",$criteria['proof_exist']);
				$sheet6->setCellValue("E$i",$criteria['proof_new']);
				$sheet6->setCellValue("G$i",$criteria['example']);
				
		}
	}
// ############################### EQUITABLE NORD/SUD ###########################

$sheet7 = $objPHPExcel->createSheet();
$sheet7->setTitle($txt_fairtradeNS);
$sheet7->setCellValue('A1',$txt_fairtradeNS);
$sheet7->setCellValue('A3','Id');
$sheet7->setCellValue('B3',$txt_group);
$sheet7->setCellValue('C3',$txt_question);
$sheet7->setCellValue('D3',$txt_proofexist);
$sheet7->setCellValue('E3',$txt_proofnew);
$sheet7->setCellValue('F3',$txt_response);
$sheet7->setCellValue('G3',$txt_example);

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
	$headings=$db->getHeadings(6,0,0,$lang);
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
		$criterias=$db->getSubratings2(0,6,0,$heading['id'],$lang);
		
		foreach ($criterias as $criteria) {
			$i++;
			$sheet7->getStyle("A$i:G$i")->getAlignment()->setWrapText(true);
			$sheet7->getStyle("A$i:G$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				$sheet7->setCellValue("A$i",$criteria['id']);
				$sheet7->setCellValue("B$i",$criteria['name']);
				$sheet7->setCellValue("C$i",$criteria['question']);
				$sheet7->setCellValue("D$i",$criteria['proof_exist']);
				$sheet7->setCellValue("E$i",$criteria['proof_new']);
				$sheet7->setCellValue("G$i",$criteria['example']);
				
		}
	}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

if ($lang==1) $fichier='excel/criterias_FR.xlsx'; else $fichier='excel/criterias_EN.xlsx';

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
		$db->updateNewSubrating(req('id'), $this->paramsList(),req('lang'));
		$rv = $db->recalculateAffectedProducts(req('id'));

		
		$to      = 'contact@ecocompare.com';
		$subject = 'Modification du critère '.req('id');
		$headers = 
			'From: contact@ecocompare.com'."\n".
 		$headers.= "Content-Type: text/plain; charset=UTF-8;";
    	$message = "Produits affect豠: \n".$rv;


		if (mail($to, $subject, $message, $headers)){
			header('Location: subratings?action=admin&lang='.req('lang'));
		}
	}
	
	function delete(){
		requireAdmin();
		global $db;
		$product = $db->deleteSubrating(req('id'));		
		header('Location: '.$GLOBALS['base'].'subratings?action=admin');
	}
	
	function deleteSubratingLabel(){
		requireAdmin();
		global $db;
		$product = $db->deleteSubratingLabel(req('id'));		
		header('Location: '.$GLOBALS['base'].'labels?action=edit&id='.req('labelId'));
	}
	
	
	private function paramsList(){
		$params['theme_id'] = req('themeid');
		$params['name'] = 	req('name');
		$params['lifecycle_id'] = req('lifecycleid');
		$params['heading_id'] = req('headingid');
		$params['question'] = req('question');
		$params['proof_exist'] = req('proof_exist');
		$params['proof_new'] = req('proof_new');
		$params['example'] = req('example');
		$params['points'] = req('points');
		$params['lang'] = req('lang');
		
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