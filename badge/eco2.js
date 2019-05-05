/**######################################### Mise en place du webservice ###########################################**/
function ecocompare_getxhr(url){
		var xhReq;
		if (window.XMLHttpRequest)
			xhReq = new XMLHttpRequest(); 
		else if (window.ActiveXObject)
			xhReq = new ActiveXObject("Microsoft.XMLHTTP"); 
		xhReq.open("GET", url , false);
		xhReq.send(null);
		console.log(xhReq.responseText);
		return xhReq.responseText;
	}


var idpdt = document.getElementById("ecocompare_idpdt").value;
var code = document.getElementById("ecocompare_code").value;
var domaine = window.location.host;
var chemin_client = window.location.pathname;
var cheminServeur = "http://ecocompare.com/badge/";

//var verification = ecocompare_getxhr(cheminServeur+"insertView.php?id_pdt="+idpdt+"&code="+code+"&chemin_client="+chemin_client+"&domaine="+domaine);
//var etat = JSON.parse(verification);
//if(etat =="valide"){
	var mydiv = document.getElementById("vueEcocompare");
	var box = new ecocompare_lightbox;
	var infosProduit = new ecocompare_produit(idpdt, cheminServeur);
	var ecocompare = new vueEcocompare(idpdt, cheminServeur, infosProduit); 
	ecocompare.init(mydiv); 
//}

/**########################################## Classes du webservice ##############################################**/
function outils(){

	this.arrondir_demi = function(valeur){
		return (Math.round(valeur*2)/2);
	}

	this.getXHR = function(url){
		var xhReq;
		if (window.XMLHttpRequest)
			xhReq = new XMLHttpRequest(); 
		else if (window.ActiveXObject)
			xhReq = new ActiveXObject("Microsoft.XMLHTTP"); 
		xhReq.open("GET", url , false);
		xhReq.send(null);
		//console.log(xhReq.responseText);
		return xhReq.responseText;
	}
}

/* Effectue les requetes concernant le produit */
function ecocompare_produit(id, base){

	var idpdt = id;
	var req = new outils();
	var cheminserveur = base;

	this.getProduit = function(){
		var produit = req.getXHR(cheminServeur + "getProduct.php?id="+ idpdt);
		var product = JSON.parse(produit);
		return product;
	}
	
	this.getDetailNotation = function(typeNote){
		var xhr = req.getXHR(cheminServeur + "getNotation.php?typeNote="+ typeNote+"&id="+ idpdt);
		//console.log(xhr);
		var data = JSON.parse(xhr);
		return data;
	}
	
	this.insertAvis = function(textarea, numquestion){
		var avis = document.getElementById(textarea);
		req.getXHR(cheminServeur + "addAvis.php?id="+ idpdt +'&avis='+avis.value+'&numquestion='+numquestion);
		var zone = document.getElementById("question"+numquestion);
		zone.innerHTML = "<label style='text-align: center;' >Merci! Votre r&eacuteponse a bien été envoy&eacute;e.</label>";
		zone.className = "ecocompareSansBordure";
	}
}

/* Gere le fonctionnement de la lightbox */
function ecocompare_lightbox(){

	this.gradient = function(id, level){
		var box = document.getElementById(id);
		box.style.opacity = level;
		box.style.MozOpacity = level;
		box.style.KhtmlOpacity = level;
		box.style.filter = "alpha(opacity=" + level * 100 + ")";
		box.style.display="block";
		return;
	}

	this.fadein = function(id){
		var level = 0;
		while(level <= 1){
			setTimeout( "gradient('" + id + "'," + level + ")", (level* 1000) + 10);
			level += 0.01;
		}
	}

	this.openbox = function(fadin){
		var box = document.getElementById('box'); 
		document.getElementById('shadowing').style.display='block';
		if(fadin){
			gradient("box", 0);
			fadein("box");
		}
		else{ 	
		box.style.display='block';
		}  	
	}

	this.closebox = function(){
		document.getElementById('box').style.display='none';
		document.getElementById('shadowing').style.display='none';
	}
}

/* classe principale : insert tous les elements au chargement du fichier html */
function vueEcocompare(id, base, prod){	
	var idpdt = id;
	var cheminServeur = base; 
	var infosProduit = prod;
	this.afficheDetail = function(data, typeNote){
		if(typeNote==0||typeNote==1){
		var txt ='<div class="detail_ecocompare">';
			if(data.length){
				for(var i=0;i<data.length;i++){
					var v = data[i];
					txt += "<span class='catCritere'><input class='boutonexpand' type='image' src='"+cheminServeur+"img/expand.png' onClick='ecocompare.derouler(this.parentNode, this)' >&nbsp;"+v.name +"</span>";
					txt += "<span class='invisible'>";
					for(var j=0;j<v.subrating.length;j++){
						var v2 = v.subrating[j];
						txt += '<span class="critere"><img src="'+cheminServeur+'img/subrating.png" >' +v2.name+'</span>';
						if(v2.islabel=="1"){
							for(var k=0; k<v2.subratingslabel.length;k++){ 
								var v3 = v2.subratingslabel[k];
									txt += '<span class="verif"><img src="'+cheminServeur+'img/subrating.png" >'+v3.comment+'</span>';
							}
						}
						else{
							switch(v2.ask_proof){
								case "0":
									txt += '<span class="verif">'+v2.comment+'</span>';
								break;
								case "1":
									txt += '<span class="verif">Photo ou preuve fournie</span>';
								break;
								case "2":
									txt += '<span class="verif">Attestation sur l\'honneur fournie</span>';
								break;
							}
						}
					}							
					txt += "</span></span></span>";
				}
			}
			else{
				txt = '<p>Désolé.<br>Nous n\'avons pas d\'informations supplémentaires concernant cette note.</p>';
			}
		}
		//Display Sante
		if(typeNote==2){
			if(data.length){
				txt = "<div class='detail_ecocompare' ><div class='titreSante'>Sant&eacute;</div>";
				for(var i=0;i<data.length;i++){
					var v = data[i];
					txt += '<span class="critere"><img src="'+cheminServeur+'img/subrating.png" >' + v.name+'</span>';;
					if(v.islabel=="1"){
						for(var j=0; j<v.subratingslabel.length;j++){
							var v2 = v.subratingslabel[j];
							txt += '<span class="verif"><img src="'+cheminServeur+'img/subrating.png" >'+v2.comment+'</span>';
						}
					}
					else{
						switch(v.ask_proof){
							case "0":
								txt += '<span class="verif">'+v2.comment+'</span>';
							break;
							case "1":
								txt += '<span class="verif">Photo ou preuve fournie</span>';
							break;
							case "2":
								txt += '<span class="verif">Attestation sur l\'honneur fournie</span>';
							break;
						}
					}
				}
			}
			else{
				txt = '<p>Désolé.<br>Nous n\'avons pas d\'informations supplémentaires concernant cette note.</p>';
			}	
		}
		txt += '</div>';
		return txt;
	}
	
	this.entree = function(elm){
		if(elm.className != 'encours')
			elm.className = 'entree';
	}

	this.sortie = function(elm){
		if(elm.className != 'encours')
			elm.className = 'sortie';
	}

	this.afficheOnglet = function(elm, idconteneur){
		var nom = "ecocompare_onglet";
		for (var i=1; i < 7 ; i++){
			var monOnglet = document.getElementById(nom + i);
			monOnglet.className = 'sortie';
		}
		elm.className = 'encours';
		
		nom = "ecocompare_contenu";
		for (var j=1; j < 7 ; j++){
			var monOnglet = document.getElementById(nom + j);
			monOnglet.className = 'invisible';
		}
		var conteneur = document.getElementById(idconteneur);
		conteneur.className = 'ecocompare_contenu_onglet';	
	}

	this.derouler = function(parent, bouton){
		if(parent.nextSibling.className == 'visible'){
			parent.nextSibling.className = 'invisible';
			bouton.src = cheminServeur+"img/expand.png";
		}
		else{
			parent.nextSibling.className = 'visible';
			bouton.src = cheminServeur+"img/reduire.png";
		}
	}

	this.affValider = function(textArea, boutonId){
		var bouton = document.getElementById(boutonId);
		if(textArea.value != "")
			bouton.className = "ecocompare_button_avis";
		else
			bouton.className = "invisible";
	}
	
	this.init = function(mydiv){
		var produit = infosProduit.getProduit();
		if(produit["published"] == "true"){
		var detailEnv = infosProduit.getDetailNotation(0);
		var detailSocietal = infosProduit.getDetailNotation(1);
		var detailSante = infosProduit.getDetailNotation(2);
		var outil = new outils();
		var ecocompare_theme = document.getElementById("ecocompare_theme");
		var ecocompare_personnaliser = document.getElementById("ecocompare_personnaliser");
		var contenu = '<link type="text/css" rel="stylesheet" href="'+cheminServeur+'css/ecocompare_lightbox.css">';
		var personnalisation = false;
		if(ecocompare_personnaliser == null){
			contenu += '<link type="text/css" rel="stylesheet" href="'+cheminServeur+'css/badge_classique.css">';
		}else{
			personnalisation = true;
		}


		contenu += '<link type="text/css" rel="stylesheet" href="'+cheminServeur+'css/ecocompare_contenu.css">';
		contenu += '<link type="text/css" rel="stylesheet" href="'+cheminServeur+'css/ecocompare_menu.css">';
		contenu += '<link type="text/css" rel="stylesheet" href="'+cheminServeur+'css/ecocompare_detail.css">';
		contenu += '<div id="ecocompare_webservice" >';
		contenu += '<div id="shadowing" onClick="box.closebox();"></div>';
			/**DEBUT : badge **/
			contenu += '<div id="badge_encart"><div id="badge_bandeau_sup2" class="badge_bandeau_sup"><img src="'+cheminServeur+'img/logoEcocompare.gif" class="logoBadge" /></div>';
			contenu += '<div style="color : black;" class="notes">';
				contenu += '<table id="badge_table" cellpadding="0" cellspacing="0" style="margin-top : 0; margin-bottom : 0;width : 230px; margin-left:auto;margin-right:auto;border : none;"> ';
					contenu += '<tr><td id="badge_l1">Environnement</td><td>&nbsp;<img src="' + cheminServeur + 'img/gauges/gauge' + outil.arrondir_demi(produit["score1"]) +'.gif" style="margin : 0;padding:0;max-width : 120px;"/></td></tr> ';
					contenu += '<tr><td id="badge_l2">Soci&eacute;tal</td><td>&nbsp;<img src="' + cheminServeur + 'img/gauges/gauge' + outil.arrondir_demi(produit["score2"]) +'.gif" style="margin : 0;padding:0;max-width : 120px;"/></td></tr> ';
					contenu += '<tr><td id="badge_l3">Sant&eacute;</td><td>&nbsp;<img src="' + cheminServeur + 'img/gauges/gauge' + outil.arrondir_demi(produit["score3"]) +'.gif" style="margin : 0;padding:0;max-width : 120px;"/></td></tr> ';
				contenu += '</table> ';
				contenu += '<div id="badge_bandeau_inf" class="badge_bandeau_inf"><table style="margin-left : 8px;border : none;" cellpadding="0" cellspacing="0" ><tr><td class="badge_titre"><label id="ecocompare_globale1" class="ecocompare_globale1" style ="font-size : 12px;">Note globale</label></td><td class="badge_note1 ecocompare_globale1 " id="ecocompare_globale2" >&nbsp;'+ produit["score4"]+'</td><td  id="ecocompare_globale3" class="badge_note1 ecocompare_globale2"> &nbsp;/ 5 </td><td>&nbsp;<label  id="ecocompare_globale4" class="badge_savoir_plus ecocompare_globale1">En savoir&nbsp;</label><a href="#" onclick="box.openbox(0)"><img title="Voir le d&eacute;tail pour ce produit" src="'+ cheminServeur+'img/plus.gif" class="badge_plus" /></a></td></tr></table> ';
			contenu += '</div></div></div>';

			/**FIN : badge **/
			/**DEBUT : contenu de la lightbox **/
			contenu += '<div id="box"><div class="badge_bandeau_sup" id="ecocompare_bandeau_sup">';
				contenu += '<img class="boxheader" src="'+ cheminServeur + 'img/popupEcocompare.png" /></div>';

				/* onglets du menu */		
				contenu += '<div id="ecocompare_navigation">';
					contenu += '<div class="encours" id="ecocompare_onglet1" onmouseover="ecocompare.entree(this);" onmouseout="ecocompare.sortie(this);" onclick="ecocompare.afficheOnglet(this, \'ecocompare_contenu1\');" >&nbsp;Global&nbsp;</div>';
					contenu += '<div class="ecocompare_onglet" id="ecocompare_onglet2" onmouseover="ecocompare.entree(this);" onmouseout="ecocompare.sortie(this);" onclick="ecocompare.afficheOnglet(this, \'ecocompare_contenu2\');" >&nbsp;Environnement&nbsp;</div>';
					contenu += '<div class="ecocompare_onglet" id="ecocompare_onglet3" onmouseover="ecocompare.entree(this);" onmouseout="ecocompare.sortie(this);" onclick="ecocompare.afficheOnglet(this, \'ecocompare_contenu3\');">&nbsp;Soci&eacute;tal&nbsp;</div>';
					contenu += '<div class="ecocompare_onglet" id="ecocompare_onglet4" onmouseover="ecocompare.entree(this);" onmouseout="ecocompare.sortie(this);" onclick="ecocompare.afficheOnglet(this, \'ecocompare_contenu4\');">&nbsp;Sant&eacute;&nbsp;</div>';
					contenu += '<div class="ecocompare_onglet" id="ecocompare_onglet5" onmouseover="ecocompare.entree(this);" onmouseout="ecocompare.sortie(this);" onclick="ecocompare.afficheOnglet(this, \'ecocompare_contenu5\');">&nbsp;Avis&nbsp;</div>';
					contenu += '<div class="ecocompare_onglet" id="ecocompare_onglet6" onmouseover="ecocompare.entree(this);" onmouseout="ecocompare.sortie(this);" onclick="ecocompare.afficheOnglet(this, \'ecocompare_contenu6\');">&nbsp;Infos&nbsp;</div>';
				contenu += '</div><div class="line" /></div></br>';	
				/* contenus des onglets */
					/*Global*/
				var nblabels = (produit["labels"]).length;
				if (nblabels > 1)
					var libelle = "Labels ";
				else if ( nblabels == 1 )	
					var libelle = "Label "; 
				var labels = " ";	
				var referentiellabel = "";
				for(var i=0;i<nblabels;i++){
					referentiellabel = "";
					if (produit["labels"][i]["referentiel"] != "") referentiellabel = " - "+ produit["labels"][i]["referentiel"];
					labels += '<img title="'+produit["labels"][i]["name"]+referentiellabel+".  "+ produit["labels"][i]["description"]+'"  alt="'+produit["labels"][i]["name"]+'"  src="http://ecocompare.com/images/labels_16/'+ produit["labels"][i]["image"]+'" />&nbsp;&nbsp;&nbsp;';		
				}
				contenu += '<div class="ecocompare_contenu_onglet" id="ecocompare_contenu1">';
					contenu += '<div><span class="ecocomparec1" style="font-size : 17px;vertical-align : top;">Ecocompare : &nbsp;&nbsp;&nbsp;</span><div class="ecocomparec2" style="display: inline-block; width : 75%;">L\'outil qui r&eacutef&eacute;rence gratuitement les produits de grande consommation après en avoir &eacute;valué scientifiquement les impacts environnementaux, sanitaires et soci&eacute;taux &agrave; destination des marques, entreprises et consommateurs.</div></div></br>';
					contenu += '<table style="height : 50px;" cellpadding="0" cellspacing="0" style="width : 100%;">';
						contenu += '<tr><td  class="ecocomparec1" style="vertical-align : top;width : 100px; font-size : 17px;">Produit&nbsp;&nbsp;&nbsp; </td>';
						contenu += '<td class="ecocomparec3"  style="vertical-align : top;font-size : 17px;" colspan=2><span class="ecocomparec1" >: </span>'+produit["name"]+'</td></tr>';
					contenu += '</table>';
					contenu += '<table cellpadding="0" cellspacing="0" style=" width : 100%;">';
						contenu += '<tr>';
							contenu += '<td  class="ecocomparec1" style="vertical-align : top; width : 85px;font-size : 17px;"></br>Fabricant</td>';
							contenu += '<td class="ecocomparec3" style="vertical-align : top; width : 270px; font-size : 17px;"></br><span  class="ecocomparec1" >: </span>'+produit["brand"]+'</td>';
							contenu += '<td  class="ecocomparec3" style="vertical-align : top; width : 150px; font-size : 17px;"></br><label style="font-size:20px;">Note globale :</label></td>';
						contenu += '</tr><tr>';
							contenu += '<td  class="ecocomparec1" style="width : 85px;font-size : 17px;"></br>'+libelle+'</td>';
							contenu += '<td  class="ecocomparec3" style="width : 270px; font-size : 17px;"></br><span  class="ecocomparec1" >: </span>'+labels+'</td>';
							contenu += '<td style="vertical-align : top;width : 150px;font-size : 17px;"></br><label  class="ecocomparec1" style="font-size : 45px;">'+ produit["score4"]+'</label><label class="ecocomparec4" style="font-size : 45px;display : inline;"> / 5  </label></td>';
						contenu += '</tr>';
					contenu += '</table>';
				contenu += '</div>';
					/*Environnement*/
				contenu += '<div class="invisible" id="ecocompare_contenu2">';
					contenu += '<div id="ecocompare_detail0_texte" class="ecocompare_detail_texte">';
						contenu += '<span>'+this.afficheDetail(detailEnv, 0);+'</span>';
					contenu += '</div>';
					contenu += '<div class="ecocompare_detail_note">';
						contenu += '<div  class="ecocomparec1"  style="text-align : center; font-size : 20px;"> Note </br> Environnement : </br></div></br>';
						contenu += '<div  class="ecocomparec1" style="font-size : 45px; text-align : center;" ><span>'+ produit["score1"]+'</span><span class="ecocomparec4" > / 5 </span></div>';					
					contenu += '</div>';					
				contenu += '</div>';
					/*Sociétal*/
				contenu += '<div class="invisible" id="ecocompare_contenu3">';
					contenu += '<div id="ecocompare_detail1_texte" class="ecocompare_detail_texte">';
						contenu += '<span>'+this.afficheDetail(detailSocietal, 1);+'</span>';
					contenu += '</div>';
					contenu += '<div class="ecocompare_detail_note">';
						contenu += '<div class="ecocomparec1"  style="text-align : center; font-size : 20px;"> Note </br> Soci&eacute;tale : </br></div></br>';
						contenu += '<div  class="ecocomparec1" style="font-size : 45px; text-align : center;" ><span>'+ produit["score2"]+'</span><span class="ecocomparec4" > / 5 </span></div>';					
					contenu += '</div>';
				contenu += '</div>';
					/*Santé*/
				contenu += '<div class="invisible" id="ecocompare_contenu4">';
					contenu += '<div id="ecocompare_detail2_texte" class="ecocompare_detail_texte">';
						contenu += '<span>'+this.afficheDetail(detailSante , 2);+'</span>';
					contenu += '</div>';
					contenu += '<div class="ecocompare_detail_note">';
						contenu += '<div class="ecocomparec1"  style="text-align : center;font-size : 20px;"> Note </br> Sant&eacute; : </br></div></br>';
						contenu += '<div  class="ecocomparec1" style="font-size : 45px; text-align : center;" ><span>'+ produit["score3"]+'</span><span class="ecocomparec4" > / 5 </span></div>';					
					contenu += '</div>';
				contenu += '</div>';
					/*Avis*/
				contenu += '<div class="invisible" id="ecocompare_contenu5">';
					contenu += '<label> Ces infos vous ont-elles guid&eacute; lors de votre acte d\'achat ? Pourquoi ?</label></br></br>';
					contenu += '<div id="question1" class="ecocompare_div_avis">';
						contenu += '<textarea onkeyup="ecocompare.affValider(this, \'ecocompare_valider1\');" id="ecocompare_influence" class="ecocompare_area_avis" ></textarea>';
						contenu += '<div id="ecocompare_valider1" class="invisible" >';
							contenu += '<input onClick="infosProduit.insertAvis(\'ecocompare_influence\', 1 )" id="ecocompare_influence_button" type="image" style="margin-bottom : -6px;" src="'+cheminServeur+'img/valider.gif" /></br>';
							contenu += '<span style="font-size : 10px;">valider</span>';
						contenu += '</div>';
					contenu += '</div></br></br>';
					contenu += '<label> Que pensez-vous de cet &eacute;co-comparateur ?</label></br></br>';
					contenu += '<div id="question2" class="ecocompare_div_avis">';
						contenu += '<textarea onkeyup="ecocompare.affValider(this, \'ecocompare_valider2\');" id="ecocompare_avis" rows="3" class="ecocompare_area_avis" ></textarea>';
						contenu += '<div id="ecocompare_valider2" class="invisible" >';
							contenu += '<input onClick="infosProduit.insertAvis(\'ecocompare_avis\', 2 )" style="margin-bottom : -6px;" type="image" src="'+cheminServeur+'img/valider.gif" value="valider" /></br>';
							contenu += '<span style="font-size : 10px;">valider</span>';
						contenu += '</div>';
					contenu += '</div></br></br>';
					contenu += '<label> Am&eacute;liorez-nous en 30 secondes !&nbsp;</label><input class="amelioration" type="image" src="'+cheminServeur+'img/plus.gif" /></br></br>';
				contenu += '</div>';
					/*Infos*/
				contenu += '<div class="invisible" id="ecocompare_contenu6">';
					contenu += '<table class="liensInfos">';
						contenu += '<tr><td style="text-align : left;width : 300px;">En savoir plus sur ecocompare</td><td><a href="http://www.ecocompare.com/Pourquoi-Ecocompare.html" target="_blank"><img src="'+cheminServeur+'img/onglet6plus.gif" class="ecocompare_plus_lien"/></a> </td></tr>';
						contenu += '<tr><td>En savoir plus sur la m&eacutethodologie</td><td><a href="http://www.ecocompare.com/Methodologie.html" target="_blank"><img src="'+cheminServeur+'img/onglet6plus.gif" class="ecocompare_plus_lien"/></a> </td></tr>';
						contenu += '<tr><td>Autres produits r&eacute;f&eacute;renc&eacute;s</td><td> <a href="http://www.ecocompare.com/selection.html" target="_blank"><img src="'+cheminServeur+'img/onglet6plus.gif" class="ecocompare_plus_lien"/></a> </td></tr>';
					contenu += '</table></br></br></br>';
					contenu += '<table style="text-align : center;width : 100%;">';
						contenu += '<tr>';
							contenu += '<td><a href="mailto:contact@ecocompare.com"><img src="'+cheminServeur+'img/mail.gif" class="ecocompare_contact"/></a></td>';
							contenu += '<td><a href="http://twitter.com/ecocompare" target="_blank"><img src="'+cheminServeur+'img/twitter.gif" class="ecocompare_contact"/></a></td>';
							contenu += '<td><a href="http://www.facebook.com/ecocompare" target="_blank"><img src="'+cheminServeur+'img/facebook.gif" class="ecocompare_contact"/></a></td>';
						contenu += '</tr>';
						contenu += '</tr><td>Mail</td><td>Twitter</td><td>Facebook</td></tr>';
					contenu += '</table>';
				contenu += '</div>';
			contenu += '</div>';
			/**FIN : contenu de la lightbox **/
		contenu +=	'</div>  <div style ="clear : both;"></div>';
		mydiv.innerHTML += contenu;
									
				if(personnalisation===true){
					document.getElementById("badge_bandeau_sup2").style.background= ecocompare_personnaliser.value;
					document.getElementById("ecocompare_bandeau_sup").style.background= ecocompare_personnaliser.value;

					if(ecocompare_personnaliser.name == "2"){
						document.getElementById("badge_bandeau_inf").style.background= ecocompare_personnaliser.value;
						
						var $r = parseInt(ecocompare_personnaliser.value.substr(1,2), 16);
						var $g = parseInt(ecocompare_personnaliser.value.substr(3,2), 16);
						var $b = parseInt(ecocompare_personnaliser.value.substr(5,2), 16);
						if($r + $g + $b > 382){
							//couleur claire => texte foncé
							 document.getElementById("ecocompare_globale1").style.color = "black";
							 document.getElementById("ecocompare_globale2").style.color = "black";
							 document.getElementById("ecocompare_globale3").style.color = "black";
							 document.getElementById("ecocompare_globale4").style.color = "black";
						}else{
							//couleur foncée => texte clair	
							 document.getElementById("ecocompare_globale1").style.color = "white";
							 document.getElementById("ecocompare_globale2").style.color = "white";
							 document.getElementById("ecocompare_globale3").style.color = "white";
							 document.getElementById("ecocompare_globale4").style.color = "white";
						}
						
					}else{
						document.getElementById("badge_bandeau_inf").style.background="none";
						document.getElementById("ecocompare_globale1").style.color = "black";
						document.getElementById("ecocompare_globale2").style.color = "black";
						document.getElementById("ecocompare_globale3").style.color = "#a9a9a9";
						document.getElementById("ecocompare_globale4").style.color = "black";
					}
				}
		}else{
			mydiv.innerHTML = "Ce produit n'est pas publié."
		}		
	}
}