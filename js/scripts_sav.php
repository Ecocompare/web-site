<?	$GLOBALS['base'] = "http://www.ecocompare.com/"; ?>
var map;
var markersArray = [];


if(!Array.indexOf){
	Array.prototype.indexOf = function(obj){
		for(var i=0; i<this.length; i++){
			if(this[i]==obj){
				return i;
			}
		}
		return -1;
	}
}

function fancy(content,width,height){

     $.fancybox({
         'width'            : width,
         'height'    :    height,
         'content'            : content,
         'autoDimensions'	:	false
     });
}

function startcanva() {

 try {
          TagCanvas.Start('myCanvas','tags',{
            textColour: '#71C146',
            outlineColour: '#606060',
            reverse: true,
            initial : [0.1,-0.1],
            depth: 0.8,
            maxSpeed: 0.05
          });
        } catch(e) {
          // something went wrong, hide the canvas container
        
          document.getElementById('myCanvasContainer').style.display = 'none';
        }
}

 function getRandomTestimony(){ 
        var url_testimony = "<?=$GLOBALS['base']?>/index.php?ctrl=User&action=getTestimony";
  
            $.getJSON(url_testimony, function(json){ 
            	console.log(json);
                        if(json.description != 'null') { 
                            $('#testimony_msg').fadeOut(function(){    
                                $('#testimony_msg').html('<b>'+json.subject+'</b><br/>&laquo; '+json.description+' &raquo;. <div class="faded">'+json.author+'</div>');  
                                $('#testimony_msg').fadeIn();        
                            }); 
                        } 
                     }
            ); 
    }


function createXMLHttpRequest() {
   try { return new ActiveXObject("Msxml2.XMLHTTP"); } catch (e) {}
   try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch (e) {}
   try { return new XMLHttpRequest(); } catch(e) {}
   return null;
}

function visibilite(thingId) 
{ 
var targetElement; 
targetElement = document.getElementById(thingId) ; 
if (targetElement.style.display == "none") 
{ 
targetElement.style.display = "" ; 
} else { 
targetElement.style.display = "none" ; 
} 
} 
function check_equitable(product_id,type_id,equitable_sud) {

   $.get('<?=$GLOBALS['base']?>index.php?ctrl=Product&action=ajax9&id='+product_id+'&type_id='+type_id+'&equitable_sud='+equitable_sud, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#section9').empty(); //on vide 
    $('#section9').append(data); //on remplie l’élément DOM d'id 
    });

}
function loadRules(product_id,type_id,equitable_sud) {


    $.get('<?=$GLOBALS['base']?>index.php?ctrl=Product&action=ajax4&id='+product_id+'&type_id='+type_id, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#section4').empty(); //on vide 
    $('#section4').append(data); //on remplie l’élément DOM d'id 
    });

    $.get('<?=$GLOBALS['base']?>index.php?ctrl=Product&action=ajax5&id='+product_id+'&type_id='+type_id, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#section5').empty(); //on vide 
    $('#section5').append(data); //on remplie l’élément DOM d'id 
    });

    $.get('<?=$GLOBALS['base']?>index.php?ctrl=Product&action=ajax6&id='+product_id+'&type_id='+type_id, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#section6').empty(); //on vide 
    $('#section6').append(data); //on remplie l’élément DOM d'id 
    });

 	 $.get('<?=$GLOBALS['base']?>index.php?ctrl=Product&action=ajax7&id='+product_id+'&type_id='+type_id, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#section7').empty(); //on vide 
    $('#section7').append(data); //on remplie l’élément DOM d'id 
    });
    
    $.get('<?=$GLOBALS['base']?>index.php?ctrl=Product&action=ajax8&id='+product_id+'&type_id='+type_id, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#section8').empty(); //on vide 
    $('#section8').append(data); //on remplie l’élément DOM d'id 
    });

//on passe le parametre equitable
    $.get('<?=$GLOBALS['base']?>index.php?ctrl=Product&action=ajax9&id='+product_id+'&type_id='+type_id+'&equitable_sud='+equitable_sud, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#section9').empty(); //on vide 
    $('#section9').append(data); //on remplie l’élément DOM d'id 
    });

    $.get('<?=$GLOBALS['base']?>index.php?ctrl=Label&action=ajaxlabel&id='+product_id+'&type_id='+type_id, function(data) { //execution d'une requete GET vers une url qui retourne le bout d'HTML souhaité 
    $('#sectionlabel').empty(); //on vide 
    $('#sectionlabel').append(data); //on remplie l’élément DOM d'id 
    });
    
    
       
}







function validateComment(id, productid){
	var req = createXMLHttpRequest();
	req.open("POST", "<?=$GLOBALS['base']?>comments/validate", true);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.onreadystatechange = function() {
		if (req.readyState == 4) {
			document.getElementById('commentslist').innerHTML = req.responseText;
		}
   };
   req.send("id=" + id + "&productid=" + productid);
}

function editComment(id){
	location.href = '<?=$GLOBALS['base']?>comments/edit?id=' + id + '&returnurl=' + document.getElementById('returnurl').value;
}

function deleteComment(id, productid){
	if (confirm('Voulez-vous vraiment supprimer ce commentaire ?')){
		var req = createXMLHttpRequest();
		req.open("POST", "/comments/delete", true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		req.onreadystatechange = function() {
			if (req.readyState == 4) {
				document.getElementById('commentslist').innerHTML = req.responseText;
			}
	   };
	   req.send("id=" + id + "&productid=" + productid);
	}
}

function isEmailAddr(elem) {
    var str = elem.value;
    var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!str.match(re)) {
        return false;
    } else {
        return true;
    }
    
}

function checkCommentAndSubmitForm(){
	name = document.getElementById('name').value;
	if (name == ''){
		alert('Entrez un nom');
		return;
	}
	text = document.getElementById('text').value;
	if (text == ''){
		alert('Entrez un commentaire');
		return;
	}
	checkContactAndSubmitForm();
}

function checkContactAndSubmitForm(){
	email = document.getElementById('useremail');
	

	if (isEmailAddr(email)){
		
	}else{
		alert('Entrez une adresse email valide');
		return;
	}
	
	document.getElementById('form').submit();
	
}

function checkEmailAndSubmitForm(){
	email = document.getElementById('useremail');
	
	checkbox = document.getElementById('accept');
	
	
	if (!checkCategories()){
		return;
	}

	if (checkbox.checked != true){
		alert('Vous devez lire et accepter les CGU');
		return;	
	}
	
	if (isEmailAddr(email)){
		
	}else{
		alert('Entrez une adresse email valide');
		return;
	}
	
	document.getElementById('form').submit();
	
}

function checkCGUsAndSubmitForm(){

	email = document.getElementById('useremail');	
	checkbox = document.getElementById('accept');
	
	
	
	typeidselect = document.getElementById('typeid');
	typeidvalue = typeidselect.options[typeidselect.selectedIndex].value;
	
	
	if (typeidvalue==0){
		alert('Vous devez affectez un type de produit');
		switchFormSection(1);
		return;	
	}
	
	if (!checkCategories()){
		return;
	}
	
	if (checkbox.checked != true){
		alert('Vous devez lire et accepter les CGU');
		return;	
	}
	
	if (isEmailAddr(email)){
		
	}else{
		alert('Entrez une adresse email valide');
		return;
	}	
	
	document.getElementById('form').submit();
	
}


function checkCategories() {
var max=document.formulaire.elements["categories[]"].length;	
var total = 0;

for(var idx = 0; idx < max; idx++) {
        if(eval("document.formulaire.elements['categories[]'][" + idx + "].checked") == true) {
            total += 1;
        }
    }
   
if (total==0) {alert("Vous devez sélectionner une catégorie");
				switchFormSection(2);
			return false;}
			else return true;

}

checkPrecisions = function(){
//	console.log(document.forms.formulaire);

	var globalRating = document.getElementById('rating1').value+document.getElementById('rating2').value+document.getElementById('rating3').value+document.getElementById('rating4').value+document.getElementById('rating5').value;
	
	if (globalRating == '0'){
		alert('Veuillez remplir tous les onglets et cocher des critères');
		return false;
	}

//test environnement et 12 étapes
for (var lifecycleId= 2; lifecycleId<=12; lifecycleId++){

for (var j= 0; document.getElementById('rating1' + '-' +lifecycleId + '-' + j) != null; j++){
			var checkbox = document.getElementById('rating1' + '-' +lifecycleId + '-' + j);
		//	alert('rating1' + '-' +lifecycleId + '-' + j+ 'value:'+document.getElementById('comment1' + '-' +lifecycleId + '-' + j).value);
				// si critere checké et Ni commentaire ecolabel, ni commentaire marque env
			if (checkbox.checked == true){
				if (trim(document.getElementById('comment1' + '-' +lifecycleId + '-' + j).value) == '' && trim(document.getElementById('commentlabel1' + '-' +lifecycleId + '-' + j).value) == ''){
					switchFormSection(4);
					alert('Veuillez remplir le champs "précisions" pour le critère coché : '+document.getElementById('question1' + '-' +lifecycleId + '-' + j).value);

					return false;

				}
			}
		}
	
}

//tester les autres onglets
for (var themeId= 2; themeId<=5; themeId++){
for (var j= 0; document.getElementById('rating' + themeId +'-0-' + j) != null; j++){
			var checkbox = document.getElementById('rating' + themeId +'-0-' + j);
			//alert(checkbox);
			// si critere checké et Ni commentaire ecolabel, ni commentaire marque autre que env
			if (checkbox.checked == true){
				if (trim(document.getElementById('comment' +  themeId +'-0-' + j).value) == '' && trim(document.getElementById('commentlabel' +  themeId +'-0-' + j).value) == ''){
					switchFormSection(themeId+3);
					
					alert('Veuillez remplir le champs "précisions" pour le critère coché :' + document.getElementById('question' + themeId+ '-0-' + j).value);

					return false;

				}
			}
		}
}
return true;
}
	function trim(myString)
	{
		return myString.replace(/^\s+/g,'').replace(/\s+$/g,'')
	} 

initSearch = function(){
	input = document.getElementById('searchinput');
	if (input.value == "Recherche produits"){
		input.value = "";
	}
}

initNewsletter = function(){
	input = document.getElementById('newsletterinput');
	if (input.value == "Votre email"){
		input.value = "";
	}
}

showFileInput = function(){
	document.getElementById('fileinput').style.display = "block";
	document.getElementById('filestatus').style.display = "none";
	document.getElementById('fileaction').value = "upload";
}

hideFileInput = function(){
	document.getElementById('fileinput').style.display = "none";
	document.getElementById('filestatus').style.display = "block";
	document.getElementById('fileaction').value = "keep";
}

changeUser= function () {
	tempSelect = document.getElementById('users');
	tempUserid = tempSelect.options[tempSelect.selectedIndex].value;
	destination = "products?action=justify&userId="+tempUserid;
	location.href = destination;	
}

changeProduct= function () {
	tempSelect = document.getElementById('users');
	tempUserid = tempSelect.options[tempSelect.selectedIndex].value;
	tempSelect = document.getElementById('products');
	tempProductid = tempSelect.options[tempSelect.selectedIndex].value;
	destination = "products?action=justify&userId="+tempUserid+'&productId='+tempProductid;
	location.href = destination;	
}

changeDisplay = function(){
	tempSelect = document.getElementById('category');
	tempCategory = tempSelect.options[tempSelect.selectedIndex].value;
	tempSelect = document.getElementById('orderby');
	tempOrderBy = tempSelect.options[tempSelect.selectedIndex].value;
	tempSelect = document.getElementById('published');
	tempPublished = tempSelect.options[tempSelect.selectedIndex].value;
	tempSelect = document.getElementById('users');
	tempUserid = tempSelect.options[tempSelect.selectedIndex].value;
	
	
	destination = "products?action=admin&category=" + tempCategory + "&orderby=" + tempOrderBy + "&published=" + tempPublished+ "&userId="+tempUserid;
	location.href = destination;
}

browseFilter = function(action){
	destination = action + "?" + getBrowseQuery();
	location.href = destination;
}

getBrowseQuery = function(){
	tempHidden = document.getElementById('previouskeywords');
	tempKeywords = tempHidden.value;

	tempHidden = document.getElementById('category');
	tempCategory = tempHidden.value;

	tempHidden = document.getElementById('personnal');
	tempPersonnal = tempHidden.value;
	
	tempSelect = document.getElementById('orderby');
	tempOrderBy = tempSelect.options[tempSelect.selectedIndex].value;

	tempSelect = document.getElementById('label');
	tempLabel = tempSelect.options[tempSelect.selectedIndex].value;

	return "keywords=" + tempKeywords + "&category=" + tempCategory + "&orderby=" + tempOrderBy + "&label=" + tempLabel + "&personnal=" + tempPersonnal;	
}

getSelection = function(){
	selection = new Array();
	inputs = document.getElementsByTagName('input');
	for (var i = 0; i < inputs.length; i++){
		if (inputs[i].checked && (selection.indexOf(inputs[i].name) == -1)){
			selection.push(inputs[i].name);
		}
	}
	return selection;
}

changePage = function(action, page){

	selection = getSelection();
	query = getBrowseQuery();
	query += "&page=" + page;
	for (i = 0; i < selection.length; i++){
		query += "&selection" + (i + 1) + "=" + selection[i];
	}
	destination = action + "?" + query;
	
	location.href = destination;	
}

deselectAll = function(){
	for (var i = 0; i < inputs.length; i++){
		if (inputs[i].checked){
			inputs[i].checked = false;
		}
	}
	updateCompareButton();
}

updateCompareButton = function (){
	selection = getSelection();
	selectionLength = selection.length;
	if (selectionLength > 0) {
		document.getElementById('comparebuttonbottom').innerHTML = "Comparer " + selectionLength + " produit(s)";
		document.getElementById('comparebuttontop').innerHTML = "Comparer " + selectionLength + " produit(s)";	
		//document.getElementById('cancelselection').style.display = "inline";
	}else{
		document.getElementById('comparebuttonbottom').innerHTML = "Cocher pour comparer";
		document.getElementById('comparebuttontop').innerHTML = "Cocher pour comparer";
		//document.getElementById('cancelselection').style.display = "none";
	}
}

compare = function(action){

	selection = getSelection();
	query = "";
	for (i = 0; i < selection.length; i++){
		query += "&selection" + (i + 1) + "=" + selection[i];
	}
	destination = action + "?" + query;	
	
	if (selection.length == 0 ){
		alert("Selectionnez jusqu'à 4 produits");
	}else if (selection.length > 4){
		alert("Vous pouvez comparer 4 produits au maximum");
	}else{
		location.href = destination;
	}
}

switchFormSection = function(selected){

	for (var id = 1; document.getElementById('tab' + id) != null; id++){
		tab = document.getElementById('tab' + id);
		section = document.getElementById('section' + id);
		tab.className = "off";
		section.style.display = "none";			
	}
	for (var id = 1; document.getElementById('tab' + id) != null; id++){
		tab = document.getElementById('tab' + id);
		section = document.getElementById('section' + id);
		if (id == selected){
			tab.className = "on";
			section.style.display = "block";
			section.style.visible = "true";
			section.style.visible = "false";
		}
	}
}



switchFormSection2 = function(selected){

	for (var id = 1; document.getElementById('tab' + id) != null; id++){
		tab = document.getElementById('tab' + id);
		section = document.getElementById('section' + id);
		if (id == selected){
			tab.className = "on";
			section.style.display = "block";
		}else{
			tab.className = "off";
			section.style.display = "none";			
		}
	}
}

discloseSubmenu = function(id){
	submenu = document.getElementById(id);
	submenuOn = document.getElementById(id + "on");
	submenuOff = document.getElementById(id + "off");
	if (submenu.style.display == "none"){
		submenu.style.display = "block";
		submenuOn.style.display = "block";
		submenuOff.style.display = "none";
	}else{
		submenu.style.display = "none";
		submenuOn.style.display = "none";
		submenuOff.style.display = "block";
	}
}

deleteProduct = function(id,published,page,lang){

mess=''
if (lang==1) mess='Cette fiche sera supprimée définitivement'; else mess='This product form will be deleted';
	if (confirm(mess)){
if (page==0) page='';
		window.location = "products?action=delete&id=" + id+"&published="+published+"&page="+page;
	}
}

disableProduct = function(id,published,page){
	if (confirm('Cette fiche sera placée comme brouillon')){
if (page==0) page='';
		window.location = "products?action=disable&id=" + id+"&published="+published+"&page="+page;
	}
}



duplicateProduct = function(id,published,page,lang){
if (lang==1) mess='Cette fiche sera dupliquée'; else mess='This product form will be duplicated';
	if (confirm(mess)){
if (page==0) page='';
		window.location = "products?action=duplicate&id=" + id+"&published="+published+"&page="+page;
	}
}


sendFeedback = function(id){
	if (confirm('Envoyer les remarques par mail ?')){
		window.location = "products?action=feedback&id=" + id;
	}
}

deleteUser = function(id){
	if (confirm('Cet utilisateur sera supprimé définitivement')){
		window.location = "users?action=delete&id=" + id;
	}
}

deleteMatch = function(id){
	if (confirm('Ce match sera supprimé définitivement')){
		window.location = "<?=$GLOBALS['base']?>matches/delete?id=" + id;
	}
}

deleteSubratingLabel = function(id,labelId){
	if (confirm('Ce critère sera supprimé définitivement pour ce label')){
		window.location = "<?=$GLOBALS['base']?>subratings/deleteSubratingLabel?id=" + id+"&labelId="+labelId;
	}
}

deleteSubrating = function(id){
	if (confirm('Ce critère sera supprimé définitivement')){
		window.location = "<?=$GLOBALS['base']?>subratings/delete?id=" + id;
	}
}


deleteCategory = function(id){
	if (confirm('Cette catégorie sera supprimée définitivement')){
		window.location = "categories?action=delete&id=" + id;
	}
}

deleteArticle = function(id){
	if (confirm('Cet article sera supprimée définitivement')){
		window.location = "articles?action=delete&id=" + id;
	}
}

deleteNew = function(id){
	if (confirm('Cette actualité sera supprimée définitivement')){
		window.location = "news?action=delete&id=" + id;
	}
}

deleteCompany = function(id){
	if (confirm('Cette entreprise sera supprimée définitivement')){
		window.location = "companies?action=delete&id=" + id;
	}
}

function updateTotalRating(){
	total = 0;
	ratings = 0;
	for (i = 1; i <=3; i++){
		if (document.getElementById("rating" + i + 'enabled').checked == false){
			ratings++;
			total += parseInt(document.getElementById("rating" + i).value);
			
		}
	}
	
	if (ratings == 0){
		document.getElementById("rating4").value = 0;
	}
	
	document.getElementById("rating4").value = Math.round(total / ratings);
}

//ouvre les box précisions
function changeSubrating(themeId,lifecycleId,key){

		if (document.getElementById("rating" + themeId + '-' + lifecycleId + '-' +  key).checked == true){
			document.getElementById("precisions" + themeId + '-' + lifecycleId + '-' +  key).style.display="block";
		}else{
			document.getElementById("precisions" + themeId + '-' + lifecycleId + '-' +  key).style.display="none";
		}
		
	//on calcule la somme des points par theme : environnement, santé, qualité, social et éthique
		 liveRating(themeId);
}

function liveRating(themeId){
	total = 0;
	//si environnement balayer les 12 cycles de vie sinon non
	if (themeId==1) {
	for(lifecycleId=1; lifecycleId<=12; lifecycleId++){
	
	for (i = 0; document.getElementById("rating" + themeId + '-' +lifecycleId + '-' + i) != null; i++){
	
		if (document.getElementById("rating" + themeId + '-' +lifecycleId + '-' + i).checked == true){

			total += parseInt(document.getElementById("rating" + themeId + '-' + lifecycleId + '-' + i + '-points').value);
		//	alert("theme="+themeId+" lifecycle="+lifecycleId+" total="+total);
		}
	}
 }
	}
else {
	for (i = 0; document.getElementById("rating" + themeId + '-0-' + i) != null; i++){
	
		if (document.getElementById("rating" + themeId + '-0-' + i).checked == true){

			total += parseInt(document.getElementById("rating" + themeId + '-0-' + i + '-points').value);
		//	alert("theme="+themeId+" lifecycle="+0+" total="+total);
		}
	}
	
}

	document.getElementById("rating" + themeId).value = total;

	
//	updateTotalRating();
}

      function initialize(x,y,name,libelle) {
        var myOptions = {
          center: new google.maps.LatLng(x,y),
          zoom: 8,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
        
 
		deleteOverlays();
	
		var myWindowOptions = {
		content: libelle+' <br/> par <b>'+name+'</b>'
		};
	//creation de la fenetre
	var myInfoWindow = new google.maps.InfoWindow(myWindowOptions);

		var myLatlng = new google.maps.LatLng(x,y);
		var marker = new google.maps.Marker({
		  position: myLatlng,
		  title : libelle+' par '+name,
		  icon: 'http://www.ecocompare.com/images/ecoacteurs/pointeur.png'
		});
		
		google.maps.event.addListener(marker, 'click', function() {
			myInfoWindow.open(map,marker);
		});

		markersArray.push(marker);

	
		
		
		showOverlays();
      }
	  
	  // Removes the overlays from the map, but keeps them in the array
		function clearOverlays() {
		  if (markersArray) {
			for (i in markersArray) {
			  markersArray[i].setMap(null);
			}
		  }
		}

		// Shows any overlays currently in the array
		function showOverlays() {
		  if (markersArray) {
			for (i in markersArray) {
			  markersArray[i].setMap(map);
			}
		  }
		}
		
		// Deletes all markers in the array by removing references to them
		function deleteOverlays() {
		  if (markersArray) {
			for (i in markersArray) {
			  markersArray[i].setMap(null);
			}
			markersArray.length = 0;
		  }
		}