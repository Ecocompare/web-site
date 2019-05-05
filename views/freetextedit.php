<h1>Modifier un texte</h1>
<div>

	

		
		<div class="formsection" id="section1">

			<form id="form" action="content?action=update" method="post" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?=$this->freeText['id']?>"/>	
			<div class="fieldlabel">
				Identifiant :
			</div>
			<div class="fieldcontent">
				<?=stripSlashes($this->freeText['id'])?>
			</div>


			<div id="htmleditor" class="editor">
				<div class="editortoolbar">
					<a href="javascript:switchEditorView('wysiwyg')"><img src="<?=$GLOBALS['base']?>style/switchtowysiwyg.gif"/></a>
				</div>
				<textarea id="html" name="text"><?=htmlspecialchars(stripSlashes(stripSlashes($this->freeText['text'])))?></textarea>
			</div>
			</form>

			<div id="wysiwygeditor" class="editor">
				<script src="js/wysiwyg.js"></script>
				<div class="editortoolbar">
					<a href="javascript:switchEditorView('html')" id="switchtohtml"><img src="<?=$GLOBALS['base']?>style/switchtohtml.gif"/></a>
					<select id="blockformat" onChange="formatBlock();">
						<option value="">Style</option>
						<option value="<p>">Normal</option>
						<option value="<h1>"><h1>Titre 1</h1></option>
						<option value="<h2>">Titre 2</option>
						<option value="<h3>">Titre 3</option>
					</select>
					<a href="javascript:doRichEditCommand('bold')"><img src="<?=$GLOBALS['base']?>style/bold.gif"/></a>
					<a href="javascript:doRichEditCommand('italic')"><img src="<?=$GLOBALS['base']?>style/italic.gif"/></a>
					<a href="javascript:insertLink()"><img src="<?=$GLOBALS['base']?>style/link.gif"/></a>
	
					<a href="javascript:doRichEditCommand('justifyleft')"><img src="<?=$GLOBALS['base']?>style/alignleft.gif"/></a><a href="javascript:doRichEditCommand('justifycenter')"><img src="<?=$GLOBALS['base']?>style/aligncenter.gif"/></a><a href="javascript:doRichEditCommand('justifyright')"><img src="<?=$GLOBALS['base']?>style/alignright.gif"/></a>
					<a href="javascript:doRichEditCommand('insertunorderedlist')"><img src="<?=$GLOBALS['base']?>style/list.gif"/></a>
				</div>
				<iframe name="wysiwyg" id="wysiwyg" src="blank.php" onload="initWysiwygArea();" frameborder="0">
				</iframe>
	
	
			</div>
			
			<div style="clear: both; padding: 12px;">&nbsp;</div>

				
		</div>
		<div class="formbuttons">
			<input type="button" onclick="prepareToSubmit(); document.getElementById('form').submit();" value="Enregistrer"/> ou <a href="content?action=admin">Annuler</a>
		</div>

</div>