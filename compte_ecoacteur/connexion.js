var domainName = "http://www.ecocompare.com";
//var domainName = "http://projets2.idnext.net/ecocompare";



function getXHR(url){
	var xhReq;
	if (window.XMLHttpRequest)
		xhReq = new XMLHttpRequest(); 
	else if (window.ActiveXObject)
		xhReq = new ActiveXObject("Microsoft.XMLHTTP"); 
	xhReq.open("GET", url , false);
	xhReq.send(null);
	return xhReq.responseText;
}

function checkUser(url){
	var diverror = document.getElementById("msgerreur");
	var email = document.getElementById("mail").value;
	var password = document.getElementById("pwd").value;
	var responsetext = getXHR(domainName+"/compte_ecoacteur/connexionClassique.php?email="+email+"&pwd="+password);
	var authentification = JSON.parse(responsetext);
	if (authentification == "errone"){
		diverror.innerHTML = "Adresse email ou mot de passe invalide";
	}
	else if (authentification == "inconnu"){
		diverror.innerHTML = "Adresse email inconnue";
	}
	else if (authentification == "ok"){	
		if(typeof(url)==='undefined'){
				window.top.location.href=domainName+"/espace-eco-acteur.html";
		}
		else{
		
			window.top.location.href=domainName+'/'+url;
		}
	}

}

function checkUserFacebook(me){
	var user = getXHR("cnx_inscriptionFacebook.php?email="+me["email"]+"&id="+me["id"]+"&name="+me["name"]+"&gender="+me["gender"]);
	var session = getXHR("creationSession.php?user="+user+"&typecnx=1");
	window.top.location.href=domainName+"/espace-eco-acteur.html";
}


function inscriptionClassique(){
	var email = document.getElementById('mail');
	var pwd = document.getElementById('pwd');
	var isvalid = testChamps(email, pwd);

	if (isvalid == "ok"){
		var responsetext = getXHR("inscriptionClassique.php?email="+email.value+"&pwd="+pwd.value);
		var res = JSON.parse(responsetext);
		var msg = document.getElementById("msgerreur");
		
		if(res == "0"){
			msg.innerHTML = "Cette adresse email est d&eacute;j&agrave; utilis&eacute;."
		}else if (res == "1"){
			msg.innerHTML = "L'email de confirmation va vous être ré-envoy&eacute;";
		}else{
			msg.innerHTML = "Votre inscription à bien été prise en compte. Un lien de confirmation va vous être envoyé par mail.";
		}
	}else{
		var diverror = document.getElementById("msgerreur");
		diverror.innerHTML = isvalid;
	}
}

function testChamps(email, pwd){
	var reg = new RegExp('^[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*@[a-z0-9]+([_|\.|-]{1}[a-z0-9]+)*[\.]{1}[a-z]{2,6}$', 'i');
	if(reg.test(email.value) && (pwd.value!=""))
		return "ok";
	else {
		var msg="";
		if(email.value!=''){
			if(!reg.test(email.value)){
				msg += 'Veuillez saisir une adresse email valide.</br>';
			}
		}else{
			msg += 'Veuillez remplir le champ email.</br>';
		}
		if(pwd.value!=''){
			if(pwd.length<4){
				msg += 'Votre mot de passe doit contenir au moins 4 caractères.</br>';
			}
		}else{
			msg += 'Veuillez remplir le champ mot de passe.';
		}	
		
		return msg;
	}
}
