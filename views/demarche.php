<script>
		box1 = new ecocompare_lightbox("shadowing1", "lightbox1");
		box2 = new ecocompare_lightbox("shadowing2", "lightbox2");
		box3 = new ecocompare_lightbox("shadowing3", "lightbox3");
</script>
<div style="font-weight : bold; text-align : center;font-size : 20px;">Référencez vos produits</div></br>

<div id="conteneur_global">
	<!--DEBUT NAVIGATION-->
	<div id="navigation">
		<div class="encours" id="onglet1" onClick="afficheOnglet (4, this, 'contenu1');">Produits concernés</div>
		<div class="onglet" id="onglet2" onClick="afficheOnglet (4, this, 'contenu2');">Fonctionnement</div>
		<div class="onglet" id="onglet3" onClick="afficheOnglet (4, this, 'contenu3');">Les avantages</div>
		<div class="onglet" id="onglet4" onClick="afficheOnglet (4, this, 'contenu4');">Rejoignez-nous</div>
	</div>
	<!--FIN NAVIGATION-->

	<!--DEBUT CONTENEURS-->
	<div id="shadowing1" onClick="box1.closebox();"></div>
	<div id="shadowing2" onClick="box2.closebox();"></div>
	<div id="shadowing3" onClick="box3.closebox();"></div>

	<!--contenu onglet1-->   
	<div class="contenu_onglet" id="contenu1">
		<p><img style="margin-left : 20px;max-width : 150px;float : right;" src="<?php $_GLOBAL['base']?>images/demarche/labels.png"/>Certains de vos produits sont certifiés d’un label ou Eco-label ou présentent des qualités environnementales, sociétales et sanitaires  intéressantes, preuve de <strong>votre engament en faveur d’un mode de production plus responsable.</strong> Faites-le savoir en référençant vos produits sur <a href="http://www.ecocompare.com" target="_blank" >www.ecocompare.com</a> !
		</p>
		</br><p><div style="float : left;height : 400px;"><br><img style="margin-right : 20px;max-width : 140px;float : left;" src="<?php $_GLOBAL['base']?>images/demarche/consommateur.png"/></div>Comme vous et vos consommateurs, nous pensons que les produits de grande consommation responsables doivent être <strong>adoptés par le plus grand nombre</strong> si l’on souhaite conserver durablement notre modèle actuel de production et de consommation. C’est pourquoi nous sommes convaincus que vos <strong>efforts doivent être valorisés</strong> auprès des consommateurs et souhaitons vous aider à le faire en vous présentant notre plateforme de référencement de produits responsables et ses outils, la plateforme ecocompare.  
		</p>	
	</div>
	<!--contenu onglet2-->
	<div class="invisible" id="contenu2">
		<p>Cette plateforme web, avec déclinaison mobile, référence gratuitement les produits de grande consommation après en avoir évalué les <strong>impacts environnementaux, sociétaux et sanitaires.</strong> Cette évaluation repose sur une <a href="#" onClick="box3.openbox();">méthodologie originale</a> et <strong>totalement transparente</strong>, dite qualitative et positive.
		</p>
		<ul>
			<li><strong>Qualitative</strong> car en lieu et place d’une boîte noire qui calcule des impacts à partir de données d’activités (par exemple, la consommation d’énergie, d’eau, etc.) nous vérifions en coproduction avec l'industriel la validation de critères donnés sur l’ensemble du cycle de vie du produit ainsi que sur les aspects sociétaux et sanitaires le concernant. 
			</li></br>
			<li><strong>Positive</strong> car nous valorisons uniquement les enjeux maîtrisés sans mettre à l’index ceux qui doivent encore être travaillés.
			</li>
		</ul></br>
		<p><div style="float : right;height : 200px;"></br><img style="margin-left : 20px;vertical-align : middle;max-width : 150px;float : right;" src="<?php $_GLOBAL['base']?>images/demarche/verteego.png"/></div>Cette méthodologie a été élaborée par une équipe d’ingénieurs spécialisés du cabinet de solutions environnementales <a href="http://www.verteego.com" target="_blank">Verteego</a>. Elle couvre l’ensemble des enjeux <strong>environnementaux, sociétaux et sanitaires</strong> qu’il convient de surveiller au cours du cycle de vie d’un produit et se fait l’écho des préoccupations actuelles des consommateurs.
		</p> 
	</div>
	<!--contenu onglet3-->
	<div class="invisible" id="contenu3">
		<p>Les avantages offerts par cette approche sont multiples : 
		</p>
		<ul>
			<li><img style="margin-left : 20px;max-width : 65px;float : right;" src="<?php $_GLOBAL['base']?>images/demarche/smartphone.png"/><strong>Côté consommateur,</strong> il est possible <strong>d’accéder aux informations concernant un produit</strong> en accédant au site web ecocompare ou <strong>en scannant le code-barres du produit</strong> via l’application mobile ecocompare (<a href="https://itunes.apple.com/fr/app/ecocompare/id393539838" target="_blank">App Store</a> & <a href="https://itunes.apple.com/fr/app/ecocompare/id393539838" target="_blank">Android</a>). Une fiche produit détaillée, par les informations de l’industriel lui-même, est alors présentée lui révélant tous les points positifs associés à ce produit.  <a href="#" onclick="box1.openbox()">En savoir + </a>
			</li>
			</br><li><div style="float : left; height : 150px;"></br><img style="margin-right : 20px;max-width : 140px;float : left;" src="<?php $_GLOBAL['base']?>images/demarche/badge.png"/></div><strong>Côté industriels,</strong> les critères constituent un outil qui vous permet de repérer vos points forts et vos points faibles dans une démarche d’amélioration continue de vos produits. La plateforme, ses application mobile, le blog, les réseaux sociaux et les réseaux partenaires d’ecocompare constituent eux une vitrine idéale pour valoriser vos marques et produits auprès de consommateurs toujours plus enclins à plus de transparence.   <a href="#" onclick="box2.openbox()">En savoir + </a>
			</li>
		</ul>
		<p>En outre, afin de faciliter et d’industrialiser au maximum le travail de référencement de vos produits qui peuvent être labelisés ou écolabelisés, <strong>une grille de correspondance entre les critères de chaque label, écolabel et ceux de la méthodologie ecocompare a été développée.</strong> Cela permet ainsi de réduire sensiblement  le temps passé au référencement de vos produits et ainsi de se concentrer sur des aspects plus importants, voire urgents.
		</p>
	</div>
	<!--contenu onglet4-->
	<div class="invisible" id="contenu4">
		<p><img style="margin-left : 20px;margin-top : 5px;max-width : 140px;float : right;" src="<?php $_GLOBAL['base']?>images/demarche/labels2.png"/>A l’heure actuelle, ce sont déjà <strong>plus de 80 marques engagées qui  ont choisi ecocompare</strong> pour recenser leurs produits responsables : Carrefour EcoPlanet, Lafuma, l’Arbre Vert, les laboratoires dermatologiques Ducray, Rainett, Etamine du Lys, Ecover, Ecodoo, Douce Nature etc…
		</p>
		<p>La démarche ecocompare c’est aussi une communauté en constante augmentation, aujourd’hui forte de <strong>plus de 6000 consommateurs, appelés éco-acteurs,</strong> qui <a target="_blank" href="http://www.ecocompare.com/ecoacteur-smartphone.html">chaque mois scannent vos produits</a>, émettent leurs avis et animent au quotidien les réseaux sociaux d’ecocompare, vous offrant ainsi de la proximité avec vos consommateurs et des retours clients pertinents et qualifiés.
		</p>
		<p>La philosophie et la démarche ecocompare reposent donc sur <strong>une coproduction entre éco-acteurs et industriels,</strong> en mettant l’accent sur <strong>le dialogue, l’échange des bonnes pratiques et la transparence</strong> pour une confiance retrouvée dans la consommation.
		</p></br></br>
		<p style="font-size : 15px;font-weight : bold;color : #98bd3e">Alors vous aussi, rejoignez ces entreprises engagées et exemplaires en nous envoyant à l’adresse <a href="mailto:support@ecocompare.com">support@ecocompare.com</a> une demande de création de compte. Pour de plus amples informations, contactez-nous à l’adresse suivante <a href="mailto:contact@ecocompare.com">contact@ecocompare.com</a> ou au 04 75 70 18 11.
		</p>
	</div>
	<!--FIN CONTENEURS-->
	
	<!-- DEBUT CONTENU LIGHTBOX 1 : en savoir + conso -->
	<div id="lightbox1">
		<div class="boxheader">Les produits sont accessibles depuis :</div></br></br></br>
		<div style="width : 420px;float : left;">
			<div style="text-align : center;font-weight : bold; font-size : 20px;">Site Web</div> 
			<img style="max-width : 420px;" src="<?php $_GLOBAL['base']?>images/demarche/fiche1.png" />
		</div>
		<div style="width : 225px;float : right;">
			<div style="text-align : center;font-weight : bold; font-size : 20px;">Application mobile/tablette</div>
			<img style="max-width : 225px;" src="<?php  $_GLOBAL['base']?>images/demarche/fiche2.png" />
		</div>
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 1 -->
	<!-- DEBUT CONTENU LIGHTBOX 2 :  en savoir + industriel-->
	<div id="lightbox2">
		<div class="boxheader">Badge Exportable Ecocompare</div></br>
		<div style="font-size : 16px;">Un badge personnalisable et paramétrable à intégrer sur votre page fabricant ou distributeur est disponible. Le badge est également imprimable sur produit.</div>
		<img style="margin-left : 20px;float : center;max-width : 600px;" src= "<?php $_GLOBAL['base']?>images/demarche/badgeexport.png" />
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 2 -->
	<!-- FIN CONTENU LIGHTBOX 3 : La méthode ecocompare -->
	<div id="lightbox3">
		<div class="boxheader">Principe de fonctionnement d'Ecocompare</div></br></br>
		<img style="margin-left : -16px;float : center;margin-top : 5px;max-width : 690px;" src= "<?php $_GLOBAL['base']?>images/demarche/methode.png" />
		<div style ="clear : both;"></div>
	</div>
	<!-- FIN CONTENU LIGHTBOX 3 -->
	</br></br>
</div>