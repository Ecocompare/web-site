	<div id="sectionlabel">
			<div class="fieldlabel<?=$this->hasChanged('labels') ?>"  >
				Label(s) :
			</div>
			<div class="fieldcontent" id="labellist">
				<? $this->labelCtrl->showCheckboxesType($this->getFormValue('labels'),$this->getFormValue('typeid')); ?>
			</div>
			</div>