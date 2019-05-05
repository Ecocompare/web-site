var wysiwyg;
var html;

function initWysiwygArea(){
	html = document.getElementById('html');
	wysiwyg = document.getElementById('wysiwyg').contentWindow.document;
	//editor.body.innerHTML = html.value;
	wysiwyg.designMode = "on";
	switchEditorView("wysiwyg");
}

function switchEditorView(id){
	wysiwygEditor = document.getElementById('wysiwygeditor');
	htmlEditor = document.getElementById('htmleditor');
	if (id == "wysiwyg"){
		wysiwyg.body.innerHTML = html.value;
		wysiwygEditor.style.display = "block";
		htmlEditor.style.display = "none";
	}else{
		html.value = wysiwyg.body.innerHTML;
		wysiwygEditor.style.display = "none";
		htmlEditor.style.display = "block";
	}
}

function prepareToSubmit(){
	if (wysiwygEditor.style.display == "block"){
		html.value = wysiwyg.body.innerHTML;
	}
}

function insertLink(){
	reply = prompt("URL", "");
	if (reply != ""){
		doRichEditCommand("createlink", reply);
	}else{
		doRichEditCommand("unlink", "");
	}
}

function insertImage(url){
	doRichEditCommand("insertimage", url);
	document.getElementById('uploadinput').value = '';
}

function delayedInsertImage(url){
	setTimeout("insertImage('" + url + "')", 0);
}

function formatBlock(){
	select = document.getElementById('blockformat');
	format = select.options[select.selectedIndex].value;
	if (format != ""){
		doRichEditCommand("formatblock", format);
	}
	select.selectedIndex = 0;
}

function doRichEditCommand(name, arg){
	document.getElementById('wysiwyg').contentWindow.document.execCommand(name, false, arg);
	document.getElementById('wysiwyg').contentWindow.focus();
}

function insertTable(){
	doRichEditCommand("inserthtml", "<table><tr><td></td><td></td></tr><tr><td></td><td></td></tr></table>");
}

  function insertNodeAtSelection(win, insertNode)
  {
      // get current selection
      var sel = win.getSelection();

      // get the first range of the selection
      // (there's almost always only one range)
      var range = sel.getRangeAt(0);

      // deselect everything
      sel.removeAllRanges();

      // remove content of current selection from document
      range.deleteContents();

      // get location of current selection
      var container = range.startContainer;
      var pos = range.startOffset;

      // make a new range for the new selection
      range=document.createRange();

      if (container.nodeType==3 && insertNode.nodeType==3) {

        // if we insert text in a textnode, do optimized insertion
        container.insertData(pos, insertNode.nodeValue);

        // put cursor after inserted text
        range.setEnd(container, pos+insertNode.length);
        range.setStart(container, pos+insertNode.length);

      } else {


        var afterNode;
        if (container.nodeType==3) {

          // when inserting into a textnode
          // we create 2 new textnodes
          // and put the insertNode in between

          var textNode = container;
          container = textNode.parentNode;
          var text = textNode.nodeValue;

          // text before the split
          var textBefore = text.substr(0,pos);
          // text after the split
          var textAfter = text.substr(pos);

          var beforeNode = document.createTextNode(textBefore);
          afterNode = document.createTextNode(textAfter);

          // insert the 3 new nodes before the old one
          container.insertBefore(afterNode, textNode);
          container.insertBefore(insertNode, afterNode);
          container.insertBefore(beforeNode, insertNode);

          // remove the old node
          container.removeChild(textNode);

        } else {

          // else simply insert the node
          afterNode = container.childNodes[pos];
          container.insertBefore(insertNode, afterNode);
        }

        range.setEnd(afterNode, 0);
        range.setStart(afterNode, 0);
      }

      sel.addRange(range);
  };