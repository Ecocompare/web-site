/* Directory config */
var base = ""; //Main directory
var url = "mobile/"; //Web Service directory
var url2 = "compte_ecoacteur/"; //Web Service directory


function getProduct(id){
	var url = base + 'getProduct.php';
	$.ajax({
		url: url,
		data:{id: id,},
		contentType:'application/json',
		dataType: 'json',
		type:'GET',
		success: function(data){
			product(data);
		},
		error: function(){
			console.log('Error');
		}
	});
}


function getProductEan(ean){
	var url = 'mobile/getProductEan.php';
	$.ajax({
		url: url,
		data:{ean: ean,},
		contentType:'application/json',
		dataType: 'json',
		type:'GET',
		success: function(data){		
			product(data);

		},
		error: function(){
			alert("erreur");;
		}
	});
}

function product(data){
	if(data.name && (data.published == "true")){
		window.location.href= toURL(data.name)+'_p'+data.id+'.html';	
	}else{
		if(data!=false){
			msg.innerHTML='<p>Nous ne disposons pas encore d\'informations de la part de la marque pour ce produit.</p>';
		}
		else{
			msg.innerHTML='<p>Ce produit n\'existe pas encore dans notre base de données.</p>';
		}
	}
}


function toURL(str) {
  str = str.replace(/^\s+|\s+$/g, '');  
  var from = "àáäâèéëêìíïîòóöôùúüûñç& ·/_,:;";
  var to   = "aaaaeeeeiiiioooouuuunc--------";
  for (var i=0, l=from.length ; i<l ; i++) {
	str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
  }
  return str;
}

function resendValidationMail(iduser){
	$.ajax({
		url: 'mobile/checkUser.php',
		data:{id: iduser,resend: true},
		contentType:'application/json',
		dataType: 'json',
		type:'GET',
		success: function(){
			alert('Un mail de validation vous a été envoyé. Vous allez maintenant être déconnecté.');
		},
		error: function(){
			alert("probleme");
		}
	});
}


/**
 * setuserInfo()
 * Update information for the current connected User
 * Required : name
 * 			: gender
 * 			: postalcode
 */
function setUserInfo(id){
	var name = document.getElementById('name').value;
	var gender = document.getElementById('gender').value;
	var tel = document.getElementById('tel').value;
    var birthyear = document.getElementById('birthyear').value;
    var ville = document.getElementById('ville').value;
    var postalcode = document.getElementById('postalcode').value;
    var address = document.getElementById('address').value;
    var job = document.getElementById('job').value;
    var child = document.getElementById('child').value;
    var description = document.getElementById('description').value;
    
    //Check value info before ajax send
    var errors = [];
    var checkMailParrain= new RegExp("^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$","g");
    var checkName= new RegExp("^[a-zA-Z0-9]+[ \-']?[[a-zA-Z0-9]+[ \-']?]*[a-zA-Z0-9]+$","g");
    var checkTel = new RegExp("^0[1-9]((\\s|\.|-)?[0-9]{2}){4}$","g");
    var checkPostalCode = new RegExp("^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$","g");
    
	if(name!=''){
		if(!checkName.test(name)){
			errors.push('Veuillez saisir un prénom et nom valide');
		}
	}else{
		errors.push('Veuillez remplir le champ Nom Prénom');
	}
   	if(birthyear!=''){
   		//test année en cours
   		var date = new Date();
   		if((birthyear<1900)||(birthyear>date.getFullYear())){
   			errors.push('Veuillez saisir une année de naissance cohérente');
   		}
   	}else{
   		errors.push('Veuillez remplir le champ Année de naissance');
   	}
   	if(tel!=''){
   		if(!checkTel.test(tel)){
   			errors.push('Veuillez saisir un numéro de téléphone valide');
   		}
   	}
   	if(postalcode!=''){
   		if(!checkPostalCode.test(postalcode)){
   			errors.push('Veuillez entrez un code postal valide');
   		}
   	}else{
   		errors.push('Veuillez remplir le champ Code postal');
   	}
    
   	if(errors.length>0){
   		$('.box-notif.error').remove();
   		var txt = '<div class="box-notif error">';
   		for(var i=0; i<errors.length; i++){
   			txt += errors[i]+'<br>';
   		}
   		txt += '</div>';
   		$('.box-notif.information').before(txt);
   		$('.box-notif.information').css('display','none');
		window.top.window.scrollTo(0,0);
   	}else{
	    $.ajax({
	    	url: url2 + 'updateUserInfo.php',
	    	data:{id: id,name: name,gender: gender, tel: tel, birthyear: birthyear, postalcode: postalcode, ville: ville, address: address, job: job, child: child, description: description},
	    	contentType:'application/json',
	    	dataType: 'json',
	    	type:'GET',
	    	success: function(data){
	    		if(data!=false){
	    			console.log('Données enregistrées avec succés!');
				}
	    	},
	    	error: function(){
	    		console.log('Error');
			},
	    	complete: function(){
	    		window.top.location.href="http://www.ecocompare.com/espace-eco-acteur.html";
	    	}
	    });
   	}
}

/*
 * setUserPassword()
 * Update user password for the current connected User
 */
function setUserPassword(id){
	var pwdnew = document.getElementById('pwdnew').value;
	var pwdbis = document.getElementById('pwdbis').value;
	var errors=[];
	if(pwdnew!=''){
		if(pwdnew.length<4){
			errors.push('Le mot de passe doit au moins contenir 4 caractères.');
		}
	}
	else{
		errors.push('Veuillez remplir le champ de saisie du nouveau mot de passe.');
	}
	if(pwdbis!=''){
		if(pwdbis.length<4){
			errors.push('Le mot de passe doit au moins contenir 4 caractères.');
		}
	}
	else{
		errors.push('Veuillez remplir le champ de confirmation du mot de passe.');
	}
	if(pwdbis!=pwdnew){
		errors.push('Les valeurs ne correspondent pas.');
	}
	if(errors.length>0){
   		$('.error').empty();
   		var txt = '';
   		for(var i=0; i<errors.length; i++){
   			txt += errors[i]+'<br>';
   		}
   		$('.error').append(txt+'<br>');
//		window.top.window.scrollTo(0,0);
   		
   	}else{

		url = 'mobile/setUserPassword.php';
		$.ajax({
		    url: url,
		    data:{id: id,pwd: pwdnew,},
		    contentType:'application/json',
		    dataType: 'json',
		    type:'GET',
		    success: function(data){
		    	if(data!=false){
				   	$('.error').empty();
					$('.ok').empty();
		    		$('.ok').append('Votre mot de passe a été changé avec succès.<br><br>');
		    	}
		    },
		    error: function(){
		    	console.log('Error');
		    }
		 });
	}

}


function resetUserPassword(){
	var errors=[];
	var checkMail= new RegExp("^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$","g");
	var email = document.getElementById('email').value;
	if(email!=''){
		if(!checkMail.test(email)){
			errors.push('Veuillez saisir une adresse email valide');
		}
	}else{
		errors.push('Veuillez remplir le champ email');
	}
	if(errors.length>0){
   		$('#error').empty();
   		var txt = '';
   		for(var i=0; i<errors.length; i++){
   			txt += errors[i]+'<br>';
   		}
   		txt += '</div></br></br>';
   		$('#error').append(txt);
  	}
	else{
		 url = '../mobile/forgotPassword.php';
		    $.ajax({
		    	url: url,
		    	data:{email: email,},
		    	contentType:'application/json',
		    	dataType: 'json',
		    	type:'GET',
		    	success: function(data){
		    		if(data==true){
		    			$(".ok").append('Un mail de réinitialisation vous a été envoyé.');
		    		}
		    		else{
		    			$("#error").append('Cette adresse email ne correspond à aucun compte.');
		    		}
		    	},
		    	error: function(){
		    		console.log('Error');
		    	},
		    });
	}
}


/**
* getUserScans
* @author idnext
* display a historic for 15 last user scans
* Template called : 'userScans'
*/
function getUserScans(id){
	var url = url2 + 'getUserScans.php';
	$.ajax({
		url: url,
		data:{id:id},
		contentType:'application/json',
		dataType: 'json',
		type:'GET',
		success: function(data){
		    userScans(data); 
			dernierScan(data);
			console.log('Success');
		},
		error: function(){
			console.log('Error');
		},
	});
}


/**
 * getUserStats
 * @author idnext
 * get user stats and display medals
 * Template called : 'userStats'
 */
function getUserStats(id){
	var url = base + 'mobile/getUserStats.php';
	$.ajax({
		url: url,
		data:{id: id},
		contentType:'application/json',
		dataType: 'json',
		type:'GET',
		success: function(data){
		    userStats(data);
			console.log('Success');
		},
		error: function(){
			console.log('Error');
		},
	});
}

/**
 * userScans
 * @author idnext
 * @param {String}[] data
 * @description Display the 15 last scans from a user
 */
function userScans(data){
	var html='';
	if(data.length>0){
		$.each(data, function(k, v){
			//reference
			console.log(v.publie);
			if(v.product_id!=0 && v.publie=="true"){		
				html+="<div class='scan-row'>";
			
					html+="<a class='link-area' href='"+toURL(v.description)+'_p'+v.product_id+'.html'+"'>";
						html+="<div class='info'>";
							html+="<div class='lib'><b>"+v.description+"</b></div>";
							html+="<div class='brand'>"+v.marque+"</div>";
							html+="<div class='brand'>"+timeSpent(v.date)+"</div>";
						html+="</div>";
						html+="<div class='status'>";
							html+="<div class='tag ok'>Référencé</div>";
							if(v.produitvert==1){
								html+=" <div class='tag ok'>Responsable</div>";
							}
						html+="</div>";
					html+="</a>";
				html+="</div></br>";
			}else if(v.noresult==1){
				html+="<div class='scan-row'>";
				html+="<div class='info'>";
				html+="<div class='lib'><b>Ean : "+v.ean+"</b></div>";
				html+="<div class='brand'>"+timeSpent(v.date)+"</div>";
				html+="</div>";
				html+="<div class='status'>";
				html+=" <div class='tag never'>Ean non trouvé</div>";
				html+="</div>";
				html+="</div></br>";
			}
			else if(v.noresult==0&&v.description==''){
				html+="<div class='scan-row'>";
				html+="<div class='info'>";
				html+="<div class='lib'><b>Ean : "+v.ean+"</b></div>";
				html+="<div class='brand'>"+timeSpent(v.date)+"</div>";
				html+="</div>";
				html+="<div class='status'>";
				html+=" <div class='tag soon'>Recherche en cours</div>";
				html+="</div>";
				html+="</div></br>";
			}
			else{
				html+="<div class='scan-row'>";
				html+="<div class='info'>";
				html+="<div class='lib'><b>"+v.description+"</b></div>";
				html+="<div class='brand'>"+v.marque+"</div>";
				html+="<div class='brand'>"+timeSpent(v.date)+"</div>";
				html+="</div>";
				html+="<div class='status'>";
				if(v.produitvert==1){
					html+=" <div class='tag ok'>Responsable</div>";
				}
				html+="</div>";
				html+="</div></br>";
			}
		});
	}
	else{
		html+="<div class='box noshadow'><p>Aucun scan à afficher</p></div>";
	}
	
	$(".list_scans").append(html);
}

function dernierScan(data){
	var html='';
	if(data.length>0){

			if(data[0].product_id!=0  && data[0].publie=="true"){		
				html+="<div class='scan-row'>";
					html+="<a class='link-area' href='"+toURL(data[0].description)+"_p"+data[0].product_id+".html'>";
						html+="<div class='info'>";
							html+="<div class='lib'><b>"+data[0].description+"</b></div>";
							html+="<div class='brand'>"+data[0].marque+"</div>";
							html+="<div class='brand'>"+timeSpent(data[0].date)+"</div>";
						html+="</div>";
						html+="<div class='status'>";
							html+="<div class='tag ok'>Référencé</div>";
							if(data[0].produitvert==1){
								html+=" <div class='tag ok'>Responsable</div>";
							}
						html+="</div>";
					html+="</a>";
				html+="</div></br>";
			}else if(data[0].noresult==1){
				html+="<div class='scan-row'>";
				html+="<div class='info'>";
				html+="<div class='lib'><b>Ean : "+data[0].ean+"</b></div>";
				html+="<div class='brand'>"+timeSpent(data[0].date)+"</div>";
				html+="</div>";
				html+="<div class='status'>";
				html+=" <div class='tag never'>Ean non trouvé</div>";
				html+="</div>";
				html+="</div></br>";
			}
			else if(data[0].noresult==0&&data[0].description==''){
				html+="<div class='scan-row'>";
				html+="<div class='info'>";
				html+="<div class='lib'><b>Ean : "+data[0].ean+"</b></div>";
				html+="<div class='brand'>"+timeSpent(data[0].date)+"</div>";
				html+="</div>";
				html+="<div class='status'>";
				html+=" <div class='tag soon'>Recherche en cours</div>";
				html+="</div>";
				html+="</div></br>";
			}
			else{
				html+="<div class='scan-row'>";
				html+="<div class='info'>";
				html+="<div class='lib'><b>"+data[0].description+"</b></div>";
				html+="<div class='brand'>"+data[0].marque+"</div>";
				html+="<div class='brand'>"+timeSpent(data[0].date)+"</div>";
				html+="</div>";
				html+="<div class='status'>";
				if(data[0].produitvert==1){
					html+=" <div class='tag ok'>Responsable</div>";
				}
				html+="</div>";
				html+="</div></br>";
			}
			
			$("#list15").append('<a href="espace-eco-acteur.html?section=derniers_scans">Voir mes 15 derniers scans </a>');
	}
	else{
		html+="<div class='box noshadow'><p>Aucun scan à afficher</p></div>";
	}
	
	$(".dernier_scan").append(html);
}

/**
 * userStats
 * @author idnext
 * @param {String}[] data
 * @description Display the user statistics and medals
 */
function userStats(data){
	var html='';
	if(data){
	//  html+='<div class="box-notif information">Progression</div>';
	  html+='<div class="statrow">Nombre de scans : <strong>'+data.total_scan+'</strong></div>';
	  html+='<div class="statrow">Nombre de scans responsables : <strong>'+data.total_resp_scan+'</strong></div>';
	  html+='<div class="statrow">Nombre de scans ce mois-ci : ';
	  if(data.month_scan == null){
		  html+= '<strong>0<strong>';
	  }
	  else{
		  html+= '<strong>'+data.month_scan+'</strong>';
	  }
	  html+='</div>';
	  html+='<div class="statrow">Nombre de scans responsables ce mois-ci : ';
	  if(data.month_resp_scan == null){
		  html+= '<strong>0<strong>';
	  }
	  else{
		  html+= '<strong>'+data.month_resp_scan+'</strong>';
	  }
	  html+='</div>';
	  html+='<div class="statrow">Nombre de victoires : <strong>'+data.nbwin+'</strong></div>';
		   
		$(".list_stats").append(html);  
		  //display medals
		html="";
		
		if(data.nbwin >= 1 || data.total_resp_scan >= 20){
			html+='<div style="width : 100%;height : 0px;clear : both;"></div></br>  <div class="box medailles">  <div><table><tr><td><div class="sstitre">Mes médailles</div></td></tr>';
		}
		  
		if(data.total_resp_scan >= 20){
			html += '<tr><td>&nbsp;<img style="max-width : 60px;" title="Apprenti : Effectuer 20 scans responsables" src="'+url2+'img/medals/20scanresp.png"/>';
		}
		if(data.total_resp_scan >= 50){
			  html += '&nbsp;<img style="max-width : 60px;" title="Compétent : Effectuer 50 scans responsables" src="'+url2+'img/medals/50scanresp.png"/>';
		}
		if(data.total_resp_scan >= 100){
			  html += '&nbsp;<img style="max-width : 60px;" title="Aguerri : Effectuer 100 scans responsables" src="'+url2+'img/medals/100scanresp.png"/>';
		}
		if(data.total_resp_scan >= 500){
			  html += '&nbsp;<img style="max-width : 60px;" title="Expert : Effectuer 500 scans responsables" src="'+url2+'img/medals/500scanresp.png"/>';
		}
		if(data.total_resp_scan >= 1000){
			  html += '&nbsp;<img style="max-width : 60px;" title="Maître : Effectuer 1000 scans responsables" src="'+url2+'img/medals/1000scanresp.png"/>';
		}
		if(data.nbwin >= 1){
			  html += '&nbsp;<img style="margin-top : 5px;max-width : 60px;" title="Gagnant : Gagner une fois le concours du mois" src="'+url2+'img/medals/1win.png"/>';
		}
		if(data.nbwin > 2){
			  html += '&nbsp;<img style="margin-top : 5px;max-width : 60px;" title="Gladiateur : Gagner 3 fois le concours du mois" src="'+url2+'img/medals/2-4win.png"/>';
		}
		if(data.nbwin >= 5){
			  html += '&nbsp;<img style="margin-top : 5px;max-width : 60px;" title="Dieu du scan : Gagner 5 fois le concours du mois" src="'+url2+'img/medals/5win.png"/>';
		}
		if(data.nbwin >= 1 || data.total_resp_scan >= 20){
			html+='</td></tr></table></div></div>';
		}

	}
	$("#medailles").append(html);
}

//--------------------------------------------------------------------------------------------------------

/**
 * mois
 * @author idnext
 * @param {int} i
 * @description Receive an int and return the matched month in French
 * @returns {String}
 */
function mois(i){
	switch (i) {
	 case 0:
	 return "Janvier";
	 break;
	 case 1:
	 return "Février";
	 break;
	 case 2:
	 return "Mars";
	 break;
	 case 3:
	 return "Avril";
	 break;
	 case 4:
	 return "Mai";
	 break;
	 case 5:
	 return "Juin";
	 break;
	 case 6:
	 return "Juillet";
	 break;
	 case 7:
	 return "Août";
	 break;
	 case 8:
	 return "Septembre";
	 break;
	 case 9:
	 return "Octobre";
	 break;
	 case 10:
	 return "Novembre";
	 break;
	 case 11:
	 return "Décembre";
	 break;
	}
}

/**
 * formatDate
 * @author idnext
 * @param {int} since70
 * @description Receive PHP TimeStamp in milliseconds, adapt for JS in seconds and return date in "day month year" format
 * @returns {String}
 */
function formatDate(since70){
	var d = new Date();
	d.setTime(since70*1000); //milliseconds * 1000 = result in seconds
	return (d.getDate()+" "+mois(d.getMonth())+" "+d.getFullYear());
}

/**
 * dateDiff
 * @author idnext
 * @param {String} date1
 * @param {String} date2
 * @description create an array with the difference between 2 dates
 * @returns {String}[]
 */
function dateDiff(date1, date2){
    var diff = {};                          // Initialisation du retour
    var tmp = date2 - date1;
 
    tmp = Math.floor(tmp/1000);             // Nombre de secondes entre les 2 dates
    diff.sec = tmp % 60;                    // Extraction du nombre de secondes
 
    tmp = Math.floor((tmp-diff.sec)/60);    // Nombre de minutes (partie entière)
    diff.min = tmp % 60;                    // Extraction du nombre de minutes
 
    tmp = Math.floor((tmp-diff.min)/60);    // Nombre d'heures (entières)
    diff.hour = tmp % 24;                   // Extraction du nombre d'heures
     
    tmp = Math.floor((tmp-diff.hour)/24);   // Nombre de jours
    diff.day = tmp;
     
    return diff;
}

/**
 * timeSpent
 * @author idnext
 * @param {String} date
 * @description Display the time since scan query
 * @returns {String}
 */
function timeSpent(date){
	var now = new Date(); //Current Date
    
	now.toLocaleString();
	var dateparse = date.replace(/-/gi, '/');
	var d = new Date(dateparse); //Scan Date
	diff = dateDiff(d, now);
	
	if(diff.day > 0){
		return 'Il y a '+diff.day+' j';
	}
	else if(diff.hour > 0){
		return 'Il y a '+diff.hour+' h';
	}
	else if(diff.min > 0){
		return 'Il y a '+diff.min+' min';
	}
	else{
		return 'Il y a moins d\'une min';
	}
}
