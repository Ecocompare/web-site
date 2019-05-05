<?php
class Controller{

	var $formValues = array();
	var $keywords = '';
	var $description = '';
	var $title = '';

	protected function getFormValue($name){
		if (isset($this->formValues[$name])){
			return $this->formValues[$name];
		}else{
			return "";
		}
	}
	
	protected function getFormValueDefault($name,$default = ''){
		if (isset($this->formValues[$name])){
			return $this->formValues[$name];
		}else{
			return $default;
		}
	}

	protected function render($tpl){
		$this->tpl = $tpl;
		require('./views/page.php');
	}

	protected function render2($tpl){
		$this->tpl = $tpl;
		require('./views/bloc.php');
	}

	protected function getproof($id,$lang) {
		
		if ($id==1 && $lang==1) return "Photo ou preuve fournie";
		if ($id==1 && $lang==2) return "Photo or proof provided";
		if ($id==2 && $lang==1) return "Attestation sur l'honneur fournie";
		if ($id==2 && $lang==2) return "Certificate of honor provided";
	  return '';
	}
	

	protected function showSelect($name, $items, $selected, $onChange = ''){
		echo '<select name="'.$name.'" id="'.$name.'" onchange="'.$onChange.'">';
		foreach($items as $key=>$item){
			echo '<option value="'.$item['id'].'"';
			if ($selected == $item['id']){
				echo ' selected';
			}
			echo '>'.$item['name'].'</option>';
		}
		echo '</select>';
	}
	
		protected function formatTime($time,$lang=1){
		
		if ($lang==1) {
			$today = date("d/m/y", time());
			$yesterday = date("d/m/y", time() - 3600 * 24);
			$date = date("d/m/y", $time);
			
			$day = date("j", $time);
			if ($day == "1"){
				$day = "1er";
			}
			$month = date("n", $time);
			$year = date("Y", $time);
			
			$months = array();
			$months[1] = "janvier";
			$months[2] = "fevrier";
			$months[3] = "mars";
			$months[4] = "avril";
			$months[5] = "mai";
			$months[6] = "juin";
			$months[7] = "juillet";
			$months[8] = "aout";
			$months[9] = "septembre";
			$months[10] = "octobre";
			$months[11] = "novembre";
			$months[12] = "decembre";
			
			if ($today == $date){
				return "aujourd'hui";
			}else if ($yesterday == $date){
				return "hier";
			}else{
				return 'le&nbsp;'.$day."&nbsp;".$months[$month].'&nbsp;'.$year;
			}
		}

else
{
			$today = date("m/d/y", time());
			$yesterday = date("m/d/y", time() - 3600 * 24);
			$date = date("m/d/y", $time);
			
			$day = date("j", $time);
			if ($day == "1"){
				$day = "First";
			}
			$month = date("n", $time);
			$year = date("Y", $time);
			
			$months = array();
			$months[1] = "january";
			$months[2] = "february";
			$months[3] = "march";
			$months[4] = "april";
			$months[5] = "may";
			$months[6] = "june";
			$months[7] = "july";
			$months[8] = "august";
			$months[9] = "september";
			$months[10] = "october";
			$months[11] = "november";
			$months[12] = "december";
			
			if ($today == $date){
				return "today";
			}else if ($yesterday == $date){
				return "yesterday";
			}else{
				return 'on&nbsp;'.$day."&nbsp;".$months[$month].'&nbsp;'.$year;
			}
		}	
}	
}